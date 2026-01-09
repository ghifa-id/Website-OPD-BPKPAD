@extends('admin.layouts.app')

@section('title', 'Tambah Agenda Baru')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-calendar-alt me-2"></i>Tambah Agenda Baru
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

                <form action="{{ route('store.agendaAdmin') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Header Info -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 border-start border-success border-4">
                                <h6 class="mb-1 text-success">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Agenda
                                </h6>
                                <p class="text-muted mb-0 small">Lengkapi informasi agenda dengan detail yang akurat</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tema Agenda -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tema" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-heading text-success me-2"></i>Tema Agenda
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tema" id="tema"
                                    class="form-control form-control-lg @error('tema') is-invalid @enderror"
                                    value="{{ old('tema') }}" required placeholder="Masukkan tema agenda">
                                @error('tema')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Isi Agenda -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="isi" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-align-left text-success me-2"></i>Isi Agenda
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="isi" id="editor1" class="form-control @error('isi') is-invalid @enderror" rows="8"
                                    placeholder="Deskripsikan agenda secara detail...">{{ old('isi') }}</textarea>
                                @error('isi')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Gambar -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="gambar" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-image text-success me-2"></i>Gambar
                                </label>
                                <div id="uploadArea" class="border-2 border-dashed rounded-3 p-4 mb-3 upload-area">
                                    <div id="uploadContent" class="text-center">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-success mb-3"></i>
                                        <h5 class="mb-2">Seret & Lepas gambar di sini</h5>
                                        <p class="text-muted small mb-2">Atau klik untuk memilih gambar</p>
                                        <span class="badge bg-light text-dark">Format: JPG, PNG (Maks. 2MB)</span>
                                    </div>
                                    <div id="imagePreview" class="d-none text-center">
                                        <img id="previewImage" src="#" alt="Preview" class="img-fluid mb-3 d-none"
                                            style="max-height: 150px;">
                                        <div class="mb-3">
                                            <i class="fas fa-file-image fa-3x text-success d-none" id="fileIcon"></i>
                                        </div>
                                        <p class="file-name fw-bold mb-2"></p>
                                        <div class="preview-controls">
                                            <button type="button" id="changeFile" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-sync me-1"></i>Ganti
                                            </button>
                                            <button type="button" id="removeFile" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <input type="file" name="gambar" id="gambar" class="d-none" accept="image/*">
                                </div>
                                @error('gambar')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Tempat -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tempat" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-map-marker-alt text-success me-2"></i>Tempat
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tempat" id="tempat"
                                    class="form-control form-control-lg @error('tempat') is-invalid @enderror"
                                    value="{{ old('tempat') }}" required placeholder="Masukkan tempat agenda">
                                @error('tempat')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Waktu -->
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jam" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-clock text-success me-2"></i>Jam Mulai - Selesai
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="jam" id="jam"
                                    class="form-control form-control-lg @error('jam') is-invalid @enderror"
                                    value="{{ old('jam') }}" required placeholder="Contoh: 08:00 - 17:00">
                                @error('jam')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tanggal" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-calendar-day text-success me-2"></i>Tanggal Mulai - Selesai
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tanggal" id="rangepicker"
                                    class="form-control form-control-lg" placeholder="Pilih rentang tanggal">
                            </div>
                        </div>
                    </div>

                    <!-- Pengirim -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pengirim" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-user text-success me-2"></i>Pengirim
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="pengirim" id="pengirim"
                                    class="form-control form-control-lg @error('pengirim') is-invalid @enderror"
                                    value="{{ old('pengirim') }}" required placeholder="Masukkan nama pengirim">
                                @error('pengirim')
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
                                <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan Agenda
                                </button>
                                <a href="{{ route('administrator.agenda') }}"
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
        /* Gunakan style yang sama dengan contoh sebelumnya */
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

        .daterangepicker {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .daterangepicker td.active,
        .daterangepicker td.active:hover {
            background-color: #000000;
        }

        .daterangepicker .ranges li.active {
            background-color: #000000;
            color: white;
        }

        .daterangepicker .drp-buttons .btn {
            border-radius: 8px;
            padding: 8px 16px;
        }

        .daterangepicker .calendar-table {
            border-radius: 10px;
            overflow: hidden;
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
            const filePreview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
            const fileIcon = document.getElementById('fileIcon');
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
                    // Check file size (2MB = 2 * 1024 * 1024 bytes)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        return;
                    }

                    // Check file type (image)
                    if (!file.type.match('image.*')) {
                        alert('Format file tidak didukung. Harap upload file gambar (JPG, PNG).');
                        return;
                    }

                    fileName.textContent = file.name;
                    uploadContent.classList.add('d-none');
                    filePreview.classList.remove('d-none');

                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            previewImage.classList.remove('d-none');
                            fileIcon.classList.add('d-none');
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewImage.classList.add('d-none');
                        fileIcon.classList.remove('d-none');
                    }
                }
            }

            // Remove file
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.value = '';
                uploadContent.classList.remove('d-none');
                filePreview.classList.add('d-none');
                fileName.textContent = '';
                previewImage.classList.add('d-none');
                fileIcon.classList.add('d-none');
            });

            // Change file
            changeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });

            $(function() {
                $('#rangepicker').daterangepicker({
                    locale: {
                        format: 'DD MMMM YYYY',
                        applyLabel: 'Pilih',
                        cancelLabel: 'Batal',
                        daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                        monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                            'Agustus',
                            'September', 'Oktober', 'November', 'Desember'
                        ],
                        firstDay: 1
                    },
                    opens: 'right',
                    startDate: moment(),
                    endDate: moment().add(1, 'days'),
                    showDropdowns: true,
                });

                $('#rangepicker').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD MMMM YYYY') + ' - ' + picker.endDate
                        .format('DD MMMM YYYY'));
                });
            });
        });
    </script>
@endpush
