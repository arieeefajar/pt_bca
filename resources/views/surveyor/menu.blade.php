@extends('layout1.app')
@section('title', 'Dashboard')
@section('menu', 'dashboard')
@section('submenu', 'Analytics')

@section('content')

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Good job!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    buttonsStyling: false,
                    showCloseButton: true
                });
            });
        </script>
    @elseif (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Warning",
                    text: "{{ session('error') }}",
                    icon: "warning",
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    buttonsStyling: false,
                    showCloseButton: true
                });
            });
        </script>
    @endif

    <style>
        .card {
            width: 100%;
            height: 80%;
        }
    </style>

    <div class="row project-wrapper">
        <div class="col-xxl-8">
            <div class="row">
                <div class="col-xl-4">
                    <a href="{{ route('kepuasanPelanggan.index') }}">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                            <i class="ri-file-text-line text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-semibold text-muted text-truncate mb-3"></p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0">Kuisioner Kepuasan Pelanggan</h4>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </a>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <a href="{{ route('analisisPesaing.index') }}">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                            <i class="ri-file-text-line text-warning"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold text-truncate text-muted mb-3"></p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0">Kuisioner Analisis Pesaing</h4>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </a>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <a href="{{ route('KekuatanDanKelemahanPesaing.index') }}">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-secondary text-secondary rounded-2 fs-2">
                                            <i class="ri-file-text-line text-secondary"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold text-truncate text-muted mb-3"></p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0">Kuisioner Kekuatan dan Kelemahan Pesaing</h4>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </a>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <a href="{{ route('formPotensiLahan.index') }}">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-success text-info rounded-2 fs-2">
                                            <i class="ri-survey-line text-success"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-semibold text-muted text-truncate mb-3"></p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0">Form Survey Potensi Lahan</h4>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </a>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <a href="{{ route('formPesaing.index') }}">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-danger text-info rounded-2 fs-2">
                                            <i class="ri-survey-line text-danger"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-semibold text-muted text-truncate mb-3"></p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0">Form Survey Pesaing</h4>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </a>
                </div><!-- end col -->
            </div> <!--end row -->
        </div><!-- end col -->
    </div><!-- end row -->
@endsection
