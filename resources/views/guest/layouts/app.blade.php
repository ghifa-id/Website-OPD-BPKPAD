<!DOCTYPE html>
<html lang="en">
@include('guest.layouts.head')
@stack('styles')

<body>
    <!-- Green Themed Preloader - FIXED VERSION -->
    <div id="pre-loader" class="loading">
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

    @include('guest.partials.header')
    @include('guest.partials.mobileNav')

    <div class="page-wrapper">
        @yield('content')
    </div>

    @include('guest.partials.footer')
    @stack('scripts')
    @include('guest.layouts.script')

    <!-- Green Themed Scroll to Top Button -->
    <a href="#" class="scroll-to-top-green scroll-to-target" data-target="html">
        <div class="scroll-icon">
            <i class="fas fa-arrow-up"></i>
        </div>
        <div class="scroll-ripple"></div>
    </a>

    <!-- Green Themed Features Button -->
    <button id="fiturToggleBtn" class="fitur-btn-green">
        <div class="btn-content">
            <i class="fas fa-sliders"></i>
            <span>Fitur</span>
        </div>
        <div class="btn-glow"></div>
    </button>

    <!-- Green Themed Features Panel -->
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

    <!-- Green Themed Weather Modal -->
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

    <!-- Green Themed Quick Access Modal -->
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
            --primary-green: #2dcd7c;
            --secondary-green: #003b49;
            --light-green: rgba(230, 247, 255, 0.3);
            --dark-green: #003b49;
            --accent-green: rgba(45, 205, 124, 0.1);
        }

        /* ===== IMPROVED PRELOADER - NO JERKY ANIMATION ===== */
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
            transition: opacity 0.6s ease, visibility 0.6s ease;
            opacity: 1;
            visibility: visible;
        }

        #pre-loader.loaded {
            opacity: 0;
            visibility: hidden;
        }

        .loader-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="loaderPattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23ffffff" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23loaderPattern)"/></svg>');
            pointer-events: none;
            opacity: 0.5;
        }

        .loader-content {
            text-align: center;
            color: white;
            position: relative;
            z-index: 2;
            animation: contentFadeIn 0.8s ease-out;
        }

        @keyframes contentFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo Container - FIXED SIZE */
        #loader-logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(45, 205, 124, 0.3);
            animation: logoFloat 3s ease-in-out infinite;
            position: relative;
        }

        /* Logo Image - NO SCALE CHANGES */
        #loader-logo img {
            width: 65px;
            height: 65px;
            object-fit: contain;
            filter: brightness(1.2);
            display: block;
        }

        /* Smooth Float Animation - NO SCALE */
        @keyframes logoFloat {
            0%, 100% { 
                transform: translateY(0px);
            }
            50% { 
                transform: translateY(-8px);
            }
        }

        .loader-text h3 {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 5px;
            color: white;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            animation: textGlow 2s ease-in-out infinite alternate;
            letter-spacing: 1px;
        }

        .loader-text p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 25px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        @keyframes textGlow {
            0% { 
                text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3); 
            }
            100% { 
                text-shadow: 0 4px 12px rgba(45, 205, 124, 0.6), 0 2px 8px rgba(0, 0, 0, 0.3); 
            }
        }

        .loader-progress {
            width: 180px;
            height: 3px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            margin: 0 auto 25px;
            overflow: hidden;
            position: relative;
        }

        .loader-bar {
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                var(--primary-green) 30%, 
                white 50%, 
                var(--primary-green) 70%, 
                transparent
            );
            border-radius: 3px;
            animation: loadingBar 1.8s ease-in-out infinite;
        }

        @keyframes loadingBar {
            0% { 
                transform: translateX(-100%); 
            }
            100% { 
                transform: translateX(100%); 
            }
        }

        .loader-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
        }

        .loader-dots span {
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            animation: dotBounce 1.4s ease-in-out infinite;
        }

        .loader-dots span:nth-child(1) { animation-delay: 0s; }
        .loader-dots span:nth-child(2) { animation-delay: 0.2s; }
        .loader-dots span:nth-child(3) { animation-delay: 0.4s; }

        @keyframes dotBounce {
            0%, 60%, 100% { 
                transform: translateY(0) scale(1); 
                opacity: 0.7; 
            }
            30% { 
                transform: translateY(-12px) scale(1.2); 
                opacity: 1; 
            }
        }

        /* ===== SCROLL TO TOP GREEN THEME ===== */
        .scroll-to-top-green {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: white;
            font-size: 18px;
            z-index: 1050;
            box-shadow: 0 8px 25px rgba(45, 205, 124, 0.4);
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
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 35px rgba(45, 205, 124, 0.5);
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
            border-radius: 15px;
            transform: scale(0);
            transition: transform 0.3s ease;
        }

        .scroll-to-top-green:active .scroll-ripple {
            transform: scale(1);
        }

        /* ===== FITUR BUTTON GREEN THEME ===== */
        .fitur-btn-green {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 12px;
            font-weight: 600;
            z-index: 1050;
            box-shadow: 0 8px 25px rgba(45, 205, 124, 0.4);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
            overflow: hidden;
            animation: featurePulse 3s ease-in-out infinite;
        }

        .fitur-btn-green:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 35px rgba(45, 205, 124, 0.5);
            animation: none;
        }

        .btn-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .btn-content i {
            font-size: 18px;
        }

        .btn-content span {
            font-size: 10px;
            line-height: 1;
        }

        .btn-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(230, 247, 255, 0.3), transparent);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.3s ease;
        }

        .fitur-btn-green:hover .btn-glow {
            transform: translate(-50%, -50%) scale(1);
        }

        @keyframes featurePulse {
            0%, 100% { transform: scale(1); box-shadow: 0 8px 25px rgba(45, 205, 124, 0.4); }
            50% { transform: scale(1.02); box-shadow: 0 10px 30px rgba(45, 205, 124, 0.5); }
        }

        /* ===== FITUR PANEL GREEN THEME ===== */
        .fitur-panel-green {
            position: fixed;
            width: 320px;
            max-height: 450px;
            bottom: 140px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(45, 205, 124, 0.3);
            border: 1px solid rgba(45, 205, 124, 0.2);
            display: none;
            z-index: 1040;
            overflow: hidden;
            animation: panelSlideIn 0.3s ease-out;
        }

        .fitur-list {
            list-style: none;
            margin: 0;
            padding: 15px;
            max-height: 450px;
            overflow-y: auto;
        }

        .fitur-item {
            margin-bottom: 12px;
        }

        .fitur-item:last-child {
            margin-bottom: 0;
        }

        .fitur-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            border: 1px solid rgba(45, 205, 124, 0.1);
            cursor: pointer;
            text-align: left;
        }

        .fitur-card:hover {
            background: var(--accent-green);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 205, 124, 0.2);
            color: inherit;
        }

        .fitur-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            flex-shrink: 0;
        }

        .fitur-icon.satisfaction { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .fitur-icon.weather { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .fitur-icon.quick-access { background: linear-gradient(135deg, #10b981, #059669); }

        .fitur-content {
            flex-grow: 1;
        }

        .fitur-content h6 {
            margin: 0 0 5px 0;
            font-weight: 700;
            font-size: 14px;
            color: var(--secondary-green);
        }

        .fitur-content p {
            margin: 0;
            font-size: 12px;
            color: #6b7280;
            line-height: 1.4;
        }

        .fitur-arrow {
            color: var(--primary-green);
            font-size: 14px;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .fitur-card:hover .fitur-arrow {
            opacity: 1;
            transform: translateX(3px);
        }

        @keyframes panelSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes panelSlideOut {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            to {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
        }

        /* ===== MODAL GREEN THEME ===== */
        .green-modal {
            border: none;
            border-radius: 25px;
            box-shadow: 0 25px 80px rgba(45, 205, 124, 0.3);
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff, var(--accent-green));
        }

        .green-modal-header {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
            border: none;
            padding: 20px 25px;
            border-radius: 25px 25px 0 0;
        }

        .green-modal-header .modal-title {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .green-modal-header .modal-title i {
            font-size: 20px;
        }

        .green-btn-close {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .green-btn-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .green-modal-body {
            padding: 25px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .green-modal-footer {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            padding: 20px 25px;
            border-radius: 0 0 25px 25px;
            display: flex;
            justify-content: center;
        }

        /* Weather Info Styling */
        .weather-info {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            padding: 20px;
        }

        .weather-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(45, 205, 124, 0.1);
        }

        .weather-row:last-child {
            border-bottom: none;
        }

        .weather-label {
            font-weight: 600;
            color: var(--secondary-green);
        }

        .weather-value {
            color: #374151;
            font-weight: 500;
        }

        /* Quick Access Grid */
        .quick-access-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .quick-access-item {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .access-card {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid rgba(45, 205, 124, 0.1);
            transition: all 0.3s ease;
        }

        .access-card:hover {
            background: var(--accent-green);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(45, 205, 124, 0.2);
        }

        .access-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            flex-shrink: 0;
        }

        .access-icon img {
            width: 35px;
            height: 35px;
            object-fit: contain;
        }

        .access-content {
            flex-grow: 1;
        }

        .access-content h6 {
            margin: 0 0 5px 0;
            font-weight: 700;
            color: var(--secondary-green);
            font-size: 14px;
        }

        .access-content p {
            margin: 0;
            font-size: 12px;
            color: #6b7280;
            line-height: 1.4;
        }

        .access-arrow {
            color: var(--primary-green);
            font-size: 16px;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .access-card:hover .access-arrow {
            opacity: 1;
            transform: translateX(3px);
        }

        /* Button Green Gradient */
        .btn-green-gradient {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(45, 205, 124, 0.3);
        }

        .btn-green-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 205, 124, 0.4);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .fitur-panel-green {
                width: calc(100vw - 40px);
                right: 20px;
                left: 20px;
            }
            
            .scroll-to-top-green {
                bottom: 140px;
            }
            
            .quick-access-grid {
                grid-template-columns: 1fr;
            }
            
            #loader-logo {
                width: 85px;
                height: 85px;
            }
            
            #loader-logo img {
                width: 55px;
                height: 55px;
            }
            
            .loader-text h3 {
                font-size: 22px;
            }
            
            .loader-text p {
                font-size: 12px;
            }
            
            .loader-progress {
                width: 150px;
            }
        }

        @media (max-width: 480px) {
            #loader-logo {
                width: 75px;
                height: 75px;
            }
            
            #loader-logo img {
                width: 48px;
                height: 48px;
            }
            
            .loader-text h3 {
                font-size: 20px;
            }
        }

        /* Scrollbar for Panel */
        .fitur-list::-webkit-scrollbar {
            width: 4px;
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
        .btn-green-gradient:focus {
            outline: 2px solid var(--primary-green);
            outline-offset: 2px;
        }

        .fitur-card:focus {
            outline: 2px solid var(--primary-green);
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
            .fitur-panel-green {
                display: none !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===== IMPROVED PRELOADER - SMOOTH LOADING =====
            const preloader = document.getElementById('pre-loader');
            
            if (preloader) {
                const minLoadTime = 800;
                const startTime = Date.now();
                
                window.addEventListener('load', function() {
                    const elapsedTime = Date.now() - startTime;
                    const remainingTime = Math.max(0, minLoadTime - elapsedTime);
                    
                    setTimeout(() => {
                        preloader.classList.add('loaded');
                        
                        setTimeout(() => {
                            preloader.style.display = 'none';
                        }, 600);
                    }, remainingTime);
                });
                
                // Fallback: Force hide after 3 seconds
                setTimeout(() => {
                    if (preloader.style.display !== 'none') {
                        preloader.classList.add('loaded');
                        setTimeout(() => {
                            preloader.style.display = 'none';
                        }, 600);
                    }
                }, 3000);
            }

            // ===== SCROLL TO TOP BUTTON =====
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

            // ===== FEATURES PANEL TOGGLE =====
            const fiturBtn = document.getElementById('fiturToggleBtn');
            const fiturPanel = document.getElementById('fiturPanel');
            
            if (fiturBtn && fiturPanel) {
                fiturBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isVisible = fiturPanel.style.display === 'block';
                    
                    if (isVisible) {
                        fiturPanel.style.animation = 'panelSlideOut 0.3s ease-in forwards';
                        setTimeout(() => {
                            fiturPanel.style.display = 'none';
                            fiturPanel.style.animation = '';
                        }, 300);
                    } else {
                        fiturPanel.style.display = 'block';
                        fiturPanel.style.animation = 'panelSlideIn 0.3s ease-out forwards';
                    }
                });

                // Close panel when clicking outside
                document.addEventListener('click', function(e) {
                    if (!fiturPanel.contains(e.target) && !fiturBtn.contains(e.target)) {
                        if (fiturPanel.style.display === 'block') {
                            fiturPanel.style.animation = 'panelSlideOut 0.3s ease-in forwards';
                            setTimeout(() => {
                                fiturPanel.style.display = 'none';
                                fiturPanel.style.animation = '';
                            }, 300);
                        }
                    }
                });

                // Prevent panel from closing when clicking inside
                fiturPanel.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }

            // ===== WEATHER API =====
            const apiKey = '51862b58cee99f1c4f1afcd4faa07fd1';
            const city = 'Painan';
            const weatherUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=id`;

            // Set current date
            const dateEl = document.getElementById('cuaca-date');
            if (dateEl) {
                const today = new Date();
                const dateStr = today.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                dateEl.textContent = dateStr;
            }

            // Fetch weather data
            fetch(weatherUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Weather data not available');
                    }
                    return response.json();
                })
                .then(data => {
                    const description = data.weather[0].description;
                    const temp = Math.round(data.main.temp);
                    const humidity = data.main.humidity;
                    const windSpeed = Math.round(data.wind.speed * 3.6);

                    document.getElementById('cuaca-desc').textContent = 
                        description.charAt(0).toUpperCase() + description.slice(1);
                    document.getElementById('cuaca-temp').textContent = temp + '°C';
                    document.getElementById('cuaca-humid').textContent = humidity + '%';
                    document.getElementById('cuaca-wind').textContent = windSpeed + ' km/jam';
                })
                .catch(error => {
                    console.error('Weather fetch error:', error);
                    document.getElementById('cuaca-desc').textContent = 'Data tidak tersedia';
                    document.getElementById('cuaca-temp').textContent = '-';
                    document.getElementById('cuaca-humid').textContent = '-';
                    document.getElementById('cuaca-wind').textContent = '-';
                });

            // ===== EXTERNAL LINKS LOADING EFFECT =====
            const externalLinks = document.querySelectorAll('a[target="_blank"]');
            externalLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon && !icon.classList.contains('fa-spin')) {
                        const originalClass = icon.className;
                        icon.className = 'fas fa-spinner fa-spin';
                        this.classList.add('loading');
                        
                        setTimeout(() => {
                            icon.className = originalClass;
                            this.classList.remove('loading');
                        }, 2000);
                    }
                });
            });

            // ===== KEYBOARD NAVIGATION =====
            document.addEventListener('keydown', function(e) {
                // Close panels with Escape key
                if (e.key === 'Escape') {
                    if (fiturPanel && fiturPanel.style.display === 'block') {
                        fiturPanel.style.display = 'none';
                    }
                }
                
                // Scroll to top with Ctrl+Home
                if (e.ctrlKey && e.key === 'Home') {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            });

            // ===== RIPPLE EFFECT FOR BUTTONS =====
            const buttons = document.querySelectorAll('.btn-green-gradient, .fitur-btn-green');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('div');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: rippleEffect 0.6s linear;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });

        // ===== RIPPLE ANIMATION =====
        const rippleStyles = document.createElement('style');
        rippleStyles.textContent = `
            @keyframes rippleEffect {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(rippleStyles);
    </script>

</body>
</html>