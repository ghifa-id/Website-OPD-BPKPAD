<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.head')
@include('admin.layouts.ckeditor')

<body class="g-sidenav-show  bg-gray-100">
    @include('admin.partials.sidenav')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('admin.partials.navbar')

        <!-- End Navbar -->
        @yield('content')
        @include('admin.layouts.footer')
    </main>


    @stack('scripts')
    @include('admin.layouts.script')
</body>

</html>
