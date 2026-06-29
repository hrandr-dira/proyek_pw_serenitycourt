@extends('layouts.customer')

@section('title', 'Feedback - Serenity Court')

@push('styles')
<style>
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
    }
    .divider {
        width: 100%;
        height: 1px;
        background-color: var(--border-color);
        margin-bottom: 20px;
        margin-top: 20px;
    }
    
    .feedback-hero {
        display: flex;
        gap: 30px;
        align-items: center;
    }
    .hero-image {
        width: 250px;
        height: 150px;
        border-radius: 8px;
        overflow: hidden;
    }
    .hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .hero-text h2 {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 10px;
    }
    .hero-text p {
        font-size: 14px;
        color: var(--text-muted);
        line-height: 1.6;
    }

    .section-heading {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .rating-stars {
        display: flex;
        gap: 15px;
        font-size: 30px;
    }
    .star-filled { color: #EAB308; cursor: pointer; } /* Yellow */
    .star-empty { color: #9CA3AF; cursor: pointer; } /* Gray */

    .feedback-textarea {
        width: 100%;
        background-color: #EAEAEA;
        border: none;
        border-radius: 8px;
        padding: 20px;
        font-family: var(--font-main);
        font-size: 13px;
        resize: vertical;
        min-height: 120px;
        color: var(--text-dark);
        outline: none;
        margin-bottom: 5px;
    }
    .char-count {
        text-align: right;
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 30px;
    }

    .btn-submit {
        background-color: var(--secondary-blue);
        color: var(--white);
        border: none;
        width: 100%;
        padding: 12px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-submit:hover {
        background-color: var(--primary-blue);
    }
</style>
@endpush

@section('content')

@if(session('success'))
    <div style="background:rgba(82,196,26,0.1); color:#52C41A; padding:15px; border-radius:6px; margin-bottom:20px; font-weight:500;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

<h1 class="page-title">Feedback</h1>
<div class="divider" style="margin-top: 0;"></div>

<div class="feedback-hero">
    <div class="hero-image">
        <img src="https://images.unsplash.com/photo-1518605368461-1ee71abed5de?q=80&w=600&auto=format&fit=crop" alt="Pengalaman Serenity Court">
    </div>
    <div class="hero-text">
        <h2>Bagaimana pengalaman Anda<br>bersama kami?</h2>
        <p>Berikan penilaian dan saran untuk membantu kami<br>meningkatkan layanan,</p>
    </div>
</div>

<div class="divider"></div>

@if($reservasi->isEmpty())
    <div style="text-align:center; padding:40px; color:var(--text-muted); border:1px dashed var(--border-color); border-radius:8px; background:var(--white);">
        <i class="fa-solid fa-face-smile" style="font-size:36px; margin-bottom:15px; color:var(--secondary-blue);"></i><br>
        <h3 style="color:var(--text-dark); margin-bottom:10px;">Belum Ada Sesi yang Selesai</h3>
        <p style="font-size:13px; max-width:400px; margin:0 auto;">Anda hanya dapat memberikan ulasan (feedback) setelah Admin menandai status reservasi Anda menjadi <strong>"Selesai"</strong> (setelah Anda selesai menggunakan lapangan).</p>
    </div>
@else

<form action="{{ route('customer.feedback.store') }}" method="POST">
    @csrf
    
    <div class="section-heading">Pilih Reservasi</div>
    <select name="reservasi_id" style="width:100%; padding:10px; border-radius:6px; border:1px solid var(--border-color); margin-bottom:20px; font-family:var(--font-main);" required>
        <option value="">-- Pilih Reservasi --</option>
        @foreach($reservasi as $r)
            <option value="{{ $r->id }}">{{ $r->lapangan->nama }} - {{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }}</option>
        @endforeach
    </select>

    <div class="section-heading">Rating Anda</div>
    <div class="rating-stars" id="starContainer">
        <i class="fa-solid fa-star star-empty" data-value="1"></i>
        <i class="fa-solid fa-star star-empty" data-value="2"></i>
        <i class="fa-solid fa-star star-empty" data-value="3"></i>
        <i class="fa-solid fa-star star-empty" data-value="4"></i>
        <i class="fa-solid fa-star star-empty" data-value="5"></i>
    </div>
    <input type="hidden" name="bintang" id="bintangInput" required>
    @error('bintang') <div style="color:red; font-size:12px; margin-top:5px;">Pilih rating bintang terlebih dahulu.</div> @enderror

    <div class="divider"></div>

    <div class="section-heading">Saran & Masukan</div>
    <div style="position: relative;">
        <textarea name="ulasan" class="feedback-textarea" id="ulasanText" placeholder="Tulis saran atau masukan anda disini" maxlength="200"></textarea>
        <div class="char-count" id="charCount" style="position: absolute; bottom: 15px; right: 15px; margin: 0;">0/200</div>
    </div>

    <button type="submit" class="btn-submit" style="margin-top: 20px;">Kirim Feedback</button>
</form>

@push('scripts')
<script>
    const stars = document.querySelectorAll('#starContainer i');
    const bintangInput = document.getElementById('bintangInput');
    const ulasanText = document.getElementById('ulasanText');
    const charCount = document.getElementById('charCount');

    // Star rating logic
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

    // Character count logic
    if(ulasanText) {
        ulasanText.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCount.textContent = currentLength + '/200';
        });
    }
</script>
@endpush

@endif

@endsection
