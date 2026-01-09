@extends('guest.layouts.app')

@section('title', $playlist->jdl_playlist)

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-box-glass p-4 rounded">
                    <h3 class="mb-3">{{ $playlist->jdl_playlist }}</h3>

                    <div class="mb-3 text-muted" style="font-size: 0.9em;">
                        <i class="fa fa-calendar"></i>
                        {{ \Carbon\Carbon::parse($playlist->created_at ?? now())->format('d M Y') }}
                        <i class="fa fa-video ms-3"></i>
                        {{ $videos->count() }} Video
                    </div>

                    @if ($playlist->gbr_playlist && file_exists(public_path('asset/img_playlist/' . $playlist->gbr_playlist)))
                        <div class="mb-4 text-center">
                            <img src="{{ asset('asset/img_playlist/' . $playlist->gbr_playlist) }}"
                                alt="{{ $playlist->jdl_playlist }}" class="img-fluid rounded"
                                style="max-height: 400px; object-fit: playlist;">
                        </div>
                    @endif

                    <div class="mb-4">
                        {!! $playlist->deskripsi ?? '<p>Tidak ada deskripsi untuk playlist ini.</p>' !!}
                    </div>

                    <div class="videos-section">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="mb-0 fw-semibold">
                                <i class="fa fa-list-play me-2 text-primary"></i>
                                Daftar Video
                            </h4>
                            <div class="ms-auto">
                                <span class="text-muted small">{{ $videos->count() }} dari
                                    {{ $videos->total() ?? $videos->count() }} video</span>
                            </div>
                        </div>

                        <div class="row g-4">
                            @forelse ($videos as $index => $video)
                                <div class="col-12 mb-4">
                                    <div class="video-card card border-0 shadow-sm rounded-4 overflow-hidden">
                                        <div class="row g-0 h-100">
                                            <!-- Video Section - Takes 60% width -->
                                            <div class="col-lg-8">
                                                <div class="position-relative h-100">
                                                    <!-- Video Number Badge -->
                                                    <div class="position-absolute top-0 start-0 m-3 z-3">
                                                        <span class="badge bg-dark bg-opacity-75 rounded-pill px-3 py-2">
                                                            #{{ $index + 1 }}
                                                        </span>
                                                    </div>

                                                    <!-- Video Embed -->
                                                    @if ($video->youtube_embed)
                                                        <div class="video-wrapper h-100">
                                                            <div class="ratio ratio-16x9 h-100">
                                                                <iframe src="{{ $video->youtube_embed }}" frameborder="0"
                                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                    allowfullscreen loading="lazy" class="w-100 h-100"
                                                                    style="min-height: 350px;">
                                                                </iframe>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="video-placeholder bg-light d-flex align-items-center justify-content-center h-100"
                                                            style="min-height: 350px;">
                                                            <div class="text-center text-muted">
                                                                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                                                                <h5>Video tidak tersedia</h5>
                                                                <p class="mb-0">Format video tidak didukung</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Content Section - Takes 40% width -->
                                            <div class="col-lg-4">
                                                <div class="card-body h-100 d-flex flex-column p-4">
                                                    <div class="flex-grow-1">
                                                        <h4 class="card-title fw-bold mb-3 text-dark">
                                                            {{ $video->jdl_video }}
                                                        </h4>

                                                        @if ($video->keterangan)
                                                            <div class="card-text text-muted mb-4">
                                                                <p class="mb-0" style="line-height: 1.6;">
                                                                    {{ $video->keterangan }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- Card Footer -->
                                                    <div class="card-footer-custom pt-3 border-top">
                                                        <div class="row g-2">
                                                            <div class="col-12 mb-2">
                                                                <div class="d-flex align-items-center text-muted">
                                                                    <i class="far fa-calendar-alt me-2 text-primary"></i>
                                                                    <span
                                                                        class="fw-medium">{{ $video->tanggal ?: 'Tanggal tidak tersedia' }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="d-flex align-items-center text-muted">
                                                                    <i class="far fa-eye me-2 text-success"></i>
                                                                    <span
                                                                        class="fw-medium">{{ number_format($video->dilihat ?? 0) }}
                                                                        kali ditonton</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="empty-state text-center py-5">
                                        <div class="mb-4">
                                            <i class="fas fa-video fa-4x text-muted opacity-50"></i>
                                        </div>
                                        <h5 class="text-muted mb-2">Belum Ada Video</h5>
                                        <p class="text-muted">Playlist ini belum memiliki video. Silakan kembali lagi nanti.
                                        </p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @if ($videos->hasPages())
                        <div class="mt-4">
                            {{ $videos->links('pagination::bootstrap-5') }}
                        </div>
                    @endif

                    <a href="{{ route('videoPlaylist') }}" class="btn btn-outline-secondary mt-4">
                        <i class="fa fa-arrow-left"></i> Kembali ke Semua Playlist
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
