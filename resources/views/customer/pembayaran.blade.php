@extends('layouts.customer')

@section('title', 'Pembayaran - Serenity Court')

@push('styles')
<style>
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
    }
    .section-heading {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 10px;
    }

    /* Summary Card */
    .summary-card {
        display: flex;
        align-items: center;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 15px;
        background-color: var(--white);
        margin-bottom: 30px;
    }
    .summary-img {
        width: 120px;
        height: 80px;
        border-radius: 6px;
        overflow: hidden;
        margin-right: 20px;
    }
    .summary-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .summary-details {
        flex: 1;
    }
    .summary-title {
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 8px;
    }
    .summary-meta {
        font-size: 12px;
        color: var(--text-muted);
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .summary-price {
        font-weight: 700;
        font-size: 14px;
        color: var(--text-dark);
    }

    /* Payment Methods */
    .payment-methods {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
    }
    .payment-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 15px 20px;
        cursor: pointer;
        transition: border-color 0.2s;
    }
    .payment-option.active {
        border-color: var(--primary-blue);
        border-width: 2px;
        padding: 14px 19px;
    }
    .payment-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-dark);
    }
    .payment-label i {
        font-size: 14px;
        color: var(--text-muted);
    }
    .check-circle {
        width: 20px;
        height: 20px;
        border: 2px solid var(--border-color);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: transparent;
    }
    .payment-option.active .check-circle {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
        color: var(--white);
        font-size: 12px;
    }

    /* Total Section */
    .total-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 700;
        font-size: 14px;
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .btn-bayar {
        width: 100%;
        background-color: var(--primary-blue);
        color: var(--white);
        padding: 15px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
        text-align: center;
    }
    .btn-bayar:hover { background-color: #0f2740; }
    @media (max-width: 768px) {
        .summary-card {
            align-items: stretch;
            flex-direction: column;
            gap: 12px;
        }
        .summary-img {
            width: 100%;
            height: 150px;
            margin-right: 0;
        }
        .summary-price {
            font-size: 16px;
        }
        .payment-option {
            padding: 14px;
        }
        .payment-option.active {
            padding: 13px;
        }
    }
</style>
@endpush

@section('content')

<h1 class="page-title">Pembayaran</h1>

<div class="section-heading">Ringkasan Reservasi</div>
<div class="summary-card">
    <div class="summary-img">
        {{-- LOGIKA BARU: GAMBAR DISESUAIKAN DENGAN LAPANGAN YANG DI-BOOKING --}}
        @if(str_contains(strtolower($reservasi->lapangan->nama), 'futsal a'))
            <img src="{{ asset('images/futsalA.jpg') }}" alt="{{ $reservasi->lapangan->nama }}">
        @elseif(str_contains(strtolower($reservasi->lapangan->nama), 'futsal b'))
            <img src="{{ asset('images/futsalB.jpg') }}" alt="{{ $reservasi->lapangan->nama }}">
            
        @elseif(str_contains(strtolower($reservasi->lapangan->nama), 'badminton a'))
            <img src="{{ asset('images/badmintonA.jpg') }}" alt="{{ $reservasi->lapangan->nama }}">
        @elseif(str_contains(strtolower($reservasi->lapangan->nama), 'badminton b'))
            <img src="{{ asset('images/badmintonB.jpg') }}" alt="{{ $reservasi->lapangan->nama }}">
            
        @elseif(str_contains(strtolower($reservasi->lapangan->nama), 'basket a'))
            <img src="{{ asset('images/basketA.jpg') }}" alt="{{ $reservasi->lapangan->nama }}">
        @elseif(str_contains(strtolower($reservasi->lapangan->nama), 'basket b'))
            <img src="{{ asset('images/basketB.jpg') }}" alt="{{ $reservasi->lapangan->nama }}">
        @else
            {{-- Default Fallback Gambar --}}
            <img src="{{ asset('images/futsalA.jpg') }}" alt="{{ $reservasi->lapangan->nama }}">
        @endif
    </div>
    <div class="summary-details">
        <div class="summary-title">{{ $reservasi->lapangan->nama }}</div>
        <div class="summary-meta">
            <div><i class="fa-regular fa-calendar" style="width:15px;"></i> {{ strtoupper(\Carbon\Carbon::parse($reservasi->tanggal)->translatedFormat('l, d M Y')) }}</div>
            <div><i class="fa-regular fa-clock" style="width:15px;"></i> {{ substr($reservasi->jam_mulai, 0, 5) }} - {{ substr($reservasi->jam_selesai, 0, 5) }}</div>
        </div>
    </div>
    <div class="summary-price">
        Rp{{ number_format($reservasi->total_harga, 0, ',', '.') }}
    </div>
</div>

<form action="{{ route('customer.pembayaran.proses', $reservasi->id) }}" method="POST">
    @csrf
    <div class="section-heading">Metode Pembayaran</div>
    <div class="payment-methods">
        <label class="payment-option active" id="opt-transfer">
            <input type="radio" name="payment_method" value="transfer" style="display:none;" checked>
            <div class="payment-label">
                <i class="fa-solid fa-building-columns"></i> Transfer Bank
            </div>
            <div class="check-circle"><i class="fa-solid fa-check"></i></div>
        </label>

        <label class="payment-option" id="opt-ewallet">
            <input type="radio" name="payment_method" value="ewallet" style="display:none;">
            <div class="payment-label">
                <i class="fa-solid fa-wallet"></i> E-Wallet
            </div>
            <div class="check-circle"><i class="fa-solid fa-check"></i></div>
        </label>

        <label class="payment-option" id="opt-cash">
            <input type="radio" name="payment_method" value="cash" style="display:none;">
            <div class="payment-label">
                <i class="fa-solid fa-money-bill-wave"></i> Cash
            </div>
            <div class="check-circle"><i class="fa-solid fa-check"></i></div>
        </label>
    </div>

    <div class="total-section">
        <div>Total pembayaran</div>
        <div>Rp{{ number_format($reservasi->total_harga, 0, ',', '.') }}</div>
    </div>

    <button type="submit" class="btn-bayar">Bayar Sekarang</button>
</form>

@push('scripts')
<script>
    const options = document.querySelectorAll('.payment-option');
    options.forEach(opt => {
        opt.addEventListener('click', function() {
            options.forEach(o => o.classList.remove('active'));
            this.classList.add('active');
            this.querySelector('input').checked = true;
        });
    });
</script>
@endpush

@endsection