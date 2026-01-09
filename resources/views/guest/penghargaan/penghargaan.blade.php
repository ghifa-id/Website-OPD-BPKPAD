@extends('guest.layouts.app')

@section('title', 'Bapedalitbang')

@section('content')
    <section class="service-details-section">
        <div class="container">
            <div class="row">

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb bg-transparent p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}" class="text-decoration-none text-success">
                                        <i class="fa fa-home me-1"></i> Beranda
                                    </a>
                                </li>
                                <li class="breadcrumb-item active text-dark" aria-current="page">
                                    Penghargaan
                                </li>
                            </ol>
                        </nav>
                    </ol>
                </nav>

                {{-- Konten utama --}}
                <div class="col-lg-8">
                    <div class="content-box-glass p-4 rounded">
                        <h2 class="fw-bold mb-4 border-bottom pb-2">Penghargaan</h2>
                        <a href="{{ route('guest.beranda') }}" class="btn btn-outline-success fw-bold mb-4">
                            ← Kembali ke Beranda
                        </a>
                        @foreach ($penghargaan as $item)
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title fw-bold">{{ $item->judul }}</h4>

                                    <div class="mb-3 text-muted" style="font-size: 0.9rem;">
                                        <i class="fa fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($item->tgl_posting)->translatedFormat('d M Y') }}

                                        <i class="fa fa-clock ms-3"></i>
                                        {{ $item->jam ? \Carbon\Carbon::parse($item->jam)->format('H:i') : '-' }} WIB

                                        <i class="fa fa-eye ms-3"></i>
                                        {{ $item->dibaca ?? 0 }}x dibaca
                                    </div>
                                    @if ($item->gambar)
                                        <div class="mb-3">
                                            <img src="{{ asset('asset/penghargaan/' . $item->gambar) }}"
                                                class="img-fluid rounded" alt="Gambar Penghargaan">
                                        </div>
                                    @endif
                                    <p><strong>Pemberi:</strong> {{ $item->pemberi }}</p>
                                    <p><strong>Tahun:</strong> {{ $item->tahun }}</p>
                                    <p><strong>Tingkat:</strong> {{ $item->tingkat }}</p>
                                    <p> {{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        @endforeach

                        {{-- Pagination --}}
                        <div class="row mt-4">
                            <div class="col-lg-12 d-flex justify-content-center">
                                {{ $penghargaan->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Sidebar Penghargaan Lainnya --}}
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="custom-card-glass">
                        <div class="card-body">
                            <div class="d-flex justify-content-center gap-3 mb-3 mt-2">
                                <h4 class="fw-semibold text-center">Penghargaan Lainnya</h4>
                            </div>

                            @if ($secPenghargaan->count())
                                <div class="row g-3">
                                    @foreach ($secPenghargaan as $item)
                                        <div class="col-12">
                                            <div class="border rounded shadow-sm p-3 h-100 bg-white">
                                                <h6 class="mb-1">
                                                    <a href="{{ url('page/detail/' . $item->judul_seo) }}"
                                                        class="text-dark text-decoration-none">
                                                        {{ $item->judul }}
                                                    </a>
                                                </h6>
                                                <small class="text-muted">{{ $item->tahun }} •
                                                    {{ $item->tingkat }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted text-center">Tidak ada penghargaan lainnya.</p>
                            @endif
                        </div>
                    </div>
                </div>


            </div>

        </div>
        </div>
    </section>
@endsection
