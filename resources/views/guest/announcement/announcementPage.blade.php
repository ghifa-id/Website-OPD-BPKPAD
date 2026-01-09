@extends('guest.layouts.app')

@section('title', 'Bapedalitbang')

@section('content')

    <div class="container">
        <div class="row">

            <div class="container">
                <h1 class="mb-4">Semua Pengumuman</h1>
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="text-decoration-none text-success">
                                <i class="fa fa-home me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">
                            Seluruh Pengumuman
                        </li>
                    </ol>
                </nav>
                <a href="{{ route('guest.beranda') }}" class="btn btn-outline-success fw-bold mb-4">
                    ← Kembali ke Beranda
                </a>
                <div class="list-group shadow-sm mb-3">
                    {{-- Header --}}
                    <div class="list-group-item d-flex fw-bold bg-light">
                        <div class="text-center" style="width: 50px;">No</div>
                        <div style="flex: 1;">Judul</div>
                        <div class="text-center" style="width: 100px;">Download</div>
                        <div class="text-center" style="width: 120px;">Tanggal</div>
                    </div>

                    {{-- Daftar Pengumuman --}}
                    @forelse ($pengumuman as $index => $item)
                        <div class="list-group-item d-flex align-items-start">
                            {{-- No --}}
                            <div class="text-center pt-1" style="width: 50px;">{{ $index + 1 }}</div>

                            {{-- Judul --}}
                            <div style="flex: 1;">
                                <div class="fw-bold mb-1">
                                    @if ($item->file_pendukung)
                                        <a href="{{ asset('asset/files/' . $item->file_pendukung) }}" target="_blank"
                                            style="text-decoration: none; color: inherit;">
                                            {{ $item->judul }}
                                        </a>
                                    @else
                                        {{ $item->judul }}
                                    @endif
                                </div>
                            </div>

                            {{-- Tombol Download --}}
                            <div class="text-center pt-1" style="width: 100px;">
                                @if ($item->file_pendukung)
                                    <a href="{{ asset('asset/files/' . $item->file_pendukung) }}"
                                        class="btn btn-sm btn-primary py-1 px-2" style="font-size: 0.75rem;" download>
                                        Download
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>

                            {{-- Tanggal --}}
                            <div class="text-center pt-1" style="width: 120px;">
                                {{ \Carbon\Carbon::parse($item->tanggal_posting)->format('d M Y') }}
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item text-center text-muted">
                            Tidak ada pengumuman untuk saat ini.
                        </div>
                    @endforelse
                </div>


                <!-- Pagination -->
                <div class="row mt-4">
                    <div class="col-lg-12 d-flex justify-content-center">
                        {{ $pengumuman->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
