@extends('layout.app')
@section('title', 'Dashboard')
@section('menu', 'dashboard')
@section('submenu', 'Analytics')

@section('content')

    <div class="container-fluid">
        <div class="row">

            {{-- data jumlah surveyor --}}
            <div class="col-md-6">
                <a href="{{ route('dataSurveyor.index') }}">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-semibold text-muted mb-0">Jumlah Surveyor</p>
                                    <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value"
                                            data-target="{{ $dataJumlah['surveyor'] }}">0</span>
                                    </h2>
                                    <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                            <i class="ri-arrow-up-line align-middle"></i> 16.24 %
                                        </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i data-feather="users" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </a>
            </div> <!-- end col-->

            {{-- data jumlah executive --}}
            <div class="col-md-6">
                <a href="{{ route('dataExecutive.index') }}">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-semibold text-muted mb-0">Jumlah Executive</p>
                                    <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value"
                                            data-target="{{ $dataJumlah['executive'] }}">0</span>
                                    </h2>
                                    <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                            <i class="ri-arrow-up-line align-middle"></i> 16.24 %
                                        </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i data-feather="users" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </a>
            </div> <!-- end col-->

            {{-- data jumlah toko --}}
            <div class="col-md-6">
                <a href="{{ route('dataTargetToko.index') }}">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-semibold text-muted mb-0">Jumlah Target Toko</p>
                                    <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value"
                                            data-target="{{ $dataJumlah['targetToko'] }}">0</span>
                                    </h2>
                                    <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                            <i class="ri-arrow-up-line align-middle"></i> 16.24 %
                                        </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i data-feather="home" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </a>
            </div> <!-- end col-->

            {{-- data jumlah toko yang sudah disurvey --}}
            <div class="col-md-6">
                <a href="{{ route('dataSurveyToko.index') }}">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-semibold text-muted mb-0">Jumlah Toko yang sudah di Survey</p>
                                    <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value"
                                            data-target="{{ $dataJumlah['surveyToko'] }}">0</span>
                                    </h2>
                                    <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                            <i class="ri-arrow-up-line align-middle"></i> 16.24 %
                                        </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i data-feather="home" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </a>
            </div> <!-- end col-->
        </div> <!-- end row-->
    </div>
@endsection
