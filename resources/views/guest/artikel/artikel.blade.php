@extends('guest.layouts.app')

@section('title', 'Bapedalitbang')

@section('content')
    <div class="container my-5">

        <h2 class="mb-4 section-title">Semua <span style="color: #2dcd7c; font-weight: 700;">Artikel</span></h2>
        <div class="row g-4">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-decoration-none text-success">
                            <i class="fa fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">
                        Seluruh Artikel
                    </li>
                </ol>
            </nav>
            @forelse ($artikel as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div
                            style="height: 200px; overflow: hidden; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                            <img src="{{ asset('asset/foto_berita/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                class="card-img-top w-100 h-100 object-fit-cover" loading="lazy">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold" style="font-size: 1.1rem;">
                                <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"
                                    class="text-decoration-none text-dark">
                                    {{ $item->judul }}
                                </a>
                            </h5>
                            <p class="card-text text-muted mt-auto">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->isi_berita), 100) }}
                            </p>
                            <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"
                                class="btn btn-sm btn-outline-success mt-2 align-self-start">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada artikel yang tersedia.
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-center">
                {{ $artikel->links('pagination::bootstrap-5') }}
            </div>
        </div>
        <a href="{{ route('guest.beranda') }}" class="btn btn-outline-success fw-bold mb-4">
            ← Kembali ke Beranda
        </a>
    </div>
@endsection
