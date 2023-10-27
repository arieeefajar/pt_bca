@extends('layout.app')
@section('title', 'Dashboard')
@section('menu', 'dashboard')
@section('submenu', 'Analytics')

@section('content')
    {{-- @dd($dataJumlah) --}}
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
                {{-- data jumlah toko --}}
                <div class="col-md-6">
                    <a href="{{ route('listTargetToko.index') }}">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-semibold text-muted mb-0">Jumlah Target Toko</p>
                                        <div class="d-flex mt-4">
                                            <h2 class="ff-secondary fw-bold"><span class="counter-value"
                                                    data-target="{{ $dataJumlah['targetTokoSelesai'] }}">{{ $dataJumlah['targetTokoSelesai'] }}</span>
                                            </h2>
                                            <h2 class="ff-secondary fw-bold">/</h2>
                                            <h2 class="ff-secondary fw-bold"><span class="counter-value"
                                                    data-target="{{ $dataJumlah['targetToko'] }}">{{ $dataJumlah['targetToko'] }}</span>
                                            </h2>
                                        </div>
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
                    <a href="{{ route('listHasilSurvey.index') }}">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-semibold text-muted mb-0">Jumlah Belum Selesai Survey Toko</p>
                                        <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value"
                                                data-target="{{ $dataJumlah['targetTokoBlmSelesai'] }}">{{ $dataJumlah['targetTokoBlmSelesai'] }}</span>
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
                        </div> <!-- end card-->
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
