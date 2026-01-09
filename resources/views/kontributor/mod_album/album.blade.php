@extends('kontributor.layouts.app')

@section('title', 'BPKPAD')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-bold">Album Management</h1>
                <p class="text-muted mb-0">Kelola album foto kegiatan Bpkpad</p>
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
                            <i class="fas fa-images text-primary me-2"></i>
                            Daftar Gallery
                        </h6>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('kontributor_tambah_album') }}" class="btn btn-primary btn-sm px-3">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Foto
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
                                <th class="text-center" style="width: 60px;">
                                    <small class="text-muted fw-semibold">No</small>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <small class="text-muted fw-semibold">Cover</small>
                                </th>
                                <th style="width: 120px;">
                                    <small class="text-muted fw-semibold">Tanggal</small>
                                </th>
                                <th style="width: 150px;">
                                    <small class="text-muted fw-semibold">Tempat</small>
                                </th>
                                <th>
                                    <small class="text-muted fw-semibold">Judul Kegiatan</small>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <small class="text-muted fw-semibold">Status</small>
                                </th>
                                <th class="text-center" style="width: 80px;">
                                    <small class="text-muted fw-semibold">Link</small>
                                </th>
                                {{-- <th class="text-center" style="width: 120px;">
                                    <small class="text-muted fw-semibold">Aksi</small>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($album as $index => $row)
                                <tr class="album-row" data-status="{{ $row->aktif }}"
                                    data-title="{{ strtolower($row->jdl_album) }}">
                                    <td class="text-center">
                                        <small class="text-muted">{{ $index + 1 }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="position-relative">
                                            <img src="{{ asset('asset/img_album/' . $row->gbr_album) }}" alt="Cover"
                                                class="rounded shadow-sm album-cover"
                                                style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                                onclick="previewImage('{{ asset('asset/img_album/' . $row->gbr_album) }}', '{{ $row->jdl_album }}')">
                                            <div class="position-absolute top-0 start-0 bg-dark bg-opacity-50 text-white rounded-start"
                                                style="font-size: 0.6rem; padding: 2px 4px;">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <small
                                            class="fw-medium text-dark">{{ date('d/m/Y', strtotime($row->tgl_kegiatan)) }}</small>
                                    </td>
                                    <td>
                                        <div style="white-space: normal; word-wrap: break-word; max-width: 150px; overflow-wrap: break-word;"
                                            title="{{ $row->tempat }}">
                                            <small class="text-dark">{{ $row->tempat }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark mb-1"
                                            style="line-height: 1.4; white-space: normal; word-wrap: break-word; max-width: 200px; overflow-wrap: break-word;">
                                            {{ $row->jdl_album }}
                                        </div>

                                    </td>
                                    <td class="text-center">
                                        @if ($row->aktif == 'Y')
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                                <i class="fas fa-check-circle me-1"></i>Aktif
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                                                <i class="fas fa-times-circle me-1"></i>Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($row->url)
                                            <a href="{{ $row->url }}" target="_blank"
                                                class="btn btn-outline-primary btn-sm rounded-pill" title="Lihat Album">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('edit_album', $row->id_album) }}"
                                                class="btn btn-outline-success btn-sm" title="Edit Album">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-delete"
                                                data-id="{{ $row->id_album }}" data-title="{{ $row->jdl_album }}"
                                                title="Hapus Album">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-images text-muted mb-3" style="font-size: 3rem;"></i>
                                            <h6 class="text-muted mb-2">Belum ada album</h6>
                                            <p class="text-muted mb-3">Klik tombol "Tambah Album" untuk membuat album baru
                                            </p>
                                            <a href="{{ route('kontributor_tambah_album') }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-plus me-1"></i>Tambah Album Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->

            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="imagePreviewTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="imagePreviewSrc" class="img-fluid rounded" style="max-height: 70vh;">
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    {{-- <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Apakah Anda yakin ingin menghapus album berikut?</p>
                    <div class="alert alert-warning">
                        <strong id="deleteAlbumTitle"></strong>
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
                            <i class="fas fa-trash-alt me-1"></i>Hapus Album
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
