<!doctype html>
<html lang="en" data-layout="horizontal" data-sidebar="light" data-sidebar-size="lg">

<head>

    <meta charset="utf-8" />
    <title>Spesial Kuisioner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/assets/images/logosimi.png') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('admin_assets/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin_assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin_assets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('admin_assets/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />


</head>

<body>
    <div id="loading-overlay">
        <label class="form-label loading">Loading...</label>
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            @include('layout1.navbar')
        </header>
        <!-- ========== App Menu ========== -->
        @include('layout1.menu')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>

                @include('layout1.footer')
            </div>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->





    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin_assets/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/plugins.js') }}"></script>

    <!-- prismjs plugin -->
    <script src="{{ asset('admin_assets/assets/libs/prismjs/prism.js') }}"></script>

    <script src="{{ asset('admin_assets/assets/js/app.js') }}"></script>

    <script>
        window.onload = function() {
            // Sembunyikan elemen overlay saat halaman dimuat
            document.getElementById('loading-overlay').style.display = 'none';
        }
    </script>

    @yield('otherJs')

</body>

</html>
