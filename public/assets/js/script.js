// 1. Setelah DOM siap
document.addEventListener("DOMContentLoaded", function () {
    // Fade-in up animasi
    const el = document.querySelector('.animate-fade-in-up');
    if (el) {
        el.classList.add('start-animation');
    }

    // Validasi input file gambar
    const gambarInput = document.querySelector('input[name="gambar"]');
    if (gambarInput) {
        gambarInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.size > 3 * 1024 * 1024) {
                alert("Ukuran gambar tidak boleh lebih dari 3MB!");
                this.value = ""; // Reset input
            }
        });
    }

    // Tombol delete dengan konfirmasi SweetAlert
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');

            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });
    });

    // Set tab default
    showTab('terbaru');
});

// 2. jQuery (pastikan jQuery sudah diload di HTML sebelum script ini)
$(document).ready(function () {
    // DataTables init
    $('#albumTable').DataTable({
        paging: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        language: {
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            },
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)"
        },
        dom: '<"top"lf>rt<"bottom"ip><"clear">'
    });

    // OwlCarousel init
    $(".client-carousel").owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: 1 }
        }
    });
});

// 3. Alert success fade out
setTimeout(() => {
    const alert = document.getElementById('success-alert');
    if (alert) {
        alert.classList.remove('show');
        alert.classList.add('fade');
        setTimeout(() => alert.remove(), 500);
    }
}, 2000);

// 4. Tab switcher
function showTab(tab) {
    const terbaru = document.getElementById('list-terbaru');
    const populer = document.getElementById('list-populer');
    const tabTerbaruBtn = document.getElementById('tab-terbaru');
    const tabPopulerBtn = document.getElementById('tab-populer');

    if (!terbaru || !populer || !tabTerbaruBtn || !tabPopulerBtn) return;

    if (tab === 'terbaru') {
        terbaru.style.display = 'block';
        populer.style.display = 'none';
        tabTerbaruBtn.style.backgroundColor = '#3498db';
        tabTerbaruBtn.style.color = 'white';
        tabPopulerBtn.style.backgroundColor = 'transparent';
        tabPopulerBtn.style.color = '#3498db';
    } else {
        terbaru.style.display = 'none';
        populer.style.display = 'block';
        tabTerbaruBtn.style.backgroundColor = 'transparent';
        tabTerbaruBtn.style.color = '#3498db';
        tabPopulerBtn.style.backgroundColor = '#3498db';
        tabPopulerBtn.style.color = 'white';
    }
}

// 5. Preview modal
function previewImage(src, title) {
    $('#imagePreviewSrc').attr('src', src);
    $('#imagePreviewTitle').text(title);
    $('#imagePreviewModal').modal('show');
}
