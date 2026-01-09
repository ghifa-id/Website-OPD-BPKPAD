@extends('admin.layouts.app')

@section('title', 'Tambah Pengumuman Baru')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-bullhorn me-2"></i>Tambah Pengumuman Baru
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

                <form action="{{ route('tambah_pengumumanAdmin') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">

                    <!-- Header Info -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 border-start border-success border-4">
                                <h6 class="mb-1 text-success">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Pengumuman
                                </h6>
                                <p class="text-muted mb-0 small">Lengkapi informasi pengumuman dengan detail yang akurat
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 1: Judul & Deadline -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="judul" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-heading text-success me-2"></i>Judul Pengumuman
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="judul" id="judul"
                                    class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                    value="{{ old('judul') }}" required placeholder="Masukkan judul pengumuman yang jelas">
                                @error('judul')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_posting" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-calendar-alt text-success me-2"></i>Tanggal Posting
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggal_posting" id="tanggal_posting"
                                    class="form-control form-control-lg @error('tanggal_posting') is-invalid @enderror"
                                    value="{{ old('tanggal_posting') }}" required>
                                @error('tanggal_posting')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Perihal -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="perihal" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-tag text-success me-2"></i>Perihal
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="perihal" id="perihal"
                                    class="form-control form-control-lg @error('perihal') is-invalid @enderror"
                                    value="{{ old('perihal') }}" required placeholder="Masukkan perihal pengumuman">
                                @error('perihal')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Deskripsi -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="deskripsi_pengumuman" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-align-left text-success me-2"></i>Deskripsi
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="deskripsi_pengumuman" id="editor1"
                                    class="form-control @error('deskripsi_pengumuman') is-invalid @enderror" rows="8"
                                    placeholder="Deskripsikan pengumuman secara detail...">{{ old('deskripsi_pengumuman') }}</textarea>
                                @error('deskripsi_pengumuman')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Row 4: File Upload -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="file_pendukung" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-file-upload text-success me-2"></i>Lampiran File
                                </label>
                                <div id="uploadArea" class="border-2 border-dashed rounded-3 p-4 mb-3 upload-area">
                                    <div id="uploadContent" class="text-center">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-success mb-3"></i>
                                        <h5 class="mb-2">Seret & Lepas file di sini</h5>
                                        <p class="text-muted small mb-2">Atau klik untuk memilih file</p>
                                        <span class="badge bg-light text-dark">Format: PDF, DOCX, XLSX (Maks. 5MB)</span>
                                    </div>
                                    <div id="imagePreview" class="d-none text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-file-alt fa-3x text-success"></i>
                                        </div>
                                        <p class="file-name fw-bold mb-2"></p>
                                        <div class="preview-controls">
                                            <button type="button" id="changeFile"
                                                class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-sync me-1"></i>Ganti
                                            </button>
                                            <button type="button" id="removeFile" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <input type="file" name="file_pendukung" id="file_pendukung" class="d-none"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx">
                                </div>

                                @error('file_pendukung')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Row 5: Keterangan Tambahan -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="keterangan" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-sticky-note text-success me-2"></i>Keterangan Tambahan
                                </label>
                                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                    rows="4" placeholder="Tambahkan catatan atau informasi tambahan jika diperlukan...">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" name="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan Pengumuman
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
            border: 2px dashed #cbd5e0;
            cursor: pointer;
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
            margin-bottom: 1.5rem;
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
            const fileInput = document.getElementById('file_pendukung');
            const uploadArea = document.getElementById('uploadArea');
            const uploadContent = document.getElementById('uploadContent');
            const filePreview = document.getElementById('imagePreview');
            const fileName = filePreview.querySelector('.file-name');
            const removeBtn = document.getElementById('removeFile');
            const changeBtn = document.getElementById('changeFile');

            // Handle file input change
            fileInput.addEventListener('change', function(e) {
                handleFileSelect(e.target.files[0]);
            });

            // Handle click on upload area
            uploadArea.addEventListener('click', function() {
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
                    handleFileSelect(files[0]);
                    fileInput.files = files;
                }
            });

            // Handle file selection
            function handleFileSelect(file) {
                if (file) {
                    // Check file size (5MB = 5 * 1024 * 1024 bytes)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        return;
                    }

                    // Check file type
                    const validTypes = ['application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];
                    if (!validTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Harap upload file PDF, DOC/DOCX, atau XLS/XLSX.');
                        return;
                    }

                    fileName.textContent = file.name;
                    uploadContent.classList.add('d-none');
                    filePreview.classList.remove('d-none');
                }
            }

            // Remove file
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.value = '';
                uploadContent.classList.remove('d-none');
                filePreview.classList.add('d-none');
                fileName.textContent = '';
            });

            // Change file
            changeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });
        });

        // Set minimum datetime for deadline (current time)
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const timezoneOffset = now.getTimezoneOffset() * 60000;
            const localISOTime = (new Date(now - timezoneOffset)).toISOString().slice(0, 16);
            document.getElementById('deadline').min = localISOTime;
        });
    </script>
@endpush
