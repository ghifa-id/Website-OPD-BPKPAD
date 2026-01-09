<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="{{ route('administrator.beranda') }}">Administrator</a>
                </li>
                @if (!empty($parentBreadcrumb))
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="{{ url('/administrator/' . $parentBreadcrumbUrl) }}">
                            {{ $parentBreadcrumb }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                    {{ $breadcrumb ?? 'beranda' }}
                </li>
            </ol>
        </nav>


        @php
            $nama_lengkap = session('nama_lengkap') ?? (session('username') ?? 'Guest');
        @endphp
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-2 mx-2 shadow-none border-radius-xl bg-dark text-white"
            style="height: 50px;">
            <div class="container-fluid py-2">
                <div class="d-flex align-items-center w-100 justify-content-center"> <!-- Menengahkan konten -->
                    <li class="nav-item d-lg-none ps-2 d-flex align-items-center me-1">
                        <a href="javascript:;" class="nav-link text-white p-0 sidenav-toggler" id="iconNavbarSidenav">
                            <i class="fas fa-bars"></i> <!-- Ikon toggle sidebar -->
                        </a>
                    </li>

                    <!-- Profil User -->
                    <ul class="navbar-nav d-flex align-items-center">
                        <li class="nav-item dropdown">
                            <a href="#"
                                class="nav-link text-white font-weight-bold px-2 d-flex align-items-center dropdown-toggle"
                                id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="material-symbols-rounded">account_circle</i>
                                <span class="ms-1">{{ $nama_lengkap }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 extra-small-dropdown animate-fade p-1"
                                aria-labelledby="profileDropdown">
                                <!-- Profile Menu -->
                                <li class="py-0">
                                    <a class="dropdown-item d-flex align-items-center text-dark small-text"
                                        href="{{ route('edit.profil') }}">
                                        <i class="material-symbols-rounded opacity-75 me-2 small-icon">person</i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <hr class="dropdown-divider my-1">

                                <!-- Logout Menu - Improved Styling -->
                                <li class="py-0">
                                    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 w-100">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item d-flex align-items-center text-danger small-text w-100 bg-transparent border-0">
                                            <i class="material-symbols-rounded opacity-75 me-2 small-icon">logout</i>
                                            <span>Log Out</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
</nav>
