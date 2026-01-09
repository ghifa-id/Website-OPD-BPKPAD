@extends('guest.layouts.app')



@section('title', 'Bapedalitbang')



@section('content')

    <section class="blog-section blog-section-two">

        <div class="container text-center mt-0 mb-4 px-3">

            <h2 class="display-5 fw-bold text-dark mb-3" style="max-width: 600px; margin-left: auto; margin-right: auto;">

                Jelajahi Berita Terkini

            </h2>

            <p class="text-muted mx-auto" style="font-size: 1.1rem; max-width: 800px; line-height: 1.6;">

                Temukan berita terbaru yang lengkap dan terpercaya di satu tempat. Ikuti perkembangan terkini dari berbagai

                sumber untuk selalu update.

            </p>

        </div>

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

                            Seluruh Berita

                        </li>

                    </ol>

                </nav>

                @foreach ($berita as $item)

                    <div class="col-lg-4 col-md-6 mb-4 mt-5">

                        <div class="card shadow-sm h-100 border-0 rounded-3 overflow-hidden"

                            style="transition: transform 0.3s ease, box-shadow 0.3s ease;">



                            <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"

                                class="d-block overflow-hidden" style="height: 12rem;">

                                <img src="{{ asset('asset/foto_berita/' . $item->gambar) }}" alt="{{ $item->judul }}"

                                    class="card-img-top h-100 object-fit-cover" style="transition: transform 0.3s ease;"

                                    loading="lazy">

                            </a>



                            <div class="card-body d-flex flex-column">

                                <h5 class="card-title mb-2">

                                    {{ $item->judul }}

                                </h5>



                                <p class="text-muted small mb-2">

                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} {{ $item->jam }}

                                    &nbsp;|&nbsp;

                                    <i class="fa fa-eye" aria-hidden="true"></i> {{ $item->dibaca }} &nbsp;|&nbsp;

                                    <i class="fa fa-user" aria-hidden="true"></i>   {{ $item->user->nama_lengkap ?? $item->username }}


                                </p>



                                <p class="card-text text-muted mb-4 flex-grow-1"

                                    style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">

                                    {{ Str::limit(strip_tags($item->isi_berita), 150) }}

                                </p>



                                <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"

                                    class="mt-auto text-success fw-semibold text-decoration-none d-flex align-items-center">

                                    Baca Berita

                                    <i class="fas fa-arrow-right ms-1"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <a href="{{ route('guest.beranda') }}" class="btn btn-outline-success fw-bold mb-4">

                ← Kembali ke Beranda

            </a>



            <!-- Pagination -->

            <div class="row mt-4">

                <div class="col-lg-12 d-flex justify-content-center">

                    {{ $berita->links('pagination::bootstrap-5') }}

                </div>

            </div>

        </div>

    </section>

@endsection

@push('styles')

    <style>

        .object-fit-cover {

            object-fit: cover;

        }



        .card:hover {

            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);

            transform: translateY(-5px);

            transition: transform 0.3s ease, box-shadow 0.3s ease;

        }



        .card-img-top:hover {

            transform: scale(1.05);

            transition: transform 0.3s ease;

        }



        .blog-section.blog-section-two {

            margin-top: 3rem !important;

            padding-top: 0 !important;

        }

    </style>

@endpush

