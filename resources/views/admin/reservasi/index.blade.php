@extends('layouts.admin')

@section('title', 'Manajemen Reservasi - Admin Serenity Court')
@section('header-title', 'Daftar Reservasi')
@section('header-subtitle', 'Verifikasi pembayaran dan kelola status pemesanan')

@push('styles')
<style>
    .admin-card {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
    }
    
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .filters {
        display: flex;
        gap: 0.5rem;
    }
    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        transition: all 0.2s;
    }
    .filter-btn.active {
        background: rgba(108, 99, 255, 0.15);
        color: var(--primary-blue);
        border-color: var(--primary-blue);
    }
    .filter-btn:hover:not(.active) {
        border-color: var(--text-muted);
        color: var(--text-dark);
    }
    
    .date-filter input {
        padding: 0.5rem;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: rgba(255,255,255,0.05);
        color: var(--text-dark);
        font-family: var(--font-main);
        font-size: 0.85rem;
    }
    .date-filter input:focus { outline: none; border-color: var(--primary-blue); }
    
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
        display: inline-block;
    }
    .badge-pending { background: rgba(251,191,36,0.15); color: #FBBF24; }
    .badge-confirmed { background: rgba(108,99,255,0.15); color: var(--primary-blue); }
    .badge-selesai { background: rgba(78,204,163,0.15); color: var(--success); }
    .badge-cancelled { background: rgba(255,107,107,0.15); color: var(--secondary-blue); }
    
    .action-select {
        padding: 0.4rem;
        border-radius: 6px;
        border: 1px solid var(--border-color);
        background: var(--bg-light);
        color: var(--text-dark);
        font-size: 0.85rem;
        cursor: pointer;
    }
    .action-select:focus { outline: none; border-color: var(--primary-blue); }
    
    .btn-update {
        background: var(--primary-blue);
        color: white;
        border: none;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        cursor: pointer;
        font-weight: 500;
        transition: background 0.2s;
    }
    .btn-update:hover { background: var(--secondary-blue); }
    
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
        .filter-bar {
            align-items: stretch;
            flex-direction: column;
        }
        .filters {
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .filter-btn {
            flex: 0 0 auto;
            white-space: nowrap;
        }
        .date-filter form {
            align-items: stretch !important;
            flex-direction: column;
        }
        .date-filter input {
            width: 100%;
        }
        td form {
            min-width: 190px;
        }
        .action-select,
        .btn-update {
            min-height: 36px;
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
    <div class="filter-bar">
        <div class="filters">
            <a href="{{ route('admin.reservasi.index') }}" class="filter-btn {{ $filter == 'semua' ? 'active' : '' }}">Semua</a>
            <a href="{{ route('admin.reservasi.index', ['filter' => 'pending']) }}" class="filter-btn {{ $filter == 'pending' ? 'active' : '' }}">Perlu Verifikasi</a>
            <a href="{{ route('admin.reservasi.index', ['filter' => 'confirmed']) }}" class="filter-btn {{ $filter == 'confirmed' ? 'active' : '' }}">Terkonfirmasi</a>
            <a href="{{ route('admin.reservasi.index', ['filter' => 'selesai']) }}" class="filter-btn {{ $filter == 'selesai' ? 'active' : '' }}">Selesai</a>
        </div>
        <div class="date-filter">
            <form action="{{ route('admin.reservasi.index') }}" method="GET" style="display:flex; gap:0.5rem; align-items:center;">
                <input type="hidden" name="filter" value="{{ $filter }}">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" onchange="this.form.submit()">
                @if(request('tanggal'))
                    <a href="{{ route('admin.reservasi.index', ['filter' => $filter]) }}" style="color:var(--secondary-blue); font-size:0.8rem; text-decoration:none;"><i class="fa-solid fa-xmark"></i> Reset</a>
                @endif
            </form>
        </div>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Lapangan & Waktu</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservasi as $r)
                <tr>
                    <td style="color:var(--text-muted); font-size:0.85rem;">#{{ str_pad($r->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div style="font-weight:600; color:var(--text-dark);">{{ $r->user->name }}</div>
                        <div style="font-size:0.8rem; color:var(--text-muted);">{{ $r->user->nomor_telepon ?? $r->user->email }}</div>
                    </td>
                    <td>
                        <div style="font-weight:500;">{{ $r->lapangan->nama }}</div>
                        <div style="font-size:0.85rem; color:var(--text-muted); margin-top:2px;">
                            {{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }} | {{ substr($r->jam_mulai,0,5) }} - {{ substr($r->jam_selesai,0,5) }}
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600; color:var(--success);">Rp{{ number_format($r->total_harga, 0, ',', '.') }}</div>
                        <div style="font-size:0.8rem; color:var(--text-muted); margin-top:2px; text-transform:uppercase;">
                            {{ $r->pembayaran ? str_replace('_', ' ', $r->pembayaran->metode) : '-' }}
                        </div>
                    </td>
                    <td>
                        @if($r->status === 'pending')
                            <span class="status-badge badge-pending">Pending Verifikasi</span>
                        @elseif($r->status === 'confirmed')
                            <span class="status-badge badge-confirmed">Dikonfirmasi</span>
                        @elseif($r->status === 'selesai')
                            <span class="status-badge badge-selesai">Selesai</span>
                        @else
                            <span class="status-badge badge-cancelled">Dibatalkan</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.reservasi.updateStatus', $r->id) }}" method="POST" style="display:flex; gap:0.5rem;">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="action-select">
                                <option value="pending" {{ $r->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $r->status == 'confirmed' ? 'selected' : '' }}>Konfirmasi</option>
                                <option value="selesai" {{ $r->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $r->status == 'cancelled' ? 'selected' : '' }}>Batalkan</option>
                            </select>
                            <button type="submit" class="btn-update">Set</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:3rem 1rem; color:var(--text-muted);">
                        <i class="fa-solid fa-clipboard-list mb-1" style="font-size:2rem; opacity:0.5;"></i><br>
                        Belum ada data reservasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
