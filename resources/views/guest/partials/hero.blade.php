<!-- Hero Section -->
<section class="main-hero">
    <!-- Background Image -->
    <div class="item-slider-bg" style="background-image: url('{{ asset('assets/image/ikon.png') }}')">
    </div>
    
    <!-- Subtle Gradient Overlay -->
    <div class="gradient-overlay-subtle"></div>
    
    <!-- Floating Particles -->
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    
    <!-- Social Icons - Vertical -->
    <div class="social-icons-vertical">
        <a href="https://wa.me/?text=Kunjungi%20website%20BPKPAD%20di%20" class="social-icon whatsapp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://www.instagram.com/bpkpad_kab.pessel" class="social-icon instagram">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://web.facebook.com/bpkpad.kabupaten.pesisir.selatan?locale=id_ID" class="social-icon facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://www.tiktok.com/@bpkpadkab.pesisirselata" class="social-icon tiktok">
            <i class="fab fa-tiktok"></i>
        </a>
        <a href="https://youtube.com/@bpkpadkab.pesisirselatan" class="social-icon youtube">
            <i class="fab fa-youtube"></i>
        </a>
    </div>
    
    <!-- Hero Content -->
    <div class="container hero-container">
        <div class="hero-content">
            <h1 class="hero-title">
                <span class="title-main">Badan Pengelola Keuangan Pendapatan dan Aset Daerah</span>
            </h1>
            <p class="hero-subtitle">
                Mengelola keuangan, pendapatan, dan aset daerah dengan profesional, transparan, dan akuntabel untuk kesejahteraan masyarakat.
            </p>
            
            <!-- Hero Statistics -->
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Aset Terkelola</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Kepuasan Masyarakat</div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="hero-actions">
                <a href="#" class="btn-primary">
                    <i class="fas fa-envelope"></i> Hubungi Kami
                </a>
                <a href="#" class="btn-outline">
                    <i class="fas fa-book"></i> Layanan Kami
                </a>
            </div>
        </div>
    </div>
    
    <!-- Welcome Marquee -->
    <div class="welcome-marquee">
        <div class="marquee-container">
            <div class="marquee-text">
                Selamat Datang di BPKPAD - Badan Pengelola Keuangan Pendapatan dan Aset Daerah
            </div>
        </div>
    </div>
    
</section>

<style>
/* ===== HERO SECTION THEME - CLEAR BACKGROUND ===== */

/* Main Hero Container */
.main-hero {
    position: relative;
    height: 100vh;
    overflow: hidden;
}

/* Background Image with Minimal Filter */
.item-slider-bg {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    filter: brightness(0.85) contrast(1.1) saturate(1.1);
}

/* Subtle Gradient Overlay */
.gradient-overlay-subtle {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        135deg,
        rgba(0, 59, 73, 0.4) 0%,
        rgba(0, 99, 122, 0.35) 30%,
        rgba(45, 205, 124, 0.3) 70%,
        rgba(45, 205, 124, 0.25) 100%
    );
    z-index: 2;
}

.gradient-overlay-subtle::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="heroPattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1.5" fill="%23ffffff" opacity="0.03"/></pattern></defs><rect width="100" height="100" fill="url(%23heroPattern)"/></svg>');
    pointer-events: none;
}

/* Hero Container */
.hero-container {
    position: relative;
    z-index: 5;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* Social Icons - Vertical Theme */
.social-icons-vertical {
    position: absolute;
    top: 35%;
    left: 0;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    gap: 15px;
    z-index: 10;
    animation: slideInLeft 0.8s ease-out 0.5s both;
}

.social-icon {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 0 20px 20px 0;
    width: 50px;
    height: 50px;
    display: grid;
    place-items: center;
    text-decoration: none;
    box-shadow: 0 4px 20px rgba(45, 205, 124, 0.3);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    border: 1px solid rgba(45, 205, 124, 0.2);
    position: relative;
    overflow: hidden;
}

.social-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e6f7ff, #ffffff);
    transform: translateX(-100%);
    transition: transform 0.3s ease;
}

.social-icon:hover {
    transform: translateX(10px) scale(1.05);
    box-shadow: 0 8px 30px rgba(45, 205, 124, 0.4);
}

.social-icon:hover::before {
    transform: translateX(0);
}

.social-icon i {
    font-size: 22px;
    position: relative;
    z-index: 2;
}

.social-icon.whatsapp i { color: #25D366; }
.social-icon.instagram i { color: #e1306c; }
.social-icon.facebook i { color: #1877f2; }
.social-icon.tiktok i { color: #000000; }
.social-icon.youtube i { color: #ff0000; }

/* Marquee Welcome Text */
.welcome-marquee {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 95%;
    max-width: 1200px;
    background: linear-gradient(135deg, #003b49, #2dcd7c);
    padding: 12px 20px;
    overflow: hidden;
    z-index: 8;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    border: 2px solid rgba(230, 247, 255, 0.3);
    border-radius: 8px;
}

.marquee-container {
    overflow: hidden;
    white-space: nowrap;
}

.marquee-text {
    display: inline-block;
    padding-left: 100%;
    animation: marquee 20s linear infinite;
    color: #ffffff;
    font-size: 18px;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    white-space: nowrap;
}

/* Hero Content */
.hero-content {
    text-align: center;
    color: white;
    animation: fadeInUp 1s ease-out;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    max-width: 900px;
    width: 100%;
}

.hero-title {
    font-size: clamp(28px, 5vw, 65px);
    line-height: 1.2;
    font-weight: 800;
    margin-bottom: 25px;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
}

.title-main {
    background: linear-gradient(135deg, #ffffff, #e6f7ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    display: block;
    animation: slideInRight 0.8s ease-out 0.4s both;
}

.hero-subtitle {
    font-size: clamp(16px, 2vw, 20px);
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.95);
    max-width: 700px;
    margin: 0 auto 30px;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
    animation: fadeInUp 0.8s ease-out 0.6s both;
}

/* Action Buttons */
.hero-actions {
    display: flex;
    flex-direction: row;
    gap: 15px;
    z-index: 10;
    animation: fadeInUp 0.8s ease-out 0.8s both;
    justify-content: center;
    margin-top: 25px;
    flex-wrap: wrap;
}

.btn-primary,
.btn-outline {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 24px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    backdrop-filter: blur(10px);
    min-width: 160px;
    justify-content: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.btn-primary {
    background: linear-gradient(135deg, #2dcd7c, #003b49);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn-outline {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    border: 2px solid rgba(230, 247, 255, 0.4);
}

.btn-primary:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 30px rgba(45, 205, 124, 0.5);
    color: white;
}

.btn-outline:hover {
    background: rgba(230, 247, 255, 0.25);
    transform: translateY(-3px) scale(1.05);
    border-color: rgba(230, 247, 255, 0.6);
    color: white;
}

/* Hero Statistics */
.hero-stats {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
    margin-top: 35px;
    animation: fadeInUp 0.8s ease-out 1s both;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 36px;
    font-weight: 800;
    color: #e6f7ff;
    line-height: 1;
    margin-bottom: 8px;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
}

.stat-label {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.95);
    font-weight: 500;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
}

.stat-divider {
    width: 1px;
    height: 50px;
    background: linear-gradient(to bottom, transparent, rgba(230, 247, 255, 0.5), transparent);
}

/* Floating Particles */
.floating-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 3;
}

.particle {
    position: absolute;
    background: rgba(230, 247, 255, 0.7);
    border-radius: 50%;
    animation: float 15s infinite linear;
}

.particle:nth-child(1) {
    width: 8px;
    height: 8px;
    top: 20%;
    left: 10%;
    animation-duration: 20s;
    animation-delay: 0s;
}

.particle:nth-child(2) {
    width: 12px;
    height: 12px;
    top: 60%;
    left: 80%;
    animation-duration: 25s;
    animation-delay: 5s;
}

.particle:nth-child(3) {
    width: 6px;
    height: 6px;
    top: 40%;
    left: 25%;
    animation-duration: 18s;
    animation-delay: 2s;
}

.particle:nth-child(4) {
    width: 10px;
    height: 10px;
    top: 70%;
    left: 50%;
    animation-duration: 22s;
    animation-delay: 7s;
}

.particle:nth-child(5) {
    width: 5px;
    height: 5px;
    top: 30%;
    left: 70%;
    animation-duration: 17s;
    animation-delay: 3s;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes float {
    0% {
        transform: translateY(0) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100vh) rotate(360deg);
        opacity: 0;
    }
}

@keyframes marquee {
    0% {
        transform: translate(0, 0);
    }
    100% {
        transform: translate(-100%, 0);
    }
}

/* ===== RESPONSIVE DESIGN ===== */

/* Large Desktop */
@media (min-width: 1200px) {
    .hero-container {
        padding: 40px;
    }
}

/* Tablet & Below */
@media (max-width: 992px) {
    .main-hero {
        min-height: 100vh;
        height: auto;
    }
    
    .hero-container {
        padding: 100px 20px 80px;
        min-height: 100vh;
    }
    
    .social-icons-vertical {
        top: 50%;
        bottom: auto;
        left: 0;
        transform: translateY(-50%);
        flex-direction: column;
        gap: 10px;
        justify-content: center;
    }
    
    .social-icon {
        border-radius: 0 15px 15px 0;
        width: 45px;
        height: 45px;
    }
    
    .social-icon:hover {
        transform: translateX(8px) scale(1.05);
    }
    
    .welcome-marquee {
        bottom: 15px;
        width: 96%;
        padding: 10px 15px;
    }
    
    .marquee-text {
        font-size: 16px;
    }
    
    .hero-stats {
        gap: 25px;
        margin-top: 30px;
    }
    
    .stat-divider {
        display: none;
    }
}

/* Mobile Large */
@media (max-width: 768px) {
    .hero-container {
        padding: 80px 15px 80px;
    }
    
    .hero-title {
        font-size: clamp(24px, 6vw, 36px);
        margin-bottom: 20px;
    }
    
    .hero-subtitle {
        font-size: 15px;
        margin-bottom: 25px;
    }
    
    .hero-actions {
        gap: 12px;
        margin-top: 20px;
    }
    
    .btn-primary,
    .btn-outline {
        min-width: 140px;
        padding: 12px 20px;
        font-size: 13px;
    }
    
    .hero-stats {
        gap: 20px;
        margin-top: 25px;
    }
    
    .stat-number {
        font-size: 32px;
    }
    
    .stat-label {
        font-size: 13px;
    }
    
    .social-icons-vertical {
        top: 45%;
        gap: 8px;
    }
    
    .social-icon {
        width: 42px;
        height: 42px;
        border-radius: 0 12px 12px 0;
    }
    
    .social-icon i {
        font-size: 20px;
    }
    
    .welcome-marquee {
        bottom: 12px;
        padding: 8px 12px;
    }
    
    .marquee-text {
        font-size: 14px;
    }
}

/* Mobile Standard */
@media (max-width: 576px) {
    .hero-container {
        padding: 70px 12px 70px;
    }
    
    .hero-title {
        font-size: clamp(20px, 5.5vw, 28px);
        margin-bottom: 16px;
        line-height: 1.3;
    }
    
    .hero-subtitle {
        font-size: 14px;
        margin-bottom: 20px;
        line-height: 1.5;
        padding: 0 5px;
    }
    
    .hero-actions {
        flex-direction: column;
        gap: 10px;
        margin-top: 18px;
        width: 100%;
        max-width: 300px;
    }
    
    .btn-primary,
    .btn-outline {
        width: 100%;
        min-width: auto;
        padding: 12px 20px;
        font-size: 13px;
    }
    
    .hero-stats {
        gap: 15px;
        margin-top: 20px;
    }
    
    .stat-number {
        font-size: 28px;
    }
    
    .stat-label {
        font-size: 12px;
    }
    
    .social-icons-vertical {
        top: 40%;
        gap: 7px;
    }
    
    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 0 12px 12px 0;
    }
    
    .social-icon i {
        font-size: 18px;
    }
    
    .welcome-marquee {
        bottom: 10px;
        padding: 7px 10px;
        width: 98%;
    }
    
    .marquee-text {
        font-size: 12px;
    }
}

/* Mobile Small */
@media (max-width: 400px) {
    .hero-container {
        padding: 60px 10px 70px;
    }
    
    .hero-title {
        font-size: clamp(18px, 5vw, 24px);
        margin-bottom: 14px;
    }
    
    .hero-subtitle {
        font-size: 13px;
        margin-bottom: 18px;
    }
    
    .hero-actions {
        max-width: 280px;
    }
    
    .btn-primary,
    .btn-outline {
        padding: 11px 18px;
        font-size: 12px;
    }
    
    .hero-stats {
        gap: 12px;
        margin-top: 18px;
    }
    
    .stat-number {
        font-size: 26px;
    }
    
    .stat-label {
        font-size: 11px;
    }
    
    .social-icons-vertical {
        top: 38%;
        gap: 6px;
    }
    
    .social-icon {
        width: 38px;
        height: 38px;
        border-radius: 0 10px 10px 0;
    }
    
    .social-icon i {
        font-size: 17px;
    }
    
    .welcome-marquee {
        bottom: 8px;
        padding: 6px 8px;
    }
    
    .marquee-text {
        font-size: 11px;
    }
}

/* Extra Small Devices */
@media (max-width: 360px) {
    .hero-container {
        padding: 50px 8px 60px;
    }
    
    .hero-title {
        font-size: 18px;
    }
    
    .hero-subtitle {
        font-size: 12px;
    }
    
    .hero-stats {
        gap: 10px;
    }
    
    .stat-number {
        font-size: 24px;
    }
    
    .social-icons-vertical {
        top: 35%;
        gap: 5px;
    }
    
    .social-icon {
        width: 36px;
        height: 36px;
        border-radius: 0 10px 10px 0;
    }
    
    .social-icon i {
        font-size: 16px;
    }
}
</style>