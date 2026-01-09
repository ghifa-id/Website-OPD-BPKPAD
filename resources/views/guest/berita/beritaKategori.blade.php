@extends('guest.layouts.app')

@section('title', 'Bapedalitbang')

@section('content')

    <section class="news-details-section">
        <div class="container">

            <div class="row">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="text-decoration-none text-success">
                                <i class="fa fa-home me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/berita/all') }}" class="text-decoration-none text-success">
                                Seluruh Berita
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">
                            {{ $kategori->nama_kategori }}
                        </li>

                    </ol>
                </nav>
                <div class="col-lg-8">
                    <div class="content-box-glass p-4 rounded">
                        <h2 class="mb-4 fw-bold">Kategori: {{ $kategori->nama_kategori }}</h2>

                        @forelse ($berita as $item)
                            <div class="card mb-4 border-0 shadow-sm rounded overflow-hidden">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img src="{{ asset('asset/foto_berita/' . $item->gambar) }}"
                                            class="img-fluid h-100 w-100 object-fit-cover" style="object-fit: cover;"
                                            alt="{{ $item->judul }}" loading="lazy">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title fw-semibold">
                                                <a href="{{ route('berita.detail', $item->judul_seo) }}"
                                                    class="text-dark text-decoration-none">
                                                    {{ $item->judul }}
                                                </a>
                                            </h5>
                                            <p class="card-text text-muted small">
                                                {{ Str::limit(strip_tags($item->isi_berita), 150) }}
                                            </p>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"
                                                    class="btn btn-link p-0 mt-auto text-success fw-semibold d-flex align-items-center">
                                                    Baca Berita
                                                    <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                                <small class="text-muted d-flex align-items-center gap-3">
                                                    <span><i class="fa fa-calendar-alt me-1"></i>
                                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                                    <span><i class="fa fa-comment-alt me-1"></i>
                                                        {{ $item->komentar_count }} komentar</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-warning">Belum ada berita dalam kategori ini.</div>
                        @endforelse

                        {{-- Pagination --}}
                        <div class="row mt-4">
                            <div class="col-lg-12 d-flex justify-content-center">
                                {{ $berita->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Side Berita --}}
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="custom-card-glass">
                        <div class="card-body">

                            <a href="{{ route('showBeritaAll') }}" class="btn btn-lihat-semua border  mb-2 mt-3">
                                Lihat Semua Berita
                                <i class="fas fa-arrow-up-right-from-square"
                                    style="font-size: 0.8em; margin-left: 6px; color: inherit;"></i>
                            </a>

                            <!-- Tabs -->
                            <div class="d-flex gap-5 mb-1">
                                <ul class="nav nav-tabs nav-tabs-berita mb-3" id="beritaTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="terbaru-tab" data-bs-toggle="tab"
                                            data-bs-target="#terbaru" type="button" role="tab" aria-controls="terbaru"
                                            aria-selected="true">Terbaru</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="terpopuler-tab" data-bs-toggle="tab"
                                            data-bs-target="#terpopuler" type="button" role="tab"
                                            aria-controls="terpopuler" aria-selected="false">Terpopuler</button>
                                    </li>
                                </ul>
                            </div>

                            <!-- Konten Tab -->
                            <div class="tab-content tab-content-berita" id="beritaTabContent">
                                <!-- Berita Terbaru -->
                                <div class="tab-pane fade show active" id="terbaru" role="tabpanel"
                                    aria-labelledby="terbaru-tab">
                                    @foreach ($beritaTerbaru as $item)
                                        <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"
                                            class="mb-3 berita-item d-block text-decoration-none text-dark">
                                            <h6 class="mb-1 fs-6">{{ $item->judul }}</h6>
                                            <small class="text-muted berita-meta">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} |
                                                {{ $item->jam }} |
                                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $item->dibaca }} |
                                                <i class="fa fa-user" aria-hidden="true" style="margin-left: 6px;"></i>
                                                {{ $item->username }}
                                            </small>
                                        </a>
                                    @endforeach
                                </div>

                                <!-- Berita Terpopuler -->
                                <div class="tab-pane fade" id="terpopuler" role="tabpanel" aria-labelledby="terpopuler-tab">
                                    @foreach ($beritaTerpopuler as $item)
                                        <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"
                                            class="mb-3 berita-item d-block text-decoration-none text-dark">
                                            <h6 class="mb-1 fs-6">{{ $item->judul }}</h6>
                                            <small class="text-muted berita-meta">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} |
                                                {{ $item->jam }} |
                                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $item->dibaca }} |
                                                <i class="fa fa-user" aria-hidden="true" style="margin-left: 6px;"></i>
                                                {{ $item->username }}
                                            </small>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- End Side Berita --}}
        </div><!-- col-lg-4 -->
        </div><!-- row -->
        </div><!-- container -->
    </section><!--causes-one-section-->
@endsection
@push('styles')
    <style>
        .card-title a:hover {
            color: #198754;
            /* Bootstrap success */
            text-decoration: underline;
        }

        .object-fit-cover {
            object-fit: cover;
            height: 100%;
        }

        .pagination .page-item.active .page-link {
            background-color: #198754;
            border-color: #198754;
            color: #fff;
        }

        .pagination .page-link {
            border-radius: 50%;
            margin: 0 5px;
            transition: all 0.3s;
        }

        .pagination .page-link:hover {
            background-color: #e9ecef;
        }

        a.text-success:hover {
            text-decoration: underline;
            color: #155724;
            /* hijau gelap bootstrap */
        }
    </style>
@endpush
