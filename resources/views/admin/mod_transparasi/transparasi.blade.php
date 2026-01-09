@extends('admin.layouts.app')



@section('title', 'BPKPAD')



@section('content')

    <div class="container-fluid px-4">

        <!-- Header Section -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h1 class="h3 mb-0 text-gray-800 fw-bold">Transparasi Data & Informasi (PPID) </h1>

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

                            Daftar PPID

                        </h6>

                    </div>

                    <div class="col-auto">

                        <a href="{{ route('tambah_ppidAdmin') }}" class="btn btn-success btn-sm px-3">

                            <i class="fas fa-plus me-1"></i>

                            Tambah PPID

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

                                    <small class="text-muted fw-semibold">Judul</small>

                                </th>

                                <th class="text-center" style="width: 80px;">

                                    <small class="text-muted fw-semibold">Tahun Dokumen</small>

                                </th>

                                <th class="text-center" style="width: 80px;">

                                    <small class="text-muted fw-semibold">Kategori</small>

                                </th>

                                <th style="width: 100px;">

                                    <small class="text-muted fw-semibold">Link</small>

                                </th>

                                <th class="text-center" style="width: 80px;">

                                    <small class="text-muted fw-semibold">Dilihat</small>

                                </th>

                                <th class="text-center" style="width: 100px;">

                                    <small class="text-muted fw-semibold">Tanggal</small>

                                </th>

                                <th class="text-center" style="width: 120px;">

                                    <small class="text-muted fw-semibold">Aksi</small>

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @php

                                $jenisKategori = [

                                    1 => 'Informasi Berkala',

                                    2 => 'Informasi Setiap Saat',

                                    3 => 'Informasi Serta Merta',

                                    4 => 'Informasi Dikecualikan',

                                ];

                            @endphp

                            @forelse ($transparasi as $index => $row)

                                <tr class="album-row" data-status="{{ $row->aktif }}"

                                    data-title="{{ strtolower($row->judul) }}">

                                    <td class="text-center">

                                        <small class="text-muted">{{ $index + 1 }}</small>

                                    </td>

                                    <td>

                                        <div class="fw-medium text-dark"

                                            style="white-space: normal; word-wrap: break-word; line-height: 1.4;">

                                            {{ $row->judul }}

                                        </div>

                                    </td>

                                    <td class="text-center">

                                        <small class="fw-medium text-dark">{{ $row->tahun }}</small>

                                    </td>

                                    <td class="text-wrap" style="max-width: 300px;">

                                        {{ $jenisKategori[$row->id_kat] ?? '-' }}

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

                                        <small class="fw-medium text-dark">{{ $row->hits }}</small>

                                    </td>

                                    <td class="text-center">

                                        <small

                                            class="fw-medium text-dark">{{ date('d/m/Y', strtotime($row->tgl_posting)) }}</small>

                                    </td>

                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="{{ route('edit_ppidAdmin', $row->id_transparasi) }}"

                                                class="btn btn-outline-success btn-sm px-2" title="Edit download">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ route('delete_ppidAdmin', $row->id_transparasi) }}"

                                                method="POST" class="d-inline">

                                                @csrf

                                                @method('DELETE')

                                              <button type="button"
    class="btn btn-outline-danger btn-sm btn-delete px-2"
    data-id="{{ $row->id_transparasi }}"
    data-title="{{ $row->judul }}"
    title="Hapus">
    <i class="fas fa-trash-alt"></i>
</button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8" class="text-center py-5">

                                        <div class="d-flex flex-column align-items-center">

                                            <i class="fas fa-bullhorn text-muted mb-3" style="font-size: 3rem;"></i>

                                            <h6 class="text-muted mb-2">Belum ada pengumuman</h6>

                                            <p class="text-muted mb-3">Klik tombol "Tambah Pengumuman" untuk membuat

                                                pengumuman baru</p>

                                            <a href="{{ route('tambah_pengumuman') }}" class="btn btn-success btn-sm">

                                                <i class="fas fa-plus me-1"></i>Tambah Pengumuman

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
                <p class="mb-3">Apakah Anda yakin ingin menghapus dokumen berikut?</p>
                <div class="alert alert-warning">
                    <strong id="deletePpidTitle"></strong>
                </div>
                <p class="text-muted small mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
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
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        const deleteTitle = document.getElementById('deletePpidTitle');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');

                deleteTitle.textContent = title;
                deleteForm.action = "{{ url('administrator/ppid/') }}/" + id;
                deleteModal.show();
            });
        });
    });

    function refreshTable() {
        window.location.reload();
    }
</script>
@endpush

@endsection

