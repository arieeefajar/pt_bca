@extends('layout.app')
@section('title', 'Dashboard')
@section('menu', 'dashboard')
@section('submenu', 'Analytics')

@section('content')

    <div class="container-fluid">
        <div class="row">

            {{-- data jumlah toko --}}
            <div class="col-md-6">
                <a href="{{ route('dataTargetToko.index') }}">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-semibold text-muted mb-0">Jumlah target toko</p>
                                    <h2 class="mt-4 ff-secondary fw-bold">
                                        {{ $dataJumlah['targetToko'] }}/20
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
            </div> <!-- end col-->

            {{-- data jumlah toko yang sudah disurvey --}}
            <div class="col-md-6">
                <a href="{{ route('dataSurveyToko.index') }}">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-semibold text-muted mb-0">Jumlah belum selesai survey toko</p>
                                    <h2 class="mt-4 ff-secondary fw-bold">
                                        {{ $dataJumlah['surveyToko'] }}
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
            </div> <!-- end col-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Maps Retail & Potensi Lahan</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="mapRetail" class="leaflet-map" style="height: 400px"></div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>

        {{-- <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Data Hasil Survey</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="custom_datalabels_bar"
                            data-colors='["--vz-primary", "--vz-secondary", "--vz-success", "--vz-info", "--vz-warning", "--vz-danger", "--vz-dark", "--vz-primary", "--vz-success", "--vz-secondary"]'
                            class="apex-charts" dir="ltr"></div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
        </div> --}}
    </div>
@endsection

@section('otherJs')
    <script>
        $(document).ready(function() {
            var base = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© SIMI 2023',
            });

            var mapRetail = L.map('mapRetail', {
                layers: [base],
                tap: false,
                center: new L.LatLng(-1.682604, 117.694631),
                zoom: 5,
                fullscreenControl: true,
                fullscreenControlOptions: { // optional
                    title: "Show me the fullscreen !",
                    titleCancel: "Exit fullscreen mode"
                }
            });

            const dataArea = @json($dataArea);
            // console.log(dataArea);
            $.each(dataArea, function(index, value) {

                const area = `<h6 class="text-center"><b>${index}</b></h6>`
                const latitude = value.retail_data != undefined ? value.retail_data.location.latitude :
                    value.potential_area_data.location.latitude
                const longtitude = value.retail_data != undefined ? value.retail_data.location.longtitude :
                    value.potential_area_data.location.longtitude

                // potential area
                let wordCountRetail = ''
                if (value.retail_data != undefined) {
                    const headerRetail =
                        `<p class="text-center" style="margin-bottom: -10px"><b>Hasil Survey Analisis Pesaing :</b></p>`
                    wordCountRetail =
                        `${headerRetail}<div class="d-flex gap-3" style="margin-bottom: -20px"><p style="margin-right:10px">`
                    $.each(value.retail_data.monthly, function(indexRetail, retail) {
                        // console.log(retail);
                        if (indexRetail == 5) {
                            wordCountRetail += `</p><p>- ${retail.word}<br>`
                        } else {
                            wordCountRetail += `- ${retail.word}<br>`
                        }
                    });
                    wordCountRetail += '</p></div>'
                }

                // retail
                let wordCountPotentialArea = ''
                if (value.potential_area_data != undefined) {
                    const headerPotential =
                        `<p class="text-center" style="margin-bottom: -10px"><b>Hasil Survey Potensi Lahan :</b></p>`
                    wordCountPotentialArea =
                        `${headerPotential}<div class="d-flex gap-3" style="margin-bottom: -20px"><p style="margin-right:10px">`
                    $.each(value.potential_area_data.monthly, function(indexPotentialArea, potentialArea) {
                        console.log(potentialArea);
                        if (indexPotentialArea == 5) {
                            wordCountPotentialArea += `</p><p>- ${potentialArea.word}<br>`
                        } else {
                            wordCountPotentialArea += `- ${potentialArea.word}<br>`
                        }
                    });
                    wordCountPotentialArea += '</p></div>'
                }

                const containerContent =
                    `<div id="content">${area}${wordCountRetail}${wordCountPotentialArea}</div>`
                var marker = L.marker([latitude, longtitude]).addTo(mapRetail).bindPopup(containerContent);
            });

        });
    </script>
@endsection
