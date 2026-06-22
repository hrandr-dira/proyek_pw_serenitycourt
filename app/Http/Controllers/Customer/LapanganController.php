<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori', 'semua');
        
        $query = Lapangan::where('status', 'aktif');
        
        if ($kategori !== 'semua') {
            $query->where('jenis', strtolower($kategori));
        }
        
        $lapangan = $query->get();
        
        return view('customer.lapangan', compact('lapangan', 'kategori'));
    }
}
