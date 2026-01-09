@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-sm border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 mb-0">Edit User</h6>
                </div>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- The form action will point to an update route, and we'll use the PUT method --}}
                <form action="{{ route('update.manajemenuser', $user->id_username) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Hidden input for user ID (already exists, but important for clarity in an edit form) --}}
                    <input type="hidden" name="id" value="{{ $user->id_username }}">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label fw-semibold">
                                Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="username" id="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username', $user->username) }}" required autofocus
                                placeholder="Masukkan username">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label fw-semibold">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required
                                placeholder="Masukkan nama lengkap">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" required placeholder="contoh@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="no_telp" class="form-label fw-semibold">No Telepon</label>
                            <input type="text" name="no_telp" id="no_telp"
                                class="form-control @error('no_telp') is-invalid @enderror"
                                value="{{ old('no_telp', $user->no_telp) }}" placeholder="08xxxxxxxxxx">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="level" class="form-label fw-semibold">
                                Level <span class="text-danger">*</span>
                            </label>
                            <select name="level" id="level" class="form-select @error('level') is-invalid @enderror"
                                required>
                                <option value="">Pilih Level</option>
                                <option value="admin" {{ old('level', $user->level) == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="kontributor"
                                    {{ old('level', $user->level) == 'kontributor' ? 'selected' : '' }}>
                                    Kontributor
                                </option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="blokir" class="form-label fw-semibold">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select name="blokir" id="blokir" class="form-select @error('blokir') is-invalid @enderror"
                                required>
                                <option value="">Pilih Status</option>
                                <option value="N" {{ old('blokir', $user->blokir) == 'N' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="Y" {{ old('blokir', $user->blokir) == 'Y' ? 'selected' : '' }}>Blokir
                                </option>
                            </select>
                            @error('blokir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">
                                Password
                                @if (!$user->password)
                                    {{-- Only show asterisk if password is empty (e.g., initial creation) --}}
                                    <span class="text-danger">*</span>
                                @else
                                    <small class="text-muted">(Kosongkan jika tidak ingin mengubah password)</small>
                                @endif
                            </label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Minimum 8 karakter">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="foto" class="form-label fw-semibold">Foto Profil</label>
                            <input type="file" name="foto" id="foto"
                                class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPG, PNG, maksimal 2MB</div>

                            @if ($user->foto)
                                <div class="mt-2">
                                    <p class="mb-1 text-muted">Foto saat ini:</p>
                                    <img src="{{ asset('storage/users/' . $user->foto) }}" alt="Foto Profil"
                                        class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="fas fa-save me-1"></i> Update User
                        </button>
                        <a href="{{ route('manajemenuser') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #495057;
            box-shadow: 0 0 0 0.2rem rgba(73, 80, 87, 0.25);
        }

        .form-label {
            color: #495057;
            margin-bottom: 8px;
        }

        .btn {
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #212529;
            transform: translateY(-1px);
        }

        .btn-outline-secondary:hover {
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .text-danger {
            font-weight: 600;
        }

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
@endpush
