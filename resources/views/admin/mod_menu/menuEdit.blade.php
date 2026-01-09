@extends('admin.layouts.app')

@section('title', 'Edit Menu Website')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-edit me-2"></i>Edit Menu Website
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

                <form action="{{ route('update_menuwebsite', $menu->id_menu) }}" method="POST" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" value="{{ $menu->id_menu }}">

                    <!-- Header Info -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 border-start border-success border-4">
                                <h6 class="mb-1 text-success">
                                    <i class="fas fa-link me-2"></i>Informasi Menu
                                </h6>
                                <p class="text-muted mb-0 small">Perbarui informasi menu website dengan detail yang akurat
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Link Menu -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="link_menu" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-external-link-alt text-success me-2"></i>Link Menu
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="link_menu" id="link_menu"
                                    class="form-control form-control-lg @error('link_menu') is-invalid @enderror"
                                    value="{{ old('link_menu', $menu->link) }}" required placeholder="Masukkan link menu">
                                @error('link_menu')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Level Menu -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="level_menu" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-sitemap text-success me-2"></i>Level Menu
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="level_menu" id="level_menu"
                                    class="form-select form-control-lg @error('level_menu') is-invalid @enderror" required>
                                    <option value="0" {{ $menu->id_parent == 0 ? 'selected' : '' }}>Menu Utama</option>
                                    @foreach ($menus as $m)
                                        <option value="{{ $m->id_menu }}"
                                            {{ $menu->id_parent == $m->id_menu ? 'selected' : '' }}>
                                            {{ $m->nama_menu }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('level_menu')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Nama Menu -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="nama_menu" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-heading text-success me-2"></i>Nama Menu
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_menu" id="nama_menu"
                                    class="form-control form-control-lg @error('nama_menu') is-invalid @enderror"
                                    value="{{ old('nama_menu', $menu->nama_menu) }}" required
                                    placeholder="Masukkan nama menu">
                                @error('nama_menu')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Position -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-arrows-alt text-success me-2"></i>Position
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="position" id="positionTop"
                                            value="Top" {{ $menu->position == 'Top' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="positionTop">
                                            <i class="fas fa-arrow-up me-1"></i> Top
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="position" id="positionBottom"
                                            value="Bottom" {{ $menu->position == 'Bottom' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="positionBottom">
                                            <i class="fas fa-arrow-down me-1"></i> Bottom
                                        </label>
                                    </div>
                                </div>
                                @error('position')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Urutan -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="urutan" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-sort-numeric-up text-success me-2"></i>Urutan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="urutan" id="urutan"
                                    class="form-control form-control-lg @error('urutan') is-invalid @enderror"
                                    value="{{ old('urutan', $menu->urutan) }}" required
                                    placeholder="Masukkan urutan menu" style="width: 100px;">
                                @error('urutan')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Aktif -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="aktif" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-toggle-on text-success me-2"></i>Status Aktif
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="aktif" id="aktif"
                                    class="form-select form-control-lg @error('aktif') is-invalid @enderror" required>
                                    <option value="Ya" {{ $menu->aktif == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ $menu->aktif == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('aktif')
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
                                    <i class="fas fa-save me-2"></i>Update Menu
                                </button>
                                <a href="{{ route('kontenmenu') }}"
                                    class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
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

        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.2em;
        }

        .form-check-label {
            margin-left: 0.5em;
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
