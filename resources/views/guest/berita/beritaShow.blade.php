@extends('guest.layouts.app')



@section('title', 'Bapedalitbang')



@section('content')



    <section class="news-details-section">

        <div class="container">

            <div class="row">

                <nav aria-label="breadcrumb" class="mb-3">

                    <ol class="breadcrumb bg-transparent p-0">

                        <li class="breadcrumb-item">

                            <a href="{{ url('/') }}" class="text-decoration-none text-success">

                                <i class="fa fa-home me-1"></i> Beranda

                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="{{ url('/berita/all') }}" class="text-decoration-none text-success">

                                Seluruh Berita

                            </a>

                        </li>

                        <li class="breadcrumb-item active text-dark" aria-current="page">

                            Berita

                        </li>

                    </ol>

                </nav>

                <div class="col-lg-8">

                    <div class="content-box-glass p-4 rounded">

                        @if ($berita)

                            <div class="service-details-content-box mb-4">

                                <h3 class="service-details-title">{{ $berita->judul }}</h3>



                                <div class="mb-3 text-muted" style="font-size: 0.9em;">

                                    <i class="fa fa-calendar"></i>

                                    {{ \Carbon\Carbon::parse($berita->tgl_posting)->format('d M Y') }}

                                    <i class="fa fa-clock ms-3"></i>

                                    {{ $berita->jam }} WIB

                                    <i class="fa fa-eye ms-3"></i>

                                    {{ $berita->dibaca }}x dibaca

                                </div>



                                @if ($berita->gambar)
                                    <div class="mb-3 text-center">

                                        <img src="{{ asset('asset/foto_berita/' . $berita->gambar) }}"
                                            alt="{{ $berita->judul }}" class="img-fluid rounded"
                                            style="max-height: 400px; object-fit: cover;" loading="lazy">

                                    </div>
                                @endif

                                <div>{!! $berita->isi_berita !!}</div>

                                <i class="fa fa-user"></i> {{ $berita->user->nama_lengkap ?? $berita->username }}
                                {{-- Reaksi Suka / Tidak Suka --}}
                                <div class="border-top pt-4 mt-4">
                                    <h5 class="mb-3 text-muted">Berikan Reaksi Anda:</h5>
                                    <div class="d-flex gap-3 align-items-center">
                                        <button id="likeBtn"
                                            class="btn btn-outline-success d-flex align-items-center gap-2">
                                            <i class="fas fa-thumbs-up"></i>
                                            <span id="likeCount">{{ $berita->likes_count }}</span>
                                        </button>
                                        <button id="dislikeBtn"
                                            class="btn btn-outline-danger d-flex align-items-center gap-2">
                                            <i class="fas fa-thumbs-down"></i>
                                            <span id="dislikeCount">{{ $berita->dislikes_count }}</span>
                                        </button>
                                    </div>
                                </div>


                            </div>
                        @else
                            <p>Konten halaman tidak ditemukan.</p>

                        @endif


                        <div class="news-details-meta-box">

                            <div class="news-details-meta-box-inner">

                                <h3 class="comments-title">

                                    {{ $berita->komentar->count() }} Komentar

                                </h3>



                                @if ($berita && $berita->komentar->count() > 0)

                                    <ul class="comments-list">

                                        @foreach ($berita->komentar as $komen)
                                            <li class="comment-item">

                                                <div class="comment-avatar">

                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($komen->nama_pengguna) }}&background=6c757d&color=fff&size=48"
                                                        alt="Avatar" loading="lazy">

                                                </div>

                                                <div class="comment-content">

                                                    <div class="comment-header">

                                                        <strong>{{ $komen->nama_pengguna }}</strong>

                                                        <small class="comment-email">({{ $komen->email }})</small>

                                                    </div>

                                                    <p class="comment-text">{{ $komen->isi_komentar }}</p>

                                                    <small
                                                        class="comment-date">{{ $komen->created_at->format('d M Y H:i') }}</small>

                                                </div>

                                            </li>
                                        @endforeach

                                    </ul>
                                @else
                                    <p>Belum ada komentar.</p>

                                @endif

                            </div>

                        </div>





                        <div class="news-details-share-box">

                            <div class="news-details-inner">

                                <div class="news-details-list">

                                    <div class="news-details-list-title">

                                        <h4>Share :</h4>

                                    </div><!-- news-details-list-title -->

                                    <div class="news-details-socials">

                                        <!-- Facebook Share -->

                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('Berita/' . $berita->judul_seo)) }}"
                                            target="_blank" rel="noopener noreferrer" title="Share on Facebook">

                                            <i class="fa-brands fa-facebook"></i>

                                        </a>



                                        <!-- Instagram tidak punya share URL resmi, biasanya share manual -->
                                        <!-- Jadi kita bisa skip Instagram atau ganti ke Twitter -->

                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('Berita/' . $berita->judul_seo)) }}&text={{ urlencode($berita->judul) }}"
                                            target="_blank" rel="noopener noreferrer" title="Share on Twitter">

                                            <i class="fa-brands fa-twitter"></i>

                                        </a>



                                        <!-- WhatsApp Share -->

                                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . url('berita/' . $berita->judul_seo)) }}"
                                            target="_blank" rel="noopener noreferrer" title="Share on WhatsApp">

                                            <i class="fa-brands fa-whatsapp"></i>

                                        </a>

                                    </div>



                                </div><!-- news-details-list -->




                                <div class="news-details-list">





                                    <div class="news-details-list mt-3">
                                    <h4>Kategori</h4>
                                    <div class="news-details-list-button">
                                        @if ($berita->kategori)
                                            <a href="{{ url('berita/kategori/' . $berita->kategori->kategori_seo) }}"
                                                class="btn btn-kominfo">
                                                {{ $berita->kategori->nama_kategori }}
                                            </a>
                                        @else
                                            <span class="btn btn-secondary">Kategori tidak tersedia</span>
                                        @endif
                                    </div>
                                </div>




                                </div><!-- news-details-list -->





                            </div><!-- news-details-inner -->

                        </div><!-- news-details-share-box -->



                        <form id="commentForm" class="needs-validation" novalidate>

                            @csrf

                            <input type="hidden" name="id" id="id_berita" value="{{ $berita->id_berita }}">



                            <div class="mb-3">

                                <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna"
                                    placeholder="Your name" value="{{ old('nama_pengguna') }}" required>

                                <div class="invalid-feedback">Please enter your name.</div>

                            </div>

                            <div class="mb-3">

                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email address" value="{{ old('email') }}" required>

                                <div class="invalid-feedback">Please enter a valid email.</div>

                            </div>

                            <div class="mb-3">

                                <textarea class="form-control" name="isi_komentar" id="isi_komentar" placeholder="Write a message" rows="4"
                                    required>{{ old('isi_komentar') }}</textarea>

                                <div class="invalid-feedback">Please write a comment.</div>

                            </div>

                            <button type="submit" class="btn btn-success">Submit Comment</button>

                        </form>



                        <div id="commentSuccessMsg" class="alert alert-success mt-3 d-none"></div>

                        <div id="commentErrorMsg" class="alert alert-danger mt-3 d-none"></div>







                    </div><!-- col-lg-8 -->

                </div>



                {{-- Side Berita --}}

                <div class="col-12 col-lg-4 col-xl-4">

                    <div class="custom-card-glass">

                        <div class="card-body">



                            <a href="{{ route('showBeritaAll') }}" class="btn btn-lihat-semua border  mb-2 mt-3">

                                Lihat Semua Berita

                                <i class="fas fa-arrow-up-right-from-square"
                                    style="font-size: 0.8em; margin-left: 6px; color: inherit;"></i>

                            </a>



                            <!-- Tabs -->

                            <div class="d-flex gap-5 mb-1">

                                <ul class="nav nav-tabs nav-tabs-berita mb-3" id="beritaTab" role="tablist">

                                    <li class="nav-item" role="presentation">

                                        <button class="nav-link active" id="terbaru-tab" data-bs-toggle="tab"
                                            data-bs-target="#terbaru" type="button" role="tab"
                                            aria-controls="terbaru" aria-selected="true">Terbaru</button>

                                    </li>

                                    <li class="nav-item" role="presentation">

                                        <button class="nav-link" id="terpopuler-tab" data-bs-toggle="tab"
                                            data-bs-target="#terpopuler" type="button" role="tab"
                                            aria-controls="terpopuler" aria-selected="false">Terpopuler</button>

                                    </li>

                                </ul>

                            </div>



                            <!-- Konten Tab -->

                            <div class="tab-content tab-content-berita" id="beritaTabContent">

                                <!-- Berita Terbaru -->

                                <div class="tab-pane fade show active" id="terbaru" role="tabpanel"
                                    aria-labelledby="terbaru-tab">

                                    @foreach ($beritaTerbaru as $item)
                                        <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"
                                            class="mb-3 berita-item d-block text-decoration-none text-dark">

                                            <h6 class="mb-1 fs-6">{{ $item->judul }}</h6>

                                            <small class="text-muted berita-meta">

                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} |

                                                {{ $item->jam }} |

                                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $item->dibaca }} |

                                                <i class="fa fa-user" aria-hidden="true" style="margin-left: 6px;"></i>

                                                {{ $item->user->nama_lengkap ?? $item->username }}

                                            </small>

                                        </a>
                                    @endforeach

                                </div>



                                <!-- Berita Terpopuler -->

                                <div class="tab-pane fade" id="terpopuler" role="tabpanel"
                                    aria-labelledby="terpopuler-tab">

                                    @foreach ($beritaTerpopuler as $item)
                                        <a href="{{ route('berita.detail', ['slug' => $item->judul_seo]) }}"
                                            class="mb-3 berita-item d-block text-decoration-none text-dark">

                                            <h6 class="mb-1 fs-6">{{ $item->judul }}</h6>

                                            <small class="text-muted berita-meta">

                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} |

                                                {{ $item->jam }} |

                                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $item->dibaca }} |

                                                <i class="fa fa-user" aria-hidden="true" style="margin-left: 6px;"></i>

                                                {{ $item->user->nama_lengkap ?? $item->username }}

                                            </small>

                                        </a>
                                    @endforeach

                                </div>

                            </div>



                        </div>

                    </div>

                </div>



                {{-- End Side Berita --}}

            </div><!-- col-lg-4 -->

        </div><!-- row -->

        </div><!-- container -->

    </section><!--causes-one-section-->

@endsection

@push('styles')
    <style>
        .news-details-socials a {

            display: inline-block;

            padding: 6px;

            position: relative;

            top: 0;

        }



        .news-details-socials a i {

            font-size: 24px;

            position: relative;

            top: 0;

            margin: 0;

            transition: color 0.3s ease;

            /* hanya ubah warna saat hover */

        }



        .news-details-socials a:hover i {

            color: #007bff;

        }



        .news-details-meta-box-inner {

            margin-top: 1rem;

        }



        .comments-title {

            font-size: 1.25rem;

            font-weight: 600;

            margin-bottom: 1rem;

            border-bottom: 2px solid #ddd;

            padding-bottom: 0.5rem;

        }



        .comments-list {

            list-style: none;

            padding: 0;

            margin: 0;

        }



        .comment-item {

            display: flex;

            gap: 1rem;

            padding: 1rem 0;

            border-bottom: 1px solid #eee;

        }



        .comment-avatar img {

            border-radius: 50%;

            width: 48px;

            height: 48px;

            object-fit: cover;

            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

        }



        .comment-content {

            flex: 1;

        }



        .comment-header {

            font-weight: 600;

            display: flex;

            align-items: center;

            gap: 0.5rem;

        }



        .comment-email {

            font-weight: 400;

            font-size: 0.85rem;

            color: #666;

        }



        .comment-text {

            margin: 0.25rem 0 0.5rem;

            line-height: 1.4;

            color: #333;

        }



        .comment-date {

            font-size: 0.75rem;

            color: #999;

        }



        .content-box-glass,

        .custom-card-glass {

            box-sizing: border-box;

            max-width: 100%;

            width: 100%;

            overflow-wrap: break-word;

        }



        .form-control {

            border: 2px solid #003b49;

            /* border tebal dan gelap */

            border-radius: 8px;

            /* sudut agak membulat */

            padding: 10px 15px;

            /* ruang dalam supaya nyaman */

            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

            /* bayangan halus supaya kedalaman */

            transition: border-color 0.3s ease, box-shadow 0.3s ease;

        }



        .form-control:focus {

            border-color: #2dcd7c;

            /* border biru saat fokus */



            outline: none;

        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('commentForm');
            const successMsg = document.getElementById('commentSuccessMsg');
            const errorMsg = document.getElementById('commentErrorMsg');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Reset pesan
                successMsg.classList.add('d-none');
                errorMsg.classList.add('d-none');
                successMsg.textContent = '';
                errorMsg.textContent = '';

                // Validasi form HTML5
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }
                form.classList.remove('was-validated');

                // Ambil data input
                const formData = {
                    id: document.getElementById('id_berita').value,
                    nama_pengguna: document.getElementById('nama_pengguna').value.trim(),
                    email: document.getElementById('email').value.trim(),
                    isi_komentar: document.getElementById('isi_komentar').value.trim(),
                };

                // CSRF token dari meta tag Laravel (pastikan ada <meta name="csrf-token" content="{{ csrf_token() }}"> di header)
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');

                try {
                    const response = await fetch(
                        '/komentar/store', { // Ganti URL sesuai route POST kamu
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(formData)
                        });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();

                    if (data.status === 'success') {
                        successMsg.textContent = data.message || 'Komentar berhasil dikirim!';
                        successMsg.classList.remove('d-none');

                        // Reset form setelah sukses
                        form.reset();
                    } else {
                        errorMsg.textContent = data.message || 'Gagal mengirim komentar.';
                        errorMsg.classList.remove('d-none');
                    }
                } catch (error) {
                    errorMsg.textContent = 'Terjadi kesalahan, silakan coba lagi.';
                    errorMsg.classList.remove('d-none');
                    console.error('Error:', error);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('commentForm');
            const successMsg = document.getElementById('commentSuccessMsg');
            const errorMsg = document.getElementById('commentErrorMsg');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                successMsg.classList.add('d-none');
                errorMsg.classList.add('d-none');
                successMsg.textContent = '';
                errorMsg.textContent = '';

                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }
                form.classList.remove('was-validated');

                const formData = {
                    id: document.getElementById('id_berita').value,
                    nama_pengguna: document.getElementById('nama_pengguna').value.trim(),
                    email: document.getElementById('email').value.trim(),
                    isi_komentar: document.getElementById('isi_komentar').value.trim(),
                };

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');

                try {
                    const response = await fetch('/komentar/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();

                    if (data.status === 'success') {
                        successMsg.textContent = data.message || 'Komentar berhasil dikirim!';
                        successMsg.classList.remove('d-none');
                        form.reset();
                    } else {
                        errorMsg.textContent = data.message || 'Gagal mengirim komentar.';
                        errorMsg.classList.remove('d-none');
                    }
                } catch (error) {
                    errorMsg.textContent = 'Terjadi kesalahan, silakan coba lagi.';
                    errorMsg.classList.remove('d-none');
                    console.error('Error:', error);
                }
            });

            // ---- Tambahan Script Like / Dislike ----
            const likeBtn = document.getElementById('likeBtn');
            const dislikeBtn = document.getElementById('dislikeBtn');
            const likeCount = document.getElementById('likeCount');
            const dislikeCount = document.getElementById('dislikeCount');
            const beritaId = document.getElementById('id_berita')?.value;

            likeBtn?.addEventListener('click', () => vote('like'));
            dislikeBtn?.addEventListener('click', () => vote('dislike'));

            async function vote(type) {
                try {
                    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const res = await fetch('/berita/like-dislike', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            berita_id: beritaId,
                            tipe: type
                        })
                    });

                    const data = await res.json();

                    if (data.status === 'success') {
                        likeCount.textContent = data.likes;
                        dislikeCount.textContent = data.dislikes;
                    } else {
                        alert(data.message || 'Vote gagal.');
                    }
                } catch (err) {
                    console.error('Vote error:', err);
                    alert('Terjadi kesalahan saat voting.');
                }
            }
        });
    </script>
@endpush
