<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Website BPKPAD Kabupaten Pesisir Selatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            height: 100vh;
        }

        .split-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Left Side - Background Image */
        .left-side {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .background-image {
            position: absolute;
            inset: 0;
            background-image: url('https://www.pesisirselatankab.go.id/assets/images/slider/gambar1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            animation: kenburns 20s ease-in-out infinite alternate;
        }

        @keyframes kenburns {
            0% { transform: scale(1) translateX(0); }
            100% { transform: scale(1.15) translateX(-20px); }
        }

        .left-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(1, 49, 60, 0.7) 0%, rgba(0, 102, 128, 0.5) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
            z-index: 1;
        }

        .left-content {
            text-align: center;
            color: white;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .left-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5);
            line-height: 1.2;
        }

        .left-content p {
            font-size: 1.3rem;
            font-weight: 300;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            margin: 0 auto;
        }

        .decorative-line {
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, transparent, white, transparent);
            margin: 30px auto;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.5; transform: scaleX(1); }
            50% { opacity: 1; transform: scaleX(1.2); }
        }

        /* Right Side - Login Form */
        .right-side {
            width: 480px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
            position: relative;
            animation: slideInRight 0.8s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .login-form-container {
            width: 100%;
            max-width: 400px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-pessel {
            width: 90px;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .logo-section h2 {
            color: #0d6efd;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 8px;
        }

        .logo-section h2 span {
            color: #20c997;
        }

        .logo-section p {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 5px;
        }

        .welcome-text {
            color: #0d6efd;
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            color: #495057;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.05rem;
            transition: color 0.3s ease;
            z-index: 1;
        }

        .form-control-custom {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }

        .form-control-custom:focus ~ .input-icon {
            color: #0d6efd;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .toggle-password:hover {
            color: #0d6efd;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-back {
            width: 100%;
            padding: 13px;
            background: white;
            border: 2px solid #dee2e6;
            border-radius: 12px;
            color: #6c757d;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 12px;
        }

        .btn-back:hover {
            background: #f8f9fa;
            border-color: #0d6efd;
            color: #0d6efd;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
        }

        .footer-text {
            margin-top: 30px;
            text-align: center;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .footer-text a {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-text a:hover {
            color: #0d6efd;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #c33;
            font-size: 0.9rem;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        /* Floating shapes decoration */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: floatShape 20s infinite ease-in-out;
        }

        .shape1 {
            width: 200px;
            height: 200px;
            background: #0d6efd;
            top: 10%;
            right: -50px;
            animation-delay: 0s;
        }

        .shape2 {
            width: 150px;
            height: 150px;
            background: #20c997;
            bottom: 15%;
            right: 30px;
            animation-delay: 5s;
        }

        @keyframes floatShape {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .split-container {
                flex-direction: column;
            }

            .left-side {
                height: 35vh;
            }

            .left-content h1 {
                font-size: 2rem;
            }

            .left-content p {
                font-size: 1rem;
            }

            .right-side {
                width: 100%;
                height: 65vh;
                overflow-y: auto;
            }
        }

        @media (max-width: 576px) {
            .right-side {
                padding: 30px 20px;
            }

            .logo-section h2 {
                font-size: 1.5rem;
            }

            .welcome-text {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="split-container">
        <!-- Left Side - Background -->
        <div class="left-side">
            <div class="background-image"></div>
            <div class="left-overlay">
                <div class="left-content">
                    <h1>Selamat Datang</h1>
                    <div class="decorative-line"></div>
                    <p>Website BPKPAD<br>Kabupaten Pesisir Selatan</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="right-side">
            <div class="floating-shape shape1"></div>
            <div class="floating-shape shape2"></div>
            
            <div class="login-form-container">
                <div class="logo-section">
                    <img src="https://www.repository.pesisirselatankab.go.id/ast-adm/assets/images/logo-pessel.png"
                        alt="Logo Pesisir Selatan" class="logo-pessel">
                    <h2>Website <span>BPKPAD</span></h2>
                    <p>Kabupaten Pesisir Selatan</p>
                </div>

                <h3 class="welcome-text">Login ke Akun Anda</h3>

                <!-- Error message from Laravel validation -->
                @error('id_user')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <!-- Error message placeholder for JavaScript -->
                <div id="error-container"></div>

                <!-- Form dengan action dan method yang benar untuk Laravel -->
                <form id="login-form" action="{{ route('login.post') }}" method="POST" role="form">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-wrapper">
                            <input type="text" 
                                   name="username" 
                                   class="form-control-custom" 
                                   id="username"
                                   placeholder="Masukkan username Anda"
                                   required>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" 
                                   name="password" 
                                   class="form-control-custom" 
                                   id="password"
                                   placeholder="Masukkan password Anda"
                                   required>
                            <i class="fas fa-lock input-icon"></i>
                            <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                    </button>
                    
                    <button type="button" class="btn-back" onclick="window.location.href='{{ route('guest.beranda') }}'">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                    </button>
                </form>

                <div class="footer-text">
                    <a href="#">
                        Developed by Diskominfo Pessel <span id="year"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Set current year
        document.getElementById('year').textContent = new Date().getFullYear();

        // Handle form submit dengan AJAX
        const loginForm = document.getElementById('login-form');
        if (loginForm) {
            loginForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(loginForm);
                const submitBtn = loginForm.querySelector('.btn-login');
                const originalText = submitBtn.innerHTML;
                
                // Disable button saat loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';

                fetch(loginForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Login Berhasil!',
                            text: 'Mengalihkan ke dashboard...',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                            didOpen: () => Swal.showLoading()
                        }).then(() => {
                            window.location.href = data.redirect;
                        });
                    } else {
                        // Reset button
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: data.message || 'Username atau Password salah!',
                            confirmButtonColor: '#0d6efd'
                        });
                    }
                })
                .catch(error => {
                    // Reset button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Silakan coba lagi!',
                        confirmButtonColor: '#0d6efd'
                    });
                    console.error('Error:', error);
                });
            });
        }
    </script>
</body>
</html>