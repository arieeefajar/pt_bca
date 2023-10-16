@extends('layout1.app')
@section('title', 'Dashboard')
@section('menu', $namaToko)
@section('submenu', 'Analytics')

@section('content')

    <style>
        .card {
            width: 100%;
            height: 80%;
        }

        .bg-warna {
            background-color: #F8F8F8;
        }

        small {
            font-weight: bold;
            font-size: 11px;
        }
    </style>

    <div class="row project-wrapper">
        <div class="col-xxl-8">
            <div class="row">

                @if ($k_pelanggan)
                    <div class="col-xl-4">
                        <a href="{{ route('kepuasanPelanggan.index', ['api_id' => $k_pelanggan[0]['api_id']]) }}">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                                <i class="ri-file-text-line text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-semibold text-muted text-truncate mb-3">
                                                <b class="text-success d-flex justify-content-end">
                                                    <small> Data sudah Diisikan </small>
                                                    <i class="bx bx-check"></i>
                                                </b>
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">Kuisioner Kepuasan Pelanggan</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div><!-- end col -->
                @else
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
                @endif

                @if ($k_analisis)
                    <div class="col-xl-4">
                        <a href="{{ route('analisisPesaing.index', ['api_id' => $k_analisis[0]['api_id']]) }}">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                                <i class="ri-file-text-line text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold text-truncate text-muted mb-3">
                                                <b class="text-success d-flex justify-content-end">
                                                    <small> Data sudah Diisikan </small>
                                                    <i class="bx bx-check"></i>
                                                </b>
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">Kuisioner Analisis Pesaing</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div><!-- end col -->
                @else
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
                @endif

                @if ($k_kekuatan_kelemahan)
                    <div class="col-xl-4">
                        <a
                            href="{{ route('KekuatanDanKelemahanPesaing.index', ['api_id' => $k_kekuatan_kelemahan[0]['api_id']]) }}">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-secondary text-secondary rounded-2 fs-2">
                                                <i class="ri-file-text-line text-secondary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold text-truncate text-muted mb-3">
                                                <b class="text-success d-flex justify-content-end">
                                                    <small> Data sudah Diisikan </small>
                                                    <i class="bx bx-check"></i>
                                                </b>
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">Kuisioner Kekuatan dan Kelemahan Pesaing
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div><!-- end col -->
                @else
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
                                                <h4 class="fs-4 flex-grow-1 mb-0">Kuisioner Kekuatan dan Kelemahan Pesaing
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div><!-- end col -->
                @endif

                @if ($skala_pasar)
                    <div class="col-xl-4">
                        <a href="{{ route('SkalaPasarProduk.index', ['api_id' => $skala_pasar[0]['api_id']]) }}">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
                                                <i class="ri-file-text-line text-info"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold text-truncate text-muted mb-3">
                                                <b class="text-success d-flex justify-content-end">
                                                    <small> Data sudah Diisikan </small>
                                                    <i class="bx bx-check"></i>
                                                </b>
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">Kuisioner Skala Pasar Produk
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div><!-- end col -->
                @else
                    <div class="col-xl-4">
                        <a href="{{ route('SkalaPasarProduk.index') }}">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
                                                <i class="ri-file-text-line text-info"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold text-truncate text-muted mb-3"></p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">Kuisioner Skala Pasar Produk
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div><!-- end col -->
                @endif


                @if ($form_lahan)
                    <div class="col-xl-4">
                        <a href="{{ route('formPotensiLahan.index', ['api_id' => $form_lahan[0]['api_id']]) }}">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-success text-info rounded-2 fs-2">
                                                <i class="ri-survey-line text-success"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-semibold text-muted text-truncate mb-3">
                                                <b class="text-success d-flex justify-content-end">
                                                    <small> Data sudah Diisikan </small>
                                                    <i class="bx bx-check"></i>
                                                </b>
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">Form Survey Potensi Lahan</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div><!-- end col -->
                @else
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
                @endif

                @if ($form_pesaing)
                    <div class="col-xl-4">
                        <a href="{{ route('formPesaing.index', ['api_id' => $form_pesaing[0]['api_id']]) }}">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-danger text-info rounded-2 fs-2">
                                                <i class="ri-survey-line text-danger"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-semibold text-muted text-truncate mb-3">
                                                <b class="text-success d-flex justify-content-end">
                                                    <small> Data sudah Diisikan </small>
                                                    <i class="bx bx-check"></i>
                                                </b>
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">Form Survey Pesaing</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div><!-- end col -->
                @else
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
                @endif
            </div> <!--end row -->
        </div><!-- end col -->

        {{-- btn pilih toko --}}
        <div class="text-center mt-3 mb-3">
            <form action="{{ route('clearCookie') }}" method="POST">
                @csrf
                <button class="btn btn-primary" type="submit">Pilih Toko</button>
            </form>
        </div>
    </div><!-- end row -->
@endsection
