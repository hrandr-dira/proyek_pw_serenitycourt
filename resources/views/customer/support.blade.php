@extends('layouts.customer')

@section('title', 'Customer Support - Serenity Court')

@push('styles')
<style>
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
    }
    .page-subtitle {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
    }
    
    .contact-cards {
        display: flex;
        gap: 30px;
        margin-bottom: 40px;
    }
    .contact-card {
        flex: 1;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        background: linear-gradient(to bottom, #ffffff 50%, #90CDE6 100%);
        text-align: center;
        padding: 30px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .contact-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
    }
    .contact-icon {
        width: 40px;
        height: 40px;
    }
    .contact-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .contact-card-title {
        font-size: 20px;
        font-weight: 700;
    }
    .contact-desc {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 20px;
        max-width: 200px;
    }
    .contact-divider {
        width: 100%;
        height: 1px;
        background-color: rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .contact-info {
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .btn-contact {
        background-color: #51A4CB;
        color: var(--white);
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        width: 100%;
        transition: background-color 0.3s;
        border: none;
        cursor: pointer;
    }
    .btn-contact:hover {
        background-color: #3b8bb0;
    }

    /* FAQ Section */
    .faq-container {
        background-color: #EAEAEA;
        border-radius: 8px;
        padding: 20px;
    }
    .faq-title {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    .faq-item {
        padding: 15px 0;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-size: 13px;
        color: var(--text-muted);
    }
    .faq-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .faq-item:hover {
        color: var(--text-dark);
    }

    @media (max-width: 768px) {
        .contact-cards { flex-direction: column; }
    }
</style>
@endpush

@section('content')

<h1 class="page-title">Customer Support</h1>
<div style="width: 100%; height: 1px; background-color: var(--border-color); margin-bottom: 20px;"></div>

<h2 class="page-subtitle">Pilih cara menghubungi kami</h2>

<div class="contact-cards">
    <!-- WhatsApp Card -->
    <div class="contact-card">
        <div class="contact-header">
            <div class="contact-icon">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
            </div>
            <div class="contact-card-title">WhatsApp</div>
        </div>
        <div class="contact-desc">
            Hubungi kami langsung melalui WhatsApp
        </div>
        <div class="contact-divider"></div>
        <div class="contact-info">
            <i class="fa-solid fa-phone" style="transform: scaleX(-1);"></i> +62 85234876456
        </div>
        <a href="#" class="btn-contact">Chat WhatsApp</a>
    </div>

    <!-- Email Card -->
    <div class="contact-card">
        <div class="contact-header">
            <div class="contact-icon">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/7e/Gmail_icon_%282020%29.svg" alt="Gmail">
            </div>
            <div class="contact-card-title">Email</div>
        </div>
        <div class="contact-desc">
            Sampaikan kepada kami melalui Email
        </div>
        <div class="contact-divider"></div>
        <div class="contact-info">
            Email: serenitycourt@gmail.com
        </div>
        <a href="#" class="btn-contact">Kirim Email</a>
    </div>
</div>

<div class="faq-container">
    <div class="faq-title">FAQ Populer</div>
    <div class="faq-item">
        <span>Bagaimana cara melakukan reservasi?</span>
        <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
    </div>
    <div class="faq-item">
        <span>Metode pembayaran apa saja yang tersedia?</span>
        <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
    </div>
</div>

@endsection
