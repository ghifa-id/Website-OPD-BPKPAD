@if (file_exists(public_path('asset/ckeditor/ckeditor.js')))
    <script src="{{ asset('asset/ckeditor/ckeditor.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Cek ada textarea dengan id editor1
            let editor = document.getElementById('editor1');
            if (editor && typeof CKEDITOR !== 'undefined') {
                CKEDITOR.replace('editor1', {
                    filebrowserImageBrowseUrl: '{{ asset('asset/kcfinder') }}', // opsional
                    height: 300
                });
            }
        });
    </script>
@endif
