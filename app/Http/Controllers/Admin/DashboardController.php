<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik Utama
        $totalReservasi = Reservasi::count();
        $reservasiHariIni = Reservasi::whereDate('created_at', Carbon::today())->count();
        $totalLapangan = Lapangan::where('status', 'aktif')->count();
        $totalPelanggan = User::where('role', 'customer')->count();

        // Total pendapatan dari reservasi berstatus confirmed/selesai
        $totalPendapatan = Reservasi::whereIn('status', ['confirmed', 'selesai'])->sum('total_harga');

        // Reservasi terbaru (10 data)
        $reservasiTerbaru = Reservasi::with(['user', 'lapangan'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Feedback terbaru (5 data)
        $feedbackTerbaru = Feedback::with(['user', 'reservasi.lapangan'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'user',
            'totalReservasi',
            'reservasiHariIni',
            'totalLapangan',
            'totalPelanggan',
            'totalPendapatan',
            'reservasiTerbaru',
            'feedbackTerbaru'
        ));
    }
}
