<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SEO Meta -->
    <meta name="description"
        content="Portal resmi BPKPAD Kabupaten Pesisir Selatan. Informasi dokumen publik, perencanaan, penelitian dan pengembangan daerah.">
    <link rel="canonical" href="{{ url()->current() }}">

    <title>BPKPAD</title>

    {{-- CSS via Vite --}}
    @vite(['resources/css/app.css'])

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://www.repository.pesisirselatankab.go.id/ast-adm/assets/logo_pessel.png" />
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://www.repository.pesisirselatankab.go.id/ast-adm/assets/logo_pessel.png" />
    <link rel="apple-touch-icon" sizes="180x180"
        href="https://www.repository.pesisirselatankab.go.id/ast-adm/assets/logo_pessel.png" />
    <link rel="manifest" href="{{ asset('assets/image/favicon/site.webmanifest') }}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>
