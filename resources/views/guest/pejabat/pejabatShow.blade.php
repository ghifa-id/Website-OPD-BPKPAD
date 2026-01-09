@extends('guest.layouts.app')

@section('title', 'Bapedalitbang')

@section('content')
    <section class="team-details-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-15">
                    <div class="content-box-glass p-4 rounded">
                        {{-- Baris Utama: Foto dan Biodata --}}
                        <div class="row g-4">
                            {{-- KIRI: Foto --}}
                            <div class="col-12 col-lg-6">
                                <div class="team-details-image">
                                    <img src="{{ asset('asset/foto_pejabat/' . $pejabat->foto) }}" alt=""
                                        class="img-fluid team-image rounded">
                                </div>
                            </div>

                            {{-- KANAN: Nama, Jabatan, Biodata --}}
                            <div class="col-12 col-lg-6">
                                <div class="team-details-title-one h-100 d-flex flex-column justify-content-center">
                                    <div class="pejabat-identitas mb-4">
                                        <h2 class="fw-bold">{{ $pejabat->nama_pejabat }}</h2>
                                        <h5 class="text-muted">{{ $pejabat->jabatan->nama_jabatan ?? '-' }}</h5>
                                    </div>

                                    @if (!empty(trim($riwayatWithoutTables)))
                                        <div class="pejabat-biodata mb-4">
                                            @foreach (explode("\n", trim($riwayatWithoutTables)) as $line)
                                                @php
                                                    [$label, $value] = explode(':', $line, 2) + [null, null];
                                                @endphp
                                                @if ($label && $value)
                                                    <div class="biodata-line">
                                                        <div class="label-col">{{ trim($label) }}</div>
                                                        <div class="separator">:</div>
                                                        <div class="value-col">{{ trim($value) }}</div>
                                                    </div>
                                                @else
                                                    <div class="biodata-line">{{ trim($line) }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Table 1 --}}
                        @if (!empty($table1))
                            <div class="pejabat-riwayat mt-4 mb-4">
                                {!! $table1 !!}
                            </div>
                        @endif

                        {{-- Table 2 --}}
                        @if (!empty($table2))
                            <div class="pejabat-riwayat mt-4">
                                {!! $table2 !!}
                            </div>
                        @endif

                        <a href="{{ route('showPejabatAll') }}" class="btn btn-outline-success fw-bold mt-4">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Pejabat
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .team-details-image {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .team-image {
            width: 100%;
            max-height: 500px;
            height: auto;
            object-fit: cover;
            object-position: top;
            border-radius: 8px;
        }

        .team-details-title-one {
            height: 100%;
        }

        /* === BIODATA === */
        .pejabat-biodata .biodata-line {
            display: flex;
            align-items: flex-start;
            font-size: 1.05rem;
            margin-bottom: 6px;
            line-height: 1.6;
        }

        .biodata-line .label-col {
            width: 200px;
            font-weight: 600;
            text-align: left;
            white-space: nowrap;
        }

        .biodata-line .separator {
            width: 10px;
            text-align: center;
            font-weight: 600;
        }

        .biodata-line .value-col {
            flex: 1;
            word-break: break-word;
            text-align: left;
        }

        /* === TABEL RIWAYAT === */
        .pejabat-riwayat table {
            width: 100% !important;
            border-collapse: collapse;
            overflow-x: auto;
        }

        .pejabat-riwayat th,
        .pejabat-riwayat td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .pejabat-riwayat th {
            background-color: #f8f9fa;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .pejabat-biodata .biodata-line {
                font-size: 0.9rem;
            }

            .biodata-line .label-col {
                width: 140px;
            }

            .team-image {
                max-height: 350px;
            }
        }
    </style>
@endpush
