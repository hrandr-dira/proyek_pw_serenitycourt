@extends('layouts.customer')

@section('title', 'Pilih Waktu - Serenity Court')

@push('styles')
<style>
    .back-btn {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 20px;
    }
    .back-btn i { font-size: 12px; }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
    }
    .page-subtitle {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 30px;
    }

    /* Date Selector */
    .date-selector {
        display: flex;
        gap: 15px;
        overflow-x: auto;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .date-card {
        flex: 0 0 auto;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 10px 15px;
        text-align: center;
        min-width: 80px;
        cursor: pointer;
        background-color: var(--white);
    }
    .date-card.active {
        background-color: var(--primary-blue);
        color: var(--white);
        border-color: var(--primary-blue);
    }
    .date-card .day {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 2px;
    }
    .date-card .date {
        font-size: 13px;
        font-weight: 700;
    }

    /* Legend */
    .legend {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-dark);
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .legend-dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
    }
    .legend-tersedia { background-color: #D6EAF8; border: 1px solid #AED6F1; }
    .legend-terpesan { background-color: #E2E8F0; border: 1px solid #CBD5E1; }
    .legend-dipilih { background-color: var(--primary-blue); border: 1px solid var(--primary-blue); }

    /* Time Grid */
    .section-title {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .time-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 40px;
    }
    .time-slot {
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        text-align: center;
        width: calc(20% - 12px);
        min-width: 110px;
        cursor: pointer;
    }
    .time-tersedia { background-color: #E2F0F9; color: var(--text-dark); border: 1px solid #AED6F1; }
    .time-terpesan { background-color: #E2E8F0; color: #9CA3AF; border: 1px solid #CBD5E1; cursor: not-allowed; }
    .time-dipilih { background-color: var(--primary-blue); color: var(--white); border: 1px solid var(--primary-blue); }

    /* Summary Box */
    .summary-box {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        background-color: var(--white);
    }
    .summary-title {
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 20px;
    }
    .summary-grid {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
    }
    .summary-col {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .summary-label {
        color: var(--text-muted);
    }
    .summary-value {
        font-weight: 700;
        color: var(--text-dark);
    }

    .btn-lanjut {
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
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    .btn-lanjut:hover { background-color: #0f2740; }
    @media (max-width: 768px) {
        .page-title {
            font-size: 22px;
        }
        .legend {
            flex-wrap: wrap;
            gap: 10px 16px;
        }
        .time-grid {
            gap: 10px;
            margin-bottom: 28px;
        }
        .time-slot {
            width: calc(50% - 5px);
            min-width: 0;
            padding: 10px 8px;
        }
        .summary-grid {
            flex-direction: column;
            gap: 12px;
        }
    }
</style>
@endpush

@section('content')

<a href="{{ route('customer.lapangan') }}" class="back-btn"><i class="fa-solid fa-chevron-left"></i> Kembali</a>

<h1 class="page-title">{{ $lapangan->nama }}</h1>
<div class="page-subtitle">{{ \Carbon\Carbon::parse($tanggalPilih)->translatedFormat('l, d F Y') }}</div>

<!-- Date Selector -->
<div class="date-selector">
    @foreach($dates as $date)
        <a href="{{ route('customer.booking', ['id' => $lapangan->id, 'tanggal' => $date['full']]) }}" style="text-decoration:none;">
            <div class="date-card {{ $date['is_active'] ? 'active' : '' }}">
                <div class="day">{{ $date['day'] }}</div>
                <div class="date">{{ $date['date'] }}</div>
            </div>
        </a>
    @endforeach
</div>

<!-- Legend -->
<div class="legend">
    <div class="legend-item"><div class="legend-dot legend-tersedia"></div> Tersedia</div>
    <div class="legend-item"><div class="legend-dot legend-terpesan"></div> Terpesan</div>
    <div class="legend-item"><div class="legend-dot legend-dipilih"></div> Dipilih</div>
</div>

@if(session('error'))
    <div style="background:rgba(255,77,79,0.1); color:#FF4D4F; padding:10px; border-radius:4px; margin-bottom:15px; font-size:13px;">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('customer.booking.store') }}" method="POST" id="booking-form">
    @csrf
    <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
    <input type="hidden" name="tanggal" value="{{ $tanggalPilih }}">
    <input type="hidden" name="jam_mulai" id="input_jam_mulai" value="">
    <input type="hidden" name="jam_selesai" id="input_jam_selesai" value="">

    <!-- Time Slot -->
    <div class="section-title">Pilih Waktu</div>
    <div class="time-grid">
        @foreach($timeSlots as $slot)
            @if($slot['status'] === 'tersedia')
                <div class="time-slot time-tersedia slot-selectable" 
                     data-start="{{ $slot['start_time'] }}" 
                     data-end="{{ $slot['end_time'] }}"
                     data-time="{{ $slot['time'] }}">
                    {{ $slot['time'] }}
                </div>
            @else
                <div class="time-slot time-terpesan">{{ $slot['time'] }}</div>
            @endif
        @endforeach
    </div>

    <!-- Summary Box -->
    <div class="summary-box">
        <div class="summary-title">Ringkasan Reservasi</div>
        <div class="summary-grid">
            <div class="summary-col">
                <span class="summary-label">Lapangan</span>
                <span class="summary-value">{{ $lapangan->nama }}</span>
            </div>
            <div class="summary-col">
                <span class="summary-label">Tanggal</span>
                <span class="summary-value">{{ \Carbon\Carbon::parse($tanggalPilih)->translatedFormat('d M Y') }}</span>
            </div>
            <div class="summary-col">
                <span class="summary-label">Waktu</span>
                <span class="summary-value" id="summary-waktu">-</span>
            </div>
            <div class="summary-col">
                <span class="summary-label">Total</span>
                <span class="summary-value" style="font-size: 15px;" id="summary-total">Rp0</span>
            </div>
        </div>
    </div>

    <button type="submit" class="btn-lanjut" id="btn-submit" disabled style="opacity: 0.5; cursor: not-allowed;">LANJUT KE PEMBAYARAN</button>
</form>

@push('scripts')
<script>
    const slots = document.querySelectorAll('.slot-selectable');
    const inputMulai = document.getElementById('input_jam_mulai');
    const inputSelesai = document.getElementById('input_jam_selesai');
    const summaryWaktu = document.getElementById('summary-waktu');
    const summaryTotal = document.getElementById('summary-total');
    const btnSubmit = document.getElementById('btn-submit');
    const hargaPerJam = {{ $lapangan->harga_per_jam }};

    slots.forEach(slot => {
        slot.addEventListener('click', function() {
            // Remove selection from all
            slots.forEach(s => {
                s.classList.remove('time-dipilih');
                s.classList.add('time-tersedia');
            });

            // Add selection to clicked
            this.classList.remove('time-tersedia');
            this.classList.add('time-dipilih');

            // Update inputs
            inputMulai.value = this.dataset.start;
            inputSelesai.value = this.dataset.end;

            // Update summary
            summaryWaktu.textContent = this.dataset.time;
            summaryTotal.textContent = 'Rp' + new Intl.NumberFormat('id-ID').format(hargaPerJam);

            // Enable button
            btnSubmit.disabled = false;
            btnSubmit.style.opacity = '1';
            btnSubmit.style.cursor = 'pointer';
        });
    });
</script>
@endpush

@endsection
