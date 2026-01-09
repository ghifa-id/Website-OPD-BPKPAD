<script src="{{ asset('assets-admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/core/bootstrap.min.js') }}"></script>

<!-- GSAP Animasi Background & Logo -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Background zoom animasi
        const bgImage = document.querySelector(".page-header > div[style*='background-image']");
        gsap.to(bgImage, {
            scale: 1.05,
            duration: 5,
            ease: "sine.inOut",
            repeat: -1,
            yoyo: true
        });

        // Animasi logo
        gsap.to("#logo-pessel", {
            scale: 1.1,
            duration: 1.5,
            yoyo: true,
            repeat: -1,
            ease: "power1.inOut"
        });

        // Input Material class handling
        const inputs = document.querySelectorAll(".input-group.input-group-outline input");

        inputs.forEach(input => {
            // Saat halaman diload
            if (input.value.trim() !== "") {
                input.parentElement.classList.add("is-filled");
            }

            // Saat input fokus
            input.addEventListener("focus", () => {
                input.parentElement.classList.add("is-focused", "is-filled");
            });

            // Saat blur (lepas fokus)
            input.addEventListener("blur", () => {
                input.parentElement.classList.remove("is-focused");
                if (input.value.trim() === "") {
                    input.parentElement.classList.remove("is-filled");
                }
            });
        });

        // Form login handler
        const loginForm = document.getElementById("login-form");
        if (loginForm) {
            loginForm.addEventListener("submit", function(event) {
                event.preventDefault();

                const formData = new FormData(loginForm);
                fetch(loginForm.action, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: "Login Berhasil!",
                                text: "Mengalihkan ke dashboard...",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500,
                                didOpen: () => Swal.showLoading(),
                                willClose: () => window.location.href = data.redirect
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: "error",
                                title: data.message || "User ID atau Password salah.",
                                showConfirmButton: false,
                                timer: 2500,
                                timerProgressBar: true,
                                customClass: {
                                    popup: "small-toast"
                                }
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "Terjadi kesalahan! Silakan coba lagi.",
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            customClass: {
                                popup: "small-toast"
                            }
                        });
                        console.error("Error:", error);
                    });
            });
        }
    });
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Material Dashboard Core JS -->
<script src="{{ asset('assets-admin/js/material-dashboard.min.js?v=3.2.0') }}"></script>
