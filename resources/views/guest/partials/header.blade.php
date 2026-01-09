<header class="header">
    <!-- Curved Section Below Navbar -->
    <div class="main-menu sticky-header active">
        <div class="topbar">
            <div class="topbar-inner">
                <div class="topbar-left">
                    <div class="topbar-info">
                        <ul>
                            <li>
                                <div class="topbar-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div><!-- topbar-icon -->
                                <div class="topbar-text">
                                    <a href="mailto:bpkpad@pesisirselatankab.go.id">bpkpad@pesisirselatankab.go.id</a>
                                </div><!-- topbar-text -->
                            </li><!-- li -->
                            <li>
                                <div class="topbar-icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div><!-- topbar-icon -->
                                <div class="topbar-text">
                                    <span>(0756) 2312227</span>
                                </div><!-- topbar-text -->
                            </li><!-- li -->
                            <li>
                                <div class="topbar-icon">
                                    <i class="fa-solid fa-clock"></i>
                                </div><!-- topbar-icon -->
                                <div class="topbar-text">
                                    <span>Senin - Jumat: 08.00 - 16.00 WIB</span>
                                </div><!-- topbar-text -->
                            </li><!-- li -->
                        </ul><!-- ul -->
                    </div><!--topbar-info-->
                </div><!-- topbar-left -->
            </div><!-- topbar-inner -->
        </div><!--topbar-->

        {{-- Start Navbar --}}
        <div class="main-menu-inner shadow-lg">
            <div class="main-menu-left">
                <div class="main-menu-logo">
                    <a href="https://www.pesisirselatankab.go.id/">
                        <img src="https://www.pesisirselatankab.go.id/assets/images/logo2.png" alt="logo" width="250" loading="lazy">
                    </a>
                </div><!--main-menu-logo-->

                <div class="navigation">
                    <ul class="main-menu-list list-unstyled">
                        @foreach ($menus->where('id_parent', 0)->where('aktif', 'Ya') as $parent)
                            @php
                                $children = $menus->where('id_parent', $parent->id_menu)->where('aktif', 'Ya');
                            @endphp
                            <li @class(['has-dropdown' => $children->count() > 0])>
                                @if ($children->count() > 0)
                                    <a href="{{ url($parent->link) }}" class="block py-2 px-3 font-semibold underline-animate">
                                        {{ $parent->nama_menu }}
                                    </a>
                                    <ul class="list-unstyled sub-menu">
                                        @foreach ($children as $child)
                                            @php
                                                $grandChildren = $menus->where('id_parent', $child->id_menu)->where('aktif', 'Ya');
                                            @endphp
                                            <li @class(['has-dropdown' => $grandChildren->count() > 0])>
                                                @if ($grandChildren->count() > 0)
                                                    <a href="{{ url($child->link) }}" class="block py-2 px-3 font-semibold underline-animate">
                                                        {{ $child->nama_menu }}
                                                    </a>
                                                    <ul class="list-unstyled sub-sub-menu">
                                                        @foreach ($grandChildren as $grandChild)
                                                            @php
                                                                $greatGrandChildren = $menus->where('id_parent', $grandChild->id_menu)->where('aktif', 'Ya');
                                                            @endphp
                                                            <li @class(['has-dropdown' => $greatGrandChildren->count() > 0, 'mb-2 border-b border-gray-100 pb-2'])>
                                                                @if ($greatGrandChildren->count() > 0)
                                                                    <a href="{{ url($grandChild->link) }}" class="block py-2 px-3 font-semibold underline-animate">
                                                                        {{ $grandChild->nama_menu }}
                                                                    </a>
                                                                    <ul class="list-unstyled sub-sub-sub-menu">
                                                                        @foreach ($greatGrandChildren as $greatGrandChild)
                                                                            <li class="mb-1">
                                                                                <a href="{{ url($greatGrandChild->link) }}" class="block py-2 px-3 font-semibold underline-animate">
                                                                                    {{ $greatGrandChild->nama_menu }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                    <a href="{{ url($grandChild->link) }}" class="block py-2 px-3 font-semibold underline-animate">
                                                                        {{ $grandChild->nama_menu }}
                                                                    </a>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <a href="{{ url($child->link) }}" class="block py-2 px-3 font-semibold underline-animate">
                                                        {{ $child->nama_menu }}
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <a href="{{ url($parent->link) }}" class="block py-2 px-3 font-semibold underline-animate">
                                        {{ $parent->nama_menu }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div><!--main-menu-left-->

            <div class="main-menu-right d-flex align-items-center gap-3">
                <!-- Mobile Menu Button -->
                <div class="mobile-menu-button mobile-nav-toggler d-flex flex-column justify-content-center gap-0.5 cursor-pointer">
                    <span class="d-block bg-dark" style="width: 24px; height: 2px;"></span>
                    <span class="d-block bg-dark" style="width: 24px; height: 2px;"></span>
                    <span class="d-block bg-dark" style="width: 24px; height: 2px;"></span>
                </div>
            </div>
        </div><!--main-menu-inner-->
    </div><!--main-menu-->
    {{-- End Navbar --}}
</header><!--header-->

<style>
    /* Topbar dengan warna yang sesuai dengan beranda */
    .topbar,
    .topbar-inner,
    .topbar-left,
    .topbar-socials,
    .topbar-info,
    .topbar-right {
        background: linear-gradient(135deg, #003b49, #2dcd7c) !important;
        color: #ffffff !important;
    }

    .topbar-socials a,
    .topbar-info i,
    .topbar-info a,
    .topbar-info span,
    .topbar-right a {
        color: #ffffff !important;
    }

    /* Hover effects untuk topbar links */
    .topbar-info a:hover,
    .topbar-right a:hover {
        color: rgba(255, 255, 255, 0.8) !important;
        transition: color 0.3s ease;
    }

    .topbar-info ul {
        display: flex;
        align-items: center;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .topbar-info ul li {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Main menu styling */
    .main-menu-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 18px !important;
        min-height: 60px !important;
        background: #ffffff;
        border-bottom: 1px solid rgba(45, 205, 124, 0.1);
    }

    .main-menu-logo {
        min-width: 220px;
        justify-content: center;
        display: flex;
        align-items: center;
        padding: 8px 12px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(45, 205, 124, 0.1);
    }

    .main-menu-logo img {
        max-height: 50px;
        height: auto;
        width: auto;
    }
    
    /* Menu navigation styling */
    .main-menu-list > li > a {
        font-size: 0.95rem !important;
        padding: 0.5rem 0.75rem !important;
        color: #003b49 !important;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 6px;
        position: relative;
    }

    .main-menu-list > li > a:hover {
        color: #2dcd7c !important;
        background: rgba(45, 205, 124, 0.05);
    }

    /* Underline animation effect */
    .underline-animate {
        position: relative;
        overflow: hidden;
    }

    .underline-animate::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, #2dcd7c, #003b49);
        transition: left 0.3s ease;
    }

    .underline-animate:hover::after {
        left: 0;
    }

    /* Sub menu styling - PERBAIKAN SENSITIVITY */
    .sub-menu,
    .sub-sub-menu,
    .sub-sub-sub-menu {
        display: none;
        position: absolute;
        background: #ffffff !important;
        border: 1px solid rgba(45, 205, 124, 0.2) !important;
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(0, 59, 73, 0.15) !important;
        padding: 8px 0 !important;
        min-width: 220px !important;
        z-index: 9999 !important;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: opacity 0.25s ease, visibility 0.25s ease, transform 0.25s ease;
        pointer-events: none;
    }

    /* Tambahkan padding area untuk mencegah dropdown hilang saat mouse bergerak */
    .has-dropdown {
        position: relative;
    }

    .has-dropdown::before {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        right: 0;
        height: 10px;
        background: transparent;
    }

    /* Aktifkan dropdown dengan delay */
    .has-dropdown.menu-active > .sub-menu,
    .has-dropdown.menu-active > .sub-sub-menu,
    .has-dropdown.menu-active > .sub-sub-sub-menu {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) !important;
        pointer-events: auto;
    }

    /* Styling untuk link di sub menu */
    .sub-menu li,
    .sub-sub-menu li,
    .sub-sub-sub-menu li {
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
        position: relative;
    }

    .sub-menu a,
    .sub-sub-menu a,
    .sub-sub-sub-menu a {
        color: #003b49 !important;
        font-weight: 500 !important;
        font-size: 0.9rem !important;
        padding: 10px 16px !important;
        display: block !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
        border-radius: 4px;
        margin: 2px 8px !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .sub-menu a:hover,
    .sub-sub-menu a:hover,
    .sub-sub-sub-menu a:hover {
        color: #2dcd7c !important;
        background: rgba(45, 205, 124, 0.08) !important;
        padding-left: 20px !important;
    }

    /* Styling khusus untuk nested menu */
    .sub-sub-menu {
        left: 100% !important;
        top: 0 !important;
        margin-left: 8px !important;
    }

    .sub-sub-sub-menu {
        left: 100% !important;
        top: 0 !important;
        margin-left: 8px !important;
    }

    /* Border untuk item menu */
    .sub-menu li,
    .sub-sub-menu li,
    .sub-sub-sub-menu li {
        border-bottom: 1px solid rgba(45, 205, 124, 0.08);
    }

    .sub-menu li:last-child,
    .sub-sub-menu li:last-child,
    .sub-sub-sub-menu li:last-child {
        border-bottom: none;
    }

    /* Icon indicator untuk dropdown */
    .has-dropdown > a::after {
        content: '\f107';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        margin-left: 6px;
        font-size: 0.8em;
        transition: transform 0.3s ease;
    }

    .has-dropdown.menu-active > a::after {
        transform: rotate(180deg);
    }

    /* Sub-menu icon ke kanan */
    .sub-menu .has-dropdown > a::after,
    .sub-sub-menu .has-dropdown > a::after {
        content: '\f105';
        float: right;
        margin-left: auto;
        transform: none !important;
    }
    
    /* Style untuk memperkecil ukuran font di header */
    .topbar-info,
    .topbar-info a,
    .topbar-info span {
        font-size: 0.85rem !important;
        font-weight: 500;
    }

    /* Mobile menu button styling */
    .mobile-menu-button {
        cursor: pointer;
        padding: 8px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .mobile-menu-button:hover {
        background: rgba(45, 205, 124, 0.05);
    }

    .mobile-menu-button span {
        transition: all 0.3s ease;
        background: #003b49 !important;
    }

    .mobile-menu-button:hover span {
        background: #2dcd7c !important;
    }

    /* Sticky header enhancement */
    .sticky-header.active {
        box-shadow: 0 2px 15px rgba(0, 59, 73, 0.1);
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .main-menu-inner {
            padding: 12px 15px !important;
        }
        
        .main-menu-logo {
            min-width: 180px;
        }
        
        .main-menu-logo img {
            max-height: 40px;
        }
        
        .topbar-info ul {
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .topbar-info ul li {
            font-size: 0.8rem !important;
        }
    }

    @media (max-width: 768px) {
        .topbar-info ul {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        
        .main-menu-logo {
            min-width: 160px;
        }
        
        .main-menu-logo img {
            max-height: 35px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua elemen yang memiliki dropdown
    const dropdownItems = document.querySelectorAll('.has-dropdown');
    
    dropdownItems.forEach(item => {
        let enterTimeout;
        let leaveTimeout;
        
        // Mouse enter event - buka dropdown dengan delay
        item.addEventListener('mouseenter', function() {
            const element = this;
            
            // Clear timeout leave jika ada
            if (leaveTimeout) {
                clearTimeout(leaveTimeout);
            }
            
            // Set timeout untuk membuka dropdown (delay 300ms)
            enterTimeout = setTimeout(() => {
                element.classList.add('menu-active');
            }, 200);
        });
        
        // Mouse leave event - tutup dropdown dengan delay
        item.addEventListener('mouseleave', function() {
            const element = this;
            
            // Clear timeout enter jika ada
            if (enterTimeout) {
                clearTimeout(enterTimeout);
            }
            
            // Set timeout untuk menutup dropdown (delay 200ms)
            leaveTimeout = setTimeout(() => {
                element.classList.remove('menu-active');
            }, 150);
        });
        
        // Click event untuk toggle (opsional, untuk touch devices)
        item.addEventListener('click', function(e) {
            // Hanya untuk item yang memiliki submenu
            if (this.querySelector('.sub-menu, .sub-sub-menu, .sub-sub-sub-menu')) {
                // Jika klik pada link yang memiliki href #, toggle dropdown
                const link = e.target.closest('a');
                if (link && (link.getAttribute('href') === '#' || link.getAttribute('href') === 'javascript:void(0)')) {
                    e.preventDefault();
                    this.classList.toggle('menu-active');
                }
            }
        });
    });
    
    // Close all dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.has-dropdown')) {
            dropdownItems.forEach(item => {
                item.classList.remove('menu-active');
            });
        }
    });
});
</script>