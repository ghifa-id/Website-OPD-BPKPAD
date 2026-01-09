@extends('guest.layouts.app')

@section('title', $jeniss)

@section('content')
    @php
        $jenisMap = [
            '1' => 'SK PPID',
            '2' => 'Struktur PPID',
            '3' => 'Tugas & Fungsi PPID',
            '4' => 'Pedoman Pelayanan Informasi Publik',
            '5' => 'Form Permohonan Informasi',
            '6' => 'Form Pengajuan Keberatan',
            '7' => 'Maklumat Pelayanan',
            '8' => 'SOP Permohonan Informasi Publik',
            '9' => 'SOP Penanganan Keberatan Informasi Publik',
            '10' => 'Tata Cara Pengaduan',
            '11' => 'SK DIP',
            '99' => 'Informasi Dikecualikan',
        ];
        $jeniss = $jenisMap[$record->jenis] ?? '~ Jenis Tidak Dikenal';
    @endphp

    <div class="container my-5">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 align-items-center">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-success fw-semibold d-flex align-items-center hover-breadcrumb">
                        <i class="fa fa-home me-1"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">
                    {{ $jeniss }}
                </li>
            </ol>
        </nav>

        <style>
            .hover-breadcrumb {
                transition: color 0.2s ease-in-out;
                cursor: pointer;
            }

            .hover-breadcrumb:hover {
                color: #0a58ca !important;
                text-decoration: underline;
            }

            .breadcrumb-item+.breadcrumb-item::before {
                content: "\f105";
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                color: #6c757d;
                margin-right: 0.4rem;
                margin-left: 0.4rem;
            }
        </style>

        <div class="row">
            <div class="col-lg-12">
                <div class="content-box-glass p-4 rounded">
                    <h1 class="font-w700 text-white mb-4">
                        Dokumen PPID
                    </h1>

                    <div class="block mt-4">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">{{ $jeniss }}</h3>
                        </div>

                        <div class="block-content">
                            <div class="row items-push">
                                <div class="col-md-12">
                                    <p>
                                        Jika dibutuhkan, silakan Anda <strong>Lihat</strong> atau
                                        <strong>Download</strong> dokumen di bawah ini. Terima kasih.
                                    </p>

                                    @if ($record->nama_file)
                                        <a href="{{ asset('asset/files/' . $record->nama_file) }}" target="_blank"
                                            class="btn btn-primary mb-3">
                                            >> Download File << </a>

                                                <iframe src="{{ asset('asset/files/' . $record->nama_file) }}"
                                                    width="100%" height="800px" style="border:1px solid #ccc;"></iframe>

                                                <div class="mt-3 text-muted">
                                                    <i>* Informasi ini akan diperbaharui secara berkala</i>
                                                </div>
                                            @else
                                                <div class="alert alert-warning mt-3">
                                                    Dokumen belum diunggah.
                                                </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.block -->
                </div> <!-- /.content-box-glass -->
            </div>
        </div>
    </div>
@endsection
