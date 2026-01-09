@extends('guest.layouts.app')
@section('title', 'BPKPAD')

@section('content')
    <section class="service-details-section">
        <div class="container">
            <div class="row">

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="mb-3 mt-5">
                    <ol class="breadcrumb bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="text-decoration-none text-kominfo">
                                <i class="fa fa-home me-1"></i> Beranda
                            </a>
                        </li>

                        @if ($page)
                            <li class="breadcrumb-item active text-dark" aria-current="page">
                                {{ $page->judul }}
                            </li>
                        @else
                            <li class="breadcrumb-item active text-dark" aria-current="page">
                                Tidak Ditemukan
                            </li>
                        @endif
                    </ol>
                </nav>

                {{-- Konten Halaman --}}
                <div class="col-lg-8">
                    <div class="content-box-depth p-4 rounded">
                        @if ($page)
                            <div class="service-details-content-box mb-4">

                                {{-- Judul --}}
                                <h3 class="service-details-title">{{ $page->judul }}</h3>

                                {{-- Meta --}}
                                <div class="mb-3 text-muted" style="font-size: 0.9em;">
                                    <i class="fa fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($page->tgl_posting)->format('d M Y') }}

                                    <i class="fa fa-clock ms-3"></i>
                                    {{ $page->jam }} WIB

                                    <i class="fa fa-eye ms-3"></i>
                                    {{ $page->dibaca }}x dibaca
                                </div>

                                {{-- Konten --}}
                                <div class="page-content">
                                    <div class="overflow-hidden">
                                        <img src="{{ asset('asset/foto_statis/' . $page->gambar) }}" alt=""
                                            class="img-fluid rounded shadow-sm mb-3" style="width: 100%; height: auto;"
                                            loading="lazy">



                                        <div class="page-content" style="font-size: 0.95rem; line-height: 1.7;">
                                            {!! $page->isi_halaman !!}
                                        </div>

                                        <style>
                                            .page-content,
                                            .page-content * {
                                                line-height: 1.7;
                                                color: #000 !important;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>Konten halaman tidak ditemukan.</p>
                        @endif
                    </div>
                </div>
                {{-- End Konten Halaman --}}

                {{-- Sidebar Berita --}}
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="custom-card-depth">
                        <div class="card-body">

                            {{-- Tombol Lihat Semua --}}
                            <a href="{{ route('showBeritaAll') }}" class="btn btn-lihat-semua border mb-2 mt-3">
                                Lihat Semua Berita
                                <i class="fas fa-arrow-up-right-from-square"
                                    style="font-size: 0.8em; margin-left: 6px; color: inherit;"></i>
                            </a>

                            {{-- Tabs --}}
                            <div class="d-flex gap-5 mb-1">
                                <ul class="nav nav-tabs nav-tabs-berita mb-3" id="beritaTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="terbaru-tab" data-bs-toggle="tab"
                                            data-bs-target="#terbaru" type="button" role="tab" aria-controls="terbaru"
                                            aria-selected="true">
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
                            </div>

                            {{-- Tab Content --}}
                            <div class="tab-content tab-content-berita" id="beritaTabContent">

                                {{-- Berita Terbaru --}}
                                <div class="tab-pane fade show active" id="terbaru" role="tabpanel"
                                    aria-labelledby="terbaru-tab">
                                    @foreach ($beritaTerbaru as $item)
                                        <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"
                                            class="mb-3 p-3 berita-item d-block text-decoration-none text-dark rounded-3 shadow-sm bg-white transition-hover">
                                            <h6 class="mb-1 fs-6">{{ $item->judul }}</h6>
                                            <small class="text-muted berita-meta">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} |
                                                {{ $item->jam }} |
                                                <i class="fa fa-eye"></i> {{ $item->dibaca }} |
                                                <i class="fa fa-user ms-2"></i> {{ $item->username }}
                                            </small>
                                        </a>
                                    @endforeach
                                </div>

                                {{-- Berita Terpopuler --}}
                                <div class="tab-pane fade" id="terpopuler" role="tabpanel" aria-labelledby="terpopuler-tab">
                                    @foreach ($beritaTerpopuler as $item)
                                        <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"
                                            class="mb-3 p-3 berita-item d-block text-decoration-none text-dark rounded-3 shadow-sm bg-white transition-hover">
                                            <h6 class="mb-1 fs-6">{{ $item->judul }}</h6>
                                            <small class="text-muted berita-meta">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} |
                                                {{ $item->jam }} |
                                                <i class="fa fa-eye"></i> {{ $item->dibaca }} |
                                                <i class="fa fa-user ms-2"></i> {{ $item->username }}
                                            </small>
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                            {{-- End Tab Content --}}

                        </div>
                    </div>
                </div>
                {{-- End Sidebar Berita --}}

            </div>
        </div>
    </section>
@endsection
