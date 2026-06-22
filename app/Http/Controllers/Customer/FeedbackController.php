<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        return redirect(route('customer.riwayat') . '#feedback');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservasi_id' => 'required|exists:reservasi,id',
            'bintang' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string'
        ]);

        $reservasi = Reservasi::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->whereDoesntHave('feedback')
            ->findOrFail($request->reservasi_id);

        Feedback::create([
            'user_id' => Auth::id(),
            'reservasi_id' => $reservasi->id,
            'bintang' => $request->bintang,
            'ulasan' => $request->ulasan
        ]);

        return redirect(route('customer.riwayat') . '#feedback')
            ->with('success', 'Terima kasih! Ulasan Anda sangat berarti bagi kami.');
    }
}
