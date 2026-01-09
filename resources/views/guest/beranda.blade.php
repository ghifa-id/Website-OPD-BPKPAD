@extends('guest.layouts.app')
@section('title', 'BPKPAD')

@section('style')
<style>
    /* Global section styling */
    .section-spacing {
        padding: 4rem 0;
        background-color: white;
    }
    
    .bg-light-section {
        background: linear-gradient(135deg, rgba(230, 247, 255, 0.3) 0%, rgba(255, 255, 255, 0.8) 100%) !important;
    }
    
    .section-title {
        position: relative;
        display: inline-block;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: #003b49;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #2dcd7c, #003b49);
        border-radius: 3px;
    }
    
    .section-title span {
        background: linear-gradient(135deg, #2dcd7c, #003b49);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
    }
    
    .berita-box {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 30px rgba(0, 59, 73, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(230, 247, 255, 0.5);
    }
    
    .btn-lihat-semua {
        background: linear-gradient(135deg, #2dcd7c, #003b49);
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 15px rgba(45, 205, 124, 0.3);
    }
    
    .btn-lihat-semua:hover {
        background: linear-gradient(135deg, #25a864, #002a36);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(45, 205, 124, 0.4);
    }
    
    .hr-connector {
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, rgba(45,205,124,0.2) 0%, rgba(45,205,124,0.8) 50%, rgba(45,205,124,0.2) 100%);
        margin: 0 1.5rem;
        border-radius: 2px;
    }
    
    .hover-text-success:hover {
        color: #2dcd7c !important;
    }
    
    .hover-bg-light:hover {
        background-color: rgba(45, 205, 124, 0.05) !important;
    }
    
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 59, 73, 0.15) !important;
    }
    
    .bg-gradient-overlay {
        background: linear-gradient(to top, rgba(0, 59, 73, 0.8) 0%, transparent 100%);
    }
    
    .modern-position-badge {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(45, 205, 124, 0.2) !important;
    }
    
    .carousel-control-prev, .carousel-control-next {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.8;
    }
    
    .carousel-control-prev {
        left: 15px;
    }
    
    .carousel-control-next {
        right: 15px;
    }
    
    .carousel-control-prev-icon, .carousel-control-next-icon {
        width: 20px;
        height: 20px;
    }

    /* Pulse Animation */
    @keyframes pulse {
        0% {
            transform: translate(-50%, -50%) scale(0.8);
            opacity: 1;
        }
        70% {
            transform: translate(-50%, -50%) scale(1.1);
            opacity: 0.5;
        }
        100% {
            transform: translate(-50%, -50%) scale(1.2);
            opacity: 0;
        }
    }

    .portal-card:hover .pbb-icon-wrapper {
    background: linear-gradient(135deg, #25a864, #002a36) !important;
    transform: scale(1.05);
    transition: all 0.3s ease;
    }

    .portal-card:hover .pbb-home-icon {
        animation: bounce-icon 0.6s ease;
    }

    .portal-card:hover .pbb-arrow {
        transform: translateX(5px);
    }

    .portal-card:hover .pbb-hover-overlay {
        opacity: 1 !important;
    }

    .portal-card:hover .pbb-pulse {
        border-color: rgba(45, 205, 124, 0.6);
    }

    /* Bounce Animation untuk Icon */
    @keyframes bounce-icon {
        0%, 100% {
            transform: translateY(0);
        }
        25% {
            transform: translateY(-8px);
        }
        50% {
            transform: translateY(0);
        }
        75% {
            transform: translateY(-4px);
        }
    }

    /* Enhanced Pulse Animation */
    @keyframes pulse {
        0% {
            transform: translate(-50%, -50%) scale(0.85);
            opacity: 0.8;
        }
        50% {
            transform: translate(-50%, -50%) scale(1.1);
            opacity: 0.4;
        }
        100% {
            transform: translate(-50%, -50%) scale(1.3);
            opacity: 0;
        }
    }

    /* Responsive adjustments untuk PBB Card */
    @media (max-width: 768px) {
        .portal-card .pbb-icon-wrapper {
            width: 70px !important;
            height: 70px !important;
        }
        
        .portal-card .pbb-home-icon {
            font-size: 1.75rem !important;
        }
        
        .portal-card h6 {
            font-size: 1rem !important;
        }
    }

    /* Shadow enhancement on hover - Hijau */
    .portal-card:hover {
        box-shadow: 0 15px 50px rgba(45, 205, 124, 0.25) !important;
        border-color: rgba(45, 205, 124, 0.3) !important;
    }

    /* Glow effect untuk icon saat hover */
    .portal-card:hover .pbb-icon-wrapper {
        box-shadow: 0 0 30px rgba(45, 205, 124, 0.4);
    }
    .portal-card:hover .pbb-logo-img {
    animation: bounce-logo 0.6s ease;
    transform: scale(1.1);
    }

    @keyframes bounce-logo {
        0%, 100% {
            transform: scale(1.1) translateY(0);
        }
        25% {
            transform: scale(1.1) translateY(-8px);
        }
        50% {
            transform: scale(1.1) translateY(0);
        }
        75% {
            transform: scale(1.1) translateY(-4px);
        }
    }

        /* Fallback jika logo tidak ditemukan */
        .pbb-logo-img {
            transition: all 0.3s ease;
    }
    /* PPID Card Styling - Matching PBB P2 Design */
    .ppid-portal-card:hover .ppid-icon-wrapper {
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

    .ppid-portal-card:hover .ppid-arrow {
        transform: translateX(5px);
    }

    .ppid-portal-card:hover .ppid-hover-overlay {
        opacity: 1 !important;
    }

    .ppid-portal-card:hover .ppid-pulse {
        border-color: rgba(0, 123, 255, 0.6);
    }

    /* Logo Pessel Styling di tengah */
    .ppid-logo-img {
        transition: all 0.3s ease;
    }

    .ppid-portal-card:hover .ppid-logo-img {
        animation: bounce-logo 0.6s ease;
        transform: scale(1.1);
    }

    @keyframes bounce-logo {
        0%, 100% {
            transform: scale(1.1) translateY(0);
        }
        25% {
            transform: scale(1.1) translateY(-8px);
        }
        50% {
            transform: scale(1.1) translateY(0);
        }
        75% {
            transform: scale(1.1) translateY(-4px);
        }
    }

    /* Shadow enhancement on hover - Different colors for each card */
    .ppid-portal-card:hover {
        box-shadow: 0 15px 50px rgba(0, 123, 255, 0.25) !important;
        border-color: rgba(0, 123, 255, 0.3) !important;
    }

    .ppid-portal-card:nth-child(2):hover {
        box-shadow: 0 15px 50px rgba(40, 167, 69, 0.25) !important;
        border-color: rgba(40, 167, 69, 0.3) !important;
    }

    .ppid-portal-card:nth-child(3):hover {
        box-shadow: 0 15px 50px rgba(255, 193, 7, 0.25) !important;
        border-color: rgba(255, 193, 7, 0.3) !important;
    }

    .ppid-portal-card:nth-child(4):hover {
        box-shadow: 0 15px 50px rgba(108, 117, 125, 0.25) !important;
        border-color: rgba(108, 117, 125, 0.3) !important;
    }

    /* Glow effect untuk icon saat hover */
    .ppid-portal-card:hover .ppid-icon-wrapper {
        box-shadow: 0 0 30px rgba(0, 123, 255, 0.4);
    }

    .ppid-portal-card:nth-child(2):hover .ppid-icon-wrapper {
        box-shadow: 0 0 30px rgba(40, 167, 69, 0.4);
    }

    .ppid-portal-card:nth-child(3):hover .ppid-icon-wrapper {
        box-shadow: 0 0 30px rgba(255, 193, 7, 0.4);
    }

    .ppid-portal-card:nth-child(4):hover .ppid-icon-wrapper {
        box-shadow: 0 0 30px rgba(108, 117, 125, 0.4);
    }

    /* Responsive adjustments untuk PPID Card */
    @media (max-width: 768px) {
        .ppid-portal-card .ppid-icon-wrapper {
            width: 70px !important;
            height: 70px !important;
        }
        
        .ppid-portal-card .ppid-logo-img {
            width: 40px !important;
            height: 40px !important;
        }
        
        .ppid-portal-card h6 {
            font-size: 1rem !important;
        }
    }
</style>
@endsection

@section('content')
    @include('guest.partials.hero')

<!-- Data Makro Section -->
<!-- Data Makro Section -->
<section class="container section-spacing">
    <div class="text-center mb-5">
        <h2 class="section-title">
            Layanan Informasi<span class="text-success"> BPKPAD </span>
        </h2>
        <p class="text-muted">Dapatkan Layanan Publik yang ada butuhkan</p>
        
        <!-- Container untuk kedua portal -->
        <div class="row justify-content-center g-4 mt-3">
            <!-- Portal Utama Pessel -->

            <!-- Portal PBB P2 -->
            <div class="col-md-6">
                <a href="https://pbb.pesisirselatankab.go.id/CekPajak/p2" class="text-decoration-none" target="_blank">
                    <div class="portal-card position-relative overflow-hidden rounded-4 hover-lift h-100" 
                        style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); 
                                border: 1px solid rgba(45, 205, 124, 0.15);
                                box-shadow: 0 8px 30px rgba(45, 205, 124, 0.12);
                                transition: all 0.4s ease;">
                        
                        <!-- Background Decoration -->
                        <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10">
                            <div class="position-absolute top-0 end-0 rounded-circle" 
                                style="width: 80px; height: 80px; background: #2dcd7c; transform: translate(30px, -30px);"></div>
                            <div class="position-absolute bottom-0 start-0 rounded-circle" 
                                style="width: 60px; height: 60px; background: #003b49; transform: translate(-20px, 20px);"></div>
                        </div>

                        <div class="position-relative d-flex align-items-center gap-4 p-4 z-1">
                            <!-- Icon Container dengan Logo PBB PNG -->
                            <div class="flex-shrink-0 position-relative">
                                <div class="portal-icon-container position-relative">
                                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center shadow-lg pbb-icon-wrapper"
                                        style="width: 80px; height: 80px; 
                                                background: linear-gradient(135deg, #2dcd7c, #003b49) !important;
                                                border: 3px solid rgba(255, 255, 255, 0.5);">
                                        <!-- Logo PBB PNG -->
                                        <img src="{{ asset('asset/logo/LOGOPBB.png') }}" 
                                            alt="Logo PBB P2" 
                                            class="pbb-logo-img"
                                            style="width: 45px; height: 45px; object-fit: contain; filter: brightness(0) invert(1);"
                                            onerror="this.onerror=null; this.outerHTML='<i class=\'fas fa-home text-white\' style=\'font-size: 2rem;\'></i>';">
                                    </div>
                                    <!-- Pulse Effect -->
                                    <div class="position-absolute top-50 start-50 translate-middle rounded-circle pbb-pulse"
                                        style="width: 90px; height: 90px; 
                                                border: 2px solid rgba(45, 205, 124, 0.3);
                                                animation: pulse 2s infinite;"></div>
                                </div>
                            </div>

                            <!-- Text Content -->
                            <div class="flex-grow-1 text-start">
                                <h6 class="fw-bold mb-2" style="font-size: 1.1rem; color: #2dcd7c;">
                                    PBB P2
                                </h6>
                                <p class="text-muted mb-2 small lh-sm">
                                    Cek Pajak Bumi dan Bangunan Perdesaan dan Perkotaan
                                </p>
                                <div class="d-flex align-items-center gap-2 mt-3">
                                    <span class="fw-semibold small" style="color: #2dcd7c;">Kunjungi Portal</span>
                                    <div class="arrow-container">
                                        <i class="fas fa-arrow-right pbb-arrow" 
                                        style="font-size: 0.9em; transition: transform 0.3s ease; color: #2dcd7c;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Effect Overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-0 rounded-4 pbb-hover-overlay"
                            style="transition: opacity 0.3s ease; background: linear-gradient(135deg, rgba(45, 205, 124, 0.05), rgba(0, 59, 73, 0.02));"></div>
                    </div>
                </a>
            </div>


        </div>
    </div>

    <div id="dataMakroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded-3 overflow-hidden shadow-lg">
            @foreach ($beritaInfografis as $index => $item)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="card border-0 bg-transparent">
                        <div class="position-relative">
                            <img src="{{ asset('asset/foto_berita/' . $item->gambar) }}" 
                                 alt="{{ $item->judul }}"
                                 class="img-fluid w-100"
                                 style="height: 400px; object-fit: contain; background: linear-gradient(135deg, #e6f7ff, #ffffff);"
                                 loading="lazy">
                            <div class="card-caption">
                                <h5 class="mb-0 py-2 px-3 bg-white d-inline-block rounded-pill shadow-sm" style="border: 1px solid rgba(45, 205, 124, 0.2);">
                                    {{ $item->keterangan_gambar }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Berita Section -->
<section class="container section-spacing">
    <div class="berita-box">
        <div class="d-flex justify-content-between align-items-center w-100 mb-4">
            <div class="section-title-box">
                <h2 class="section-title mb-1">
                    Berita <span>Terkini</span>
                </h2>
            </div>
            <div class="hr-connector"></div>
            <a href="{{ route('showBeritaAll') }}" class="btn btn-lihat-semua">
                Lihat Semua Berita <i class="fas fa-arrow-right" style="font-size: 0.8em;"></i>
            </a>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div id="beritaCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-3 overflow-hidden shadow-sm">
                        @foreach ($berita->take(4) as $index => $item)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="card border-0">
                                    <img src="{{ asset('asset/foto_berita/' . $item->gambar) }}" 
                                         alt="{{ $item->judul }}" 
                                         class="card-img-top"
                                         style="height: 300px; object-fit: cover;"
                                         loading="lazy">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge bg-success me-2">NEW</span>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                            </small>
                                        </div>
                                        <h5 class="card-title">
                                            <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}" 
                                               class="text-decoration-none text-dark hover-text-success">
                                                {{ $item->judul }}
                                            </a>
                                        </h5>
                                        <p class="card-text text-muted">{{ Str::limit(strip_tags($item->isi), 150) }}</p>
                                        <div class="d-flex align-items-center">
                                            <small class="text-muted me-3">
                                                <i class="far fa-eye me-1"></i> {{ $item->dibaca }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="far fa-user me-1"></i> 
                                                {{ $item->user->nama_lengkap ?? $item->username }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <ul class="nav nav-tabs mb-3" id="beritaTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="terbaru-tab" data-bs-toggle="tab" 
                                data-bs-target="#terbaru" type="button" role="tab" 
                                aria-controls="terbaru" aria-selected="true">
                            Terbaru
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="terpopuler-tab" data-bs-toggle="tab" 
                                data-bs-target="#terpopuler" type="button" role="tab" 
                                aria-controls="terpopuler" aria-selected="false">
                            Terpopuler
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="beritaTabContent">
                    <div class="tab-pane fade show active" id="terbaru" role="tabpanel" aria-labelledby="terbaru-tab">
                        <div class="list-group list-group-flush">
                            @foreach ($beritaTerbaru as $item)
                                <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}" 
                                   class="list-group-item list-group-item-action border-0 py-3 px-0 hover-bg-light">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="me-3">
                                            <h6 class="mb-1 fw-bold">{{ $item->judul }}</h6>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} • 
                                                <i class="far fa-eye me-1"></i> {{ $item->dibaca }}
                                            </small>
                                        </div>
                                        <i class="fas fa-chevron-right text-muted mt-1"></i>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane fade" id="terpopuler" role="tabpanel" aria-labelledby="terpopuler-tab">
                        <div class="list-group list-group-flush">
                            @foreach ($beritaTerpopuler as $item)
                                <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}" 
                                   class="list-group-item list-group-item-action border-0 py-3 px-0 hover-bg-light">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="me-3">
                                            <h6 class="mb-1 fw-bold">{{ $item->judul }}</h6>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} • 
                                                <i class="far fa-eye me-1"></i> {{ $item->dibaca }}
                                            </small>
                                        </div>
                                        <i class="fas fa-chevron-right text-muted mt-1"></i>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Agenda & Pejabat Section -->
<section class="py-5 section-spacing bg-light-section">
    <div class="container">
        <div class="row g-4">
            <!-- Pejabat Struktural -->
            <div class="col-lg-7">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                    <!-- Header -->
                    <div class="card-header bg-white border-0 border-bottom border-2 border-light px-4 py-3">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-primary text-white rounded-2 p-3 d-flex align-items-center justify-content-center"
                                    style="width: 48px; height: 48px; background: linear-gradient(135deg, #2dcd7c, #003b49) !important;">
                                    <i class="fas fa-user-tie fs-5 text-white"></i>
                                </div>
                                <div>
                                    <h2 class="h4 fw-bold text-success mb-1">
                                        Pejabat <span class="text-success">Struktural</span>
                                    </h2>
                                    <p class="text-muted small mb-0 lh-base">Struktur Kepemimpinan BPKPAD</p>
                                </div>
                            </div>
                            <a href="{{ route('showPejabatAll') }}"
                                class="btn btn-lihat-semua btn-sm d-flex align-items-center gap-2 fw-semibold">
                                <span>Lihat Semua Pejabat</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Officials Carousel -->
                    <div class="card-body px-4 py-3">
                        <div id="pejabatCarousel" class="carousel slide" data-bs-ride="carousel"
                            data-bs-interval="5000">
                            <div class="carousel-inner">
                                @foreach ($pejabat as $index => $item)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8 col-lg-10">
                                                <div class="text-center p-2">
                                                    <!-- Foto dengan Frame -->
                                                    <div class="position-relative d-inline-block mb-4">
                                                        <div class="bg-light border border-3 border-success rounded-circle overflow-hidden shadow-lg"
                                                            style="width: 280px; height: 280px; border-color: rgba(45, 205, 124, 0.3) !important;">
                                                            <img src="{{ asset('asset/foto_pejabat/' . $item->foto) }}"
                                                                class="w-100 h-100 object-fit-cover">
                                                        </div>
                                                    </div>

                                                    <!-- Info di Bawah Foto -->
                                                    <div class="text-center">
                                                        <!-- Name -->
                                                        <h3 class="h4 fw-bold text-dark mb-2">
                                                            {{ $item->nama_pejabat }}</h3>

                                                        <!-- Position Badge -->
                                                        <div class="modern-position-badge bg-light border border-success border-opacity-10 rounded-pill px-3 py-1 mb-4 d-inline-flex align-items-center gap-2">
                                                        <i class="fas fa-id-card text-success" style="font-size: 0.9rem;"></i>
                                                        <span class="fw-semibold text-success" style="font-size: 0.95rem;">
                                                            {{ optional($item->jabatan)->nama_jabatan ?? 'Jabatan Tidak Tersedia' }}
                                                        </span>
                                                    </div>

                                                        <!-- Button -->
                                                        <div class="d-block">
                                                            <a href="{{ route('pejabat.detail', ['slug' => $item->slug]) }}"
                                                                class="btn btn-lihat-semua btn-sm px-4 py-2">
                                                                <span>Lihat Profil</span>
                                                                <i class="fas fa-user-circle ms-2"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#pejabatCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"
                                    aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#pejabatCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle p-2"
                                    aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agenda Kegiatan -->
            <div class="col-lg-5">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                    <!-- Header -->
                    <div class="card-header bg-white border-0 border-bottom border-2 border-light px-4 py-3">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-primary text-white rounded-2 p-3 d-flex align-items-center justify-content-center"
                                    style="width: 48px; height: 48px; background: linear-gradient(135deg, #2dcd7c, #003b49) !important;">
                                    <i class="fas fa-calendar-alt fs-5 text-white"></i>
                                </div>
                                <div>
                                    <h2 class="h4 fw-bold text-success mb-1">
                                        Agenda <span class="text-success">Kegiatan</span>
                                    </h2>
                                    <p class="text-muted small mb-0 lh-base">Jadwal kegiatan BPKPAD</p>
                                </div>
                            </div>
                            <a href="{{ route('showAgendaAll') }}"
                                class="btn btn-lihat-semua btn-sm d-flex align-items-center gap-2 fw-semibold">
                                <span>Lihat Semua Agenda</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Agenda List -->
                    <div class="card-body px-4 py-3">
                        <div class="agenda-list" style="max-height: 500px; overflow-y: auto;">
                            @foreach ($agendas as $item)
                                <div class="agenda-item border-bottom border-light py-3">
                                    <div class="d-flex gap-3">
                                        <!-- Date Badge -->
                                        <div class="flex-shrink-0">
                                            <div class="bg-light text-center rounded-2 p-2 shadow-sm"
                                                style="min-width: 60px; border: 1px solid rgba(45, 205, 124, 0.2);">
                                                <div class="fw-bold text-success mb-0"
                                                    style="font-size: 1.25rem; line-height: 1.2;">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}
                                                </div>
                                                <div class="text-muted small text-uppercase fw-semibold"
                                                    style="font-size: 0.75rem;">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}
                                                </div>
                                                <div class="text-muted small fw-semibold"
                                                    style="font-size: 0.7rem; line-height: 1.2;">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('Y') }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Agenda Details -->
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold text-dark mb-1">{{ $item->nama_agenda }}</h6>
                                            <div class="d-flex align-items-center gap-2 text-muted small mb-1">
                                                <i class="fas fa-clock text-success" style="font-size: 0.8rem;"></i>
                                                <span>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 text-muted small">
                                                <i class="fas fa-map-marker-alt text-success" style="font-size: 0.8rem;"></i>
                                                <span>{{ $item->lokasi }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Informasi Publik PPID --}}
<section class="container section-spacing" id="ppid">
    <div class="text-center mb-5">
        <h2 class="section-title">
            Informasi Publik <span class="text-success">PPID</span>
        </h2>
        <p class="text-muted">Akses informasi publik sesuai dengan ketentuan peraturan perundang-undangan</p>
        
        <!-- Container untuk kartu PPID -->
        <div class="row justify-content-center g-4 mt-3">
            <!-- Informasi Berkala -->
            <div class="col-md-6 col-lg-3">
                <a href="https://www.bpkpad.pesisirselatankab.go.id/ip/detail/1" class="text-decoration-none" target="_blank">
                    <div class="ppid-portal-card position-relative overflow-hidden rounded-4 hover-lift h-100" 
                         style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); 
                                border: 1px solid rgba(0, 123, 255, 0.15);
                                box-shadow: 0 8px 30px rgba(0, 123, 255, 0.12);
                                transition: all 0.4s ease;">
                        
                        <!-- Background Decoration -->
                        <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10">
                            <div class="position-absolute top-0 end-0 rounded-circle" 
                                 style="width: 80px; height: 80px; background: #007bff; transform: translate(30px, -30px);"></div>
                            <div class="position-absolute bottom-0 start-0 rounded-circle" 
                                 style="width: 60px; height: 60px; background: #0056b3; transform: translate(-20px, 20px);"></div>
                        </div>

                        <div class="position-relative d-flex flex-column align-items-center text-center p-4 z-1 h-100">
                            <!-- Icon Container dengan Logo Pessel -->
                            <div class="flex-shrink-0 position-relative mb-3">
                                <div class="ppid-icon-container position-relative">
                                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center shadow-lg ppid-icon-wrapper"
                                         style="width: 80px; height: 80px; 
                                                background: linear-gradient(135deg, #007bff, #0056b3) !important;
                                                border: 3px solid rgba(255, 255, 255, 0.5);">
                                        <!-- Logo Pessel PNG -->
                                        <img src="https://www.repository.pesisirselatankab.go.id/ast-adm/assets/logo_pessel.png" 
                                             alt="Logo Pessel" 
                                             class="ppid-logo-img"
                                             style="width: 45px; height: 45px; object-fit: contain; filter: brightness(0) invert(1);"
                                             onerror="this.onerror=null; this.outerHTML='<i class=\'fas fa-sync-alt text-white\' style=\'font-size: 2rem;\'></i>';">
                                    </div>
                                    <!-- Pulse Effect -->
                                    <div class="position-absolute top-50 start-50 translate-middle rounded-circle ppid-pulse"
                                         style="width: 90px; height: 90px; 
                                                border: 2px solid rgba(0, 123, 255, 0.3);
                                                animation: pulse 2s infinite;"></div>
                                </div>
                            </div>

                            <!-- Text Content -->
                            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="fw-bold mb-2" style="font-size: 1.1rem; color: #007bff;">
                                        Informasi Berkala
                                    </h6>
                                    <p class="text-muted mb-3 small lh-sm">
                                        Informasi yang wajib disediakan dan diumumkan secara berkala
                                    </p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-2 mt-auto">
                                    <span class="fw-semibold small" style="color: #007bff;">Akses Informasi</span>
                                    <div class="arrow-container">
                                        <i class="fas fa-arrow-right ppid-arrow" 
                                           style="font-size: 0.9em; transition: transform 0.3s ease; color: #007bff;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Effect Overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-0 rounded-4 ppid-hover-overlay"
                             style="transition: opacity 0.3s ease; background: linear-gradient(135deg, rgba(0, 123, 255, 0.05), rgba(0, 86, 179, 0.02));"></div>
                    </div>
                </a>
            </div>

            <!-- Informasi Setiap Saat -->
            <div class="col-md-6 col-lg-3">
                <a href="https://www.bpkpad.pesisirselatankab.go.id/ip/detail/2" class="text-decoration-none" target="_blank">
                    <div class="ppid-portal-card position-relative overflow-hidden rounded-4 hover-lift h-100" 
                         style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); 
                                border: 1px solid rgba(40, 167, 69, 0.15);
                                box-shadow: 0 8px 30px rgba(40, 167, 69, 0.12);
                                transition: all 0.4s ease;">
                        
                        <!-- Background Decoration -->
                        <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10">
                            <div class="position-absolute top-0 end-0 rounded-circle" 
                                 style="width: 80px; height: 80px; background: #28a745; transform: translate(30px, -30px);"></div>
                            <div class="position-absolute bottom-0 start-0 rounded-circle" 
                                 style="width: 60px; height: 60px; background: #1e7e34; transform: translate(-20px, 20px);"></div>
                        </div>

                        <div class="position-relative d-flex flex-column align-items-center text-center p-4 z-1 h-100">
                            <!-- Icon Container dengan Logo Pessel -->
                            <div class="flex-shrink-0 position-relative mb-3">
                                <div class="ppid-icon-container position-relative">
                                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center shadow-lg ppid-icon-wrapper"
                                         style="width: 80px; height: 80px; 
                                                background: linear-gradient(135deg, #28a745, #1e7e34) !important;
                                                border: 3px solid rgba(255, 255, 255, 0.5);">
                                        <!-- Logo Pessel PNG -->
                                        <img src="https://www.repository.pesisirselatankab.go.id/ast-adm/assets/logo_pessel.png" 
                                             alt="Logo Pessel" 
                                             class="ppid-logo-img"
                                             style="width: 45px; height: 45px; object-fit: contain; filter: brightness(0) invert(1);"
                                             onerror="this.onerror=null; this.outerHTML='<i class=\'fas fa-clock text-white\' style=\'font-size: 2rem;\'></i>';">
                                    </div>
                                    <!-- Pulse Effect -->
                                    <div class="position-absolute top-50 start-50 translate-middle rounded-circle ppid-pulse"
                                         style="width: 90px; height: 90px; 
                                                border: 2px solid rgba(40, 167, 69, 0.3);
                                                animation: pulse 2s infinite;"></div>
                                </div>
                            </div>

                            <!-- Text Content -->
                            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="fw-bold mb-2" style="font-size: 1.1rem; color: #28a745;">
                                        Informasi Setiap Saat
                                    </h6>
                                    <p class="text-muted mb-3 small lh-sm">
                                        Informasi yang wajib tersedia setiap saat dan dapat diakses
                                    </p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-2 mt-auto">
                                    <span class="fw-semibold small" style="color: #28a745;">Akses Informasi</span>
                                    <div class="arrow-container">
                                        <i class="fas fa-arrow-right ppid-arrow" 
                                           style="font-size: 0.9em; transition: transform 0.3s ease; color: #28a745;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Effect Overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-0 rounded-4 ppid-hover-overlay"
                             style="transition: opacity 0.3s ease; background: linear-gradient(135deg, rgba(40, 167, 69, 0.05), rgba(30, 126, 52, 0.02));"></div>
                    </div>
                </a>
            </div>

            <!-- Informasi Serta Merta -->
            <div class="col-md-6 col-lg-3">
                <a href="https://www.bpkpad.pesisirselatankab.go.id/ip/detail/3" class="text-decoration-none" target="_blank">
                    <div class="ppid-portal-card position-relative overflow-hidden rounded-4 hover-lift h-100" 
                         style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); 
                                border: 1px solid rgba(255, 193, 7, 0.15);
                                box-shadow: 0 8px 30px rgba(255, 193, 7, 0.12);
                                transition: all 0.4s ease;">
                        
                        <!-- Background Decoration -->
                        <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10">
                            <div class="position-absolute top-0 end-0 rounded-circle" 
                                 style="width: 80px; height: 80px; background: #ffc107; transform: translate(30px, -30px);"></div>
                            <div class="position-absolute bottom-0 start-0 rounded-circle" 
                                 style="width: 60px; height: 60px; background: #e0a800; transform: translate(-20px, 20px);"></div>
                        </div>

                        <div class="position-relative d-flex flex-column align-items-center text-center p-4 z-1 h-100">
                            <!-- Icon Container dengan Logo Pessel -->
                            <div class="flex-shrink-0 position-relative mb-3">
                                <div class="ppid-icon-container position-relative">
                                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center shadow-lg ppid-icon-wrapper"
                                         style="width: 80px; height: 80px; 
                                                background: linear-gradient(135deg, #ffc107, #e0a800) !important;
                                                border: 3px solid rgba(255, 255, 255, 0.5);">
                                        <!-- Logo Pessel PNG -->
                                        <img src="https://www.repository.pesisirselatankab.go.id/ast-adm/assets/logo_pessel.png" 
                                             alt="Logo Pessel" 
                                             class="ppid-logo-img"
                                             style="width: 45px; height: 45px; object-fit: contain; filter: brightness(0) invert(1);"
                                             onerror="this.onerror=null; this.outerHTML='<i class=\'fas fa-bolt text-white\' style=\'font-size: 2rem;\'></i>';">
                                    </div>
                                    <!-- Pulse Effect -->
                                    <div class="position-absolute top-50 start-50 translate-middle rounded-circle ppid-pulse"
                                         style="width: 90px; height: 90px; 
                                                border: 2px solid rgba(255, 193, 7, 0.3);
                                                animation: pulse 2s infinite;"></div>
                                </div>
                            </div>

                            <!-- Text Content -->
                            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="fw-bold mb-2" style="font-size: 1.1rem; color: #ffc107;">
                                        Informasi Serta Merta
                                    </h6>
                                    <p class="text-muted mb-3 small lh-sm">
                                        Informasi yang wajib diumumkan segera tanpa penundaan
                                    </p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-2 mt-auto">
                                    <span class="fw-semibold small" style="color: #ffc107;">Akses Informasi</span>
                                    <div class="arrow-container">
                                        <i class="fas fa-arrow-right ppid-arrow" 
                                           style="font-size: 0.9em; transition: transform 0.3s ease; color: #ffc107;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Effect Overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-0 rounded-4 ppid-hover-overlay"
                             style="transition: opacity 0.3s ease; background: linear-gradient(135deg, rgba(255, 193, 7, 0.05), rgba(224, 168, 0, 0.02));"></div>
                    </div>
                </a>
            </div>

            <!-- Informasi Dikecualikan -->
            <div class="col-md-6 col-lg-3">
                <a href="https://www.bpkpad.pesisirselatankab.go.id/ip/detail/4" class="text-decoration-none" target="_blank">
                    <div class="ppid-portal-card position-relative overflow-hidden rounded-4 hover-lift h-100" 
                         style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); 
                                border: 1px solid rgba(108, 117, 125, 0.15);
                                box-shadow: 0 8px 30px rgba(108, 117, 125, 0.12);
                                transition: all 0.4s ease;">
                        
                        <!-- Background Decoration -->
                        <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10">
                            <div class="position-absolute top-0 end-0 rounded-circle" 
                                 style="width: 80px; height: 80px; background: #6c757d; transform: translate(30px, -30px);"></div>
                            <div class="position-absolute bottom-0 start-0 rounded-circle" 
                                 style="width: 60px; height: 60px; background: #495057; transform: translate(-20px, 20px);"></div>
                        </div>

                        <div class="position-relative d-flex flex-column align-items-center text-center p-4 z-1 h-100">
                            <!-- Icon Container dengan Logo Pessel -->
                            <div class="flex-shrink-0 position-relative mb-3">
                                <div class="ppid-icon-container position-relative">
                                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center shadow-lg ppid-icon-wrapper"
                                         style="width: 80px; height: 80px; 
                                                background: linear-gradient(135deg, #6c757d, #495057) !important;
                                                border: 3px solid rgba(255, 255, 255, 0.5);">
                                        <!-- Logo Pessel PNG -->
                                        <img src="https://www.repository.pesisirselatankab.go.id/ast-adm/assets/logo_pessel.png" 
                                             alt="Logo Pessel" 
                                             class="ppid-logo-img"
                                             style="width: 45px; height: 45px; object-fit: contain; filter: brightness(0) invert(1);"
                                             onerror="this.onerror=null; this.outerHTML='<i class=\'fas fa-lock text-white\' style=\'font-size: 2rem;\'></i>';">
                                    </div>
                                    <!-- Pulse Effect -->
                                    <div class="position-absolute top-50 start-50 translate-middle rounded-circle ppid-pulse"
                                         style="width: 90px; height: 90px; 
                                                border: 2px solid rgba(108, 117, 125, 0.3);
                                                animation: pulse 2s infinite;"></div>
                                </div>
                            </div>

                            <!-- Text Content -->
                            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="fw-bold mb-2" style="font-size: 1.1rem; color: #6c757d;">
                                        Informasi Dikecualikan
                                    </h6>
                                    <p class="text-muted mb-3 small lh-sm">
                                        Informasi yang dikecualikan dari kewajiban untuk dibuka
                                    </p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-2 mt-auto">
                                    <span class="fw-semibold small" style="color: #6c757d;">Akses Informasi</span>
                                    <div class="arrow-container">
                                        <i class="fas fa-arrow-right ppid-arrow" 
                                           style="font-size: 0.9em; transition: transform 0.3s ease; color: #6c757d;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Effect Overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-0 rounded-4 ppid-hover-overlay"
                             style="transition: opacity 0.3s ease; background: linear-gradient(135deg, rgba(108, 117, 125, 0.05), rgba(73, 80, 87, 0.02));"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
{{-- End Informasi Publik PPID --}}

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects for PPID cards
            document.querySelectorAll('.ppid-portal-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Add click tracking for analytics
            document.querySelectorAll('.ppid-portal-card').forEach(card => {
                card.addEventListener('click', function() {
                    const cardTitle = this.querySelector('h6').textContent;
                    console.log(`PPID Card clicked: ${cardTitle}`);
                    // Add your analytics tracking code here
                });
            });
        });
        </script>
    @endpush
@endsection