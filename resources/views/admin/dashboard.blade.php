@extends('layouts.admin')

@section('title', 'Admin Dashboard - Serenity Court')
@section('header-title', 'Dashboard Overview')
@section('header-subtitle', 'Ringkasan aktivitas sistem hari ini')

@push('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        border-left: 4px solid transparent;
    }
    .stat-card:hover { transform: translateY(-3px); }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .icon-primary { background: rgba(108, 99, 255, 0.15); color: var(--primary-blue); }
    .icon-success { background: rgba(78, 204, 163, 0.15); color: var(--success); }
    .icon-warning { background: rgba(251, 191, 36, 0.15); color: var(--warning); }
    .icon-accent { background: rgba(255, 107, 107, 0.15); color: var(--secondary-blue); }
    
    .stat-info h3 { font-size: 1.6rem; margin-bottom: 0.1rem; }
    .stat-info p { color: var(--text-muted); font-size: 0.85rem; }

    .card-border-primary { border-left-color: var(--primary-blue); }
    .card-border-success { border-left-color: var(--success); }
    .card-border-warning { border-left-color: var(--warning); }
    .card-border-accent { border-left-color: var(--secondary-blue); }
    
    .recent-section {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
    }
    .table-responsive { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
    th, td { padding: 1rem; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); }
    th { color: var(--text-muted); font-weight: 500; font-size: 0.9rem; }
    tr:last-child td { border-bottom: none; }
    .status-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-pending { background: rgba(251,191,36,0.15); color: #FBBF24; }
    .badge-confirmed { background: rgba(108,99,255,0.15); color: var(--primary-blue); }
    .badge-selesai { background: rgba(78,204,163,0.15); color: var(--success); }
    .badge-cancelled { background: rgba(255,107,107,0.15); color: var(--secondary-blue); }
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .stat-card {
            padding: 1rem;
            gap: 1rem;
        }
        .stat-icon {
            width: 44px;
            height: 44px;
            font-size: 1.2rem;
        }
        .stat-info h3 {
            font-size: 1.35rem;
            word-break: break-word;
        }
        .recent-section {
            padding: 1rem;
        }
        .recent-section > div:first-child {
            align-items: flex-start !important;
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="stats-grid">
    <div class="glass-card stat-card card-border-primary">
        <div class="stat-icon icon-primary"><i class="fa-solid fa-calendar-check"></i></div>
        <div class="stat-info">
            <h3>{{ $reservasiHariIni }}</h3>
            <p>Booking Hari Ini</p>
        </div>
    </div>
    
    <div class="glass-card stat-card card-border-warning">
        <div class="stat-icon icon-warning"><i class="fa-solid fa-layer-group"></i></div>
        <div class="stat-info">
            <h3>{{ $totalReservasi }}</h3>
            <p>Total Reservasi</p>
        </div>
    </div>
    
    <div class="glass-card stat-card card-border-success">
        <div class="stat-icon icon-success"><i class="fa-solid fa-wallet"></i></div>
        <div class="stat-info">
            <h3>Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            <p>Total Pendapatan</p>
        </div>
    </div>
    
    <div class="glass-card stat-card card-border-accent">
        <div class="stat-icon icon-accent"><i class="fa-solid fa-users"></i></div>
        <div class="stat-info">
            <h3>{{ $totalPelanggan }}</h3>
            <p>Total Customer</p>
        </div>
    </div>
</div>

<div class="recent-section mt-4">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem;">
        <h3>Booking Terbaru</h3>
        <a href="{{ route('admin.reservasi.index') }}" style="font-size:0.9rem; font-weight:500; color:var(--primary-blue); text-decoration:none;">
            Lihat Semua <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Lapangan</th>
                    <th>Jadwal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservasiTerbaru as $r)
                <tr>
                    <td style="color:var(--text-muted); font-size:0.85rem;">#{{ $r->id }}</td>
                    <td>
                        <div style="font-weight:600;">{{ $r->user->name }}</div>
                        <div style="font-size:0.8rem; color:var(--text-muted);">{{ $r->user->email }}</div>
                    </td>
                    <td>{{ $r->lapangan->nama }}</td>
                    <td>
                        <div>{{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }}</div>
                        <div style="font-size:0.8rem; color:var(--text-muted);">{{ substr($r->jam_mulai,0,5) }} - {{ substr($r->jam_selesai,0,5) }}</div>
                    </td>
                    <td style="font-weight:600;">Rp{{ number_format($r->total_harga, 0, ',', '.') }}</td>
                    <td>
                        @if($r->status === 'pending')
                            <span class="status-badge badge-pending">Pending</span>
                        @elseif($r->status === 'confirmed')
                            <span class="status-badge badge-confirmed">Dikonfirmasi</span>
                        @elseif($r->status === 'selesai')
                            <span class="status-badge badge-selesai">Selesai</span>
                        @else
                            <span class="status-badge badge-cancelled">Dibatalkan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:3rem 1rem; color:var(--text-muted);">
                        <i class="fa-solid fa-inbox mb-1" style="font-size:2rem; opacity:0.5;"></i><br>
                        Belum ada reservasi baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="recent-section mt-4">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
        <h3>Ulasan Terbaru</h3>
    </div>
    
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:1.5rem;">
        @forelse($feedbackTerbaru as $f)
        <div style="background:var(--bg-light); padding:1.5rem; border-radius:12px; border:1px solid var(--border-color);">
            <div style="display:flex; justify-content:space-between; margin-bottom:1rem;">
                <div>
                    <div style="font-weight:600; color:var(--text-dark);">{{ $f->user->name }}</div>
                    <div style="font-size:0.8rem; color:var(--text-muted);">{{ $f->reservasi->lapangan->nama }} | {{ \Carbon\Carbon::parse($f->created_at)->diffForHumans() }}</div>
                </div>
                <div style="color:#FBBF24; font-size:0.9rem;">
                    @for($i=1; $i<=5; $i++)
                        @if($i <= $f->bintang)
                            <i class="fa-solid fa-star"></i>
                        @else
                            <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
                </div>
            </div>
            <div style="font-size:0.9rem; color:var(--text-muted); line-height:1.5;">
                "{{ $f->ulasan ?: 'Tidak ada ulasan tertulis.' }}"
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align:center; padding:2rem; color:var(--text-muted); border:1px dashed var(--border-color); border-radius:8px;">
            Belum ada ulasan dari pelanggan.
        </div>
        @endforelse
    </div>
</div>
@endsection
