@extends('kontributor.layouts.app')


@section('title', 'Edit Berita')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-edit me-2"></i>Edit Berita
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-5">

                {{-- Notifikasi --}}
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

                {{-- Form --}}
                <form action="{{ route('update_listberita', ['id_berita' => $berita->id_berita]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf


                    {{-- Judul --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-heading text-primary me-2"></i>Judul <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" class="form-control form-control-lg"
                            value="{{ old('judul', $berita->judul) }}" required>
                    </div>

                    {{-- Sub Judul --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-heading text-primary me-2"></i>Sub Judul
                        </label>
                        <input type="text" name="sub_judul" class="form-control form-control-lg"
                            value="{{ old('sub_judul', $berita->sub_judul) }}">
                    </div>

                    {{-- Video Youtube --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fab fa-youtube text-primary me-2"></i>Video YouTube
                        </label>
                        <input type="text" name="youtube" class="form-control form-control-lg"
                            placeholder="Contoh: http://www.youtube.com/embed/xbuEmoRWQHU"
                            value="{{ old('youtube', $berita->youtube) }}">
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-tags text-primary me-2"></i>Pilih Kategori <span class="text-danger">*</span>
                        </label>
                        <select name="id_kategori" class="form-select form-control-lg" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $row)
                                <option value="{{ $row->id_kategori }}"
                                    {{ old('id_kategori', $berita->id_kategori) == $row->id_kategori ? 'selected' : '' }}>
                                    {{ $row->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Berita Utama --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2 d-block">
                            <i class="fas fa-star text-primary me-2"></i>Berita Utama <span class="text-danger">*</span>
                        </label>
                        <label class="me-3"><input type="radio" name="utama" value="Y"
                                {{ old('utama', $berita->utama) == 'Y' ? 'checked' : '' }}> Ya</label>
                        <label><input type="radio" name="utama" value="N"
                                {{ old('utama', $berita->utama) == 'N' ? 'checked' : '' }}> Tidak</label>
                    </div>

                    {{-- Isi Berita --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-align-left text-primary me-2"></i>Isi Berita <span class="text-danger">*</span>
                        </label>
                        <textarea name="isi_berita" class="form-control form-control-lg" style="min-height: 200px;" required>{{ old('isi_berita', $berita->isi_berita) }}</textarea>
                    </div>

                    {{-- Current Image --}}
                    @if ($berita->gambar)
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold text-dark mb-2">
                                <i class="fas fa-image text-primary me-2"></i>Gambar Saat Ini
                            </label>
                            <div class="mb-3">
                                <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="Gambar Berita"
                                    class="img-thumbnail" style="max-height: 200px;">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="hapus_gambar" id="hapus_gambar"
                                        value="1">
                                    <label class="form-check-label" for="hapus_gambar">
                                        Hapus gambar ini
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- New Image Upload --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i
                                class="fas fa-image text-primary me-2"></i>{{ $berita->gambar ? 'Ganti Gambar' : 'Upload Gambar' }}
                        </label>
                        <input type="file" name="gambar" class="form-control form-control-lg" accept="image/*">
                        <small class="text-muted d-block mt-1">* Maksimal ukuran 3MB (jpg, jpeg, png)</small>
                    </div>

                    {{-- Keterangan Gambar --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-pen text-primary me-2"></i>Keterangan Gambar
                        </label>
                        <input type="text" name="keterangan_gambar" class="form-control form-control-lg"
                            value="{{ old('keterangan_gambar', $berita->keterangan_gambar) }}">
                    </div>

                    {{-- Tag --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-tags text-primary me-2"></i>Tag
                        </label>
                        <input type="text" name="tag" class="form-control form-control-lg"
                            value="{{ old('tag', $berita->tag) }}" placeholder="Pisahkan dengan koma">
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-3 pt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                            <i class="fas fa-save me-2"></i>Update Berita
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #000000 0%, #2d3748 100%);
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 15px 20px;
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

        .btn-primary {
            background: linear-gradient(135deg, #000000 0%, #2d3748 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            border-radius: 12px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
        }

        .btn-outline-secondary {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #64748b;
        }

        .btn-outline-secondary:hover {
            background-color: #f8fafc;
            color: #475569;
            transform: translateY(-2px);
        }

        .img-thumbnail {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 5px;
        }
    </style>
@endpush
