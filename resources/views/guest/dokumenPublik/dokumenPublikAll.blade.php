@extends('guest.layouts.app')

@section('title', 'Seluruh Dokumen Publik')

@section('content')
    <section class="blog-section blog-section-two">
        <div class="container text-center mt-0 mb-4 px-3">
           <h2 class="display-5 fw-bold text-dark mb-3">
  Jelajahi <span class="text-success">Dokumen Publik</span>
</h2>
            <p class="text-muted mx-auto" style="font-size: 1.1rem; max-width: 800px; line-height: 1.6;">
                Temukan dokumen resmi dan publikasi strategis yang relevan dengan kebijakan dan pembangunan daerah.
            </p>
        </div>

        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-decoration-none text-success">
                            <i class="fa fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Seluruh Dokumen</li>
                </ol>
            </nav>

            <div class="row g-4">
                <div class="mt-4">
                    <a href="{{ route('guest.beranda') }}" class="btn btn-outline-success fw-bold">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>


                @forelse ($dokumenPublik as $dok)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="pdf-card d-flex flex-column justify-content-between text-center p-3 h-100">

                            {{-- Gambar Cover Potret atau Ikon PDF --}}
                            <div class="cover-wrapper mb-3">
                                @if ($dok->cover_file && file_exists(public_path('asset/img_dokumen/' . $dok->cover_file)))
                                    <img src="{{ asset('asset/img_dokumen/' . $dok->cover_file) }}" alt="Cover Dokumen"
                                        class="img-fluid cover-image mx-auto" loading="lazy">
                                @else
                                    <img src="https://www.jabarprov.go.id/icons/document/pdf.svg" alt="PDF Icon"
                                        class="img-fluid pdf-icon mx-auto" loading="lazy">
                                @endif
                            </div>

                            {{-- Judul & Tahun --}}
                            <div class="dokumen-info flex-grow-1 d-flex flex-column justify-content-start">
                                <h6 class="fw-semibold card-title mb-1" style="min-height: 2.5rem;">
                                    {{ get_jenis_dokumen_singkat($dok->jenis) }}
                                </h6>
                                <small class="text-muted d-block mb-1">
                                    {{ get_jenis_label($dok->jenis) }}
                                </small>
                                <small class="text-secondary" style="font-size: 0.85rem;">
                                    Tahun: {{ $dok->tahun_dokumen }}
                                </small>
                            </div>

                            {{-- Tombol --}}
                            <div class="btn-group-dokumen mt-3">
                                <a href="{{ asset('asset/files/' . $dok->nama_file) }}"
                                    class="btn btn-outline-primary btn-lihat-semua" download>
                                    <i class="fas fa-cloud-arrow-down me-1"></i> Unduh
                                </a>
                                <a href="{{ asset('asset/files/' . $dok->nama_file) }}"
                                    class="btn btn-outline-secondary btn-lihat-semua" target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada dokumen publik tersedia.</p>
                @endforelse


            </div>

            <div class="row mt-5">
                <div class="col-lg-12 d-flex justify-content-center">
                    {{ $dokumenPublik->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
.blog-section {
    padding-top: 3rem !important;
    margin-top: 3rem !important;
}

        .pdf-card {
            background-color: #fff;
            border-radius: 16px;
            border: 1px solid #eaeaea;
            padding: 1.5rem 1rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        .pdf-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }

        .cover-wrapper {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cover-image {
            height: 100%;
            width: auto;
            max-width: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .pdf-icon {
            width: 70px;
            height: 90px;
            object-fit: contain;
        }

        .btn-group-dokumen {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-lihat-semua {
            font-size: 0.85rem;
            padding: 0.45rem 1rem;
            border-radius: 10px;
        }

        .card-title {
            font-weight: 600;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .cover-wrapper {
                height: 240px;
            }
        }
    </style>
@endpush
