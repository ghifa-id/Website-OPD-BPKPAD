<!DOCTYPE html>
<html lang="en">
@include('guest.layouts.head')
@stack('styles')

<body>
    <!-- Themed Preloader -->
    <div id="pre-loader">
        <div class="loader-content">
            <div id="loader-logo">
                <img src="https://www.pesisirselatankab.go.id/assets/images/logo2.png" alt="BPKPAD Logo">
            </div>
            <div class="loader-text">
                <h3>BPKPAD</h3>
                <p>Pesisir Selatan</p>
            </div>
            <div class="loader-progress">
                <div class="loader-bar"></div>
            </div>
            <div class="loader-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="loader-overlay"></div>
    </div>

    <!-- Header & Navigation -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top custom-navbar">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="/">
                    <img src="https://www.pesisirselatankab.go.id/assets/images/logo2.png" alt="BPKPAD Logo" width="40" height="40" class="d-inline-block align-top">
                    <span class="brand-text">BPKPAD</span>
                    <small class="brand-subtitle">Pesisir Selatan</small>
                </a>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" 
                        aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Main Navigation -->
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Beranda -->
                        <li class="nav-item">
                            <a class="nav-link active" href="/">Beranda</a>
                        </li>

                        <!-- Profil Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Profil
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                                <li><a class="dropdown-item" href="/profil/visi-misi">Visi & Misi</a></li>
                                <li><a class="dropdown-item" href="/profil/tugas-fungsi">Tugas & Fungsi</a></li>
                                <li><a class="dropdown-item" href="/profil/struktur-organisasi">Struktur Organisasi</a></li>
                                <li><a class="dropdown-item" href="/profil/pegawai">Data Pegawai</a></li>
                            </ul>
                        </li>

                        <!-- Layanan Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Layanan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="layananDropdown">
                                <li><a class="dropdown-item" href="/layanan/informasi-publik">Informasi Publik</a></li>
                                <li><a class="dropdown-item" href="/layanan/pengaduan">Pengaduan Masyarakat</a></li>
                                <li><a class="dropdown-item" href="/layanan/permohonan-data">Permohonan Data</a></li>
                                <li><a class="dropdown-item" href="/layanan/konsultasi">Konsultasi</a></li>
                            </ul>
                        </li>

                        <!-- Data & Informasi Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dataDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Data & Informasi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dataDropdown">
                                <li><a class="dropdown-item" href="/data/anggaran">Anggaran</a></li>
                                <li><a class="dropdown-item" href="/data/kinerja">Laporan Kinerja</a></li>
                                <li><a class="dropdown-item" href="/data/statistik">Data Statistik</a></li>
                                <li><a class="dropdown-item" href="/data/publikasi">Publikasi</a></li>
                            </ul>
                        </li>

                        <!-- Berita & Artikel -->
                        <li class="nav-item">
                            <a class="nav-link" href="/berita">Berita</a>
                        </li>

                        <!-- Galeri -->
                        <li class="nav-item">
                            <a class="nav-link" href="/galeri">Galeri</a>
                        </li>

                        <!-- Kontak -->
                        <li class="nav-item">
                            <a class="nav-link" href="/kontak">Kontak</a>
                        </li>
                    </ul>

                    <!-- Search Form -->
                    <form class="d-flex search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari..." aria-label="Search">
                            <button class="btn btn-search" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile Navigation -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
    <nav class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-header">
            <div class="mobile-logo">
                <img src="https://www.pesisirselatankab.go.id/assets/images/logo2.png" alt="BPKPAD Logo" width="30" height="30">
                <span>BPKPAD Pesisir Selatan</span>
            </div>
            <button class="mobile-close-btn" id="mobileCloseBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mobile-nav-content">
            <ul class="mobile-nav-list">
                <li><a href="/" class="mobile-nav-link active"><i class="fas fa-home"></i> Beranda</a></li>
                <li class="mobile-nav-dropdown">
                    <a href="#" class="mobile-nav-link"><i class="fas fa-user"></i> Profil <i class="fas fa-chevron-down"></i></a>
                    <ul class="mobile-submenu">
                        <li><a href="/profil/visi-misi">Visi & Misi</a></li>
                        <li><a href="/profil/tugas-fungsi">Tugas & Fungsi</a></li>
                        <li><a href="/profil/struktur-organisasi">Struktur Organisasi</a></li>
                        <li><a href="/profil/pegawai">Data Pegawai</a></li>
                    </ul>
                </li>
                <li class="mobile-nav-dropdown">
                    <a href="#" class="mobile-nav-link"><i class="fas fa-concierge-bell"></i> Layanan <i class="fas fa-chevron-down"></i></a>
                    <ul class="mobile-submenu">
                        <li><a href="/layanan/informasi-publik">Informasi Publik</a></li>
                        <li><a href="/layanan/pengaduan">Pengaduan Masyarakat</a></li>
                        <li><a href="/layanan/permohonan-data">Permohonan Data</a></li>
                        <li><a href="/layanan/konsultasi">Konsultasi</a></li>
                    </ul>
                </li>
                <li><a href="/berita" class="mobile-nav-link"><i class="fas fa-newspaper"></i> Berita</a></li>
                <li><a href="/galeri" class="mobile-nav-link"><i class="fas fa-images"></i> Galeri</a></li>
                <li><a href="/kontak" class="mobile-nav-link"><i class="fas fa-phone"></i> Kontak</a></li>
            </ul>
        </div>
    </nav>

    <div class="page-wrapper">
        @yield('content')
    </div>

    @include('guest.partials.footer')
    @stack('scripts')
    @include('guest.layouts.script')

    <!-- Themed Scroll to Top Button -->
    <a href="#" class="scroll-to-top-green scroll-to-target" data-target="html">
        <div class="scroll-icon">
            <i class="fas fa-arrow-up"></i>
        </div>
        <div class="scroll-ripple"></div>
    </a>

    <!-- Themed Features Button -->
    <button id="fiturToggleBtn" class="fitur-btn-green">
        <div class="btn-content">
            <i class="fas fa-sliders"></i>
            <span>Fitur</span>
        </div>
        <div class="btn-glow"></div>
    </button>

    <!-- Themed Features Panel -->
    <article id="fiturPanel" class="fitur-panel-green">
        <ul class="fitur-list">
            <!-- Kepuasan Publik -->
            <li class="fitur-item">
                <a href="https://www.bpkpad.pesisirselatankab.go.id/kepuasanPublik" target="_blank" rel="noopener noreferrer">
                    <div class="fitur-card">
                        <div class="fitur-icon satisfaction">
                            <i class="fas fa-face-smile"></i>
                        </div>
                        <div class="fitur-content">
                            <h6>Kepuasan Publik</h6>
                            <p>Berikan penilaian seberapa puas kamu dengan layanan dan informasi yang disajikan di website ini.</p>
                        </div>
                        <div class="fitur-arrow">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                    </div>
                </a>
            </li>

            <!-- Cuaca Hari Ini -->
            <li class="fitur-item">
                <button class="fitur-card w-100 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#modalCuaca">
                    <div class="fitur-icon weather">
                        <i class="fas fa-cloud-sun"></i>
                    </div>
                    <div class="fitur-content">
                        <h6>Cuaca Hari Ini</h6>
                        <p>Lihat prakiraan cuaca terkini untuk wilayah Painan.</p>
                    </div>
                    <div class="fitur-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </button>
            </li>

            <!-- Akses Cepat -->
            <li class="fitur-item">
                <button class="fitur-card w-100 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#modalAksesCepat">
                    <div class="fitur-icon quick-access">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="fitur-content">
                        <h6>Akses Cepat</h6>
                        <p>Jelajahi konten atau fitur utama dengan lebih efisien dan cepat.</p>
                    </div>
                    <div class="fitur-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </button>
            </li>
        </ul>
    </article>

    <!-- Themed Weather Modal -->
    <div class="modal fade" id="modalCuaca" tabindex="-1" aria-labelledby="modalCuacaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content green-modal">
                <div class="modal-header green-modal-header">
                    <h5 class="modal-title" id="modalCuacaLabel">
                        <i class="fas fa-cloud-sun"></i>
                        <span>Prakiraan Cuaca IV Jurai</span>
                    </h5>
                    <button type="button" class="btn-close green-btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body green-modal-body">
                    <div class="weather-info">
                        <div class="weather-row">
                            <span class="weather-label">Tanggal</span>
                            <span class="weather-value" id="cuaca-date">Memuat...</span>
                        </div>
                        <div class="weather-row">
                            <span class="weather-label">Cuaca</span>
                            <span class="weather-value" id="cuaca-desc">Memuat...</span>
                        </div>
                        <div class="weather-row">
                            <span class="weather-label">Suhu</span>
                            <span class="weather-value" id="cuaca-temp">-</span>
                        </div>
                        <div class="weather-row">
                            <span class="weather-label">Kelembapan</span>
                            <span class="weather-value" id="cuaca-humid">-</span>
                        </div>
                        <div class="weather-row">
                            <span class="weather-label">Angin</span>
                            <span class="weather-value" id="cuaca-wind">-</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer green-modal-footer">
                    <button type="button" class="btn-green-gradient" data-bs-dismiss="modal">
                        <span>Tutup</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Themed Quick Access Modal -->
    <div class="modal fade" id="modalAksesCepat" tabindex="-1" aria-labelledby="modalAksesCepatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content green-modal">
                <div class="modal-header green-modal-header">
                    <h5 class="modal-title" id="modalAksesCepatLabel">
                        <i class="fas fa-bolt"></i>
                        <span>Akses Cepat</span>
                    </h5>
                    <button type="button" class="btn-close green-btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body green-modal-body">
                    <div class="quick-access-grid">
                        <!-- Portal Utama -->
                        <a href="https://www.pesisirselatankab.go.id/" target="_blank" class="quick-access-item">
                            <div class="access-card">
                                <div class="access-icon">
                                    <img src="https://www.pesisirselatankab.go.id/assets/images/logo2.png" alt="Portal Pessel" loading="lazy">
                                </div>
                                <div class="access-content">
                                    <h6>Portal Utama</h6>
                                    <p>Website resmi Pemerintah Kabupaten Pesisir Selatan</p>
                                </div>
                                <div class="access-arrow">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>
                            </div>
                        </a>

                        <!-- PPID -->
                        <a href="https://ppid.pesisirselatankab.go.id/" target="_blank" class="quick-access-item">
                            <div class="access-card">
                                <div class="access-icon">
                                    <img src="https://ppid.pesisirselatankab.go.id/asset/images/logo.png" alt="PPID" loading="lazy">
                                </div>
                                <div class="access-content">
                                    <h6>PPID</h6>
                                    <p>Pusat informasi publik terkait layanan dan dokumen resmi</p>
                                </div>
                                <div class="access-arrow">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>
                            </div>
                        </a>

                        <!-- e-SAKIP -->
                        <a href="https://spbe2.pesisirselatankab.go.id/login" target="_blank" class="quick-access-item">
                            <div class="access-card">
                                <div class="access-icon">
                                    <img src="https://www.repository.pesisirselatankab.go.id/ast-adm/assets/logo_pessel.png" alt="e-SAKIP" loading="lazy">
                                </div>
                                <div class="access-content">
                                    <h6>e-SAKIP</h6>
                                    <p>Sistem Pemerintahan Berbasis Elektronik Pemerintah Kabupaten Pesisir Selatan</p>
                                </div>
                                <div class="access-arrow">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="modal-footer green-modal-footer">
                    <button type="button" class="btn-green-gradient" data-bs-dismiss="modal">
                        <span>Tutup</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* ===== CSS VARIABLES ===== */
        :root {
            --primary-green: #003b49;
            --secondary-green: #2dcd7c;
            --light-green: rgba(45, 205, 124, 0.1);
            --dark-green: #003b49;
            --accent-green: rgba(230, 247, 255, 0.5);
        }

        /* ===== NAVBAR STYLES ===== */
        .custom-navbar {
            box-shadow: 0 2px 20px rgba(0, 59, 73, 0.1);
            padding: 8px 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            color: var(--primary-green) !important;
            text-decoration: none;
        }

        .brand-text {
            font-size: 1.1rem !important;
            font-weight: 800;
        }

        .brand-subtitle {
            font-size: 0.6rem !important;
            color: var(--secondary-green);
            font-weight: 500;
        }

        /* ===== NAVBAR FONT SIZE FIXES ===== */
        .navbar-nav .nav-link {
            color: var(--primary-green) !important;
            font-weight: 500 !important;
            padding: 6px 10px !important;
            margin: 0 2px;
            border-radius: 6px;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.8rem !important;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: var(--light-green);
            color: var(--secondary-green) !important;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--secondary-green);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 70%;
        }

        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 25px rgba(0, 59, 73, 0.15);
            border-radius: 10px;
            padding: 8px;
            margin-top: 8px !important;
            border: 1px solid rgba(45, 205, 124, 0.1);
            min-width: 180px !important;
        }

        .dropdown-item {
            padding: 6px 10px !important;
            border-radius: 6px;
            margin: 2px 0;
            color: var(--primary-green);
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.75rem !important;
        }

        .dropdown-item:hover {
            background: var(--light-green);
            color: var(--secondary-green);
        }

        .dropdown-toggle::after {
            margin-left: 4px !important;
            font-size: 0.7rem;
        }

        /* Search Form */
        .search-form .input-group {
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--light-green);
        }

        .search-form .form-control {
            border: none;
            padding: 6px 12px !important;
            background: transparent;
            font-size: 0.8rem !important;
        }

        .search-form .form-control:focus {
            box-shadow: none;
            background: transparent;
        }

        .btn-search {
            background: var(--secondary-green);
            border: none;
            color: white;
            padding: 6px 12px !important;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }

        .btn-search:hover {
            background: var(--primary-green);
        }

        /* Mobile Navigation */
        .mobile-nav-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 59, 73, 0.8);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-nav-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            right: -100%;
            width: 280px;
            height: 100%;
            background: white;
            z-index: 1050;
            transition: right 0.3s ease;
            box-shadow: -5px 0 30px rgba(0, 0, 0, 0.1);
        }

        .mobile-nav.active {
            right: 0;
        }

        .mobile-nav-header {
            padding: 15px;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mobile-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .mobile-close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
        }

        .mobile-nav-content {
            padding: 15px;
            height: calc(100% - 60px);
            overflow-y: auto;
        }

        .mobile-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px !important;
            color: var(--primary-green);
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 4px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.85rem !important;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            background: var(--light-green);
            color: var(--secondary-green);
        }

        .mobile-nav-dropdown .mobile-nav-link {
            justify-content: space-between;
        }

        .mobile-submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            padding-left: 15px;
            display: none;
        }

        .mobile-submenu.active {
            display: block;
        }

        .mobile-submenu a {
            display: block;
            padding: 8px 12px !important;
            color: var(--primary-green);
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 2px;
            transition: all 0.3s ease;
            font-size: 0.8rem !important;
        }

        .mobile-submenu a:hover {
            background: var(--light-green);
            color: var(--secondary-green);
        }

        /* For even smaller text on larger screens */
        @media (min-width: 1200px) {
            .navbar-nav .nav-link {
                font-size: 0.75rem !important;
                padding: 5px 8px !important;
            }
            
            .dropdown-item {
                font-size: 0.7rem !important;
            }
            
            .brand-text {
                font-size: 1rem !important;
            }
            
            .brand-subtitle {
                font-size: 0.55rem !important;
            }
        }

        /* ===== PRELOADER THEME ===== */
        #pre-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--dark-green) 0%, var(--secondary-green) 50%, var(--primary-green) 100%);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="loaderPattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="5" cy="5" r="0.5" fill="%2345d1a4" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23loaderPattern)"/></svg>');
            pointer-events: none;
        }

        .loader-content {
            text-align: center;
            color: white;
            position: relative;
            z-index: 2;
        }

        #loader-logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(45, 205, 124, 0.3);
            animation: logoFloat 3s ease-in-out infinite;
        }

        #loader-logo img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            filter: brightness(1.2);
        }

        .loader-text h3 {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 5px;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        .loader-text p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 20px;
            font-weight: 500;
        }

        .loader-progress {
            width: 180px;
            height: 3px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            margin: 0 auto 20px;
            overflow: hidden;
        }

        .loader-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--secondary-green), white, var(--secondary-green));
            border-radius: 2px;
            animation: loadingBar 2s ease-in-out infinite;
        }

        .loader-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
        }

        .loader-dots span {
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            animation: dotBounce 1.5s ease-in-out infinite;
        }

        .loader-dots span:nth-child(1) { animation-delay: 0s; }
        .loader-dots span:nth-child(2) { animation-delay: 0.2s; }
        .loader-dots span:nth-child(3) { animation-delay: 0.4s; }

        /* Loader Animations */
        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(5deg); }
        }

        @keyframes textGlow {
            0% { text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); }
            100% { text-shadow: 0 4px 8px rgba(45, 205, 124, 0.5), 0 2px 4px rgba(0, 0, 0, 0.3); }
        }

        @keyframes loadingBar {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(200%); }
        }

        @keyframes dotBounce {
            0%, 80%, 100% { transform: scale(0); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }

        /* ===== SCROLL TO TOP THEME ===== */
        .scroll-to-top-green {
            position: fixed;
            bottom: 80px;
            right: 15px;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: white;
            font-size: 16px;
            z-index: 1050;
            box-shadow: 0 6px 20px rgba(45, 205, 124, 0.4);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            overflow: hidden;
        }

        .scroll-to-top-green.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .scroll-to-top-green:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 10px 30px rgba(45, 205, 124, 0.5);
            color: white;
        }

        .scroll-icon {
            position: relative;
            z-index: 2;
        }

        .scroll-ripple {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3), transparent);
            border-radius: 12px;
            transform: scale(0);
            transition: transform 0.3s ease;
        }

        .scroll-to-top-green:active .scroll-ripple {
            transform: scale(1);
        }

        /* ===== FITUR BUTTON THEME ===== */
        .fitur-btn-green {
            position: fixed;
            bottom: 15px;
            right: 15px;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 10px;
            font-weight: 600;
            z-index: 1050;
            box-shadow: 0 6px 20px rgba(45, 205, 124, 0.4);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
            overflow: hidden;
            animation: featurePulse 3s ease-in-out infinite;
        }

        .fitur-btn-green:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 30px rgba(45, 205, 124, 0.5);
            animation: none;
        }

        .btn-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1px;
        }

        .btn-content i {
            font-size: 16px;
        }

        .btn-content span {
            font-size: 8px;
            line-height: 1;
        }

        .btn-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80px;
            height: 80px;
            background: radial-gradient(circle, rgba(45, 205, 124, 0.3), transparent);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.3s ease;
        }

        .fitur-btn-green:hover .btn-glow {
            transform: translate(-50%, -50%) scale(1);
        }

        @keyframes featurePulse {
            0%, 100% { transform: scale(1); box-shadow: 0 6px 20px rgba(45, 205, 124, 0.4); }
            50% { transform: scale(1.02); box-shadow: 0 8px 25px rgba(45, 205, 124, 0.5); }
        }

        /* ===== FITUR PANEL THEME ===== */
        .fitur-panel-green {
            position: fixed;
            width: 280px;
            max-height: 400px;
            bottom: 120px;
            right: 15px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            box-shadow: 0 15px 50px rgba(45, 205, 124, 0.3);
            border: 1px solid rgba(45, 205, 124, 0.2);
            display: none;
            z-index: 1040;
            overflow: hidden;
            animation: panelSlideIn 0.3s ease-out;
        }

        .panel-header {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
            padding: 12px 15px;
            border-radius: 15px 15px 0 0;
        }

        .panel-header h6 {
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
        }

        .fitur-list {
            list-style: none;
            margin: 0;
            padding: 12px;
            max-height: 300px;
            overflow-y: auto;
        }

        .fitur-item {
            margin-bottom: 8px;
        }

        .fitur-item:last-child {
            margin-bottom: 0;
        }

        .fitur-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            border: 1px solid rgba(45, 205, 124, 0.1);
            cursor: pointer;
            text-align: left;
        }

        .fitur-card:hover {
            background: var(--light-green);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(45, 205, 124, 0.2);
            color: inherit;
        }

        .fitur-icon {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            flex-shrink: 0;
        }

        .fitur-icon.satisfaction { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .fitur-icon.weather { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .fitur-icon.quick-access { background: linear-gradient(135deg, var(--secondary-green), var(--primary-green)); }

        .fitur-content {
            flex-grow: 1;
        }

        .fitur-content h6 {
            margin: 0 0 4px 0;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--primary-green);
        }

        .fitur-content p {
            margin: 0;
            font-size: 0.7rem;
            color: #6b7280;
            line-height: 1.3;
        }

        .fitur-arrow {
            color: var(--secondary-green);
            font-size: 12px;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .fitur-card:hover .fitur-arrow {
            opacity: 1;
            transform: translateX(2px);
        }

        @keyframes panelSlideIn {
            from {
                opacity: 0;
                transform: translateY(15px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ===== MODAL THEME ===== */
        .green-modal {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(45, 205, 124, 0.3);
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff, var(--accent-green));
        }

        .green-modal-header {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 20px 20px 0 0;
        }

        .green-modal-header .modal-title {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .green-modal-header .modal-title i {
            font-size: 18px;
        }

        .green-btn-close {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .green-btn-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .green-modal-body {
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .green-modal-footer {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            padding: 15px 20px;
            border-radius: 0 0 20px 20px;
            display: flex;
            justify-content: center;
        }

        /* Weather Info Styling */
        .weather-info {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 12px;
            padding: 15px;
            border: 1px solid rgba(45, 205, 124, 0.1);
        }

        .weather-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-bottom: 1px solid rgba(45, 205, 124, 0.1);
            font-size: 0.85rem;
        }

        .weather-row:last-child {
            border-bottom: none;
        }

        .weather-label {
            font-weight: 600;
            color: var(--primary-green);
        }

        .weather-value {
            color: #374151;
            font-weight: 500;
        }

        /* Quick Access Grid */
        .quick-access-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px;
        }

        .quick-access-item {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .access-card {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid rgba(45, 205, 124, 0.1);
            transition: all 0.3s ease;
        }

        .access-card:hover {
            background: var(--light-green);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 205, 124, 0.2);
        }

        .access-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            flex-shrink: 0;
        }

        .access-icon img {
            width: 30px;
            height: 30px;
            object-fit: contain;
        }

        .access-content {
            flex-grow: 1;
        }

        .access-content h6 {
            margin: 0 0 4px 0;
            font-weight: 700;
            color: var(--primary-green);
            font-size: 0.8rem;
        }

        .access-content p {
            margin: 0;
            font-size: 0.7rem;
            color: #6b7280;
            line-height: 1.3;
        }

        .access-arrow {
            color: var(--secondary-green);
            font-size: 14px;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .access-card:hover .access-arrow {
            opacity: 1;
            transform: translateX(2px);
        }

        /* Button Gradient */
        .btn-green-gradient {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(45, 205, 124, 0.3);
            font-size: 0.8rem;
        }

        .btn-green-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(45, 205, 124, 0.4);
            color: white;
        }

        /* ===== NAVBAR FIXES ===== */
        /* Prevent accidental hover triggers */
        @media (min-width: 992px) {
            .dropdown-menu {
                display: none !important;
                opacity: 0;
                visibility: hidden;
                transform: translateY(8px);
                transition: all 0.3s ease;
            }
            
            .dropdown:hover .dropdown-menu {
                display: block !important;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            
            .dropdown-menu.show {
                display: block !important;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .fitur-panel-green {
                width: calc(100vw - 30px);
                right: 15px;
                left: 15px;
            }
            
            .scroll-to-top-green {
                bottom: 100px;
            }
            
            .quick-access-grid {
                grid-template-columns: 1fr;
            }
            
            #loader-logo {
                width: 80px;
                height: 80px;
            }
            
            #loader-logo img {
                width: 50px;
                height: 50px;
            }
            
            .loader-text h3 {
                font-size: 18px;
            }
            
            .navbar-brand {
                font-size: 0.8rem;
            }
            
            .brand-text {
                font-size: 0.9rem !important;
            }
            
            .brand-subtitle {
                font-size: 0.5rem !important;
            }
        }

        /* Scrollbar for Panel */
        .fitur-list::-webkit-scrollbar {
            width: 3px;
        }

        .fitur-list::-webkit-scrollbar-track {
            background: rgba(45, 205, 124, 0.1);
            border-radius: 2px;
        }

        .fitur-list::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border-radius: 2px;
        }

        /* Focus States for Accessibility */
        .fitur-btn-green:focus,
        .scroll-to-top-green:focus,
        .btn-green-gradient:focus,
        .navbar-toggler:focus,
        .nav-link:focus,
        .dropdown-item:focus {
            outline: 2px solid var(--secondary-green);
            outline-offset: 2px;
        }

        .fitur-card:focus {
            outline: 2px solid var(--secondary-green);
            outline-offset: -2px;
        }

        /* Loading Animation for External Links */
        .loading i {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Print Styles */
        @media print {
            #pre-loader,
            .scroll-to-top-green,
            .fitur-btn-green,
            .fitur-panel-green,
            .navbar {
                display: none !important;
            }
        }
    </style>

    <script>
        // Enhanced Navbar Control
        document.addEventListener('DOMContentLoaded', function() {
            // Main navbar control
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            if (navbarToggler && navbarCollapse) {
                let isNavbarOpen = false;
                
                // Better toggle control
                navbarToggler.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    isNavbarOpen = !isNavbarOpen;
                    if (isNavbarOpen) {
                        navbarCollapse.classList.add('show');
                        navbarToggler.setAttribute('aria-expanded', 'true');
                    } else {
                        navbarCollapse.classList.remove('show');
                        navbarToggler.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // Close navbar when clicking outside
                document.addEventListener('click', function(e) {
                    if (isNavbarOpen && !navbarCollapse.contains(e.target) && !navbarToggler.contains(e.target)) {
                        navbarCollapse.classList.remove('show');
                        navbarToggler.setAttribute('aria-expanded', 'false');
                        isNavbarOpen = false;
                    }
                });
                
                // Close navbar on resize (for mobile to desktop transition)
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 992) {
                        navbarCollapse.classList.remove('show');
                        navbarToggler.setAttribute('aria-expanded', 'false');
                        isNavbarOpen = false;
                    }
                });
            }
            
            // Enhanced dropdown behavior for desktop
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('mouseenter', function() {
                    if (window.innerWidth >= 992) {
                        const menu = this.querySelector('.dropdown-menu');
                        if (menu) {
                            menu.style.opacity = '1';
                            menu.style.visibility = 'visible';
                            menu.style.transform = 'translateY(0)';
                        }
                    }
                });
                
                dropdown.addEventListener('mouseleave', function() {
                    if (window.innerWidth >= 992) {
                        const menu = this.querySelector('.dropdown-menu');
                        if (menu) {
                            menu.style.opacity = '0';
                            menu.style.visibility = 'hidden';
                            menu.style.transform = 'translateY(8px)';
                        }
                    }
                });
            });
            
            // Mobile navigation control
            const mobileNavToggler = document.querySelector('.navbar-toggler');
            const mobileNav = document.getElementById('mobileNav');
            const mobileNavOverlay = document.getElementById('mobileNavOverlay');
            const mobileCloseBtn = document.getElementById('mobileCloseBtn');
            
            if (mobileNavToggler && mobileNav) {
                mobileNavToggler.addEventListener('click', function() {
                    mobileNav.classList.add('active');
                    mobileNavOverlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
                
                function closeMobileNav() {
                    mobileNav.classList.remove('active');
                    mobileNavOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
                
                if (mobileCloseBtn) {
                    mobileCloseBtn.addEventListener('click', closeMobileNav);
                }
                
                if (mobileNavOverlay) {
                    mobileNavOverlay.addEventListener('click', closeMobileNav);
                }
                
                // Mobile dropdown functionality
                const mobileDropdowns = document.querySelectorAll('.mobile-nav-dropdown');
                mobileDropdowns.forEach(dropdown => {
                    const link = dropdown.querySelector('.mobile-nav-link');
                    const submenu = dropdown.querySelector('.mobile-submenu');
                    
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        submenu.classList.toggle('active');
                        const icon = this.querySelector('.fa-chevron-down');
                        icon.classList.toggle('fa-rotate-180');
                    });
                });
            }
            
            // Features panel control
            const fiturToggleBtn = document.getElementById('fiturToggleBtn');
            const fiturPanel = document.getElementById('fiturPanel');
            
            if (fiturToggleBtn && fiturPanel) {
                fiturToggleBtn.addEventListener('click', function() {
                    const isVisible = fiturPanel.style.display === 'block';
                    fiturPanel.style.display = isVisible ? 'none' : 'block';
                });
                
                // Close features panel when clicking outside
                document.addEventListener('click', function(e) {
                    if (!fiturToggleBtn.contains(e.target) && !fiturPanel.contains(e.target)) {
                        fiturPanel.style.display = 'none';
                    }
                });
            }
            
            // Scroll to top functionality
            const scrollToTopBtn = document.querySelector('.scroll-to-top-green');
            
            if (scrollToTopBtn) {
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        scrollToTopBtn.classList.add('show');
                    } else {
                        scrollToTopBtn.classList.remove('show');
                    }
                });
                
                scrollToTopBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
            
            // Preloader removal
            window.addEventListener('load', function() {
                const preloader = document.getElementById('pre-loader');
                if (preloader) {
                    setTimeout(() => {
                        preloader.style.opacity = '0';
                        preloader.style.visibility = 'hidden';
                        setTimeout(() => {
                            preloader.remove();
                        }, 500);
                    }, 1000);
                }
            });
        });

        // Touch device detection for better mobile handling
        function isTouchDevice() {
            return 'ontouchstart' in window || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
        }

        if (isTouchDevice()) {
            document.body.classList.add('touch-device');
            
            // Prevent hover effects on touch devices
            const style = document.createElement('style');
            style.textContent = `
                @media (hover: none) and (pointer: coarse) {
                    .dropdown:hover .dropdown-menu {
                        opacity: 0 !important;
                        visibility: hidden !important;
                        transform: translateY(8px) !important;
                    }
                    
                    .dropdown.show .dropdown-menu {
                        opacity: 1 !important;
                        visibility: visible !important;
                        transform: translateY(0) !important;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    </script>
</body>
</html>