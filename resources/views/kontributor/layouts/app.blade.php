<!DOCTYPE html>
<html lang="en">
@include('kontributor.layouts.head')
@stack('styles')

<body class="g-sidenav-show bg-gray-100">
    @include('kontributor.partials.sidenav')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        @include('kontributor.partials.navbar')
        <!-- End Navbar -->

        @yield('content')
        @include('kontributor.layouts.footer')
    </main>

    @stack('scripts')
    @include('kontributor.layouts.script')
</body>

</html>
