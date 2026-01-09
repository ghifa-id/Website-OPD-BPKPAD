@extends('admin.layouts.app')

@section('title', 'Tambah Halaman Baru')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Halaman Baru
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

                <form action="{{ route('store_halamanbaru') }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" value="">

                    <!-- Header Info -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 border-start border-success border-4">
                                <h6 class="mb-1 text-success">
                                    <i class="fas fa-file-alt me-2"></i>Informasi Halaman
                                </h6>
                                <p class="text-muted mb-0 small">Lengkapi informasi halaman baru dengan detail yang akurat
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Judul -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="judul" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-heading text-success me-2"></i>Judul
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="judul" id="judul"
                                    class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                    value="{{ old('judul') }}" required placeholder="Masukkan judul halaman">
                                @error('judul')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Isi Halaman -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="editor1" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-align-left text-success me-2"></i>Isi Halaman
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="isi_halaman" id="editor1"
                                    class="form-control form-control-lg @error('isi_halaman') is-invalid @enderror" rows="8" required
                                    placeholder="Masukkan konten halaman">{{ old('isi_halaman') }}</textarea>
                                @error('isi_halaman')
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
                                <input type="file" name="gambar" id="gambar"
                                    class="form-control form-control-lg @error('gambar') is-invalid @enderror"
                                    accept="image/*">
                                <small class="text-muted mt-2 d-block">
                                    <i class="fas fa-info-circle me-1"></i>Maksimal ukuran gambar 5MB (jpg, jpeg, png)
                                </small>
                                @error('gambar')
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
                                    <i class="fas fa-save me-2"></i>Simpan Halaman
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
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

        textarea.form-control-lg {
            min-height: 200px;
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

        .text-success {
            color: #000000 !important;
        }

        .border-success {
            border-color: #000000 !important;
        }

        .bg-light {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
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
