@extends('admin.layouts.app')

@section('title', 'Edit Penghargaan')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-trophy me-2"></i>Edit Penghargaan
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

                <form action="{{ route('update_penghargaan', $penghargaan->id_penghargaan) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf


                    <!-- Header Info -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 border-start border-success border-4">
                                <h6 class="mb-1 text-success">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Penghargaan
                                </h6>
                                <p class="text-muted mb-0 small">Perbarui informasi penghargaan dengan detail yang akurat
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 1: Judul & Pemberi -->
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="judul" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-heading text-success me-2"></i>Judul Penghargaan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="judul" id="judul"
                                    class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $penghargaan->judul) }}" required
                                    placeholder="Masukkan judul penghargaan">
                                @error('judul')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pemberi" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-building text-success me-2"></i>Pemberi Penghargaan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="pemberi" id="pemberi"
                                    class="form-control form-control-lg @error('pemberi') is-invalid @enderror"
                                    value="{{ old('pemberi', $penghargaan->pemberi) }}" required
                                    placeholder="Masukkan nama pemberi penghargaan">
                                @error('pemberi')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Tahun & Tingkat -->
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tahun" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-calendar-alt text-success me-2"></i>Tahun Penghargaan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="tahun" id="tahun"
                                    class="form-control form-control-lg @error('tahun') is-invalid @enderror"
                                    value="{{ old('tahun', $penghargaan->tahun) }}" required min="1900"
                                    max="{{ date('Y') }}" placeholder="Masukkan tahun penghargaan">
                                @error('tahun')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tingkat" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-layer-group text-success me-2"></i>Tingkat Penghargaan
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="tingkat" id="tingkat"
                                    class="form-select form-select-lg @error('tingkat') is-invalid @enderror" required>
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="Nasional"
                                        {{ old('tingkat', $penghargaan->tingkat) == 'Nasional' ? 'selected' : '' }}>
                                        Nasional</option>
                                    <option value="Provinsi"
                                        {{ old('tingkat', $penghargaan->tingkat) == 'Provinsi' ? 'selected' : '' }}>
                                        Provinsi</option>
                                    <option value="Kabupaten"
                                        {{ old('tingkat', $penghargaan->tingkat) == 'Kabupaten' ? 'selected' : '' }}>
                                        Kabupaten</option>
                                </select>
                                @error('tingkat')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Deskripsi -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="deskripsi" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-align-left text-success me-2"></i>Deskripsi Penghargaan
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="8"
                                    placeholder="Deskripsikan penghargaan secara detail...">{{ old('deskripsi', $penghargaan->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb text-warning me-1"></i>
                                    Jelaskan pentingnya penghargaan ini dan pencapaian yang diraih
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 4: Gambar -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="gambar" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-image text-success me-2"></i>Gambar Penghargaan
                                </label>
                                <div class="upload-area border-2 border-dashed border-success rounded-3 p-4 text-center position-relative"
                                    id="uploadArea">
                                    <input type="file" name="gambar" id="gambar"
                                        class="form-control position-absolute opacity-0 w-100 h-100 @error('gambar') is-invalid @enderror"
                                        accept="image/*" style="cursor: pointer;">
                                    <div class="upload-content {{ $penghargaan->gambar ? 'd-none' : '' }}"
                                        id="uploadContent">
                                        <i class="fas fa-cloud-upload-alt text-success mb-2" style="font-size: 2rem;"></i>
                                        <p class="mb-1 fw-semibold">Klik untuk upload gambar</p>
                                        <small class="text-muted">atau drag & drop file di sini</small>
                                    </div>
                                    <div class="image-preview {{ $penghargaan->gambar ? '' : 'd-none' }}"
                                        id="imagePreview">
                                        @if ($penghargaan->gambar)
                                            <img src="{{ asset('asset/penghargaan/' . $penghargaan->gambar) }}"
                                                alt="Current Image" class="img-fluid rounded-3 mb-2"
                                                style="max-height: 200px; object-fit: cover;">
                                        @else
                                            <img src="" alt="Preview" class="img-fluid rounded-3 mb-2"
                                                style="max-height: 200px; object-fit: cover;">
                                        @endif
                                        <div class="preview-controls">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                id="removeImage">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success"
                                                id="changeImage">
                                                <i class="fas fa-edit me-1"></i>Ganti
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @error('gambar')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle text-info me-1"></i>
                                    Format: JPG, JPEG, PNG • Maksimal 5MB
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" name="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                                </button>
                                <a href="{{ url()->previous() }}"
                                    class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
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

        .form-control,
        .form-select {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 15px 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #fafbfc;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #000000;
            box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.15);
            background-color: #fff;
            transform: translateY(-2px);
        }

        .form-control-lg {
            padding: 18px 24px;
            font-size: 1.1rem;
        }

        .form-label {
            color: #2d3748;
            margin-bottom: 12px;
            font-size: 0.95rem;
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

        .alert {
            border-radius: 15px;
            border: none;
            padding: 20px;
        }

        .alert-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
        }

        .upload-area {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        }

        .upload-area:hover {
            border-color: #000000 !important;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            transform: translateY(-2px);
        }

        .upload-area.drag-over {
            border-color: #38a169 !important;
            background: linear-gradient(135deg, #f0fff4 0%, #e6fffa 100%);
            transform: scale(1.02);
        }

        .image-preview img {
            border: 3px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .image-preview img:hover {
            border-color: #000000;
            transform: scale(1.02);
        }

        .preview-controls {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .text-success {
            color: #000000 !important;
        }

        .border-success {
            border-color: #000000 !important;
        }

        .bg-light {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .form-text {
            font-size: 0.875rem;
            color: #64748b;
        }

        .shadow-lg {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        }

        .shadow-sm {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }

        .form-group {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 2rem !important;
            }

            .d-flex.gap-3 {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('gambar');
            const uploadArea = document.getElementById('uploadArea');
            const uploadContent = document.getElementById('uploadContent');
            const imagePreview = document.getElementById('imagePreview');
            const removeBtn = document.getElementById('removeImage');
            const changeBtn = document.getElementById('changeImage');

            // Handle file input change
            fileInput.addEventListener('change', function(e) {
                handleFileSelect(e.target.files[0]);
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
                    handleFileSelect(files[0]);
                    fileInput.files = files;
                }
            });

            // Handle file selection
            function handleFileSelect(file) {
                if (file && file.type.startsWith('image/')) {
                    // Check file size (5MB = 5 * 1024 * 1024 bytes)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = imagePreview.querySelector('img');
                        img.src = e.target.result;
                        uploadContent.classList.add('d-none');
                        imagePreview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('Please select a valid image file.');
                }
            }

            // Remove image
            removeBtn.addEventListener('click', function() {
                fileInput.value = '';
                uploadContent.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                const img = imagePreview.querySelector('img');
                img.src = '';
            });

            // Change image
            changeBtn.addEventListener('click', function() {
                fileInput.click();
            });
        });
    </script>
@endpush
