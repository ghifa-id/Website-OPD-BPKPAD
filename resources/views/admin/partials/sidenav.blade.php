<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
    id="sidenav-main">

    <div class="sidenav-header">

        <a class="navbar-brand px-4 py-3 m-0" href="https://www.bpkpad.pesisirselatankab.go.id/">

            <img src="https://www.pesisirselatankab.go.id/assets/images/logo2.png" alt="Logo Pesisir Selatan"
                class="ms-1 text-sm text-dark"></span>

        </a>



    </div>

    <hr class="horizontal dark mt-0 mb-2">

    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">

        <ul class="navbar-nav">

            <li class="nav-item">

                <a class="nav-link active bg-gradient-success text-white no-underline"
                    href="{{ route('administrator.beranda') }}">

                    <i class="material-symbols-rounded opacity-5">home</i>

                    <span class="nav-link-text ms-1">Dashboard</span>

                </a>

            </li>



            {{-- Menu Utama --}}

            <li class="nav-item">

                <a class="nav-link text-dark" href="#navbar-menu" data-bs-toggle="collapse" role="button">

                    <i class="material-symbols-rounded opacity-5">menu</i>

                    <span class="nav-link-text ms-1">Menu Utama</span>

                </a>

                <div class="collapse" id="navbar-menu">

                    <ul class="nav flex-column ms-3">



                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('identitaswebsite') }}">

                                <i class="material-symbols-rounded opacity-5">badge</i>

                                <span class="nav-link-text ms-1">Identitas Website</span>

                            </a>

                        </li>



                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('judulmenu') }}">

                                <i class="material-symbols-rounded opacity-5">category</i>

                                <span class="nav-link-text ms-1">Judul Menu</span>

                            </a>

                        </li>



                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark"href="{{ route('kontenmenu') }}">

                                <i class="material-symbols-rounded opacity-5">description</i>

                                <span class="nav-link-text ms-1">Isi/Konten Menu</span>

                            </a>

                        </li>



                        <li class="nav-item">

                            <a class="nav-link text-dark" href="{{ route('administrator.penghargaan') }}">

                                <i class="material-symbols-rounded opacity-6">emoji_events</i>

                                <span class="nav-link-text ms-2">Penghargaan</span>

                            </a>

                        </li>



                    </ul>

                </div>

            </li>



            {{-- Modul Pejabat --}}

            <li class="nav-item">

                <a class="nav-link text-dark" href="#navbar-pejabat" data-bs-toggle="collapse" role="button">

                    <i class="material-symbols-rounded opacity-5">badge</i> {{-- Ikon baru untuk Pejabat --}}

                    <span class="nav-link-text ms-1">Modul Pejabat</span>

                </a>



                <div class="collapse" id="navbar-pejabat">

                    <ul class="nav flex-column ms-3">

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('jabatan') }}">

                                <i class="material-symbols-rounded opacity-5">work</i> {{-- Ikon untuk Jabatan --}}

                                <span class="nav-link-text ms-1">Daftar Jabatan</span>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('pejabat') }}">

                                <i class="material-symbols-rounded opacity-5">person</i> {{-- Ikon untuk Pejabat --}}

                                <span class="nav-link-text ms-1">Daftar Pejabat</span>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>

            {{-- End Modul Pejabat --}}





            {{-- Modul berita --}}

            <li class="nav-item">

                <a class="nav-link text-dark" href="#navbar-berita" data-bs-toggle="collapse" role="button">

                    <i class="material-symbols-rounded opacity-5">feed</i>

                    <span class="nav-link-text ms-1">Modul Berita</span>

                </a>



                <div class="collapse" id="navbar-berita">

                    <ul class="nav flex-column ms-3">

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('listberita') }}">

                                <i class="material-symbols-rounded opacity-5">newspaper</i>

                                <span class="nav-link-text ms-1">List Berita</span>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('kategoriberita') }}">

                                <i class="material-symbols-rounded opacity-5">label</i>

                                <span class="nav-link-text ms-1">Kategori Berita</span>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>





            {{-- Modul Foto --}}

            <li class="nav-item">

                <a class="nav-link text-dark" href="#navbar-foto" data-bs-toggle="collapse" role="button">

                    <i class="material-symbols-rounded opacity-5">photo_library</i>

                    <span class="nav-link-text ms-1">Modul Foto</span>

                </a>



                <div class="collapse" id="navbar-foto">

                    <ul class="nav flex-column ms-3">

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('album') }}">

                                <i class="material-symbols-rounded opacity-5">image</i>

                                <span class="nav-link-text ms-1">Sampul/Cover Album</span>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('gallery') }}">

                                <i class="material-symbols-rounded opacity-5">folder</i>

                                <span class="nav-link-text ms-1">Foto</span>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>



            {{-- Modul Video --}}

            <li class="nav-item">

                <a class="nav-link text-dark" href="#navbar-video" data-bs-toggle="collapse" role="button">

                    <i class="material-symbols-rounded opacity-5">video_library</i>

                    <span class="nav-link-text ms-1">Modul Video</span>

                </a>



                <div class="collapse" id="navbar-video">

                    <ul class="nav flex-column ms-3">

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('playlist') }}">

                                <i class="material-symbols-rounded opacity-5">image</i>

                                <span class="nav-link-text ms-1">Sampul/Cover Video</span>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('video') }}">

                                <i class="material-symbols-rounded opacity-5">folder</i>

                                <span class="nav-link-text ms-1">Video</span>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>



            {{-- Modul Web --}}

            <li class="nav-item">

                <a class="nav-link text-dark" href="#navbar-web" data-bs-toggle="collapse" role="button">

                    <i class="material-symbols-rounded opacity-5">language</i>

                    <span class="nav-link-text ms-1">Modul Web</span>

                </a>



                <div class="collapse" id="navbar-web">

                    <ul class="nav flex-column ms-3">
                        {{-- Kepuasan Publik --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link text-dark" href="{{ route('kepuasanPublik.Admin') }}">
                                <i class="material-symbols-rounded opacity-5">sentiment_satisfied_alt</i>
                                <span class="nav-link-text ms-1">Kepuasan Publik</span>
                            </a>
                        </li>

                        <!-- Pengumuman -->

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('admin.pengumuman') }}">

                                <i class="material-symbols-rounded opacity-5">campaign</i>

                                <span class="nav-link-text ms-1">Pengumuman</span>

                            </a>

                        </li>

                        <!-- File Download -->

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('download') }}">

                                <i class="material-symbols-rounded opacity-5">file_download</i>

                                <span class="nav-link-text ms-1">File Download</span>

                            </a>

                        </li>

                        <!-- Produk Hukum -->

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('produkhukum') }}">

                                <i class="material-symbols-rounded opacity-5">gavel</i>

                                <span class="nav-link-text ms-1">Produk Hukum</span>

                            </a>

                        </li>

                        <!-- PPID -->

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('ppid') }}">

                                <i class="material-symbols-rounded opacity-5">info</i>

                                <span class="nav-link-text ms-1">PPID</span>

                            </a>

                        </li>

                        <!-- PPID Konten -->

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('ppidkonten') }}">

                                <i class="material-symbols-rounded opacity-5">article</i>

                                <span class="nav-link-text ms-1">PPID Konten</span>

                            </a>

                        </li>

                        <!-- List Agenda -->

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('administrator.agenda') }}">

                                <i class="material-symbols-rounded opacity-5">event</i>

                                <span class="nav-link-text ms-1">List Agenda</span>

                            </a>

                        </li>

                        <!-- Data dokperenlitbangn -->

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('Dokperenlitbang') }}">

                                <i class="material-symbols-rounded opacity-5">group</i>

                                <span class="nav-link-text ms-1">Dok.Perencanaan & Litbang</span>

                            </a>

                        </li>

                    </ul>

                </div>



            </li>



            {{-- Modul User --}}

            <li class="nav-item">

                <a class="nav-link text-dark" href="#navbar-user" data-bs-toggle="collapse" role="button">

                    <i class="material-symbols-rounded opacity-5">people</i>

                    <span class="nav-link-text ms-1">Modul User</span>

                </a>



                <div class="collapse" id="navbar-user">

                    <ul class="nav flex-column ms-3">

                        <li class="nav-item">

                            <a class="nav-link menu-link text-dark" href="{{ route('manajemenuser') }}">

                                <i class="material-symbols-rounded opacity-5">manage_accounts</i>

                                <span class="nav-link-text ms-1">Manajemen User</span>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>





            <li class="nav-item mt-3">

                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account

                    pages

                </h6>

            </li>

            <li class="nav-item">

                <a class="nav-link text-dark" href="{{ route('edit.profil') }}">

                    <i class="material-symbols-rounded opacity-5">edit</i>

                    <span class="nav-link-text ms-1">Edit User</span>

                </a>

            </li>



            <li class="nav-item">

                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">

                    @csrf

                    <button type="submit" class="nav-link text-dark bg-transparent border-0 w-100 text-start">

                        <i class="material-symbols-rounded opacity-5">logout</i>

                        <span class="nav-link-text ms-1">Log Out</span>

                    </button>

                </form>

            </li>



        </ul>

    </div>

</aside>
