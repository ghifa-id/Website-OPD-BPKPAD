@extends('admin.layouts.app')

@section('title', 'Tambah Gallery Baru')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-images me-2"></i>Tambah Foto Baru
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-5">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terdapat kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <form action="{{ route('tambah_gallery') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="id_album" class="form-label">Pilih Album</label>
                        <select name="id_album" id="id_album" class="form-select" required>
                            <option value="">-- Pilih Album --</option>
                            @foreach ($album as $item)
                                <option value="{{ $item->id_album }}">{{ $item->jdl_album }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Foto + Judul Gallery (Banyak)</label>
                        <div id="upload-group">
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <input type="file" name="photos[]" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="jdl_gallery[]" class="form-control"
                                        placeholder="Judul Gallery" required>
                                </div>
                                <div class="col-md-2 d-flex align-items-center">
                                    <!-- Kosong, karena ini baris awal tanpa tombol batalkan -->
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="addUploadGroup()">+ Tambah
                            Foto</button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tampilkan di Slider?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="slider" id="slider_yes" value="Y"
                                checked>
                            <label class="form-check-label" for="slider_yes">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="slider" id="slider_no" value="N">
                            <label class="form-check-label" for="slider_no">Tidak</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" name="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                    <i class="fas fa-plus-circle me-2"></i>Tambahkan Gallery
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
                                    <i class="fas fa-arrow-left me-2"></i>Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .card {
            border-radius: 20px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #000000 0%, #2d3748 100%);
        }

        #upload-group .row {
            border: 1px solid #ced4da;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            background-color: #f9f9f9;
            align-items: center;
        }

        #upload-group .col-md-6 {
            padding-left: 10px;
            padding-right: 10px;
        }

        #upload-group input[type="file"],
        #upload-group input[type="text"] {
            width: 100%;
        }

        button.btn-outline-success {
            margin-top: 5px;
        }

        .btn {
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
        }

        .btn-lg {
            padding: 16px 32px;
            font-size: 1.1rem;
        }

        .btn-success {
            background: linear-gradient(135deg, #000000 0%, #2d3748 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
        }

        .btn-outline-secondary {
            border: 2px solid #e2e8f0;
            color: #64748b;
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e0;
            transform: translateY(-2px);
            color: #475569;
        }

        .btn-outline-success {
            border: 2px solid #000000;
            color: #000000;
            background: transparent;
        }

        .btn-outline-success:hover {
            background: #000000;
            border-color: #000000;
            color: #ffffff;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function addUploadGroup() {
            const uploadGroup = `
    <div class="row mb-2">
        <div class="col-md-5">
            <input type="file" name="photos[]" class="form-control" required>
        </div>
        <div class="col-md-5">
            <input type="text" name="jdl_gallery[]" class="form-control" placeholder="Judul Gallery" required>
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.row').remove()">Batalkan</button>
        </div>
    </div>`;
            document.getElementById('upload-group').insertAdjacentHTML('beforeend', uploadGroup);
        }
    </script>
@endpush
