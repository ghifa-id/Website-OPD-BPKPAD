@extends('guest.layouts.app')

@section('content')
    <div class="container py-5" style="min-height: 100vh; background: linear-gradient(135deg, #f0fdf4, #e0f7fa);">
        <div class="mx-auto p-5 glass-card" style="max-width: 700px;">
            <h2 class="text-center mb-3 fw-bold text-success">Sampaikan Aduan Anda</h2>
            <p class="text-center text-secondary mb-4 fs-6">
                Jangan ragu untuk menyampaikan masalah atau keluhan yang Anda alami. Kami siap mendengarkan dan membantu
                memberikan solusi terbaik.
            </p>

            <form action="{{ route('kepuasanPublik.Store') }}" method="POST">
                @csrf

                {{-- Nama --}}
                <div class="mb-4">
                    <label for="nama" class="form-label fw-semibold">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control input-modern"
                        placeholder="Masukkan nama Anda" required>
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">Email (Opsional)</label>
                    <input type="email" name="email" id="email" class="form-control input-modern"
                        placeholder="contoh@email.com">
                </div>

                {{-- Skor Emoji --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Seberapa puas Anda terhadap layanan kami?</label>
                    <div class="d-flex justify-content-between mt-3 skor-emoji gap-2">
                        @foreach ([
            1 => ['icon' => '😠', 'label' => 'Sangat Tidak Puas'],
            2 => ['icon' => '😞', 'label' => 'Tidak Puas'],
            3 => ['icon' => '😐', 'label' => 'Cukup'],
            4 => ['icon' => '🙂', 'label' => 'Puas'],
            5 => ['icon' => '😁', 'label' => 'Sangat Puas'],
        ] as $i => $data)
                            <label class="text-center pointer">
                                <input type="radio" name="skor" value="{{ $i }}" class="d-none" required>
                                <div class="emoji-box p-2 rounded-3 hover-shadow">
                                    <span class="emoji fs-3 d-block">{{ $data['icon'] }}</span>
                                    <div class="small text-muted mt-1">{{ $data['label'] }}</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>


                {{-- Menemukan Informasi --}}
                <div class="mb-4 text-center">
                    <label class="form-label fw-semibold mb-3 d-block">Apakah Anda dapat menemukan informasi yang Anda cari?
                        <span class="text-danger">*</span></label>
                    <div class="d-flex justify-content-center gap-5">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="informasi" id="menemukan_ya" value="Ya"
                                required>
                            <label class="form-check-label" for="menemukan_ya">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="informasi" id="menemukan_tidak"
                                value="Tidak">
                            <label class="form-check-label" for="menemukan_tidak">Tidak</label>
                        </div>
                    </div>
                </div>

                {{-- Komentar --}}
                <div class="mb-4">
                    <label for="komentar" class="form-label fw-semibold">Kritik dan saran Anda untuk website
                        Bapedalitbang</label>
                    <textarea name="komentar" id="komentar" class="form-control input-modern" rows="4"
                        placeholder="Sampaikan komentar atau saran..."></textarea>
                </div>

                {{-- Fitur Diinginkan --}}
                <div class="mb-4">
                    <label for="fitur" class="form-label fw-semibold">Fitur apa yang Anda inginkan namun belum tersedia
                        di website Bappedalitbang
                        <span class="text-danger">*</span></label>
                    <textarea name="fitur" id="fitur" class="form-control input-modern" rows="3"
                        placeholder="Contoh: pencarian dokumen, kalender agenda..." required></textarea>
                </div>

                {{-- Tombol --}}
                <div class="text-center">
                    <button type="submit"
                        class="btn btn-success px-5 py-2 rounded-pill fw-semibold shadow-sm transition">Kirim
                        Jawaban</button>
                </div>
            </form>

            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terima kasih!',
                            text: '{{ session('success') }}',
                            confirmButtonColor: '#198754',
                            confirmButtonText: 'Tutup'
                        });
                    });
                </script>
            @endif
        </div>
    </div>

    {{-- Style --}}
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 1rem;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .input-modern {
            border-radius: 0.7rem;
            padding: 0.75rem 1rem;
            background-color: #ffffffdd;
            border: 1.5px solid #ced4da;
            transition: all 0.3s ease-in-out;
        }

        .input-modern:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
            background-color: #fff;
        }

        .skor-emoji label .emoji-box {
            transition: transform 0.25s ease, filter 0.25s ease;
            padding: 0.5rem 0.75rem;
            border-radius: 0.75rem;
        }

        .skor-emoji input[type="radio"]:checked+.emoji-box .emoji {
            transform: scale(1.3);
            filter: drop-shadow(0 0 10px #198754);
        }

        .skor-emoji label:hover .emoji {
            transform: scale(1.15);
        }

        .pointer {
            cursor: pointer;
        }

        .transition {
            transition: all 0.3s ease-in-out;
        }

        .btn-success:hover {
            background-color: #157347;
        }

        .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }
    </style>
@endsection
