@extends('admin.layouts.app')

@section('title', 'Tambah Pejabat Baru')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize ps-3 mb-0">
                            <i class="fas fa-user-tie me-2"></i>Tambah Pejabat Baru
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

                <form action="{{ route('store_pejabat') }}" method="POST" enctype="multipart/form-data" id="formPejabat">
                    @csrf

                    <!-- Header Info -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 border-start border-success border-4">
                                <h6 class="mb-1 text-success">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Pejabat
                                </h6>
                                <p class="text-muted mb-0 small">Lengkapi informasi Pejabat dengan detail yang akurat</p>
                            </div>
                        </div>
                    </div>

                    <!-- Nama Pejabat -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="nama_pejabat" class="form-label fw-bold text-success mb-2">
                                    <i class="fas fa-user text-success me-2"></i>Nama Pejabat
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_pejabat" id="nama_pejabat"
                                    class="form-control form-control-lg @error('nama_pejabat') is-invalid @enderror"
                                    value="{{ old('nama_pejabat') }}" required placeholder="Masukkan nama pejabat">
                                @error('nama_pejabat')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Jabatan -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="jabatan_id" class="form-label fw-bold text-success mb-2">
                                    <i class="fas fa-briefcase text-success me-2"></i>Jabatan
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="jabatan_id" id="jabatan_id"
                                    class="form-select form-control-lg @error('jabatan_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->jabatan_id ?? $jabatan->id }}"
                                            {{ old('jabatan_id') == ($jabatan->jabatan_id ?? $jabatan->id) ? 'selected' : '' }}>
                                            {{ $jabatan->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jabatan_id')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat -->
                    <div class="row mb-4">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="riwayat" class="form-label fw-bold text-success mb-2">
                                    <i class="fas fa-align-left text-success me-2"></i>Riwayat
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="riwayat" id="editor1" class="form-control @error('riwayat') is-invalid @enderror" rows="8"
                                    placeholder="Berikan deskripsi riwayat pejabat..." required>{{ old('riwayat') }}</textarea>
                                @error('riwayat')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Foto -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="foto" class="form-label fw-bold text-success mb-2">
                                    <i class="fas fa-camera text-success me-2"></i>Foto Pejabat
                                    <span class="text-danger">*</span>
                                </label>
                                <div id="uploadArea" class="border-radius-lg border-dashed p-4 text-center upload-area">
                                    <div id="uploadContent">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-success mb-3"></i>
                                        <h6 class="mb-2">Seret dan lepas file disini atau klik untuk memilih</h6>
                                        <p class="text-xs text-muted mb-0">Format: JPG, PNG (Maks. 5MB)</p>
                                    </div>
                                    <div id="imagePreview" class="d-none"></div>
                                    <input type="file" name="foto" id="foto" class="d-none" accept="image/*" required>
                                </div>
                                @error('foto')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" name="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan Pejabat
                                </button>
                                <a href="{{ route('pejabat') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('foto');
            const uploadArea = document.getElementById('uploadArea');
            const uploadContent = document.getElementById('uploadContent');
            const filePreview = document.getElementById('imagePreview');

            // Handle file input change
            fileInput.addEventListener('change', function(e) {
                handleFileSelect(e.target.files[0]);
            });

            // Handle click on upload area
            uploadArea.addEventListener('click', function(e) {
                if (!filePreview.classList.contains('d-none')) return;
                fileInput.click();
            });

            // Handle drag and drop
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('drag-over');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('drag-over');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('drag-over');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(files[0]);
                    fileInput.files = dataTransfer.files;
                    handleFileSelect(files[0]);
                }
            });

            // Handle file selection with image preview
            function handleFileSelect(file) {
                if (file) {
                    // Validasi ukuran file (max 5MB)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        fileInput.value = '';
                        return;
                    }

                    // Validasi tipe file
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!validTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Harap upload file JPG atau PNG.');
                        fileInput.value = '';
                        return;
                    }

                    // Tampilkan preview gambar
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        filePreview.innerHTML = `
                            <img src="${e.target.result}" style="max-width: 100%; max-height: 200px; object-fit: contain;">
                            <div class="file-name mt-2 small">${file.name}</div>
                            <div class="mt-2">
                                <button type="button" id="changeFile" class="btn btn-sm btn-outline-success me-1">
                                    <i class="fas fa-sync"></i> Ganti
                                </button>
                                <button type="button" id="removeFile" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-times"></i> Hapus
                                </button>
                            </div>
                        `;

                        uploadContent.classList.add('d-none');
                        filePreview.classList.remove('d-none');

                        // Re-attach event listeners
                        document.getElementById('removeFile').addEventListener('click', function(e) {
                            e.stopPropagation();
                            fileInput.value = '';
                            uploadContent.classList.remove('d-none');
                            filePreview.classList.add('d-none');
                        });

                        document.getElementById('changeFile').addEventListener('click', function(e) {
                            e.stopPropagation();
                            fileInput.click();
                        });
                    };
                    reader.readAsDataURL(file);
                }
            }

            // TIDAK ADA VALIDASI FORM DI SINI - Biarkan HTML5 native validation bekerja
        });
    </script>
@endpush