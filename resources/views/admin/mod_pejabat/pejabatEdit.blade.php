@extends('admin.layouts.app')

@section('title', 'Edit Pejabat')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-user-tie me-2"></i>Edit Pejabat
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

                <form action="{{ route('update_pejabat', $pejabat->pejabat_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- TAMBAHKAN INI -->

                    <!-- Header Info -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 border-start border-success border-4">
                                <h6 class="mb-1 text-success">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Pejabat
                                </h6>
                                <p class="text-muted mb-0 small">Perbarui informasi Pejabat dengan detail yang akurat
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Nama Pejabat -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="nama_pejabat" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-user text-success me-2"></i>Nama Pejabat
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_pejabat" id="nama_pejabat"
                                    class="form-control form-control-lg @error('nama_pejabat') is-invalid @enderror"
                                    value="{{ old('nama_pejabat', $pejabat->nama_pejabat) }}" required
                                    placeholder="Masukkan nama pejabat">
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
                                <label for="jabatan_id" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-briefcase text-success me-2"></i>Jabatan
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="jabatan_id" id="jabatan_id"
                                    class="form-select form-control-lg @error('jabatan_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->jabatan_id }}"
                                            {{ old('jabatan_id', $pejabat->jabatan_id) == $jabatan->jabatan_id ? 'selected' : '' }}>
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
                        <div class="col-12">
                            <div class="form-group">
                                <label for="riwayat" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-history text-success me-2"></i>Riwayat
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="riwayat" id="editor1" class="form-control form-control-lg @error('riwayat') is-invalid @enderror"
                                    style="min-height: 200px;" required placeholder="Masukkan riwayat pejabat">{{ old('riwayat', $pejabat->riwayat) }}</textarea>
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
                                <label for="foto" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-camera text-success me-2"></i>Foto Pejabat
                                </label>
                                <div id="uploadArea" class="border-radius-lg border-dashed p-4 text-center upload-area">
                                    @if ($pejabat->foto)
                                        <div id="imagePreview" class="mb-3">
                                            <img src="{{ asset('asset/foto_pejabat/' . $pejabat->foto) }}" alt="Foto Pejabat"
                                                class="img-thumbnail mb-2" style="max-height: 150px;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="file-name text-truncate me-2">{{ $pejabat->foto }}</span>
                                                <div>
                                                    <button id="changeFile" type="button"
                                                        class="btn btn-sm btn-outline-success me-1">
                                                        <i class="fas fa-sync"></i>
                                                    </button>
                                                    <button id="removeFile" type="button"
                                                        class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div id="uploadContent">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-success mb-3"></i>
                                            <h6 class="mb-2">Seret dan lepas file disini atau klik untuk memilih</h6>
                                            <p class="text-xs text-muted mb-0">Format: JPG, PNG (Maks. 5MB)</p>
                                        </div>
                                        <div id="imagePreview" class="d-none">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="file-name text-truncate me-2"></span>
                                                <div>
                                                    <button id="changeFile" type="button"
                                                        class="btn btn-sm btn-outline-success me-1">
                                                        <i class="fas fa-sync"></i>
                                                    </button>
                                                    <button id="removeFile" type="button"
                                                        class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" name="foto" id="foto" class="d-none"
                                        accept="image/*">
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
                                <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
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
        const fileName = filePreview ? filePreview.querySelector('.file-name') : null;
        const removeBtn = document.getElementById('removeFile');
        const changeBtn = document.getElementById('changeFile');

        // Handle file input change
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                handleFileSelect(e.target.files[0]);
            });
        }

        // Handle click on upload area
        if (uploadArea) {
            uploadArea.addEventListener('click', function(e) {
                // Jika yang diklik adalah tombol change/remove, jangan trigger file input
                if (e.target.closest('button')) {
                    return;
                }
                fileInput.click();
            });
        }

        // Handle drag and drop
        if (uploadArea) {
            ['dragover', 'dragenter'].forEach(eventName => {
                uploadArea.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    uploadArea.classList.add('drag-over');
                });
            });

            ['dragleave', 'dragend', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    uploadArea.classList.remove('drag-over');
                });
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFileSelect(files[0]);
                    fileInput.files = files;
                }
            });
        }

        // Handle file selection
        function handleFileSelect(file) {
            if (file) {
                // Check file size (5MB = 5 * 1024 * 1024 bytes)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    return;
                }

                // Check file type
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Harap upload file JPG, PNG, atau GIF.');
                    return;
                }

                // Create preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Jika sudah ada preview, update
                    let imgPreview = filePreview.querySelector('img');
                    if (!imgPreview) {
                        imgPreview = document.createElement('img');
                        imgPreview.className = 'img-thumbnail mb-2';
                        imgPreview.style.maxHeight = '150px';
                        filePreview.insertBefore(imgPreview, filePreview.firstChild);
                    }
                    imgPreview.src = e.target.result;
                    imgPreview.alt = 'Preview Foto';
                };
                reader.readAsDataURL(file);

                if (fileName) fileName.textContent = file.name;
                if (uploadContent) uploadContent.classList.add('d-none');
                if (filePreview) filePreview.classList.remove('d-none');
            }
        }

        // Remove file
        if (removeBtn) {
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.value = '';
                
                // Hapus preview gambar
                const imgPreview = filePreview.querySelector('img');
                if (imgPreview) {
                    imgPreview.remove();
                }
                
                if (uploadContent) uploadContent.classList.remove('d-none');
                if (filePreview) filePreview.classList.add('d-none');
                if (fileName) fileName.textContent = '';
            });
        }

        // Change file
        if (changeBtn) {
            changeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });
        }
    });
</script>
@endpush