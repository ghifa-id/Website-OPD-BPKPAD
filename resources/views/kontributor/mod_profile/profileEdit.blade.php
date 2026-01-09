@extends('kontributor.layouts.app')





@section('title', 'Edit Profil')



@section('content')

    <div class="container-fluid px-4">

        <div class="card my-4 shadow-sm border-0">

            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">

                    <h6 class="text-white text-capitalize ps-3 mb-0">Edit Profil Saya</h6>

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



                <form action="{{ route('Kontributor_update_profil') }}" method="POST" enctype="multipart/form-data">

                    @csrf





                    <div class="row mb-3">

                        <div class="col-md-6">

                            <label for="username" class="form-label fw-semibold">Username</label>

                            <input type="text" class="form-control" value="{{ $user->username }}" readonly>

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

                            <label for="password" class="form-label fw-semibold">

                                Password Baru

                                <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>

                            </label>

                           <input type="password" name="password_confirmation" id="password_confirmation"

                                class="form-control @error('password') is-invalid @enderror"

                                placeholder="Minimum 8 karakter">

                            @error('password')

                                <div class="invalid-feedback">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label for="password_confirmation" class="form-label fw-semibold">

                                Konfirmasi Password Baru

                            </label>

                             <input type="password" name="password_confirmation" id="password_confirmation"

                                class="form-control" placeholder="Ulangi password baru">

                        </div>

                    </div>



                    <div class="row mb-4">

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

                            <i class="fas fa-save me-1"></i> Simpan Perubahan

                        </button>

                        <a href="{{ url('administrator/beranda') }}" class="btn btn-outline-secondary px-4">

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

