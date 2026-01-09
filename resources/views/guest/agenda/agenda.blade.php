@extends('guest.layouts.app')

@section('title', 'Bapedalitbang')

@section('content')

    <section class="service-details-section">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="text-decoration-none text-success">
                                <i class="fa fa-home me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">
                            Agenda
                        </li>
                    </ol>
                </nav>
                <div class="col-lg-8">
                    <div class="content-box-glass p-4 rounded">
                        <!-- Breadcrumb -->

                        <h3 class="service-details-title mb-4 pb-2 border-bottom border-2 border-success">
                            <i class="fa fa-calendar-check me-2 text-success"></i> Agenda Kegiatan Bapedalitbang
                        </h3>


                        @foreach ($agenda as $item)
                            <div
                                class="mb-4 p-4 rounded-3 border border-light shadow-sm bg-light position-relative hover-shadow transition">
                                <h4 class="fw-semibold mb-2 text-dark">{{ $item->tema }}</h4>

                                <div class="d-flex flex-wrap small text-muted mb-2">
                                    <div class="me-3">
                                        <i class="fa fa-calendar-alt me-1"></i>
                                        {{ \Carbon\Carbon::parse($item->tgl_mulai)->translatedFormat('d M Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->tgl_selesai)->translatedFormat('d M Y') }}
                                    </div>
                                    <div class="me-3">
                                        <i class="fa fa-clock me-1"></i>{{ $item->jam }}
                                    </div>
                                    <div>
                                        <i class="fa fa-map-marker-alt me-1"></i>{{ $item->tempat }}
                                    </div>
                                </div>

                                <div class="text-body text-wrap" style="line-height: 1.6;">
                                    {!! $item->isi_agenda !!}
                                </div>
                            </div>
                        @endforeach
                        <div class="row mt-4">
                            <div class="col-lg-12 d-flex justify-content-center">
                                {{ $agenda->links('pagination::bootstrap-5') }}
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
                {{-- End Side Berita --}}
            </div>
        </div><!-- /.container -->

    </section><!-- /.service-details-section -->

@endsection
