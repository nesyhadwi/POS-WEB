<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        /* Atur agar ukuran pagination lebih kecil */
        .pagination {
            font-size: 12px;
            text-align: center;
            padding: 0;
            display: flex;
            margin-bottom: 50px;
        }
    
        .pagination li {
            list-style: none;
            margin: 0;
        }
    
        .pagination li a, .pagination li span {
            padding: 6px 10px;
            font-size: 14px;
            border-radius: 5px;
            color: #333;
            text-decoration: none;
        }
    
        /* Warna aktif dan hover */
        .pagination li.active span,
        .pagination li a:hover {
            background-color: #007bff;
            color: #fff;
        }
    
        /* Sembunyikan panah besar yang tidak diinginkan */
        .pagination svg {
            display: none;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('admin.partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
