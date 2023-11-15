@extends('layout.app')
@section('title', 'Laporan')
@section('menu1')
    <span>Penilaian Pelanggan / {{ $location_name }}</span>
@endsection

@section('content')
    <div class="row project-wrapper">
        <div class="col-xxl-12">
            <div class="container">
                <div class="row mt-4 justify-content-center">

                    {{-- Market Insight --}}
                    <div class="col-xl-4">
                        <a href="{{ url("marketInsightDaerah/$location_name_encode") }}">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                                <i class="ri-bar-chart-fill text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-semibold text-muted text-truncate mb-3"></p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">Market Insight</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div>

                    {{-- Competitive Insight --}}
                    <div class="col-xl-4">
                        <a href="{{ url("competitiveInsight/$location_name_encode") }}">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                                <i class="ri-bar-chart-fill text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-semibold text-muted text-truncate mb-3"></p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">Competitive Insight</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
