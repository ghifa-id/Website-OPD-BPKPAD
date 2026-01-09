@extends('guest.layouts.app')

@section('title', 'Bapedalitbang')

@section('content')

    <section class="service-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="content-box-glass p-4 rounded">
                        {{-- Penghargaan --}}

                        @if ($page)
                            <div class="service-details-content-box mb-4">

                                <h3 class="service-details-title">{{ $page->judul }}</h3>
                                <div class="mb-3 text-muted" style="font-size: 0.9em;">
                                    <i class="fa fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($page->tgl_posting)->format('d M Y') }}
                                    <i class="fa fa-clock ms-3"></i>
                                    {{ $page->jam }} WIB
                                    <i class="fa fa-eye ms-3"></i>
                                    {{ $page->dibaca }}x dibaca
                                </div>

                                <div>{!! $page->isi !!}</div>
                            </div>
                        @else
                            <p>Konten halaman tidak ditemukan.</p>
                        @endif
                        {{-- End Judul --}}


                    </div>
                </div>



                {{-- Side Penghargaan --}}
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="custom-card-glass">
                        <div class="card-body">
                            <div class="d-flex justify-content-center gap-5 mb-1 mt-2">
                                <h3 class="service-details-title">Penghargaan Lainnya</h3>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Side Penghargaan --}}
            </div>
        </div><!-- /.container -->

    </section><!-- /.service-details-section -->

@endsection
