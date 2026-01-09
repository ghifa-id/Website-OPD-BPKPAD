@extends('guest.layouts.app')

@section('title', $jeniss)

@section('content')
    @php
        $jeniss = '~ Dokumen Belum di Unggah';
        switch ($record->jenis) {
            case '1':
                $jeniss = 'Rencana Pembangunan Jangka Panjang Daerah';
                break;
            case '2':
                $jeniss = 'Rencana Tata Ruang Wilayah';
                break;
            case '3':
                $jeniss = 'Rencana Pembangunan Jangka Menengah Daerah';
                break;
            case '4':
                $jeniss = 'Rencana Penanggulangan Kemiskinan Daerah';
                break;
            case '5':
                $jeniss = 'Roadmap Pembangunan Ekonomi';
                break;
            case '6':
                $jeniss = 'Rencana Strategis';
                break;
            case '7':
                $jeniss = 'Rencana Kerja Pemerintah Daerah';
                break;
            case '8':
                $jeniss = 'Musyawarah Perencanaan Pembangunan';
                break;
            case '9':
                $jeniss = 'Rencana Kerja';
                break;
            case '10':
                $jeniss = 'Perjanjian Kinerja';
                break;
            case '11':
                $jeniss = 'Rencana Kerja Tahunan';
                break;
            case '12':
                $jeniss = 'KUA dan PPAS';
                break;
            case '13':
                $jeniss = 'Rencana Kebijakan Anggaran';
                break;
            case '14':
                $jeniss = 'Evaluasi RPJMD';
                break;
            case '15':
                $jeniss = 'Evaluasi RKPD';
                break;
            case '16':
                $jeniss = 'Evaluasi Renja';
                break;
            case '17':
                $jeniss = 'Evaluasi Pelaksanaan DAK';
                break;
            case '18':
                $jeniss = 'Serapan Anggaran';
                break;
            case '19':
                $jeniss = 'Penelitian';
                break;
            case '20':
                $jeniss = 'Inovasi';
                break;
            case '21':
                $jeniss = 'Monev';
                break;
            case '22':
                $jeniss = 'Indeks Daya Saing Daerah (IDSD)';
                break;
            case '23':
                $jeniss = 'Kajian - Peraturan Daerah';
                break;
            case '24':
                $jeniss = 'Kajian - Peraturan Bupati';
                break;
            case '25':
                $jeniss = 'Kajian - Peraturan Kepala Badan';
                break;
        }
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
                /* Bootstrap Primary atau sesuaikan */
                text-decoration: underline;
            }

            /* Optional: ganti panah default Bootstrap */
            .breadcrumb-item+.breadcrumb-item::before {
                content: "\f105";
                /* FontAwesome right arrow */
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                color: #6c757d;
                /* grey-ish */
                margin-right: 0.4rem;
                margin-left: 0.4rem;
            }
        </style>




        <div class="row">
            <div class="col-lg-12">
                <div class="content-box-glass p-4 rounded">
                    <h1 class="font-w700 text-white mb-4">
                        Dokumen Perencanaan dan Litbang
                    </h1>
                    <div class="content">

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
                                                        width="100%" height="800px"
                                                        style="border:1px solid #ccc;"></iframe>

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
                    </div> <!-- /.content -->
                </div> <!-- /.content-box-glass -->
            </div>
        </div>
    </div>
@endsection
