<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jumlah total reservasi aktif (pending/confirmed)
        $totalAktif = Reservasi::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();

        // Total pengeluaran (reservasi yg sudah confirmed/selesai)
        $totalPengeluaran = Reservasi::where('user_id', $user->id)
            ->whereIn('status', ['confirmed', 'selesai'])
            ->sum('total_harga');

        // Reservasi mendatang (max 3)
        $reservasiMendatang = Reservasi::with('lapangan')
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->take(3)
            ->get();

        return view('customer.dashboard', compact(
            'user',
            'totalAktif',
            'totalPengeluaran',
            'reservasiMendatang'
        ));
    }
}
