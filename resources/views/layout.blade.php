{{-- <!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tambahkan CSS SB Admin -->
    <link href="{{ asset('sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar') <!-- File sidebar.blade.php bisa dibuat di folder partials -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Navbar -->
                @include('partials.navbar') <!-- File navbar.blade.php bisa dibuat di folder partials -->
                <!-- Main Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- Footer -->
            @include('partials.footer') <!-- File footer.blade.php bisa dibuat di folder partials -->
        </div>
    </div>
    <!-- Tambahkan JS SB Admin -->
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>
</body>
</html> --}}
