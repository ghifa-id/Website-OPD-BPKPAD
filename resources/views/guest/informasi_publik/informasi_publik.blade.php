@extends('guest.layouts.app')

@section('title', $jenis ?? 'Informasi Publik')

@section('content')
    @php
        $jenisNama = 'Informasi Publik';
        if ($record->isNotEmpty()) {
            $first = $record->first();
            $jenisMap = [
                1 => 'Informasi Berkala',
                2 => 'Informasi Setiap Saat',
                3 => 'Informasi Serta Merta',
                4 => 'Informasi Dikecualikan',
            ];
            $jenisNama = $jenisMap[$first->id_kat] ?? 'Informasi Publik';
        }
    @endphp

    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">{{ $jenisNama }}</h1>

                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="text-decoration-none text-success">
                                <i class="fa fa-home me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">
                            {{ $jenisNama }}
                        </li>
                    </ol>
                </nav>

                <a href="{{ route('guest.beranda') }}" class="btn btn-outline-success fw-bold mb-4">
                    ? Kembali ke Beranda
                </a>

                <div class="list-group shadow-sm mb-3">
                    <!-- Header -->
                    <div class="list-group-item d-flex fw-bold bg-light">
                        <div class="text-center" style="width: 50px;">No</div>
                        <div style="flex: 1;">Judul</div>
                        <div class="text-center" style="width: 100px;">Tahun</div>
                        <div class="text-center" style="width: 80px;">Hits</div>
                        <div class="text-center" style="width: 120px;">Download</div>
                    </div>

                    <!-- Daftar Informasi -->
                    @forelse ($record as $index => $row)
                        <div class="list-group-item d-flex align-items-start">
                            <div class="text-center pt-1" style="width: 50px;">
                                {{ $record->firstItem() + $index }}
                            </div>

                            <div style="flex: 1;">
                                <div class="fw-bold mb-1">
                                    {{ $row->judul }}
                                </div>
                            </div>

                            <div class="text-center pt-1" style="width: 100px;">{{ $row->tahun }}</div>

                            <div class="text-center pt-1" style="width: 80px;">{{ $row->hit }}</div>

                            <div class="text-center pt-1" style="width: 120px;">
                                <a href="http://ppid.pesisirselatankab.go.id/home/pemohon/{{ $row->id }}"
                                    target="_blank"
                                    class="btn btn-sm btn-primary py-1 px-2"
                                    style="font-size: 0.75rem;">
                                    Download
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item text-center text-muted">
                            Belum ada informasi publik untuk kategori ini.
                        </div>
                    @endforelse
                </div>

                @if ($record->hasPages())
                    <div class="row mt-4">
                        <div class="col-lg-12 d-flex justify-content-center">
                            {{ $record->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif

                <p class="mt-3 text-muted"><i>* Informasi ini akan diperbaharui secara berkala</i></p>
            </div>
        </div>
    </div>
@endsection
