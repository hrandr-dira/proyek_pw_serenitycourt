@extends('layouts.app')

@section('title', 'Beranda - Serenity Court')

@push('styles')
<style>
    /* Hero Section */
    .hero {
        position: relative;
        height: 500px;
        background: url('https://images.unsplash.com/photo-1574629810360-7efbb1b379e0?q=80&w=2000&auto=format&fit=crop') center/cover no-repeat;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 0 20px;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(255,255,255,0.2); /* very light overlay as in image 5 */
    }
    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin-bottom: 40px;
    }
    .hero-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 15px;
        line-height: 1.2;
    }
    .hero-subtitle {
        font-size: 14px;
        color: var(--text-dark);
        font-weight: 500;
    }

    /* Quick Search */
    .quick-search {
        position: relative;
        z-index: 2;
        background-color: var(--light-blue);
        padding: 20px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 800px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transform: translateY(50%); /* Half overlapping hero */
        margin-top: -60px;
    }
    .quick-search-title {
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--text-dark);
    }
    .search-fields {
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 15px;
    }
    .search-select {
        flex: 1;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        font-family: var(--font-main);
        font-size: 12px;
        color: var(--text-muted);
        outline: none;
    }
    .btn-search {
        background-color: var(--primary-blue);
        color: var(--white);
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 12px;
        cursor: pointer;
        font-family: var(--font-main);
    }

    /* Categories */
    .categories-section {
        margin-top: 100px; /* Space for quick search overlap */
        padding: 40px 0;
    }
    .categories-grid {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
    }
    .category-card {
        background-color: var(--light-blue);
        border-radius: 8px;
        padding: 30px 20px;
        width: 220px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .category-icon {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
    }
    .category-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .category-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 15px;
        text-transform: uppercase;
    }
    .btn-lihat {
        background-color: var(--white);
        color: var(--text-dark);
        border: 1px solid var(--text-dark);
        padding: 6px 15px;
        font-size: 11px;
        font-weight: 600;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
    }

    /* Features */
    .features-section {
        padding: 50px 0;
        text-align: center;
    }
    .features-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 40px;
        text-transform: uppercase;
    }
    .features-grid {
        display: flex;
        justify-content: center;
        gap: 50px;
    }
    .feature-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 150px;
    }
    .feature-icon {
        font-size: 40px;
        color: var(--text-dark);
        margin-bottom: 15px;
        padding: 20px;
        border: 1px solid rgba(0,0,0,0.1);
    }
    .feature-text {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* About Us (Image 3 equivalent) */
    .about-section {
        padding: 60px 0;
        background-color: var(--white);
    }
    .about-container {
        display: flex;
        align-items: center;
        gap: 50px;
    }
    .about-content {
        flex: 1;
    }
    .about-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
    }
    .about-desc {
        font-size: 14px;
        color: var(--text-dark);
        margin-bottom: 30px;
        line-height: 1.8;
    }
    .contact-list {
        list-style: none;
    }
    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        font-size: 14px;
        font-weight: 500;
    }
    .contact-item i {
        font-size: 20px;
        width: 24px;
        text-align: center;
    }
    .about-image {
        flex: 1;
        border-radius: 12px;
        overflow: hidden;
        height: 400px;
    }
    .about-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .search-fields { flex-direction: column; }
        .about-container { flex-direction: column; }
        .features-grid { flex-wrap: wrap; gap: 30px; }
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Pesan Lapangan Olahraga<br>Favoritmu dalam Hitungan Detik</h1>
        <p class="hero-subtitle">Serenity Court hadir untuk memberikan pengalaman reservasi yang mudah, cepat, dan terpercaya. Temukan lapangan terbaik untuk aktivitas olahraga Anda sekarang.</p>
    </div>

    <div class="quick-search">
        <div class="quick-search-title">QUICK SEARCH</div>
        <form action="#" class="search-fields">
            <select class="search-select">
                <option>PILIH JENIS OLAHRAGA</option>
                <option>Futsal</option>
                <option>Badminton</option>
                <option>Basket</option>
            </select>
            <select class="search-select">
                <option>TANGGAL</option>
            </select>
            <select class="search-select">
                <option>JAM</option>
            </select>
            <button type="button" class="btn-search">CARI LAPANGAN</button>
        </form>
    </div>
</section>

<!-- Categories -->
<section class="categories-section container">
    <div class="categories-grid">
        <div class="category-card">
            <div class="category-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/1165/1165187.png" alt="Futsal">
            </div>
            <div class="category-title">FUTSAL</div>
            <a href="#" class="btn-lihat">LIHAT LAPANGAN</a>
        </div>
        <div class="category-card">
            <div class="category-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/3043/3043912.png" alt="Badminton">
            </div>
            <div class="category-title">BADMINTON</div>
            <a href="#" class="btn-lihat">LIHAT LAPANGAN</a>
        </div>
        <div class="category-card">
            <div class="category-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/1041/1041071.png" alt="Basket">
            </div>
            <div class="category-title">BASKET</div>
            <a href="#" class="btn-lihat">LIHAT LAPANGAN</a>
        </div>
    </div>
</section>

<!-- Features -->
<section class="features-section container">
    <div class="features-title">FITUR UNGGULAN</div>
    <div class="features-grid">
        <div class="feature-item">
            <div class="feature-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <div class="feature-text">REAL-TIME BOOKING</div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fa-regular fa-credit-card"></i></div>
            <div class="feature-text">PEMBAYARAN MUDAH</div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fa-regular fa-message"></i></div>
            <div class="feature-text">KONFIRMASI INSTAN</div>
        </div>
    </div>
</section>

<!-- About Us (Tentang Kami) -->
<section class="about-section">
    <div class="container about-container">
        <div class="about-content">
            <h2 class="about-title">Tentang Kami</h2>
            <p class="about-desc">
                Serenity Court hadir untuk memberikan pengalaman terbaik dalam bermain olahraga dengan fasilitas berkualitas, lokasi strategi, dan pelayanan terbaik.
            </p>
            <ul class="contact-list">
                <li class="contact-item">
                    <i class="fa-solid fa-phone" style="color:var(--text-dark);"></i> 085234876456
                </li>
                <li class="contact-item">
                    <i class="fa-solid fa-location-dot" style="color:var(--text-dark);"></i> Jl. Olahraga No. 10, Jakarta Selatan
                </li>
                <li class="contact-item">
                    <i class="fa-brands fa-instagram" style="color:#E1306C;"></i> SerenityCourt_Official
                </li>
                <li class="contact-item">
                    <i class="fa-solid fa-envelope" style="color:#EA4335;"></i> serenitycourt@gmail.com
                </li>
            </ul>
        </div>
        <div class="about-image">
            <!-- TEMPAT UPLOAD GAMBAR: Simpan gambar fasilitas dengan nama "fasilitas.jpg" di dalam folder "public/images/" -->
            <img src="{{ asset('images/fasilitas.jpg') }}" alt="Fasilitas Lapangan">
        </div>
    </div>
</section>

@endsection
