@extends('kontributor.layouts.app')


@section('title', 'BPKPAD')

@section('content')

    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-bold">Gallery Management</h1>
                <p class="text-muted mb-0">Kelola foto kegiatan BPKPAD</p>
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
                        <a href="{{ route('kontributor_tambah_gallery') }}" class="btn btn-primary btn-sm px-3">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Gallery
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="albumTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 20px;">
                                <small class="text-muted fw-semibold">No</small>
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <small class="text-muted fw-semibold">Foto Kegiatan</small>
                            </th>
                            <th class="text-center" style="width: 150px;">
                                <small class="text-muted fw-semibold">Nama Album</small>
                            </th>
                            <th class="text-center" style="width: 80px;">
                                <small class="text-muted fw-semibold">Slider</small>
                            </th>
                            {{-- <th class="text-center" style="width: 80px;">
                                <small class="text-muted fw-semibold">Aksi</small>
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gallery as $index => $row)
                            <tr class="text-center align-middle">
                                <td>{{ $index + 1 }}</td>
                                <td class="text-center">
                                    <div class="position-relative">
                                        <img src="{{ asset('asset/img_gallery/' . $row->gbr_gallery) }}" alt="Cover"
                                            class="rounded shadow-sm album-cover"
                                            style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                            onclick="previewImage('{{ asset('asset/img_gallery/' . $row->gbr_gallery) }}', '{{ $row->jdl_album }}')">
                                        <div class="position-absolute top-0 start-0 bg-dark bg-opacity-50 text-white rounded-start"
                                            style="font-size: 0.6rem; padding: 2px 4px;">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                </td>
                                <td style="white-space: normal; word-wrap: break-word;"
                                    title="{{ $row->album->jdl_album }}">
                                    {{ $row->album->jdl_album ?? 'Album tidak ditemukan' }}
                                </td>


                                <td>
                                    @if ($row->slider == 'Y')
                                        <span class="badge bg-success">Ya</span>
                                    @else
                                        <span class="badge bg-danger">Tidak</span>
                                    @endif
                                </td>
                                {{-- <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('edit_gallery', $row->id_gallery) }}"
                                            class="btn btn-outline-success btn-sm" title="Edit Gallery">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-delete"
                                            data-id="{{ $row->id_gallery }}" data-title="{{ $row->jdl_gallery }}"
                                            title="Hapus Galley">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
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


        </div>
    </div>
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
@endsection
