<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::orderBy('jenis')->orderBy('nama')->get();
        return view('admin.lapangan.index', compact('lapangan'));
    }

    public function create()
    {
        return view('admin.lapangan.form', ['lapangan' => null, 'mode' => 'create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis'        => 'required|in:futsal,badminton,basket',
            'nama'         => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'fasilitas'    => 'nullable|string',
            'harga_per_jam'=> 'required|numeric|min:0',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'       => 'required|in:aktif,nonaktif',
            'jam_buka'     => 'required',
            'jam_tutup'    => 'required',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('lapangan', 'public');
            $data['foto'] = '/storage/' . $path;
        }

        Lapangan::create($data);

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil ditambahkan!');
    }

    public function edit(Lapangan $lapangan)
    {
        return view('admin.lapangan.form', ['lapangan' => $lapangan, 'mode' => 'edit']);
    }

    public function update(Request $request, Lapangan $lapangan)
    {
        $request->validate([
            'jenis'        => 'required|in:futsal,badminton,basket',
            'nama'         => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'fasilitas'    => 'nullable|string',
            'harga_per_jam'=> 'required|numeric|min:0',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'       => 'required|in:aktif,nonaktif',
            'jam_buka'     => 'required',
            'jam_tutup'    => 'required',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada dan merupakan file lokal
            if ($lapangan->foto && str_starts_with($lapangan->foto, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $lapangan->foto);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('foto')->store('lapangan', 'public');
            $data['foto'] = '/storage/' . $path;
        }

        $lapangan->update($data);

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil diperbarui!');
    }

    public function destroy(Lapangan $lapangan)
    {
        $lapangan->delete();
        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil dihapus!');
    }
}
