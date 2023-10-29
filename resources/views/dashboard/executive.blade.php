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
                                    <div class="d-flex mt-4">
                                        <h2 class="ff-secondary fw-bold"><span class="counter-value"
                                                data-target="{{ $dataJumlah['targetTokoSelesai'] }}">0</span>
                                        </h2>
                                        <h2 class="ff-secondary fw-bold">/</h2>
                                        <h2 class="ff-secondary fw-bold"><span class="counter-value"
                                                data-target="{{ $dataJumlah['targetToko'] }}">0</span>
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
                <a href="{{ route('dataSurveyToko.index') }}">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-semibold text-muted mb-0">Jumlah Belum Selesai Survey Toko</p>
                                    <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value"
                                            data-target="{{ $dataJumlah['targetTokoBlmSelesai'] }}">0</span>
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
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <h4 class="card-title mb-0">Maps Retail & Potensi Lahan</h4>
                        <select id="changeCategory" class="text-capitalize form-select mt-3 mt-md-0"
                            style="width: 100%; max-width: 300px;">
                            <option value="monthly">monthly</option>
                            <option value="quarterly">quarterly</option>
                            <option value="semesterly">semesterly</option>
                            <option value="yearly">yearly</option>
                        </select>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="mapAI"
                            class="leaflet-map d-flex align-items-center justify-content-center text-center bg-white"></div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>
@endsection

@section('otherJs')
    <script>

        $(document).ready(function() {
            getDataAi('monthly');
        });

        let mapAI;

        $('#changeCategory').on('change', function() {
            deleteMaps()
            getDataAi(this.value)
            // alert( this.value );
        });

        const getDataAi = (category) => {

            const url = "{{ route('getMapsAi') }}"

            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                beforeSend: function() {
                    // this is for loading
                    $('#mapAI').html(
                        'Loading...'
                    );
                },
                success: function(response) {
                    if (!response.data) {
                        $('#mapAI').html('Maaf, terjadi kesalahan pada server saat memuat Peta. Silakan segarkan halaman dalam beberapa menit.');
                    } else {
                        $('#mapAI').css('height', '400px');
                        var base = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© SIMI 2023',
                        });

                        mapAI = L.map('mapAI', {
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

                        $.each(response.data, function(index, value) {

                            const area = `<h6 class="text-center"><b>${index}</b></h6>`
                            const latitude = value.retail_data != undefined ? value.retail_data
                                .location
                                .latitude : value.potential_area_data.location.latitude
                            const longtitude = value.retail_data != undefined ? value.retail_data
                                .location.longtitude : value.potential_area_data.location.longtitude

                            // potential area
                            let wordCountRetail = ''
                            if (value.retail_data != undefined) {
                                const headerRetail =
                                    `<p class="text-center" style="margin-bottom: -10px"><b>Hasil Survey Analisis Pesaing :</b></p>`
                                wordCountRetail =
                                    `${headerRetail}<div class="d-flex gap-3" style="margin-bottom: -20px"><p style="margin-right:10px">`
                                $.each(value.retail_data[category], function(indexRetail, retail) {
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
                                $.each(value.potential_area_data[category], function(
                                    indexPotentialArea,
                                    potentialArea) {
                                    if (indexPotentialArea == 5) {
                                        wordCountPotentialArea +=
                                            `</p><p>- ${potentialArea.word}<br>`
                                    } else {
                                        wordCountPotentialArea +=
                                            `- ${potentialArea.word}<br>`
                                    }
                                });
                                wordCountPotentialArea += '</p></div>'
                            }

                            const containerContent =
                                `<div id="content">${area}${wordCountRetail}${wordCountPotentialArea}</div>`
                            var marker = L.marker([latitude, longtitude]).addTo(mapAI).bindPopup(
                                containerContent);
                        });
                    }

                },
                error: function() {
                    console.log('error load maps');
                    $('#mapAI').html('Maaf, terjadi kesalahan pada server saat memuat Peta. Silakan segarkan halaman dalam beberapa menit.');
                },
            });
        }

        function deleteMaps() {
            if (mapAI) {
                mapAI.remove();
            }
        }
    </script>
@endsection
