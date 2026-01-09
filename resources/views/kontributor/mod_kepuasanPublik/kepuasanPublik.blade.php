@extends('kontributor.layouts.app')

@section('title', 'Kepuasan Publik')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 fw-bold text-success mb-0">Kepuasan Publik</h1>
            <button class="btn btn-outline-secondary btn-sm" onclick="location.reload()">
                <i class="fas fa-sync-alt me-1"></i> Muat Ulang
            </button>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold text-muted">
                    <i class="fas fa-smile-beam text-success me-2"></i>
                    Daftar Penilaian Layanan
                </h6>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Nama</th>
                                <th>Skor</th>
                                <th>Komentar</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $penilaian = [
                                    1 => ['icon' => '😡', 'label' => 'Sangat Tidak Puas'],
                                    2 => ['icon' => '😞', 'label' => 'Tidak Puas'],
                                    3 => ['icon' => '😐', 'label' => 'Cukup'],
                                    4 => ['icon' => '🙂', 'label' => 'Puas'],
                                    5 => ['icon' => '😍', 'label' => 'Sangat Puas'],
                                ];
                            @endphp

                            @forelse ($dataKepuasan as $i => $data)
                                <tr>
                                    <td class="text-center text-muted">{{ $i + 1 }}</td>
                                    <td class="fw-semibold">{{ $data->nama }}</td>
                                    <td class="text-center fs-5">
                                        @php
                                            $skor = $penilaian[$data->skor] ?? [
                                                'icon' => '❓',
                                                'label' => 'Tidak Diketahui',
                                            ];
                                        @endphp
                                        <div>{{ $skor['icon'] }}</div>
                                        <small class="text-muted">{{ $skor['label'] }}</small>
                                    </td>
                                    <td style="max-width: 300px; white-space: normal;">
                                        {{ $data->komentar ?? '-' }}
                                    </td>
                                    <td class="text-center text-muted">
                                        {{ $data->created_at->format('d M Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                        Belum ada data penilaian masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($dataKepuasan->hasPages())
                    <div class="d-flex justify-content-center py-3">
                        {{ $dataKepuasan->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
