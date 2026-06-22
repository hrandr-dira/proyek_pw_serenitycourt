@extends('layouts.customer')

@section('title', 'Beranda - Serenity Court')

@push('styles')
<style>
    .section-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text-dark);
    }
    
    /* Courts Grid */
    .courts-grid {
        display: flex;
        gap: 20px;
        margin-bottom: 40px;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    .court-card {
        flex: 0 0 calc(33.333% - 14px);
        min-width: 200px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        background-color: var(--white);
    }
    .court-img {
        height: 140px;
        width: 100%;
        background-color: #E2E8F0;
    }
    .court-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .court-info {
        padding: 15px;
    }
    .court-name {
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 5px;
    }
    .court-price {
        font-size: 12px;
        color: var(--text-muted);
    }

    /* Reservations List */
    .reservation-card {
        display: flex;
        align-items: center;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 15px;
        background-color: var(--white);
        margin-bottom: 15px;
    }
    .res-img {
        width: 120px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        margin-right: 20px;
    }
    .res-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .res-details {
        flex: 1;
    }
    .res-title {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 10px;
    }
    .res-meta {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 13px;
        color: var(--text-muted);
    }
    .res-meta i {
        width: 20px;
    }
    .res-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }
    .badge-status {
        background-color: var(--light-blue);
        color: var(--text-dark);
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }
    .btn-action {
        background-color: var(--primary-blue);
        color: var(--white);
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }
    .stats-strip {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }
    .stat-card {
        flex: 1;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 15px;
        background: var(--white);
    }
    @media (max-width: 768px) {
        .section-title {
            font-size: 15px;
            margin-bottom: 14px;
        }
        .stats-strip {
            gap: 10px;
            margin-bottom: 24px;
        }
        .stat-card {
            padding: 14px;
            min-width: 0;
        }
        .courts-grid {
            gap: 12px;
            margin-bottom: 28px;
        }
        .court-card {
            flex-basis: 78%;
            min-width: 220px;
        }
        .reservation-card {
            align-items: stretch;
            flex-direction: column;
            gap: 12px;
            padding: 12px;
        }
        .res-img {
            width: 100%;
            height: 150px;
            margin-right: 0;
        }
        .res-actions {
            align-items: flex-start;
            width: 100%;
        }
        .btn-action {
            width: 100%;
            text-align: center;
        }
    }
    @media (max-width: 420px) {
        .stats-strip {
            flex-direction: column;
        }
        .court-card {
            flex-basis: 86%;
        }
    }
</style>
@endpush

@section('content')

@if(session('success'))
    <div style="background:rgba(82,196,26,0.1); color:#52C41A; padding:12px 15px; border-radius:6px; margin-bottom:20px; font-weight:500;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

<!-- Stats Strip -->
<div class="stats-strip">
    <div class="stat-card">
        <div style="font-size:22px; font-weight:700; color:var(--primary-blue);">{{ $totalAktif }}</div>
        <div style="font-size:12px; color:var(--text-muted);">Reservasi Aktif</div>
    </div>
    <div class="stat-card">
        <div style="font-size:18px; font-weight:700; color:var(--text-dark);">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
        <div style="font-size:12px; color:var(--text-muted);">Total Pengeluaran</div>
    </div>
</div>

<!-- Lapangan Tersedia -->
<h3 class="section-title">Lapangan Tersedia Hari Ini</h3>
<div class="courts-grid">
    <div class="court-card">
        <div class="court-img">
            <img src="https://images.unsplash.com/photo-1518605368461-1ee71abed5de?q=80&w=600&auto=format&fit=crop" alt="Futsal">
        </div>
        <div class="court-info">
            <div class="court-name">Futsal</div>
            <div class="court-price">Mulai dari<br>Rp 150.000/Jam</div>
        </div>
    </div>
    <div class="court-card">
        <div class="court-img">
            <img src="https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?q=80&w=600&auto=format&fit=crop" alt="Badminton">
        </div>
        <div class="court-info">
            <div class="court-name">Badminton</div>
            <div class="court-price">Mulai dari<br>Rp 60.000/Jam</div>
        </div>
    </div>
    <div class="court-card">
        <div class="court-img">
            <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=600&auto=format&fit=crop" alt="Basket">
        </div>
        <div class="court-info">
            <div class="court-name">Basket</div>
            <div class="court-price">Mulai dari<br>Rp 200.000/Jam</div>
        </div>
    </div>
</div>

<!-- Reservasi Mendatang -->
<h3 class="section-title">Reservasi Mendatang</h3>

@forelse($reservasiMendatang as $r)
<div class="reservation-card">
    <div class="res-img">
        <img src="{{ $r->lapangan->foto ? asset(ltrim($r->lapangan->foto, '/')) : 'https://images.unsplash.com/photo-1518605368461-1ee71abed5de?q=80&w=400&auto=format&fit=crop' }}" alt="{{ $r->lapangan->nama }}">
    </div>
    <div class="res-details">
        <div class="res-title">{{ $r->lapangan->nama }}</div>
        <div class="res-meta">
            <div><i class="fa-regular fa-calendar"></i> {{ strtoupper(\Carbon\Carbon::parse($r->tanggal)->translatedFormat('l, d M Y')) }}</div>
            <div><i class="fa-regular fa-clock"></i> {{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</div>
        </div>
    </div>
    <div class="res-actions">
        @if($r->status === 'confirmed')
            <div class="badge-status" style="background:#E6F7FF; color:#0066CC;">Dikonfirmasi</div>
        @elseif($r->status === 'pending')
            <div class="badge-status" style="background:#FFFBE6; color:#D97706;">Menunggu Pembayaran</div>
            <a href="{{ route('customer.pembayaran', $r->id) }}" class="btn-action">Bayar Sekarang</a>
        @endif
    </div>
</div>
@empty
<div style="text-align:center; padding:30px; color:var(--text-muted); border:1px dashed var(--border-color); border-radius:8px;">
    Belum ada reservasi mendatang. <a href="{{ route('customer.lapangan') }}" style="color:var(--primary-blue); font-weight:600;">Pesan sekarang!</a>
</div>
@endforelse

@endsection
