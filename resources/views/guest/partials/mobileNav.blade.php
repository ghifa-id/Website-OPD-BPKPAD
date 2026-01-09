<div class="mobile-nav-wrapper">
    <div class="mobile-nav-overlay mobile-nav-toggler"></div><!-- mobile-nav-overlay -->
    <div class="mobile-nav-content">
        <a href="#" class="mobile-nav-close mobile-nav-toggler">
            <span></span>
            <span></span>
        </a><!-- mobile-nav-close -->
        
        <div class="logo-box text-center mb-4">
            <a href="http://127.0.0.1:8000/">
                <img src="https://www.pesisirselatankab.go.id/assets/images/logo2.png" alt="logo" width="200"
                    loading="lazy">
            </a>
        </div><!-- logo-box -->
        
        <!-- Mobile Navigation Menu -->
        <div class="mobile-nav-container">
            <ul class="mobile-nav-menu list-unstyled">
                <!-- Beranda -->
                <li class="nav-item">
                    <a href="http://127.0.0.1:8000/" class="nav-link active">
                        <i class="fas fa-home me-2"></i>
                        Beranda
                    </a>
                </li>
                
                <!-- Profil -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-building me-2"></i>
                        Profil
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>
                </li>
                
                <!-- Berita -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-newspaper me-2"></i>
                        Berita
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>
                </li>
                
                <!-- PPID -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-info-circle me-2"></i>
                        PPID
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>
                </li>
                
                <!-- Pengumuman -->
                <li class="nav-item section-divider">
                    <span class="section-label">Pengumuman</span>
                </li>
                
                <!-- Galeri -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-images me-2"></i>
                        Galeri
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>
                </li>
                
                <!-- Survey -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar me-2"></i>
                        Survey
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>
                </li>
                
                <!-- Kontak Kami -->
                <li class="nav-item section-divider">
                    <span class="section-label">Kontak Kami</span>
                </li>
                
                <!-- LOGIN -->
                <li class="nav-item">
                    <a href="#" class="nav-link login-btn">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        LOGIN
                    </a>
                </li>
            </ul>
        </div><!-- mobile-nav-container -->
        
        <!-- Contact Information -->
        <ul class="mobile-nav-contact list-unstyled mt-4">
            <li>
                <i class="fa-solid fa-phone"></i>
                <a href="tel:(0756)7464065">(0756) 7464065</a>
            </li><!-- li -->
            <li>
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:bpkpad@pesisirselatankab.go.id">bpkpad@pesisirselatankab.go.id</a>
            </li><!-- li -->
            <li>
                <i class="fa-solid fa-map-marker-alt"></i>
                <span>
                    Jl. H. Agus Salim No.1, Painan, Kabupaten Pesisir Selatan.
                </span>
            </li><!-- li -->
        </ul><!-- mobile-nav-contact -->
        
        <!-- Social Media -->
        <ul class="mobile-nav-social list-unstyled">
            <li><a href="https://www.facebook.com/bpkpad.kabupaten.pesisir.selatan?locale=id_ID"><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href="https://www.instagram.com/bpkpad_kab.pessel"><i class="fa-brands fa-instagram"></i></a></li>
        </ul><!-- mobile-nav-social -->
    </div><!-- mobile-nav-content -->
</div><!--mobile-nav-wrapper-->

<style>
    .mobile-nav-wrapper {
        background: rgba(0, 59, 73, 0.98);
        backdrop-filter: blur(15px);
    }
    
    .mobile-nav-overlay {
        background-color: rgba(0, 59, 73, 0.9);
    }
    
    .mobile-nav-content {
        background: #ffffff; /* Latar belakang putih solid untuk kontras maksimal */
        box-shadow: 0 0 40px rgba(0, 59, 73, 0.3);
        width: 320px;
        max-width: 90vw;
    }
    
    .mobile-nav-close span {
        background-color: #003b49;
    }
    
    .mobile-nav-close:hover span {
        background-color: #2dcd7c;
    }
    
    .logo-text h6 {
        color: #003b49 !important;
        font-weight: 700;
    }
    
    .logo-text h5 {
        color: #2dcd7c !important;
        font-weight: 800;
    }
    
    /* Mobile Navigation Menu Styles */
    .mobile-nav-menu {
        padding: 0 1rem;
    }
    
    .nav-item {
        border-bottom: 1px solid #e0f0e8;
    }
    
    .nav-item:last-child {
        border-bottom: none;
    }
    
    .nav-link {
        display: flex;
        align-items: center;
        padding: 1rem 0.75rem;
        color: #003b49 !important;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 0.25rem 0;
        background: #ffffff;
        border: 1px solid #e0f0e8;
    }
    
    .nav-link i:first-child {
        color: #2dcd7c !important;
        width: 20px;
        font-size: 1.1em;
    }
    
    .nav-link .fa-chevron-right {
        color: #003b49 !important;
        opacity: 0.6;
        font-size: 0.9em;
        transition: all 0.3s ease;
    }
    
    .nav-link:hover {
        background: linear-gradient(135deg, #2dcd7c, #003b49);
        color: white !important;
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(45, 205, 124, 0.3);
        border-color: transparent;
    }
    
    .nav-link:hover i {
        color: white !important;
    }
    
    .nav-link:hover .fa-chevron-right {
        opacity: 1;
        transform: translateX(3px);
    }
    
    .nav-link.active {
        background: linear-gradient(135deg, #2dcd7c, #003b49);
        color: white !important;
        box-shadow: 0 4px 12px rgba(45, 205, 124, 0.4);
        border-color: transparent;
    }
    
    .nav-link.active i {
        color: white !important;
    }
    
    .section-divider {
        padding: 1.2rem 0 0.7rem 0;
        border-bottom: none;
    }
    
    .section-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: #2dcd7c;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: #f0f9f4;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        display: inline-block;
        border: 1px solid #e0f0e8;
    }
    
    .login-btn {
        background: linear-gradient(135deg, #2dcd7c, #003b49) !important;
        color: white !important;
        border-radius: 25px !important;
        margin: 1.5rem 0 !important;
        justify-content: center;
        font-weight: 700;
        border: none !important;
        box-shadow: 0 4px 12px rgba(45, 205, 124, 0.4);
    }
    
    .login-btn:hover {
        background: linear-gradient(135deg, #25a864, #002a36) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(45, 205, 124, 0.5) !important;
    }
    
    /* Contact Information Styles */
    .mobile-nav-contact {
        padding: 0 1.5rem;
        margin-top: 1.5rem;
    }
    
    .mobile-nav-contact li {
        display: flex;
        align-items: flex-start;
        padding: 1rem;
        border-bottom: 1px solid #e0f0e8;
        background: #f8fdfa;
        margin: 0.5rem 0;
        border-radius: 10px;
        border: 1px solid #e0f0e8;
    }
    
    .mobile-nav-contact li:last-child {
        border-bottom: none;
    }
    
    .mobile-nav-contact i {
        color: #2dcd7c !important;
        width: 20px;
        margin-right: 12px;
        margin-top: 2px;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    
    .mobile-nav-contact a {
        color: #003b49 !important;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .mobile-nav-contact a:hover {
        color: #2dcd7c !important;
    }
    
    .mobile-nav-contact span {
        color: #003b49;
        line-height: 1.5;
        font-weight: 500;
    }
    
    /* Social Media Styles */
    .mobile-nav-social {
        display: flex;
        justify-content: center;
        gap: 20px;
        padding: 1.5rem;
        margin-top: 1rem;
        border-top: 1px solid #e0f0e8;
        background: #f8fdfa;
        margin: 1rem;
        border-radius: 15px;
    }
    
    .mobile-nav-social a {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white !important;
        text-decoration: none;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #2dcd7c, #003b49);
        box-shadow: 0 4px 10px rgba(45, 205, 124, 0.3);
    }
    
    .mobile-nav-social a:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 6px 15px rgba(45, 205, 124, 0.5);
    }
    
    /* Improved readability and contrast */
    .mobile-nav-content {
        color: #003b49;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 480px) {
        .mobile-nav-content {
            width: 100vw;
            max-width: 100vw;
        }
        
        .logo-box img {
            width: 160px;
        }
        
        .mobile-nav-menu {
            padding: 0 0.75rem;
        }
        
        .mobile-nav-contact {
            padding: 0 1rem;
        }
        
        .nav-link {
            padding: 0.9rem 0.6rem;
            font-size: 0.95rem;
        }
        
        .mobile-nav-contact li {
            padding: 0.8rem;
        }
    }

    /* Scrollbar styling for mobile nav container */
    .mobile-nav-container {
        max-height: 50vh;
        overflow-y: auto;
        padding-right: 5px;
    }
    
    .mobile-nav-container::-webkit-scrollbar {
        width: 4px;
    }
    
    .mobile-nav-container::-webkit-scrollbar-track {
        background: #e0f0e8;
        border-radius: 2px;
    }
    
    .mobile-nav-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #2dcd7c, #003b49);
        border-radius: 2px;
    }

    /* Ensure text is clearly visible */
    .mobile-nav-content * {
        color: #003b49 !important;
    }
    
    .mobile-nav-content a:not(.login-btn) {
        color: #003b49 !important;
    }
    
    .mobile-nav-content a:not(.login-btn):hover {
        color: #2dcd7c !important;
    }
</style>