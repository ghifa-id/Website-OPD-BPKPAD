@extends('admin.layouts.app')

@section('title', 'Edit Konten PPID')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4 shadow-lg border-0">
            <div class="card-header bg-gradient-success text-white rounded-top">
                <h5 class="mb-0 text-white">
                    <i class="fas fa-edit me-2 text-white"></i>Edit Konten PPID
                </h5>
            </div>

            <div class="card-body p-5 bg-light">
                <div class="alert alert-danger">
                    <strong>Perhatian!</strong> Silahkan upload 1 file dengan ekstensi (*.pdf). Jika dokumen terpecah
                    beberapa bagian, harap digabung terlebih dahulu menjadi 1 file PDF.
                </div>

                <form action="{{ route('update.ppidKontenAdmin', $data->id_ppidkonten) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="jenis" class="form-label fw-bold">
                            <i class="fas fa-tag me-2 text-success"></i>Nama Konten <span class="text-danger">*</span>
                        </label>
                        <select name="jenis" id="jenis"
                            class="form-control form-select @error('jenis') is-invalid @enderror" required>
                            <option value="">-- Pilih Konten --</option>
                            @foreach([
                                1 => 'SK PPID',
                                2 => 'Struktur PPID',
                                3 => 'Tugas & Fungsi PPID',
                                4 => 'Pedoman Pelayanan Informasi Publik',
                                5 => 'Form Permohonan Informasi',
                                6 => 'Form Pengajuan Keberatan',
                                7 => 'Maklumat Pelayanan',
                                8 => 'SOP Permohonan Informasi Publik',
                                9 => 'SOP Penanganan Keberatan Informasi Publik',
                                10 => 'Tata Cara Pengaduan',
                                11 => 'SK DIP',
                                99 => 'Informasi Dikecualikan',
                            ] as $key => $label)
                                <option value="{{ $key }}" {{ $data->jenis == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="file" class="form-label fw-bold">
                            <i class="fas fa-upload me-2 text-success"></i>Ganti File PDF (Opsional)
                        </label>
                        <input type="file" name="file" id="file"
                            class="form-control @error('file') is-invalid @enderror" accept=".pdf"
                            onchange="return validasiFile()">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($data->nama_file)
                            <p class="mt-2">
                                <a href="{{ asset('asset/files/' . $data->nama_file) }}" target="_blank">
                                    ?? Lihat File Saat Ini
                                </a>
                            </p>
                        @endif
                        <small class="form-text">Hanya file PDF yang diterima.</small>
                    </div>

                    <div class="d-flex justify-content-between pt-3 flex-wrap gap-3">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('ppidkonten') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function validasiFile() {
        var inputFile = document.getElementById('file');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.pdf)$/i;
        if (!ekstensiOk.exec(pathFile)) {
            alert('Silakan upload file dengan ekstensi (.pdf) saja.');
            inputFile.value = '';
            return false;
        }
        return true;
    }
</script>
@endpush
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
