@extends('admin.layouts.app')

@section('title', 'BPKPAD')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-bold">Menu Website</h1>
                <p class="text-muted mb-0">Kelola Menu Website BPKPAD</p>
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
                            <i class="fas fa-bars text-success me-2"></i>
                            Daftar Menu
                        </h6>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('tambah_menuwebsite') }}" class="btn btn-success btn-sm px-3">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Menu
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="albumTable" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th style="min-width: 150px;">Menu</th>
                                <th style="min-width: 150px;">Level Menu</th>
                                <th style="min-width: 200px;">Link</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 100px;">Position</th>
                                <th style="width: 80px;">Urutan</th>
                                <th class="text-center" style="width: 130px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $index => $row)
                                @php
                                    $level = $row->parent ? $row->parent->nama_menu : 'Menu Utama';
                                    // atau jika menggunakan relasi groupMenu:
                                    // $level = $row->groupMenu ? $row->groupMenu->nama_menu : 'Menu Utama';
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-medium text-dark">
                                            {{ $row->nama_menu }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-dark">
                                            {{ $level }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ url($row->link) }}" target="_blank"
                                            class="text-info text-decoration-underline" style="word-break: break-word;">
                                            {{ $row->link }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if ($row->aktif == 'Ya')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark">
                                            {{ $row->position }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{ $row->urutan }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('edit_menuwebsite', $row->id_menu) }}"
                                                class="btn btn-outline-success btn-sm px-2 py-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-delete"
                                                data-id="{{ $row->id_menu }}" data-title="{{ $row->nama_menu }}"
                                                title="Hapus Menu">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-bars text-muted mb-2" style="font-size: 2.5rem;"></i>
                                            <h6 class="text-muted mb-2">Belum ada menu</h6>
                                            <a href="{{ route('tambah_menuwebsite') }}"
                                                class="btn btn-success btn-sm mt-2">
                                                <i class="fas fa-plus me-1"></i>Tambah Menu
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
                    <p class="mb-3">Apakah Anda yakin ingin menghapus Menu berikut?</p>
                    <div class="alert alert-warning">
                        <strong id="deleteMenuTitle"></strong>
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
                            <i class="fas fa-trash-alt me-1"></i>Hapus Menu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Delete confirmation modal
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');
            const deleteForm = document.getElementById('deleteForm');
            const deleteTitle = document.getElementById('deleteMenuTitle');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title');

                    deleteTitle.textContent = title;
                    deleteForm.action = "{{ route('delete_menuwebsite', '') }}/" + id;
                    deleteModal.show();
                });
            });
        });

        // Refresh table function
        function refreshTable() {
            window.location.reload();
        }
    </script>
@endpush
