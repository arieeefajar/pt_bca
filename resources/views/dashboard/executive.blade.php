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
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Maps Retail</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="mapRetail" class="leaflet-map" style="height: 600px"></div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Maps Potensi Lahan</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="mapPotensiLahan" class="leaflet-map" style="height: 600px"></div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
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
            let mapRetail = L.map('mapRetail').setView([-1.682604, 117.694631], 5);
            let mapPotensiLahan = L.map('mapPotensiLahan').setView([-1.682604, 117.694631], 5);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© SIMI 2023'
            }).addTo(mapRetail);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© SIMI 2023'
            }).addTo(mapPotensiLahan);

            const dataAI_Retail = @json($dataAI[0]['retail_data']);
            const dataAI_PotentialArea = @json($dataAI[0]['potential_area_data']);

            const onMapClick = (index) => {
                console.log(`onMapClick for index ${index}`);
            };

            dataAI_Retail.forEach((AI_Retail, index) => {
                console.log(AI_Retail);
                const area = `<h6 class="text-center" style="margin-bottom: -10px"><b>${AI_Retail.location.name}</b></h6>`
                const header = `<p class="text-center" style="margin-bottom: -10px"><b>Hasil Survey Analisis Pesaing :</b></p>`
                let wordCount = '<div class="d-flex"><p style="margin-right:10px">'
                    
                AI_Retail.monthly.forEach((content, index2) => {
                    if (index2 == 5) {
                        wordCount += `</p><p>- ${content.word}<br>`
                    }else{
                        wordCount += `- ${content.word}<br>`
                    }
                });
                wordCount += '</p></div>'

                const containerContent =
                    `<div id="content">${area}${header}${wordCount}</div>`

                var marker = L.marker([AI_Retail.location.latitude, AI_Retail.location.longtitude]).addTo(
                    mapRetail).bindPopup(containerContent);
            });
        });
    </script>
@endsection
