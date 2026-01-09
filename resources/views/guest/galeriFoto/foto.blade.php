@extends('guest.layouts.app')

@section('title', 'Semua Album')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4 section-title">Semua <span style="color: #2dcd7c; font-weight: 700;">Album</span></h2>

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-decoration-none text-success">
                        <i class="fa fa-home me-1"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">
                    Seluruh Album
                </li>
            </ol>
        </nav>

        <!-- Custom CSS untuk animasi -->


        <div class="row">
            @forelse ($foto as $item)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="album-card border rounded shadow-sm p-3 text-center h-100">
                        <div class="position-relative mb-3">
                            <a href="{{ route('foto.detail', ['seo' => $item->album_seo]) }}">
                                @if ($item->gbr_album && file_exists(public_path('asset/img_album/' . $item->gbr_album)))
                                    <img src="{{ asset('asset/img_album/' . $item->gbr_album) }}"
                                        alt="{{ $item->jdl_album }}" class="album-image" loading="lazy"
                                        onerror="this.src='{{ asset('asset/img/no-image.jpg') }}'">
                                @else
                                    <img src="{{ asset('asset/img/no-image.jpg') }}" alt="No Image Available"
                                        class="album-image" loading="lazy">
                                @endif

                                <div class="album-overlay">
                                    <i class="fa fa-eye view-icon"></i>
                                </div>
                            </a>
                        </div>

                        <div class="album-content">
                            @php
                                $jumlahFoto = \App\Models\Gallery::where('id_album', $item->id_album)->count();
                            @endphp

                            <div class="photo-count">
                                <i class="fa fa-images me-1"></i>
                                {{ $jumlahFoto }} Foto
                            </div>

                            <a href="{{ route('foto.detail', ['seo' => $item->album_seo]) }}"
                                class="album-title text-decoration-none d-block">
                                {{ Str::limit($item->jdl_album, 30) }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fa fa-images fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum Ada Album</h4>
                        <p class="text-muted">Album foto belum tersedia saat ini.</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($foto->hasPages())
            <div class="row mt-4">
                <div class="col-lg-12 d-flex justify-content-center">
                    {{ $foto->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
    @push('styles')
        <style>
            .album-card {
                transition: all 0.3s ease;
                overflow: hidden;
            }

            .album-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
            }

            .album-image {
                width: 100%;
                height: 250px;
                object-fit: cover;
                transition: all 0.4s ease;
                border-radius: 8px;
            }

            .album-card:hover .album-image {
                transform: scale(1.05);
                filter: brightness(1.1);
            }

            .album-overlay {
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

            .album-card:hover .album-overlay {
                opacity: 1;
            }

            .album-content {
                transition: all 0.3s ease;
            }

            .album-card:hover .album-content {
                transform: translateY(-2px);
            }

            .view-icon {
                color: white;
                font-size: 2rem;
                transition: transform 0.2s ease;
            }

            .album-card:hover .view-icon {
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

            .album-title {
                color: #333;
                font-weight: 600;
                font-size: 1.1rem;
                transition: color 0.3s ease;
            }

            .album-card:hover .album-title {
                color: #2dcd7c;
            }
        </style>
    @endpush
@endsection
