@extends('admin.layouts.app')

@section('title', 'Tambah Download')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-download me-2"></i>Tambah File Download
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

                <form action="{{ route('store.downloadAdmin') }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal" role="form">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="judul" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-heading text-success me-2"></i>Judul
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="judul" id="judul"
                                    class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                    value="{{ old('judul') }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="file" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-file-upload text-success me-2"></i>File Download
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="upload-area border-2 border-dashed border-success rounded-3 p-4 text-center position-relative"
                                    id="uploadArea">
                                    <input type="file" name="file" id="file"
                                        class="form-control position-absolute opacity-0 w-100 h-100 @error('file') is-invalid @enderror"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" style="cursor: pointer;" required>
                                    <div class="upload-content" id="uploadContent">
                                        <i class="fas fa-cloud-upload-alt text-success mb-2" style="font-size: 2rem;"></i>
                                        <p class="mb-1 fw-semibold">Klik untuk upload file</p>
                                        <small class="text-muted">atau drag & drop file di sini</small>
                                    </div>
                                    <div id="fileName" class="mt-2 fw-medium text-dark d-none"></div>

                                    @error('file')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-text mt-2">
                                        <i class="fas fa-info-circle text-info me-1"></i>
                                        Format: PDF, DOC, XLS, PPT • Maksimal 5MB
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                                <a href="{{ route('download') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
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
            const uploadArea = document.getElementById('uploadArea');
            const uploadContent = document.getElementById('uploadContent');
            const fileInput = document.getElementById('file');
            const fileName = document.getElementById('fileName');

            // Handle drag over
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('border-success', 'bg-light');
                uploadContent.innerHTML =
                    '<i class="fas fa-file-upload text-success mb-2" style="font-size: 2rem;"></i><p class="mb-1 fw-semibold">Lepaskan file di sini</p>';
            });

            // Handle drag leave
            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('border-success', 'bg-light');
                resetUploadContent();
            });

            // Handle drop
            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('border-success', 'bg-light');
                fileInput.files = e.dataTransfer.files;
                updateFileName();
            });

            // Handle file selection
            fileInput.addEventListener('change', updateFileName);

            function updateFileName() {
                if (fileInput.files.length > 0) {
                    fileName.textContent = fileInput.files[0].name;
                    fileName.classList.remove('d-none');
                    uploadContent.innerHTML =
                        '<i class="fas fa-file-check text-success mb-2" style="font-size: 2rem;"></i><p class="mb-1 fw-semibold">File dipilih</p>';
                } else {
                    resetUploadContent();
                }
            }

            function resetUploadContent() {
                uploadContent.innerHTML =
                    '<i class="fas fa-cloud-upload-alt text-success mb-2" style="font-size: 2rem;"></i><p class="mb-1 fw-semibold">Klik untuk upload file</p><small class="text-muted">atau drag & drop file di sini</small>';
                fileName.classList.add('d-none');
            }
        });
    </script>
@endpush
