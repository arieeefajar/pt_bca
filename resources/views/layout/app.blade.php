<!doctype html>
<html lang="en" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- leaflet Css -->
    <link href="{{ asset('admin_assets/assets/libs/leaflet/leaflet.css') }}" rel="stylesheet" type="text/css" />
    {{-- leaflet Css Extend --}}
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/leafletExtend/Control.FullScreen.css') }}">

    <!-- App favicon -->
    {{-- <!-- <link rel="shortcut icon" href="{{ asset('admin_assets/assets/images/favicon.ico') }}"> --> --}}
    <link rel="shortcut icon" href="{{ asset('admin_assets/assets/images/logosimi.png') }}">

    <!-- plugin css -->
    <link href="{{ asset('admin_assets/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Sweet Alert css-->
    <link href="{{ asset('admin_assets/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/libs/gridjs/theme/mermaid.min.css') }}">

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

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/css/dataTables.bulma.min.css') }}">

    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="{{ asset('vendor/Chart.min.js') }}"></script>

    <!-- jQuery (diperlukan oleh DataTables) -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    @yield('otherStyle')

</head>

<body>

    <div id="loading-overlay">
        <label class="form-label loading">Loading...</label>
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            @include('layout.navbar')
        </header>
        <!-- ========== App Menu ========== -->
        @if (Auth::user()->role == 'user')
            @include('layout.sidebar1')
        @else
            @include('layout.sidebar')
        @endif
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@yield('menu')@yield('menu1')</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">@yield('submenu')</a>
                                        </li>
                                        <li class="breadcrumb-item active">@yield('menu')</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    @yield('content')
                </div>
            </div>
            <!-- End Page-content -->

            @include('layout.footer')
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
    <script src="{{ asset('admin_assets/assets/js/script.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('admin_assets/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin_assets/assets/js/app.js') }}"></script>

    <!-- prismjs plugin -->
    <script src="{{ asset('admin_assets/assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/libs/list.js/list.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('admin_assets/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="{{ asset('vendor/DataTables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/DataTables/js/dataTables.bootstrap4.min.js') }}"></script>

    {{-- form validate --}}
    <script src="{{ asset('admin_assets/assets/js/pages/form-validation.init.js') }}"></script>

    <!-- leaflet plugin -->
    <script src="{{ asset('admin_assets/assets/libs/leaflet/leaflet.js') }}"></script>
    {{-- leaflet Css Extend --}}
    <script src="{{ asset('admin_assets/assets/js/leafletExtend/Control.FullScreen.js') }}"></script>

    <script>
        window.onload = function() {
            // Sembunyikan elemen overlay saat halaman dimuat
            document.getElementById('loading-overlay').style.display = 'none';
        }
    </script>

    @include('sweetalert::alert')

    @yield('otherJs')
</body>

</html>
