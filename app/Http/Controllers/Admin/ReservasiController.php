<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $tanggal = $request->query('tanggal');

        $query = Reservasi::with(['user', 'lapangan', 'pembayaran'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'asc');

        if ($filter === 'pending') {
            $query->where('status', 'pending');
        } elseif ($filter === 'confirmed') {
            $query->where('status', 'confirmed');
        } elseif ($filter === 'selesai') {
            $query->where('status', 'selesai');
        } elseif ($filter === 'cancelled') {
            $query->where('status', 'cancelled');
        }

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        $reservasi = $query->get();

        return view('admin.reservasi.index', compact('reservasi', 'filter', 'tanggal'));
    }

    public function updateStatus(Request $request, Reservasi $reservasi)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,selesai,cancelled'
        ]);

        $reservasi->update(['status' => $request->status]);

        // Jika ada pembayaran dan status berubah ke selesai, verifikasi pembayaran
        if ($request->status === 'selesai' && $reservasi->pembayaran) {
            $reservasi->pembayaran->update([
                'status' => 'verified',
                'verified_at' => Carbon::now(),
            ]);
        }

        $statusLabel = [
            'pending'   => 'Menunggu',
            'confirmed' => 'Dikonfirmasi',
            'selesai'   => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ][$request->status];

        return redirect()->route('admin.reservasi.index')->with('success', "Status reservasi berhasil diubah menjadi {$statusLabel}!");
    }
}
