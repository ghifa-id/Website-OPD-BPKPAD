@extends('kontributor.layouts.app')


@section('title', 'BPKPAD')



@section('content')

    <div class="container-fluid px-4">

        <!-- Header Section -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h1 class="h3 mb-0 text-gray-800 fw-bold">Semua Agenda</h1>

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

                            Daftar Agenda

                        </h6>

                    </div>

                    <div class="col-auto">

                        <a href="{{ route('kontributor_tambah_agenda') }}" class="btn btn-primary btn-sm px-3">

                            <i class="fas fa-plus me-1"></i>

                            Tambah Agenda

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

                                    <small class="text-muted fw-semibold">Tema</small>

                                </th>

                                <th style="width: 100px;">

                                    <small class="text-muted fw-semibold">Tanggal Mulai</small>

                                </th>

                                <th class="text-center" style="width: 100px;">

                                    <small class="text-muted fw-semibold">Tanggal Selesai</small>

                                </th>

                                <th class="text-center" style="width: 100px;">

                                    <small class="text-muted fw-semibold">Jam</small>

                                </th>

                                {{-- <th class="text-center" style="width: 120px;">

                                    <small class="text-muted fw-semibold">Aksi</small>

                                </th> --}}

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($agendakontributor as $index => $row)

                                <tr class="album-row" data-status="{{ $row->aktif }}"

                                    data-title="{{ strtolower($row->judul) }}">

                                    <td class="text-center">

                                        <small class="text-muted">{{ $index + 1 }}</small>

                                    </td>

                                    <td>

                                        <div class="fw-medium text-dark"

                                            style="white-space: normal; word-wrap: break-word; line-height: 1.4;">

                                            {{ $row->tema }}

                                        </div>

                                    </td>

                                    <td class="text-center">

                                        <small

                                            class="fw-medium text-dark">{{ date('d/m/Y', strtotime($row->tgl_mulai)) }}</small>

                                    </td>

                                    <td class="text-center">

                                        <small

                                            class="fw-medium text-dark">{{ date('d/m/Y', strtotime($row->tgl_selesai)) }}</small>

                                    </td>

                                    <td class="text-center">

                                        <small class="fw-medium text-dark">

                                            {{ date('H:i', strtotime($row->jam)) }} WIB

                                        </small>

                                    </td>



                                    {{-- <td class="text-center">

                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="{{ route('edit_agendaAdmin', $row->id_agenda) }}"

                                                class="btn btn-outline-success btn-sm px-2" title="Edit Agenda">

                                                <i class="fas fa-edit"></i>

                                            </a>



                                            <!-- Ganti dengan button delete baru -->

                                            <button type="button" class="btn btn-sm btn-outline-danger px-2 btn-delete"

                                                title="Hapus" data-id="{{ $row->id_agenda }}">

                                                <i class="fas fa-trash-alt"></i>

                                            </button>



                                            <!-- Form tersembunyi untuk delete -->

                                            <form id="delete-form-{{ $row->id_agenda }}"

                                                action="{{ route('delete_agendaAdmin', $row->id_agenda) }}" method="POST"

                                                style="display: none;">

                                                @csrf

                                                @method('DELETE')

                                            </form>

                                        </div>

                                    </td> --}}

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center py-5">

                                        <div class="d-flex flex-column align-items-center">

                                            <i class="fas fa-bullhorn text-muted mb-3" style="font-size: 3rem;"></i>

                                            <h6 class="text-muted mb-2">Belum ada agenda</h6>

                                            <p class="text-muted mb-3">Klik tombol "Tambah agenda" untuk membuat

                                                agenda baru</p>

                                            <a href="{{ route('tambah_agenda') }}" class="btn btn-primary btn-sm">

                                                <i class="fas fa-plus me-1"></i>Tambah agenda

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

    <!-- Delete Confirmation Modal -->

    {{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">

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

    </div> --}}

@endsection

