@extends('admin.layouts.app')

@section('title', 'Sekretariat Daerah')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-bold">Penghargaan Management</h1>
                <p class="text-muted mb-0">Kelola data penghargaan Sekretariat Daerah</p>
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
                            <i class="fas fa-trophy text-success me-2"></i>
                            Daftar Penghargaan
                        </h6>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('tambah_penghargaan') }}" class="btn btn-success btn-sm px-3">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Penghargaan
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="penghargaanTable">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 60px;">
                                    <small class="text-muted fw-semibold">No</small>
                                </th>
                                <th>
                                    <small class="text-muted fw-semibold">Judul</small>
                                </th>
                                <th style="width: 200px;">
                                    <small class="text-muted fw-semibold">Deskripsi</small>
                                </th>
                                <th style="width: 120px;">
                                    <small class="text-muted fw-semibold">Pemberi</small>
                                </th>
                                <th class="text-center" style="width: 80px;">
                                    <small class="text-muted fw-semibold">Tahun</small>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <small class="text-muted fw-semibold">Tingkat</small>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <small class="text-muted fw-semibold">Gambar</small>
                                </th>
                                <th class="text-center" style="width: 120px;">
                                    <small class="text-muted fw-semibold">Aksi</small>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penghargaan as $index => $row)
                                <tr>
                                    <td class="text-center">
                                        <small class="text-muted">{{ $index + 1 }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark">{{ $row->judul }}</div>
                                    </td>
                                    <td>
                                        <div style="white-space: normal; word-wrap: break-word; max-width: 200px;">
                                            <small class="text-muted">{{ $row->deskripsi }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-dark">{{ $row->pemberi }}</small>
                                    </td>
                                    <td class="text-center">
                                        <small class="fw-medium text-dark">{{ $row->tahun }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1">
                                            {{ $row->tingkat }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($row->gambar)
                                            <div class="position-relative">
                                                <img src="{{ asset('asset/penghargaan/' . $row->gambar) }}"
                                                    alt="Gambar Penghargaan" class="rounded shadow-sm"
                                                    style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                                    onclick="previewImage('{{ asset('asset/penghargaan/' . $row->gambar) }}', '{{ $row->judul }}')">
                                                <div class="position-absolute top-0 start-0 bg-dark bg-opacity-50 text-white rounded-start"
                                                    style="font-size: 0.6rem; padding: 2px 4px;">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('edit_penghargaan', $row->id_penghargaan) }}"
                                                class="btn btn-outline-success btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-delete"
                                                data-id="{{ $row->id_penghargaan }}" data-title="{{ $row->judul }}"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-trophy text-muted mb-3" style="font-size: 3rem;"></i>
                                            <h6 class="text-muted mb-2">Belum ada penghargaan</h6>
                                            <p class="text-muted mb-3">Klik tombol "Tambah Penghargaan" untuk menambahkan
                                                data</p>
                                            <a href="{{ route('tambah_penghargaan') }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-plus me-1"></i>Tambah Penghargaan
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
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Apakah Anda yakin ingin menghapus penghargaan berikut?</p>
                    <div class="alert alert-warning">
                        <strong id="deletePenghargaanTitle"></strong>
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

@push('scripts')
    <script>
        // Image Preview Function
        function previewImage(src, title) {
            document.getElementById('imagePreviewSrc').src = src;
            document.getElementById('imagePreviewTitle').textContent = title;
            const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
            modal.show();
        }

        // Delete Confirmation
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const deleteTitle = document.getElementById('deletePenghargaanTitle');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title');

                    deleteTitle.textContent = title;
                    deleteForm.action = "{{ route('delete_penghargaan', ':id') }}".replace(':id', id);

                    deleteModal.show();
                });
            });
        });

        // Refresh Table Function
        function refreshTable() {
            window.location.reload();
        }
    </script>
@endpush
