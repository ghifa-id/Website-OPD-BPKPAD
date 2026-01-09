@extends('guest.layouts.app')

@section('title', 'Diskominfo - Hubungi Kami')

@section('content')

    <div class="container-fluid px-3 px-md-5 py-4">
        <!-- Header Section -->
        <div class="header-section text-center mb-5">
            <h1 class="header-title">
                Hubungi Kami
            </h1>
            <div class="header-divider mx-auto"></div>
            <p class="header-description">
                Kami siap melayani Anda dengan sepenuh hati. Hubungi kami melalui berbagai saluran komunikasi yang tersedia.
            </p>
        </div>

        <!-- Contact Content -->
        <div class="row g-4 justify-content-center">
            <!-- Contact Information -->
            <div class="col-lg-6">
                <div class="contact-card">
                    <h2 class="section-title">
                        <span class="section-icon"><i class="fas fa-building"></i></span>
                        Informasi Kontak
                    </h2>

                    <div class="office-info">
                        <h3 class="office-name">Dinas Komunikasi dan Informatika Kab. Pesisir Selatan</h3>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Alamat Kantor</h4>
                                <p>Jl. H. Agus Salim Painan<br>PAINAN 25611<br>Kabupaten Pesisir Selatan<br>Provinsi
                                    Sumatera Barat</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Telepon</h4>
                                <p>(0756) 21005</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-fax"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Fax</h4>
                                <p>(0756) 2312227</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email</h4>
                                <p>bpkpad@pesisirselatankab.go.id</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Website</h4>
                                <p>bpkpad.pesisirselatankab.go.id</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="social-media-section mt-4">
                        <h4 class="social-title">Media Sosial Resmi</h4>
                        <div class="social-links">
                            <a href="https://web.facebook.com/bpkpad.kabupaten.pesisir.selatan?locale=id_ID" class="social-link">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/bpkpad_kab.pessel?utm_source=ig_web_button_share_sheet&igsh=c2k4bzMweW9jNzQz" class="social-link">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://youtube.com/@bpkpadkab.pesisirselatan?si=0L21qBZd6LSwc28f" class="social-link">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <!-- Contact Form -->
            <div class="col-lg-6">
                <div class="contact-card">
                    <h2 class="section-title">
                        <span class="section-icon"><i class="fas fa-paper-plane"></i></span>
                        Kirim Pesan
                    </h2>

                    <form id="contactForm" class="contact-form" method="POST" action="{{ route('kontakKami') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email <span class="required">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Subjek <span class="required">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Pesan <span class="required">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary submit-btn">
                            <i class="fas fa-paper-plane me-2"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Map Section -->
        <div class="map-section mt-5">
            <div class="map-header text-center mb-4">
                <h2 class="map-title">
                    Lokasi Kantor Kami
                </h2>
                <div class="header-divider mx-auto"></div>
                <p class="map-description">
                    Kunjungi kantor kami secara langsung untuk mendapatkan pelayanan terbaik.
                </p>
            </div>

            <div class="map-container">
                <iframe class="map-iframe"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4201.652556750374!2d100.57531361076087!3d-1.3484380356919676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd34d7925b976ad%3A0x6b6e7c932828f491!2sBPKPAD!5e1!3m2!1sid!2sid!4v1759828679374!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            // Validasi wajib isi
            const requiredFields = ['name', 'email', 'subject', 'message'];
            const emptyFields = requiredFields.filter(field => !data[field] || data[field].trim() === '');
            if (emptyFields.length > 0) {
                showAlert('Mohon lengkapi semua field yang wajib diisi!', 'danger');
                return;
            }

            // Validasi format email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(data.email)) {
                showAlert('Format email tidak valid!', 'danger');
                return;
            }

            // Loading state
            const submitBtn = this.querySelector('.submit-btn');
            const originalHTML = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...';
            submitBtn.disabled = true;

            // Kirim ke Laravel
            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('HTTP error ' + response.status);
                    return response.json();
                })
                .then(result => {
                    showAlert(result.message || 'Pesan berhasil dikirim!', 'success');
                    this.reset();
                })
                .catch(error => {
                    console.error(error);
                    showAlert('Gagal mengirim pesan. Silakan coba lagi!', 'danger');
                })
                .finally(() => {
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.disabled = false;
                });
        });

        function showAlert(message, type) {
            const alertContainer = document.createElement('div');
            alertContainer.innerHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            document.querySelector('.container-fluid').insertBefore(alertContainer, document.querySelector('.row'));

            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        }
    </script>


    @push('styles')
        <style>
            /* Color Scheme - Updated to match header */
            :root {
                --primary-color: #003b49;
                /* Dark blue from header */
                --secondary-color: #2dcd7c;
                /* Green from header */
                --accent-color: #e74c3c;
                /* For important elements */
                --light-gray: #f8f9fa;
                --medium-gray: #e9ecef;
                --dark-gray: #495057;
                --text-color: #212529;
                --text-secondary: #6c757d;
                --white: #ffffff;
                --border-radius: 8px;
                --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            }

            /* Base Styles */
            body {
                font-family: 'Segoe UI', 'Roboto', sans-serif;
                color: var(--text-color);
                background-color: var(--light-gray);
                line-height: 1.6;
            }

            /* Header Section */
            .header-section {
                padding: 2rem 0;
            }

            .header-title {
                font-size: 2.5rem;
                font-weight: 600;
                color: var(--primary-color);
                /* Updated to primary color */
                margin-bottom: 1rem;
            }

            .header-divider {
                width: 80px;
                height: 4px;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                /* Updated gradient */
                margin-bottom: 1.5rem;
            }

            .header-description {
                font-size: 1.1rem;
                color: var(--text-secondary);
                max-width: 700px;
                margin: 0 auto;
            }

            /* Contact Cards */
            .contact-card {
                background-color: var(--white);
                border-radius: var(--border-radius);
                padding: 2rem;
                box-shadow: var(--box-shadow);
                height: 100%;
                transition: transform 0.3s ease;
                border-top: 4px solid var(--secondary-color);
                /* Added accent border */
            }

            .contact-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 59, 73, 0.15);
                /* Enhanced shadow */
            }

            /* Section Titles */
            .section-title {
                font-size: 1.75rem;
                font-weight: 600;
                color: var(--primary-color);
                /* Updated to primary color */
                margin-bottom: 1.5rem;
                padding-bottom: 0.75rem;
                border-bottom: 2px solid var(--medium-gray);
                display: flex;
                align-items: center;
            }

            .section-icon {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                /* Updated gradient */
                color: var(--white);
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-right: 0.75rem;
            }

            /* Office Info */
            .office-name {
                font-size: 1.25rem;
                font-weight: 600;
                color: var(--primary-color);
                /* Updated to primary color */
                margin-bottom: 1.5rem;
            }

            /* Contact Items */
            .contact-item {
                display: flex;
                align-items: flex-start;
                margin-bottom: 1.5rem;
                padding-bottom: 1.5rem;
                border-bottom: 1px solid var(--medium-gray);
            }

            .contact-item:last-child {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }

            .contact-icon {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                /* Updated gradient */
                color: var(--white);
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                flex-shrink: 0;
            }

            .contact-details h4 {
                font-size: 1.1rem;
                font-weight: 600;
                color: var(--primary-color);
                /* Updated to primary color */
                margin-bottom: 0.5rem;
            }

            .contact-details p {
                color: var(--text-secondary);
                margin: 0;
            }

            /* Social Media */
            .social-media-section {
                margin-top: 2rem;
                padding-top: 1.5rem;
                border-top: 1px solid var(--medium-gray);
            }

            .social-title {
                font-size: 1.1rem;
                font-weight: 600;
                color: var(--primary-color);
                /* Updated to primary color */
                margin-bottom: 1rem;
                text-align: center;
            }

            .social-links {
                display: flex;
                justify-content: center;
                gap: 1rem;
            }

            .social-link {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                /* Updated gradient */
                color: var(--white);
                transition: all 0.3s ease;
            }

            .social-link:hover {
                background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
                /* Reversed gradient on hover */
                transform: translateY(-3px);
                text-decoration: none;
                color: var(--white);
            }

            /* Form Styles */
            .contact-form {
                margin-top: 1.5rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                font-weight: 500;
                color: var(--primary-color);
                /* Updated to primary color */
                margin-bottom: 0.5rem;
                display: block;
            }

            .required {
                color: var(--accent-color);
            }

            .form-control {
                border: 1px solid var(--medium-gray);
                border-radius: var(--border-radius);
                padding: 0.75rem 1rem;
                font-size: 1rem;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: var(--secondary-color);
                /* Updated to secondary color */
                box-shadow: 0 0 0 0.25rem rgba(45, 205, 124, 0.1);
                /* Updated shadow color */
            }

            textarea.form-control {
                min-height: 150px;
            }

            .submit-btn {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                /* Updated gradient */
                border: none;
                padding: 0.75rem 2rem;
                font-size: 1rem;
                font-weight: 500;
                border-radius: var(--border-radius);
                transition: all 0.3s ease;
                width: 100%;
                color: white;
            }

            .submit-btn:hover {
                background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
                /* Reversed gradient on hover */
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 59, 73, 0.2);
            }

            /* Map Section */
            .map-section {
                margin-top: 3rem;
            }

            .map-header {
                margin-bottom: 2rem;
            }

            .map-title {
                font-size: 2rem;
                font-weight: 600;
                color: var(--primary-color);
                /* Updated to primary color */
                margin-bottom: 1rem;
            }

            .map-description {
                color: var(--text-secondary);
                max-width: 600px;
                margin: 0 auto;
            }

            .map-container {
                border-radius: var(--border-radius);
                overflow: hidden;
                box-shadow: var(--box-shadow);
                border: 1px solid var(--medium-gray);
            }

            .map-iframe {
                width: 100%;
                height: 400px;
                border: 0;
            }

            /* Alert Styles */
            .alert-success {
                background-color: rgba(45, 205, 124, 0.1);
                border-color: var(--secondary-color);
                color: var(--primary-color);
            }

            .alert-danger {
                background-color: rgba(231, 76, 60, 0.1);
                border-color: var(--accent-color);
                color: var(--primary-color);
            }

            /* Responsive Adjustments */
            @media (max-width: 992px) {
                .header-title {
                    font-size: 2rem;
                }

                .section-title {
                    font-size: 1.5rem;
                }

                .office-name {
                    font-size: 1.1rem;
                }
            }

            @media (max-width: 768px) {
                .header-title {
                    font-size: 1.75rem;
                }

                .contact-card {
                    padding: 1.5rem;
                }

                .map-iframe {
                    height: 350px;
                }
            }

            @media (max-width: 576px) {
                .header-title {
                    font-size: 1.5rem;
                }

                .header-description,
                .map-description {
                    font-size: 1rem;
                }

                .contact-item {
                    flex-direction: column;
                }

                .contact-icon {
                    margin-bottom: 0.75rem;
                }

                .map-iframe {
                    height: 300px;
                }
            }
        </style>
    @endpush
@endsection