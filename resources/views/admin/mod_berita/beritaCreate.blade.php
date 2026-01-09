@extends('admin.layouts.app')

@section('title', 'Tambah Berita Terbaru')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-newspaper me-2"></i>Tambah Berita Terbaru
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
                <form action="{{ route('store.listberita') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">

                    {{-- Judul --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-heading text-success me-2"></i>Judul <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" class="form-control form-control-lg"
                            value="{{ old('judul') }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-heading text-success me-2"></i>Sub Judul
                        </label>
                        <input type="text" name="sub_judul" class="form-control form-control-lg"
                            value="{{ old('sub_judul') }}">
                    </div>

                    {{-- Video Youtube --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fab fa-youtube text-success me-2"></i>Video YouTube
                        </label>
                        <input type="text" name="youtube" class="form-control form-control-lg"
                            placeholder="Contoh: http://www.youtube.com/embed/xbuEmoRWQHU" value="{{ old('youtube') }}">
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-tags text-success me-2"></i>Pilih Kategori <span class="text-danger">*</span>
                        </label>
                        <select name="id_kategori" class="form-select form-control-lg" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $row)
                                <option value="{{ $row->id_kategori }}"
                                    {{ old('id_kategori') == $row->id_kategori ? 'selected' : '' }}>
                                    {{ $row->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Berita Utama --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2 d-block">
                            <i class="fas fa-star text-success me-2"></i>Berita Utama <span class="text-danger">*</span>
                        </label>
                        <label class="me-3"><input type="radio" name="utama" value="Y"
                                {{ old('utama', 'Y') == 'Y' ? 'checked' : '' }}> Ya</label>
                        <label><input type="radio" name="utama" value="N"
                                {{ old('utama') == 'N' ? 'checked' : '' }}> Tidak</label>
                    </div>

                    {{-- Isi Berita --}}
                     <div class="mb-3">
                        <label for="isi_berita" class="form-label fw-medium">Isi Berita <span
                            class="text-danger">*</span></label>
                            <textarea name="isi_berita" id="editor1" class="form-control @error('isi_berita') is-invalid @enderror" rows="6"
                                placeholder="Masukkan isi berita" required>{{ old('isi_berita') }}</textarea>
                                @error('isi_berita')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                    </div>


                    {{-- Gambar Upload --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-image text-success me-2"></i>Gambar
                        </label>
                        <input type="file" name="gambar" class="form-control form-control-lg" accept="image/*">
                        <small class="text-muted d-block mt-1">* Maksimal ukuran 3MB (jpg, jpeg, png)</small>
                    </div>

                    {{-- Keterangan Gambar --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-pen text-success me-2"></i>Keterangan Gambar
                        </label>
                        <input type="text" name="keterangan_gambar" class="form-control form-control-lg"
                            value="{{ old('keterangan_gambar') }}">
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label fw-bold text-dark mb-2">
                            <i class="fas fa-tag text-success me-2"></i>Tag (pisahkan dengan koma)
                        </label>
                        <input type="text" name="tag" class="form-control form-control-lg"
                            placeholder="Contoh: berita, nasional, pemerintahan" value="{{ old('tag') }}">
                        <small class="form-text">Gunakan tanda koma (,) untuk memisahkan beberapa tag.</small>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-3 pt-4 border-top">
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                            <i class="fas fa-save me-2"></i>Simpan Berita
                        </button>
                        <a href="{{ route('listberita') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>



                </form>
            </div>
        </div>
    </div>
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
                // Image upload handling
                const imageInput = document.querySelector('input[name="gambar"]');
                const uploadArea = document.createElement('div');
                uploadArea.className = 'upload-area border-dashed rounded-lg p-4 text-center cursor-pointer mb-3';
                uploadArea.innerHTML = `
            <div id="uploadContent">
                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                <h5 class="mb-1">Drag & Drop gambar atau klik untuk memilih</h5>
                <p class="text-muted mb-0">Format: JPG, JPEG, PNG (Maks. 3MB)</p>
            </div>
            <div id="imagePreview" class="d-none"></div>
            <div id="imageActions" class="d-none mt-3">
                <button id="removeImage" type="button" class="btn btn-sm btn-danger me-2">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>
                <button id="changeImage" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-sync me-1"></i> Ganti
                </button>
            </div>
        `;

                // Insert the upload area after the image input
                if (imageInput) {
                    imageInput.parentNode.insertBefore(uploadArea, imageInput.nextSibling);
                    imageInput.style.display = 'none';
                }

                const uploadContent = document.getElementById('uploadContent');
                const imagePreview = document.getElementById('imagePreview');
                const imageActions = document.getElementById('imageActions');
                const removeBtn = document.getElementById('removeImage');
                const changeBtn = document.getElementById('changeImage');

                // Handle click on upload area
                uploadArea.addEventListener('click', function() {
                    if (!imagePreview.classList.contains('d-none')) return;
                    imageInput.click();
                });

                // Handle file input change
                imageInput.addEventListener('change', function(e) {
                    handleImageSelect(e.target.files[0]);
                });

                // Handle drag and drop
                uploadArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    uploadArea.classList.add('border-success');
                    uploadArea.style.backgroundColor = 'rgba(0,0,0,0.05)';
                });

                uploadArea.addEventListener('dragleave', function() {
                    uploadArea.classList.remove('border-success');
                    uploadArea.style.backgroundColor = '';
                });

                uploadArea.addEventListener('drop', function(e) {
                    e.preventDefault();
                    uploadArea.classList.remove('border-success');
                    uploadArea.style.backgroundColor = '';
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        handleImageSelect(files[0]);
                        imageInput.files = files;
                    }
                });

                // Handle image selection with preview
                function handleImageSelect(file) {
                    if (file) {
                        // Validate file size (max 3MB)
                        if (file.size > 3 * 1024 * 1024) {
                            alert('Ukuran file terlalu besar. Maksimal 3MB.');
                            return;
                        }

                        // Validate file type
                        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                        if (!validTypes.includes(file.type)) {
                            alert('Format file tidak didukung. Harap upload file JPG, JPEG atau PNG.');
                            return;
                        }

                        // Show image preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.innerHTML = '';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '100%';
                            img.style.maxHeight = '200px';
                            img.style.objectFit = 'contain';
                            imagePreview.appendChild(img);

                            uploadContent.classList.add('d-none');
                            imagePreview.classList.remove('d-none');
                            imageActions.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                }

                // Remove image
                removeBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    imageInput.value = '';
                    uploadContent.classList.remove('d-none');
                    imagePreview.classList.add('d-none');
                    imageActions.classList.add('d-none');
                });

                // Change image
                changeBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    imageInput.click();
                });
            });
        </script>
    @endpush
@endsection
