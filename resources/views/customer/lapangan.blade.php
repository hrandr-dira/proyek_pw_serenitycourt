@extends('layouts.customer')

@section('title', 'Daftar Lapangan - Serenity Court')

@push('styles')
<style>
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
    }
    .page-subtitle {
        font-size: 14px;
        color: var(--secondary-blue);
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .filters {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
    }
    .filter-btn {
        padding: 6px 16px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .filter-btn.active {
        background-color: var(--primary-blue);
        color: var(--white);
    }
    .filter-btn:not(.active) {
        background-color: #E2E8F0;
        color: var(--text-dark);
    }
    
    .court-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .court-card-horizontal {
        display: flex;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background-color: var(--white);
        overflow: hidden;
    }
    .court-image {
        width: 200px;
        min-width: 200px;
        height: 180px;
    }
    .court-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .court-content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .court-name {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .court-desc {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 15px;
        line-height: 1.5;
    }
    .court-features {
        display: flex;
        gap: 15px;
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: auto; /* Push price and button to bottom */
    }
    .court-features i {
        margin-right: 5px;
    }
    .court-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }
    .court-price {
        font-weight: 700;
        font-size: 14px;
    }
    .btn-lihat-jadwal {
        background-color: var(--primary-blue);
        color: var(--white);
        padding: 8px 20px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
    }
    @media (max-width: 768px) {
        .page-title {
            font-size: 24px;
        }
        .filters {
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .filter-btn {
            white-space: nowrap;
        }
        .court-card-horizontal {
            flex-direction: column;
        }
        .court-image {
            width: 100%;
            min-width: 0;
            height: 180px;
        }
        .court-content {
            padding: 16px;
        }
        .court-features {
            flex-wrap: wrap;
            gap: 10px;
        }
        .court-footer {
            align-items: stretch;
            flex-direction: column;
            gap: 12px;
        }
        .btn-lihat-jadwal {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')

<h1 class="page-title">Lapangan</h1>
<div class="page-subtitle">Pilih lapangan favoritmu</div>

<div class="filters">
    <a href="{{ route('customer.lapangan', ['kategori' => 'semua']) }}" class="filter-btn {{ $kategori === 'semua' ? 'active' : '' }}">SEMUA</a>
    <a href="{{ route('customer.lapangan', ['kategori' => 'futsal']) }}" class="filter-btn {{ $kategori === 'futsal' ? 'active' : '' }}">Futsal</a>
    <a href="{{ route('customer.lapangan', ['kategori' => 'badminton']) }}" class="filter-btn {{ $kategori === 'badminton' ? 'active' : '' }}">Badminton</a>
    <a href="{{ route('customer.lapangan', ['kategori' => 'basket']) }}" class="filter-btn {{ $kategori === 'basket' ? 'active' : '' }}">Basket</a>
</div>

<div class="court-list">
    @forelse($lapangan as $l)
        <div class="court-card-horizontal">
            <div class="court-image">
                {{-- LOGIKA GAMBAR OTOMATIS BERGANTI BERDASARKAN NAMA LAPANGAN --}}
                @if(str_contains(strtolower($l->nama), 'futsal a'))
                    <img src="{{ asset('images/futsalA.jpg') }}" alt="{{ $l->nama }}">
                @elseif(str_contains(strtolower($l->nama), 'futsal b'))
                    <img src="{{ asset('images/futsalB.jpg') }}" alt="{{ $l->nama }}">
                    
                @elseif(str_contains(strtolower($l->nama), 'badminton a'))
                    <img src="{{ asset('images/badmintonA.jpg') }}" alt="{{ $l->nama }}">
                @elseif(str_contains(strtolower($l->nama), 'badminton b'))
                    <img src="{{ asset('images/badmintonB.jpg') }}" alt="{{ $l->nama }}">
                    
                @elseif(str_contains(strtolower($l->nama), 'basket a'))
                    <img src="{{ asset('images/basketA.jpg') }}" alt="{{ $l->nama }}">
                @elseif(str_contains(strtolower($l->nama), 'basket b'))
                    <img src="{{ asset('images/basketB.jpg') }}" alt="{{ $l->nama }}">
                @else
                    {{-- Gambar fallback default jika nama database tidak mengandung kata di atas --}}
                    <img src="{{ asset('images/futsalA.jpg') }}" alt="{{ $l->nama }}">
                @endif
            </div>
            <div class="court-content">
                <div class="court-name">{{ $l->nama }}</div>
                <div class="court-desc">{{ $l->deskripsi }}</div>
                <div class="court-features">
                    @if(str_contains(strtolower($l->fasilitas), 'indoor'))
                        <div><i class="fa-solid fa-house"></i> Indoor</div>
                    @endif
                    @if($l->jenis === 'futsal')
                        <div><i class="fa-solid fa-users"></i> 5 vs 5</div>
                    @elseif($l->jenis === 'badminton')
                        <div><i class="fa-solid fa-users"></i> 2 vs 2</div>
                    @elseif($l->jenis === 'basket')
                        <div><i class="fa-solid fa-users"></i> 5 vs 5</div>
                    @endif
                </div>
                <div class="court-footer">
                    <div class="court-price">Rp. {{ number_format($l->harga_per_jam, 0, ',', '.') }}/Jam</div>
                    <a href="{{ route('customer.booking', $l->id) }}" class="btn-lihat-jadwal">Lihat Jadwal</a>
                </div>
            </div>
        </div>
    @empty
        <div style="text-align:center; padding:40px; color:var(--text-muted); border:1px dashed var(--border-color); border-radius:8px;">
            Belum ada lapangan yang tersedia untuk kategori ini.
        </div>
    @endforelse
</div>

@endsection