@extends('layout1.app')
@section('title', 'Dashboard')
@section('menu', 'dashboard')
@section('submenu', 'Analytics')

@section('content')
    <div class="row project-wrapper">
        <div class="col-xxl-8">
            <div class="row">
                <div class="col-xl-12 mb-3">
                    <label for="toko">Pilih Toko:</label>
                    <select class="form-select mb-3" name="store" id="toko">
                        <option selected disabled>Pilih toko yang akan dikunjungi:</option>
                        @foreach ($dataCustommer as $value)
                            <option value="{{ $value->id }}">{{ $value->nama }}</option>
                        @endforeach
                        <!-- Tambahkan pilihan toko lain sesuai kebutuhan -->
                    </select>
                </div>
            </div><!-- end row -->

            <div class="row">
                <!-- List Target Toko -->
                <div class="col-xl-6 col-md-6">
                    <a href="{{ route('listTargetToko.index') }}">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-semibold text-muted mb-0">List Target Toko</p>
                                        <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value"
                                                data-target="{{ $dataJumlah['targetToko'] }}">0</span>
                                        </h2>
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
                        </div>
                    </a>
                </div>

                <!-- List Hasil Survey -->
                <div class="col-xl-6 col-md-6">
                    <a href="{{ route('listHasilSurvey.index') }}">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-semibold text-muted mb-0">List Hasil Survey</p>
                                        <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value"
                                                data-target="{{ $dataJumlah['surveyToko'] }}">0</span>
                                        </h2>
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
                        </div>
                    </a>
                </div>
            </div><!-- end row -->

        </div><!-- end col -->
    </div><!-- end row -->

    <script>
        document.getElementById("toko").addEventListener("change", function() {
            var selectedStore = this.value;
            window.location.href = "{{ route('surveyor.setStore') }}?store=" + selectedStore;
        });
    </script>
@endsection
