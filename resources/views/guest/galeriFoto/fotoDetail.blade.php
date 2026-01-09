@extends('guest.layouts.app')

@section('title', $album->jdl_album)

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-14">
                <div class="content-box-glass p-4 rounded">
                    <h3 class="mb-3">{{ $album->jdl_album }}</h3>

                    <div class="mb-3 text-muted" style="font-size: 0.9em;">
                        <i class="fa fa-calendar"></i>
                        {{ \Carbon\Carbon::parse($album->tgl_posting)->format('d M Y') }}
                        <i class="fa fa-image ms-3"></i>
                        {{ $galeri->count() }} Foto
                    </div>

                    @if ($album->gbr_album)
                        <div class="mb-3 text-center">
                            <img src="{{ asset('asset/img_album/' . $album->gbr_album) }}" alt="{{ $album->jdl_album }}"
                                class="img-fluid rounded" style="max-height: 400px; object-fit: cover;" loading="lazy">

                        </div>
                    @endif

                    <div class="mb-4">
                        {!! $album->deskripsi ?? '<p>Tidak ada deskripsi untuk album ini.</p>' !!}
                    </div>

                    <h5 class="mb-3">Foto dalam Album:</h5>
                    <div class="row">
                        @forelse($galeri as $foto)
                            <div class="col-md-4 col-sm-6 mb-3">
                                <a href="{{ asset('asset/img_galeri/' . $foto->gbr_galeri) }}" target="_blank">
                                    <img src="{{ asset('asset/img_galeri/' . $foto->gbr_galeri) }}"
                                        alt="{{ $foto->gbr_galeri }}" class="card-img-top h-100 object-fit-cover"
                                        style="transition: transform 0.3s ease;" loading="lazy">
                                </a>
                            </div>
                        @empty
                            <p>Tidak ada foto dalam album ini.</p>
                        @endforelse
                    </div>

                    <a href="{{ url('/albums') }}" class="btn btn-outline-secondary mt-4"><i class="fa fa-arrow-left"></i>
                        Kembali ke Semua Album</a>
                </div>
            </div>
        </div>
    </div>
@endsection
