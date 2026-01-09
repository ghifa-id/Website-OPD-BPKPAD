@extends('admin.layouts.app')

@section('title', 'BPKPAD')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-bold">Semua Dokumen Perenlitbang</h1>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary btn-sm" onclick="refreshTable()">
                    <i class="fas fa-sync-alt me-1"></i> Refresh
                </button>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="mb-0 fw-semibold text-gray-700">
                            <i class="fas fa-images text-success me-2"></i>
                            Daftar Dokperenlitbang
                        </h6>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('tambah_dokperenlitbang') }}" class="btn btn-success btn-sm px-3">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Dokperenlitbang
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="albumTable">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">
                                    <small class="text-muted fw-semibold">No</small>
                                </th>
                                <th style="min-width: 250px;">
                                    <small class="text-muted fw-semibold">Nama Dokumen</small>
                                </th>
                                <th style="width: 100px;">
                                    <small class="text-muted fw-semibold">Cover</small>
                                </th>
                                <th style="width: 100px;">
                                    <small class="text-muted fw-semibold">Tahun</small>
                                </th>
                                <th style="width: 100px;">
                                    <small class="text-muted fw-semibold">Link</small>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <small class="text-muted fw-semibold">Tanggal Publish</small>
                                </th>
                                <th class="text-center" style="width: 120px;">
                                    <small class="text-muted fw-semibold">Aksi</small>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $jenisList = [
                                    '1' => 'Rencana Pembangunan Jangka Panjang Daerah',
                                    '2' => 'Rencana Tata Ruang Wilayah',
                                    '3' => 'Rencana Pembangunan Jangka Menengah Daerah',
                                    '4' => 'Rencana Penanggulangan Kemiskinan Daerah',
                                    '5' => 'Roadmap Pembangunan Ekonomi',
                                    '6' => 'Rencana Strategis',
                                    '7' => 'Rencana Kerja Pemerintah Daerah',
                                    '8' => 'Musyawarah Perencanaan Pembangunan',
                                    '9' => 'Rencana Kerja',
                                    '10' => 'Perjanjian Kinerja',
                                    '11' => 'Rencana Kerja Tahunan',
                                    '12' => 'KUA dan PPAS',
                                    '13' => 'Rencana Kebijakan Anggaran',
                                    '14' => 'Evaluasi RPJMD',
                                    '15' => 'Evaluasi RKPD',
                                    '16' => 'Evaluasi Renja',
                                    '17' => 'Evaluasi Pelaksanaan DAK',
                                    '18' => 'Serapan Anggaran',
                                    '19' => 'Penelitian',
                                    '20' => 'Inovasi',
                                    '21' => 'Monev',
                                    '22' => 'Indeks Daya Saing Daerah (IDSD)',
                                    '23' => 'Kajian - Peraturan Daerah',
                                    '24' => 'Kajian - Peraturan Bupati',
                                    '25' => 'Kajian - Peraturan Kepala Badan',
                                ];
                            @endphp
                            @forelse ($dokperenlitbang as $index => $row)
                                <tr class="album-row" data-status="{{ $row->aktif }}"
                                    data-title="{{ strtolower($row->judul) }}">
                                    <td class="text-center">
                                        <small class="text-muted">{{ $index + 1 }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark"
                                            style="white-space: normal; word-wrap: break-word; line-height: 1.4;">
                                            {{ $jenisList[$row->jenis] ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($row->cover_file && file_exists(public_path('asset/img_dokumen/' . $row->cover_file)))
                                            <img src="{{ asset('asset/img_dokumen/' . $row->cover_file) }}" alt="Cover"
                                                class="img-fluid" style="max-height: 120px;">
                                        @else
                                            <small class="text-muted">Tidak ada cover</small>
                                        @endif

                                    </td>
                                    <td>
                                        <small class="fw-medium text-dark">{{ $row->tahun_dokumen ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <div style="word-break: break-all;">
                                            @if ($row->nama_file)
                                                <a href="{{ asset('asset/files/' . $row->nama_file) }}" target="_blank"
                                                    class="text-success">
                                                    <i class="fas fa-file-pdf me-1"></i>Download
                                                </a>
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <small
                                            class="fw-medium text-dark">{{ date('d/m/Y', strtotime($row->tgl_posting)) }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('edit_dokperenlitbang', $row->id_dokperenlitbang) }}"
                                                class="btn btn-outline-success btn-sm px-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Ganti dengan button delete baru -->
                                            <button type="button" class="btn btn-sm btn-outline-danger px-2 btn-delete"
                                                title="Hapus" data-id="{{ $row->id_dokperenlitbang }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <!-- Form tersembunyi untuk delete -->
                                            <form id="delete-form-{{ $row->id_dokperenlitbang }}"
                                                action="{{ route('delete_dokperenlitbang', $row->id_dokperenlitbang) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-bullhorn text-muted mb-3" style="font-size: 3rem;"></i>
                                            <h6 class="text-muted mb-2">Belum ada dokumen</h6>
                                            <p class="text-muted mb-3">Klik tombol "Tambah Dokperenlitbang" untuk membuat
                                                dokumen baru</p>
                                            <a href="{{ route('tambah_dokperenlitbang') }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-plus me-1"></i>Tambah Dokperenlitbang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Apakah Anda yakin ingin menghapus file berikut?</p>
                    <div class="alert alert-warning">
                        <strong id="deleteItemTitle"></strong>
                    </div>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-info-circle me-1"></i>
                        Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
