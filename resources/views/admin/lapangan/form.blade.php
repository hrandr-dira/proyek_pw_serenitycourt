@extends('layouts.admin')

@section('title', $mode == 'create' ? 'Tambah Lapangan - Admin Serenity Court' : 'Edit Lapangan - Admin Serenity Court')
@section('header-title', $mode == 'create' ? 'Tambah Lapangan Baru' : 'Edit Lapangan')
@section('header-subtitle', 'Isi detail informasi lapangan')

@push('styles')
<style>
    .admin-card {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
        max-width: 480px;
        margin: 0 auto;
        width: 100%;
        box-sizing: border-box;
    }
    
    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-dark);
        font-size: 0.95rem;
    }
    .form-control {
        width: 100%;
        box-sizing: border-box;
        padding: 0.8rem 1rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-dark);
        font-family: var(--font-main);
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-blue);
        background: rgba(255, 255, 255, 0.1);
    }
    
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1em;
    }
    select.form-control option { background: var(--bg-light); color: var(--text-dark); }
    
    .form-row {
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    .form-col {
        flex: 1;
        width: 100%;
        box-sizing: border-box;
    }
    
    .btn-submit {
        background: var(--primary-blue);
        color: white;
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        box-sizing: border-box;
        gap: 0.5rem;
        transition: transform 0.2s, background-color 0.2s;
    }
    .btn-submit:hover {
        background: var(--secondary-blue);
        transform: translateY(-2px);
    }
    
    .btn-cancel {
        background: transparent;
        color: var(--text-muted);
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        border: 1px solid var(--border-color);
        transition: color 0.2s, border-color 0.2s;
        text-align: center;
        display: block;
        width: 100%;
        box-sizing: border-box;
    }
    .btn-cancel:hover {
        color: var(--text-dark);
        border-color: var(--text-dark);
    }
    
    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }
    
    .text-danger { color: var(--secondary-blue); font-size: 0.85rem; margin-top: 0.25rem; display: block; }
</style>
@endpush

@section('content')

<div class="admin-card">
    <form action="{{ $mode == 'create' ? route('admin.lapangan.store') : route('admin.lapangan.update', $lapangan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($mode == 'edit')
            @method('PUT')
        @endif
        
        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Nama Lapangan <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $lapangan->nama ?? '') }}" required placeholder="Contoh: Futsal Court 1">
                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="jenis" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="futsal" {{ old('jenis', $lapangan->jenis ?? '') == 'futsal' ? 'selected' : '' }}>Futsal</option>
                        <option value="badminton" {{ old('jenis', $lapangan->jenis ?? '') == 'badminton' ? 'selected' : '' }}>Badminton</option>
                        <option value="basket" {{ old('jenis', $lapangan->jenis ?? '') == 'basket' ? 'selected' : '' }}>Basket</option>
                    </select>
                    @error('jenis') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Lapangan</label>
            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan spesifikasi lapangan...">{{ old('deskripsi', $lapangan->deskripsi ?? '') }}</textarea>
            @error('deskripsi') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Harga Per Jam (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_per_jam" class="form-control" value="{{ old('harga_per_jam', $lapangan->harga_per_jam ?? '') }}" required placeholder="Contoh: 150000">
                    @error('harga_per_jam') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Fasilitas (pisahkan koma)</label>
                    <input type="text" name="fasilitas" class="form-control" value="{{ old('fasilitas', $lapangan->fasilitas ?? '') }}" placeholder="Indoor, 5 vs 5, Karpet Vinyl">
                    @error('fasilitas') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Jam Buka <span class="text-danger">*</span></label>
                    <input type="time" name="jam_buka" class="form-control" value="{{ old('jam_buka', isset($lapangan) ? substr($lapangan->jam_buka,0,5) : '08:00') }}" required>
                    @error('jam_buka') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Jam Tutup <span class="text-danger">*</span></label>
                    <input type="time" name="jam_tutup" class="form-control" value="{{ old('jam_tutup', isset($lapangan) ? substr($lapangan->jam_tutup,0,5) : '22:00') }}" required>
                    @error('jam_tutup') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Foto Lapangan</label>
                    @if($mode === 'edit' && $lapangan->foto)
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset(ltrim($lapangan->foto, '/')) }}" alt="Foto Saat Ini" style="width:100%; height:140px; object-fit:cover; border-radius:8px; border:1px solid var(--border-color);">
                            <div style="font-size:11px; color:var(--text-muted); margin-top:5px;">Foto saat ini. Upload baru untuk menggantinya.</div>
                        </div>
                    @endif
                    <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/webp" style="padding:0.5rem;">
                    <div style="font-size:11px; color:var(--text-muted); margin-top:5px;">Format: JPG, PNG, WEBP. Maks: 2MB.</div>
                    @error('foto') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="aktif" {{ old('status', $lapangan->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $lapangan->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif (Sedang Perbaikan)</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-save"></i> {{ $mode == 'create' ? 'Simpan Lapangan' : 'Simpan Perubahan' }}
            </button>
            <a href="{{ route('admin.lapangan.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

@endsection
