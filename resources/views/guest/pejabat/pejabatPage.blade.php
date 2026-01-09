@extends('guest.layouts.app')

@section('title', 'BPKPAD')

@section('content')

    <section class="service-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-15">
                    <div class="content-box-glass p-4 rounded">
                        <div class="col-lg-15">
                            <div class="col-lg-12">
                                <div class="content-box">
                                    <div class="content">
                                        <a href="{{ route('guest.beranda') }}" class="btn btn-outline-success fw-bold mb-4">
                                            ← Kembali ke Beranda
                                        </a>
                                        <div class="text-center mb-4">
                                            <h2 class="display-5 fw-bold text-dark">
                                                Pejabat <span style="color: #2dcd7c !important;">BPKPAD</span>
                                            </h2>
                                            <p class="text-muted mt-2" style="font-size: 1.1rem;">
                                                Informasi pejabat struktural BPKPAD.
                                            </p>
                                        </div>

                                        <div class="mb-4 mt-5">
                                            <h4 class="fw-bold text-success pb-2 mb-4">
                                                <a href="#" class="text-decoration-none"
                                                    style="color: #2dcd7c; display: inline-block; border-bottom: 3px solid #2dcd7c; padding-bottom: 6px;">
                                                    Kepala BPKPAD
                                                </a>
                                            </h4>
                                            <div class="d-flex justify-content-center">
                                                <div class="card shadow-lg border-0 rounded-4 w-100"
                                                    style="max-width: 48rem;" data-aos="fade-up">
                                                    <div class="card-body p-4">
                                                        <div class="row align-items-center">
                                                            <div
                                                                class="col-md-4 text-center position-relative mb-4 mb-md-0">
                                                                <div class="position-relative d-inline-block">
                                                                    <div class="overflow-hidden  border-3 border-dark shadow-lg"
                                                                        style="width: 192px; height: 192px;">
                                                                        <img src="{{ asset('asset/foto_pejabat/' . $kepala->foto) }}"
                                                                            alt="" loading="lazy">
                                                                    </div>
                                                                    <div
                                                                        class="position-absolute start-50 translate-middle-x bottom-0">
                                                                        <span
                                                                            class="badge bg-success px-3 py-2 rounded-pill shadow-sm">
                                                                            Kepala BPKPAD
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 text-center">
                                                                <h3 class="fw-bold mb-2">{{ $kepala->nama_pejabat }}</h3>
                                                                <span class="text-secondary d-block mb-4"
                                                                    style="font-size: 1.1rem;">
                                                                    {{ $kepala->jabatan->nama_jabatan ?? '' }}
                                                                </span>

                                                                <div class="d-flex flex-column align-items-center gap-3">
                                                                    <div class="d-flex align-items-center gap-2 text-muted"
                                                                        style="font-size: 0.95rem;">
                                                                        <i class="bi bi-person text-success fs-5"></i>
                                                                        <span>Pejabat Struktural Eselon II</span>
                                                                    </div>
                                                                    <a href="{{ route('pejabat.detail', $kepala->slug) }}"
                                                                        class="btn btn-success d-inline-flex align-items-center gap-2 px-4 py-2 rounded-3 fw-semibold"
                                                                        style="font-size: 0.9rem;">
                                                                        <span>Lihat Profil Lengkap</span>
                                                                        <i class="bi bi-chevron-right fs-5"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4 mt-5">
                                            <h4 class="fw-bold text-success pb-2 mb-4">
                                                <a href="#" class="text-decoration-none"
                                                    style="color: #2dcd7c; display: inline-block; border-bottom: 3px solid #2dcd7c; padding-bottom: 6px;">
                                                    Sekretaris dan Kepala Bidang
                                                </a>
                                            </h4>

                                            <div class="pejabat-grid">
                                                @foreach ($sekretarisDanKepalaBidang as $pejabat)
                                                    <div class="card shadow-lg border-0 rounded-4 d-flex flex-column"
                                                        style="height: 100%;" data-aos="fade-up">
                                                        <div class="position-relative overflow-hidden   border-3 border-dark shadow-lg mx-auto mt-3"
                                                            style="width: 120px; height: 120px;">
                                                            <img src="{{ asset('asset/foto_pejabat/' . $pejabat->foto) }}"
                                                                alt=""
                                                                class="img-fluid w-100 h-100 object-fit-cover" />
                                                        </div>
                                                        <div
                                                            class="card-body text-center p-3 d-flex flex-column justify-content-between flex-grow-1">
                                                            <div>
                                                                <h5 class="fw-bold mb-1" style="font-size: 1.1rem;">
                                                                    {{ $pejabat->nama_pejabat }}
                                                                </h5>
                                                                <p class="text-muted mb-2" style="font-size: 0.85rem;">
                                                                    {{ $pejabat->jabatan->nama_jabatan ?? '-' }}
                                                                </p>
                                                            </div>
                                                            <a href="{{ route('pejabat.detail', $pejabat->slug) }}"
                                                                class="btn btn-success d-flex justify-content-center align-items-center gap-1 px-3 py-1 rounded-2"
                                                                style="font-size: 0.75rem; min-width: 120px;">
                                                                <span>Lihat Profil</span>
                                                                <i class="bi bi-chevron-right"
                                                                    style="font-size: 0.8rem;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="mb-4 mt-5">
                                        <h4 class="fw-bold text-success pb-2 mb-4">
                                            <a href="#" class="text-decoration-none"
                                                style="color: #2dcd7c; display: inline-block; border-bottom: 3px solid #2dcd7c; padding-bottom: 6px;">
                                                Kepala Sub Bagian
                                            </a>
                                        </h4>
                                        
                                        <div class="pejabat-grid">
                                            @foreach ($KepalaSubBagian as $pejabat)
                                                <div class="card shadow-lg border-0 rounded-4 d-flex flex-column"
                                                    style="height: 100%;" data-aos="fade-up">
                                                    <div class="position-relative overflow-hidden border-3 border-dark shadow-lg mx-auto mt-3"
                                                        style="width: 120px; height: 120px;">
                                                        <img src="{{ asset('asset/foto_pejabat/' . $pejabat->foto) }}"
                                                            alt="{{ $pejabat->nama_pejabat }}"
                                                            class="img-fluid w-100 h-100 object-fit-cover" />
                                                    </div>
                                                    <div class="card-body text-center p-3 d-flex flex-column justify-content-between flex-grow-1">
                                                        <div>
                                                            <h5 class="fw-bold mb-1" style="font-size: 1.1rem;">
                                                                {{ $pejabat->nama_pejabat }}
                                                            </h5>
                                                            <p class="text-muted mb-2" style="font-size: 0.85rem;">
                                                                {{ $pejabat->jabatan->nama_jabatan ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <a href="{{ route('pejabat.detail', $pejabat->slug) }}"
                                                            class="btn btn-success d-flex justify-content-center align-items-center gap-1 px-3 py-1 rounded-2"
                                                            style="font-size: 0.75rem; min-width: 120px;">
                                                            <span>Lihat Profil</span>
                                                            <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div><!-- /.container -->
    </section><!-- /.service-details-section -->
@endsection
@push('styles')
    <style>
        .pejabat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            /* responsive */
            gap: 1rem;
            justify-items: center;
        }

        @media (min-width: 1200px) {
            .pejabat-grid {
                grid-template-columns: repeat(5, 1fr);
                /* 5 kolom di desktop */
            }
        }
    </style>
@endpush
