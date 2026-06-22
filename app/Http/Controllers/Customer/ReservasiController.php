<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservasiController extends Controller
{
    // Menampilkan halaman Pilih Jadwal (Booking)
    public function booking(Request $request, $id = null)
    {
        // Jika tidak ada ID lapangan, redirect ke daftar lapangan
        if (!$id) {
            return redirect()->route('customer.lapangan');
        }

        $lapangan = Lapangan::findOrFail($id);
        
        // Default tanggal adalah hari ini
        $tanggalPilih = $request->query('tanggal', date('Y-m-d'));
        
        // Generate 7 hari ke depan untuk selector tanggal
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->addDays($i);
            $dates[] = [
                'full' => $date->format('Y-m-d'),
                'day' => $date->translatedFormat('l'),
                'date' => $date->format('j M'),
                'is_active' => $date->format('Y-m-d') === $tanggalPilih
            ];
        }

        // Generate time slots dari jam buka sampai jam tutup
        // Asumsi jam buka '08:00:00' dan tutup '22:00:00'
        $jamBuka = (int) substr($lapangan->jam_buka, 0, 2);
        $jamTutup = (int) substr($lapangan->jam_tutup, 0, 2);
        
        $timeSlots = [];
        
        // Ambil data reservasi yang sudah ada pada tanggal ini untuk lapangan ini
        $bookedSlots = Reservasi::where('lapangan_id', $id)
            ->where('tanggal', $tanggalPilih)
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();
            
        for ($i = $jamBuka; $i < $jamTutup; $i++) {
            $start = sprintf('%02d:00', $i);
            $end = sprintf('%02d:00', $i + 1);
            
            // Cek apakah slot ini sudah di-booking
            $isBooked = false;
            foreach ($bookedSlots as $book) {
                $bookStart = substr($book->jam_mulai, 0, 5);
                if ($start === $bookStart) {
                    $isBooked = true;
                    break;
                }
            }
            
            // Cek apakah waktu sudah lewat jika tanggalnya hari ini
            $isPast = false;
            if ($tanggalPilih === date('Y-m-d') && $i <= (int) date('H')) {
                $isPast = true;
            }
            
            $timeSlots[] = [
                'time' => "$start - $end",
                'start_time' => $start,
                'end_time' => $end,
                'status' => ($isBooked || $isPast) ? 'terpesan' : 'tersedia'
            ];
        }

        return view('customer.booking', compact('lapangan', 'dates', 'timeSlots', 'tanggalPilih'));
    }

    // Proses submit booking awal (membuat status pending)
    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'tanggal'     => 'required|date|after_or_equal:today',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
        ]);

        $lapangan = Lapangan::findOrFail($request->lapangan_id);

        // Normalize time format to HH:MM:SS for DB comparison
        $jamMulai   = substr($request->jam_mulai, 0, 5) . ':00';
        $jamSelesai = substr($request->jam_selesai, 0, 5) . ':00';

        // Validasi: tanggal tidak di masa lalu
        $tglPilih = Carbon::parse($request->tanggal)->startOfDay();
        if ($tglPilih->lt(Carbon::today())) {
            return back()->with('error', 'Tanggal yang dipilih sudah lewat.');
        }

        // Validasi double booking
        $isBooked = Reservasi::where('lapangan_id', $lapangan->id)
            ->where('tanggal', $request->tanggal)
            ->where('jam_mulai', $jamMulai)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($isBooked) {
            return back()->with('error', 'Maaf, jadwal tersebut baru saja dipesan oleh orang lain. Silakan pilih jadwal lain.');
        }

        // Hitung durasi (selalu 1 jam per slot)
        $durasi = 1;
        $totalHarga = $lapangan->harga_per_jam * $durasi;

        $reservasi = Reservasi::create([
            'user_id'     => Auth::id(),
            'lapangan_id' => $lapangan->id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'durasi'      => $durasi,
            'total_harga' => $totalHarga,
            'status'      => 'pending',
        ]);

        // Redirect ke halaman pembayaran
        return redirect()->route('customer.pembayaran', $reservasi->id);
    }

    // Menampilkan halaman pembayaran
    public function pembayaran($id = null)
    {
        if (!$id) {
            return redirect()->route('customer.riwayat');
        }

        $reservasi = Reservasi::with('lapangan')->where('user_id', Auth::id())->findOrFail($id);
        
        // Jika status sudah confirmed/selesai, tidak perlu bayar lagi
        if ($reservasi->status !== 'pending') {
            return redirect()->route('customer.riwayat')->with('info', 'Reservasi ini sudah diproses.');
        }

        return view('customer.pembayaran', compact('reservasi'));
    }

    // Proses konfirmasi pembayaran - menyimpan data pembayaran
    public function prosesPembayaran(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:transfer,ewallet,cash'
        ]);

        $reservasi = Reservasi::where('user_id', Auth::id())->findOrFail($id);
        
        // Map payment method ke format enum di tabel pembayaran
        $metodeMap = [
            'transfer' => 'transfer_bank',
            'ewallet' => 'e_wallet',
            'cash' => 'cash',
        ];

        // Buat record pembayaran (status pending menunggu konfirmasi admin)
        Pembayaran::create([
            'reservasi_id' => $reservasi->id,
            'metode' => $metodeMap[$request->payment_method],
            'jumlah' => $reservasi->total_harga,
            'status' => 'pending',
        ]);

        // Update status reservasi menunggu verifikasi admin
        $reservasi->update(['status' => 'confirmed']);

        return redirect()->route('customer.riwayat')->with('success', 'Pembayaran berhasil! Reservasi Anda sedang diproses oleh admin.');
    }

    // Menampilkan riwayat reservasi
    public function riwayat(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        
        $query = Reservasi::with('lapangan')->where('user_id', Auth::id())->orderBy('created_at', 'desc');
        
        if ($filter === 'selesai') {
            $query->whereIn('status', ['selesai']);
        } elseif ($filter === 'dibatalkan') {
            $query->where('status', 'cancelled');
        }
        // Jika 'semua', tampilkan semua status
        
        $riwayat = $query->get();

        $reservasiFeedback = Reservasi::with('lapangan')
            ->where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->whereDoesntHave('feedback')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('customer.riwayat', compact('riwayat', 'filter', 'reservasiFeedback'));
    }
}
