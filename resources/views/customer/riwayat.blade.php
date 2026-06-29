@extends('layouts.customer')

@section('title', 'Riwayat Reservasi - Serenity Court')

@push('styles')
<style>
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
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
        text-transform: uppercase;
    }
    .filter-btn.active {
        background-color: var(--primary-blue);
        color: var(--white);
    }
    .filter-btn:not(.active) {
        background-color: #D6EAF8; /* Light blue from image */
        color: var(--text-dark);
    }
    
    .history-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .history-card {
        display: flex;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background-color: var(--white);
        padding: 15px;
        align-items: center;
    }
    .history-image {
        width: 140px;
        height: 90px;
        border-radius: 8px;
        overflow: hidden;
        margin-right: 20px;
    }
    .history-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .history-details {
        flex: 1;
    }
    .history-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--text-dark);
    }
    .history-meta {
        font-size: 13px;
        color: var(--text-muted);
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .history-meta i {
        width: 20px;
    }
    .history-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
        height: 80px;
    }
    .badge {
        padding: 6px 15px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        text-align: center;
        min-width: 100px;
    }
    .badge-confirm { background-color: #80DEEA; color: var(--text-dark); }
    .badge-done { background-color: #80DEEA; color: var(--text-dark); }
    .badge-cancel { background-color: #E2E8F0; color: var(--text-dark); }
    
    .history-price {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .btn-load-more {
        display: block;
        width: 100%;
        padding: 15px;
        background-color: var(--primary-blue);
        color: var(--white);
        text-align: center;
        font-weight: 600;
        border-radius: 6px;
        margin-top: 30px;
        text-decoration: none;
    }
    .feedback-panel {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background: var(--white);
        padding: 20px;
        margin-top: 35px;
    }
    .feedback-header {
        display: flex;
        gap: 18px;
        align-items: center;
        margin-bottom: 20px;
    }
    .feedback-image {
        width: 150px;
        height: 95px;
        border-radius: 8px;
        overflow: hidden;
        flex: 0 0 auto;
    }
    .feedback-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .feedback-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 6px;
    }
    .feedback-desc {
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.6;
    }
    .feedback-select,
    .feedback-textarea {
        width: 100%;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-family: var(--font-main);
        font-size: 13px;
        color: var(--text-dark);
        outline: none;
    }
    .feedback-select {
        padding: 11px 12px;
        margin-bottom: 18px;
        background: var(--white);
    }
    .rating-stars {
        display: flex;
        gap: 12px;
        font-size: 28px;
        margin-bottom: 18px;
    }
    .star-filled { color: #EAB308; cursor: pointer; }
    .star-empty { color: #9CA3AF; cursor: pointer; }
    .feedback-textarea {
        min-height: 120px;
        padding: 14px;
        resize: vertical;
        background: #F8FAFC;
    }
    .char-count {
        text-align: right;
        font-size: 12px;
        color: var(--text-muted);
        margin: 5px 0 16px;
    }
    .btn-submit-feedback {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: var(--secondary-blue);
        color: var(--white);
        font-family: var(--font-main);
        font-weight: 600;
        cursor: pointer;
    }
    .empty-feedback {
        text-align: center;
        padding: 28px;
        color: var(--text-muted);
        border: 1px dashed var(--border-color);
        border-radius: 8px;
        background: #F8FAFC;
        font-size: 13px;
    }
    @media (max-width: 768px) {
        .filters {
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .history-card {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }
        .history-image {
            width: 100%;
            height: 150px;
            margin-right: 0;
        }
        .history-right {
            align-items: flex-start;
            height: auto;
            gap: 8px;
        }
        .history-price {
            font-size: 15px;
        }
        .feedback-header {
            flex-direction: column;
            align-items: stretch;
        }
        .feedback-image {
            width: 100%;
            height: 150px;
        }
        .rating-stars {
            justify-content: space-between;
            max-width: 260px;
        }
    }
</style>
@endpush

@section('content')

<h1 class="page-title">Riwayat Reservasi</h1>

<div class="filters">
    <a href="{{ route('customer.riwayat', ['filter' => 'semua']) }}" class="filter-btn {{ $filter === 'semua' ? 'active' : '' }}">SEMUA</a>
    <a href="{{ route('customer.riwayat', ['filter' => 'selesai']) }}" class="filter-btn {{ $filter === 'selesai' ? 'active' : '' }}">SELESAI</a>
    <a href="{{ route('customer.riwayat', ['filter' => 'dibatalkan']) }}" class="filter-btn {{ $filter === 'dibatalkan' ? 'active' : '' }}">DIBATALKAN</a>
</div>

@if(session('success'))
    <div style="background:rgba(82,196,26,0.1); color:#52C41A; padding:10px; border-radius:4px; margin-bottom:15px; font-size:13px;">
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div style="background:rgba(24,144,255,0.1); color:#1890FF; padding:10px; border-radius:4px; margin-bottom:15px; font-size:13px;">
        {{ session('info') }}
    </div>
@endif

<div class="history-list">
    @forelse($riwayat as $r)
        <div class="history-card">
            <div class="history-image">
                <img src="{{ $r->lapangan->foto ?? 'https://images.unsplash.com/photo-1518605368461-1ee71abed5de?q=80&w=400&auto=format&fit=crop' }}" alt="{{ $r->lapangan->nama }}">
            </div>
            <div class="history-details">
                <div class="history-title">{{ $r->lapangan->nama }}</div>
                <div class="history-meta">
                    <div><i class="fa-regular fa-calendar"></i> {{ strtoupper(\Carbon\Carbon::parse($r->tanggal)->translatedFormat('l d M Y')) }}</div>
                    <div><i class="fa-regular fa-clock"></i> {{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</div>
                </div>
            </div>
            <div class="history-right">
                @if($r->status === 'confirmed')
                    <div class="badge badge-confirm">Dikonfirmasi</div>
                @elseif($r->status === 'selesai')
                    <div class="badge badge-done">Selesai</div>
                @elseif($r->status === 'cancelled')
                    <div class="badge badge-cancel">Dibatalkan</div>
                @else
                    <div class="badge" style="background:#FFFBE6; color:#FAAD14;">Menunggu Pembayaran</div>
                @endif
                <div class="history-price">Rp{{ number_format($r->total_harga, 0, ',', '.') }}</div>
                
                @if($r->status === 'pending')
                    <a href="{{ route('customer.pembayaran', $r->id) }}" style="font-size:11px; color:var(--primary-blue); font-weight:600; text-decoration:none; margin-top:5px;">Bayar Sekarang</a>
                @endif
            </div>
        </div>
    @empty
        <div style="text-align:center; padding:40px; color:var(--text-muted); border:1px dashed var(--border-color); border-radius:8px;">
            Belum ada riwayat reservasi.
        </div>
    @endforelse
</div>

@if(count($riwayat) > 0)
<a href="#" class="btn-load-more">LIHAT LEBIH BANYAK</a>
@endif

<section class="feedback-panel" id="feedback">
    <div class="feedback-header">
        <div class="feedback-image">
            <!-- TEMPAT UPLOAD GAMBAR: Simpan gambar feedback dengan nama "feedback.jpg" di dalam folder "public/images/" -->
            <img src="{{ asset('images/feedback.jpg') }}" alt="Pengalaman Serenity Court">
        </div>
        <div>
            <div class="feedback-title">Feedback Pengalaman</div>
            <div class="feedback-desc">Berikan penilaian untuk reservasi yang sudah selesai agar layanan Serenity Court semakin baik.</div>
        </div>
    </div>

    @if($reservasiFeedback->isEmpty())
        <div class="empty-feedback">
            <i class="fa-solid fa-face-smile" style="font-size:30px; margin-bottom:12px; color:var(--secondary-blue);"></i><br>
            Belum ada reservasi selesai yang bisa diberi feedback.
        </div>
    @else
        <form action="{{ route('customer.feedback.store') }}" method="POST">
            @csrf

            <div class="section-heading" style="font-size:14px; font-weight:700; margin-bottom:10px;">Pilih Reservasi</div>
            <select name="reservasi_id" class="feedback-select" required>
                <option value="">-- Pilih Reservasi --</option>
                @foreach($reservasiFeedback as $r)
                    <option value="{{ $r->id }}">{{ $r->lapangan->nama }} - {{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }}</option>
                @endforeach
            </select>

            <div class="section-heading" style="font-size:14px; font-weight:700; margin-bottom:10px;">Rating Anda</div>
            <div class="rating-stars" id="starContainer">
                <i class="fa-solid fa-star star-empty" data-value="1"></i>
                <i class="fa-solid fa-star star-empty" data-value="2"></i>
                <i class="fa-solid fa-star star-empty" data-value="3"></i>
                <i class="fa-solid fa-star star-empty" data-value="4"></i>
                <i class="fa-solid fa-star star-empty" data-value="5"></i>
            </div>
            <input type="hidden" name="bintang" id="bintangInput" required>
            @error('bintang') <div style="color:red; font-size:12px; margin-top:-10px; margin-bottom:10px;">Pilih rating bintang terlebih dahulu.</div> @enderror

            <div class="section-heading" style="font-size:14px; font-weight:700; margin-bottom:10px;">Saran & Masukan</div>
            <textarea name="ulasan" class="feedback-textarea" id="ulasanText" placeholder="Tulis saran atau masukan anda disini" maxlength="200"></textarea>
            <div class="char-count" id="charCount">0/200</div>

            <button type="submit" class="btn-submit-feedback">Kirim Feedback</button>
        </form>
    @endif
</section>

@push('scripts')
<script>
    const stars = document.querySelectorAll('#starContainer i');
    const bintangInput = document.getElementById('bintangInput');
    const ulasanText = document.getElementById('ulasanText');
    const charCount = document.getElementById('charCount');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            bintangInput.value = value;

            stars.forEach(s => {
                if (s.getAttribute('data-value') <= value) {
                    s.classList.remove('star-empty');
                    s.classList.add('star-filled');
                } else {
                    s.classList.remove('star-filled');
                    s.classList.add('star-empty');
                }
            });
        });
    });

    if (ulasanText && charCount) {
        ulasanText.addEventListener('input', function() {
            charCount.textContent = this.value.length + '/200';
        });
    }
</script>
@endpush

@endsection
