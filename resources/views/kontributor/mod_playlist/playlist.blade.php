@extends('kontributor.layouts.app')


@section('title', 'BPKPAD')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-bold">Playlist Management</h1>
                <p class="text-muted mb-0">Kelola playlist kegiatan BPKPAD</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="mb-0 fw-semibold text-gray-700">
                            <i class="fas fa-images text-primary me-2"></i>
                            Daftar Playlist
                        </h6>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('kontributor_tambah_playlist') }}" class="btn btn-primary btn-sm px-3">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Playlist
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
                                <th>
                                    <small class="text-muted fw-semibold">Judul Playlist</small>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <small class="text-muted fw-semibold">Aktif</small>
                                </th>
                                {{-- <th class="text-center" style="width: 120px;">
                                    <small class="text-muted fw-semibold">Aksi</small>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($playlist as $index => $row)
                                <tr class="text-center align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        <div class="position-relative">
                                            <img src="{{ asset('asset/img_playlist/' . $row->gbr_playlist) }}"
                                                alt="Cover" class="rounded shadow-sm album-cover"
                                                style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                                onclick="previewImage('{{ asset('asset/img_playlist/' . $row->gbr_playlist) }}', '{{ $row->jdl_playlist }}')">
                                            <div class="position-absolute top-0 start-0 bg-dark bg-opacity-50 text-white rounded-start"
                                                style="font-size: 0.6rem; padding: 2px 4px;">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: normal; word-wrap: break-word;"
                                        title="{{ $row->jdl_playlist }} ?? 'Tidak ada' }}">
                                        {{ $row->jdl_playlist ?? 'Album tidak ditemukan' }}
                                    </td>
                                    <td>{{ $row->aktif ?? '-' }}</td>
                                    {{-- <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('edit_playlist', $row->id_playlist) }}"
                                                class="btn btn-outline-success btn-sm" title="Edit Gallery">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-delete"
                                                data-id="{{ $row->id_playlist }}" data-title="{{ $row->id_playlist }}"
                                                title="Hapus Gallery">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <form id="delete-form-{{ $row->id_playlist }}"
                                                action="{{ route('delete_playlist', $row->id_playlist) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data gallery.</td>
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
                            <i class="fas fa-trash-alt me-1"></i>Hapus Playlist
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
