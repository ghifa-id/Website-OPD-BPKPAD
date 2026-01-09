@extends('guest.layouts.app')

@section('title', 'Semua playlist')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4 section-title">Semua <span style="color: #2dcd7c; font-weight: 700;">playlist</span></h2>

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-decoration-none text-success">
                        <i class="fa fa-home me-1"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">
                    Seluruh playlist
                </li>
            </ol>
        </nav>

        <!-- Custom CSS untuk animasi -->


        <div class="row">
            @forelse ($video as $item)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="playlist-card border rounded shadow-sm p-3 text-center h-100">
                        <div class="position-relative mb-3">
                            <a href="{{ route('video.detail', ['seo' => $item->playlist_seo]) }}">
                                @if ($item->gbr_playlist && file_exists(public_path('asset/img_playlist/' . $item->gbr_playlist)))
                                    <img src="{{ asset('asset/img_playlist/' . $item->gbr_playlist) }}"
                                        alt="{{ $item->jdl_playlist }}" class="playlist-image" loading="lazy"
                                        onerror="this.src='{{ asset('asset/img/no-image.jpg') }}'">
                                @else
                                    <img src="{{ asset('asset/img/no-image.jpg') }}" alt="No Image Available"
                                        class="playlist-image" loading="lazy">
                                @endif

                                <div class="playlist-overlay">
                                    <i class="fa fa-eye view-icon"></i>
                                </div>
                            </a>
                        </div>

                        <div class="playlist-content">
                            @php
                                $jumlahvideo = \App\Models\playlist::where('id_playlist', $item->id_playlist)->count();
                            @endphp

                            <div class="photo-count">
                                <i class="fa fa-images me-1"></i>
                                {{ $jumlahvideo }} video
                            </div>

                            <a href="{{ route('video.detail', ['seo' => $item->playlist_seo]) }}"
                                class="playlist-title text-decoration-none d-block">
                                {{ Str::limit($item->jdl_playlist, 30) }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fa fa-images fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum Ada playlist</h4>
                        <p class="text-muted">playlist video belum tersedia saat ini.</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($video->hasPages())
            <div class="row mt-4">
                <div class="col-lg-12 d-flex justify-content-center">
                    {{ $video->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
    @push('styles')
        <style>
            .playlist-card {
                transition: all 0.3s ease;
                overflow: hidden;
            }

            .playlist-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
            }

            .playlist-image {
                width: 100%;
                height: 250px;
                object-fit: cover;
                transition: all 0.4s ease;
                border-radius: 8px;
            }

            .playlist-card:hover .playlist-image {
                transform: scale(1.05);
                filter: brightness(1.1);
            }

            .playlist-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, rgba(45, 205, 124, 0.8), rgba(45, 205, 124, 0.6));
                opacity: 0;
                transition: opacity 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 8px;
            }

            .playlist-card:hover .playlist-overlay {
                opacity: 1;
            }

            .playlist-content {
                transition: all 0.3s ease;
            }

            .playlist-card:hover .playlist-content {
                transform: translateY(-2px);
            }

            .view-icon {
                color: white;
                font-size: 2rem;
                transition: transform 0.2s ease;
            }

            .playlist-card:hover .view-icon {
                transform: scale(1.2);
            }

            .photo-count {
                background: linear-gradient(45deg, #2dcd7c, #20a869);
                color: white;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 0.85rem;
                font-weight: 500;
                display: inline-block;
                margin-bottom: 8px;
            }

            .playlist-title {
                color: #333;
                font-weight: 600;
                font-size: 1.1rem;
                transition: color 0.3s ease;
            }

            .playlist-card:hover .playlist-title {
                color: #2dcd7c;
            }
        </style>
    @endpush
@endsection
