@extends('layouts.admin')

@section('title', 'Manajemen Lapangan - Admin Serenity Court')
@section('header-title', 'Data Lapangan')
@section('header-subtitle', 'Kelola daftar lapangan beserta harga dan fasilitas')

@push('styles')
<style>
    .admin-card {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
    }
    
    .action-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .btn-add {
        background: var(--primary-blue);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: transform 0.2s, background-color 0.2s;
    }
    .btn-add:hover {
        background: var(--secondary-blue);
        transform: translateY(-2px);
    }
    
    .table-responsive { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 1rem; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); }
    th { color: var(--text-muted); font-weight: 500; font-size: 0.9rem; text-transform: uppercase; }
    tr:last-child td { border-bottom: none; }
    
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-aktif { background: rgba(78, 204, 163, 0.15); color: var(--success); }
    .badge-nonaktif { background: rgba(255, 107, 107, 0.15); color: var(--secondary-blue); }
    
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: background-color 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-edit { background: rgba(108, 99, 255, 0.15); color: var(--primary-blue); }
    .btn-edit:hover { background: var(--primary-blue); color: white; }
    
    .btn-delete { background: rgba(255, 107, 107, 0.15); color: var(--secondary-blue); }
    .btn-delete:hover { background: var(--secondary-blue); color: white; }
    
    .court-thumb {
        width: 60px;
        height: 40px;
        border-radius: 4px;
        object-fit: cover;
    }
    
    .alert-success {
        background: rgba(78, 204, 163, 0.15);
        color: var(--success);
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--success);
    }
    @media (max-width: 768px) {
        .admin-card {
            padding: 1rem;
        }
        .action-header {
            align-items: stretch;
            flex-direction: column;
            gap: 1rem;
        }
        .btn-add {
            justify-content: center;
            width: 100%;
        }
        .action-buttons {
            min-width: 76px;
        }
        .court-thumb {
            width: 74px;
            height: 50px;
        }
    }
</style>
@endpush

@section('content')

@if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

<div class="admin-card">
    <div class="action-header">
        <h3 style="margin:0;">Daftar Lapangan</h3>
        <a href="{{ route('admin.lapangan.create') }}" class="btn-add">
            <i class="fa-solid fa-plus"></i> Tambah Lapangan
        </a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="80">Foto</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga/Jam</th>
                    <th>Jam Operasional</th>
                    <th>Status</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lapangan as $l)
                <tr>
                    <td>
                        <img src="{{ $l->foto ? asset(ltrim($l->foto, '/')) : 'https://images.unsplash.com/photo-1518605368461-1ee71abed5de?q=80&w=200&auto=format&fit=crop' }}" alt="thumb" class="court-thumb">
                    </td>
                    <td>
                        <div style="font-weight:600; color:var(--text-dark);">{{ $l->nama }}</div>
                        <div style="font-size:0.8rem; color:var(--text-muted); margin-top:4px;">{{ Str::limit($l->deskripsi, 40) }}</div>
                    </td>
                    <td style="text-transform: capitalize;">{{ $l->jenis }}</td>
                    <td style="font-weight:600; color:var(--success);">Rp{{ number_format($l->harga_per_jam, 0, ',', '.') }}</td>
                    <td style="font-size:0.9rem;">{{ substr($l->jam_buka,0,5) }} - {{ substr($l->jam_tutup,0,5) }}</td>
                    <td>
                        <span class="status-badge {{ $l->status == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                            {{ ucfirst($l->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.lapangan.edit', $l->id) }}" class="btn-icon btn-edit" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.lapangan.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:3rem 1rem; color:var(--text-muted);">
                        <i class="fa-solid fa-layer-group mb-1" style="font-size:2rem; opacity:0.5;"></i><br>
                        Belum ada data lapangan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
