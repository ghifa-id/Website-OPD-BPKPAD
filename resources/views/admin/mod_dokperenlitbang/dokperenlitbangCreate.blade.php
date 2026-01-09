@extends('admin.layouts.app')

@section('title', 'Tambah Dokumen Perencanaan dan Litbang')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h6 class="text-white text-capitalize mb-0">
                            <i class="fas fa-file-alt me-2"></i>Tambah Dokumen Perencanaan dan Litbang
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

                <form action="{{ route('store.dokperenlitbang') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <strong><i class="fas fa-exclamation-triangle me-2"></i>Perhatian!</strong>
                                Silakan Upload 1 File dengan ekstensi (*.pdf). Dokumen yang terpecah beberapa bagian file,
                                silahkan digabungkan terlebih dahulu kedalam bentuk *.pdf menjadi 1 File Dokumen,
                                baru kemudian di Upload ke Website.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-file-signature text-success me-2"></i>Nama Dokumen
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="jenis" id="jenis"
                                    class="form-control form-control-lg @error('jenis') is-invalid @enderror" required>
                                    <option value="0" disabled selected>--Pilih Dokumen--</option>
                                    <option value="1">Rencana Pembangunan Jangka Panjang Daerah</option>
                                    <option value="2">Rencana Tata Ruang Wilayah</option>
                                    <option value="3">Rencana Pembangunan Jangka Menengah Daerah</option>
                                    <option value="4">Rencana Penanggulangan Kemiskinan Daerah</option>
                                    <option value="5">Roadmap Pembangunan Ekonomi</option>
                                    <option value="6">Rencana Strategis</option>
                                    <option value="7">Rencana Kerja Pemerintah Daerah</option>
                                    <option value="8">Musyawarah Perencanaan Pembangunan</option>
                                    <option value="9">Rencana Kerja</option>
                                    <option value="10">Perjanjian Kinerja</option>
                                    <option value="11">Rencana Kerja Tahunan</option>
                                    <option value="12">KUA dan PPAS</option>
                                    <option value="13">Rencana Kebijakan Anggaran</option>
                                    <option value="14">Evaluasi RPJMD</option>
                                    <option value="15">Evaluasi RKPD</option>
                                    <option value="16">Evaluasi Renja</option>
                                    <option value="17">Evaluasi Pelaksanaan DAK</option>
                                    <option value="18">Serapan Anggaran</option>
                                    <option value="19">Penelitian</option>
                                    <option value="20">Inovasi</option>
                                    <option value="21">Monev</option>
                                    <option value="22">Indeks Daya Saing Daerah (IDSD)</option>
                                    <option value="23">Kajian - Peraturan Daerah</option>
                                    <option value="24">Kajian - Peraturan Bupati</option>
                                    <option value="25">Kajian - Peraturan Kepala Badan</option>
                                    <option value="26">Rencana Kerja Pemerintah Daerah - Perubahan</option>
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun_dokumen" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-calendar-alt text-success me-2"></i>Tahun Dokumen
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="tahun_dokumen" id="tahun_dokumen"
                                    class="form-control form-control-lg @error('tahun_dokumen') is-invalid @enderror"
                                    value="{{ old('tahun_dokumen') }}" min="1900" max="{{ date('Y') + 1 }}" required>
                                @error('tahun_dokumen')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover_file" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-image text-success me-2"></i>Cover Dokumen (Opsional)
                                </label>
                                <input type="file" name="cover_file" id="cover_file"
                                    class="form-control form-control-lg @error('cover_file') is-invalid @enderror"
                                    accept="image/*" onchange="previewCover()">
                                @error('cover_file')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle text-info me-1"></i>
                                    Format: JPG/PNG • Maksimal 2MB
                                </div>
                                <div id="coverPreview" class="mt-3 text-center" style="display: none;">
                                    <img id="previewImage" src="#" alt="Preview Cover"
                                        style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file" class="form-label fw-bold text-dark mb-2">
                                    <i class="fas fa-file-pdf text-success me-2"></i>File Dokumen (PDF)
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="nama_file" id="file"
                                    class="form-control form-control-lg @error('file') is-invalid @enderror"
                                    accept=".pdf" required onchange="return validasiFile()">
                                @error('file')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle text-info me-1"></i>
                                    Format: PDF • Maksimal 5MB
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
                                <a href="{{ route('dokperenlitbang') }}"
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
        function validasiFile() {
            var inputFile = document.getElementById('file');
            var pathFile = inputFile.value;
            var ekstensiOk = /(\.pdf)$/i;

            if (!ekstensiOk.exec(pathFile)) {
                alert('Silakan upload file PDF saja');
                inputFile.value = '';
                return false;
            }

            if (inputFile.files[0].size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                inputFile.value = '';
                return false;
            }

            return true;
        }

        function previewCover() {
            const input = document.getElementById('cover_file');
            const preview = document.getElementById('coverPreview');
            const image = document.getElementById('previewImage');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!allowedTypes.includes(file.type)) {
                    alert('File harus berupa gambar (jpg/png/jpeg)');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran gambar maksimal 2MB.');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
