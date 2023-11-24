@extends('layout.app')
@section('title', 'Dashboard')
@section('menu', 'dashboard')
@section('submenu', 'Analytics')

@section('content')
@section('otherStyle')
    <style>
        #chartdiv {
            width: 100%;
            height: 350px;
        }

        #chartdiv1 {
            width: 100%;
            height: 350px;
        }

        .dropdown-menu {
            right: 0;
            width: 250px;
        }

        .dropdown-menu a.dropdown-item {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block;
        }

        .cardShadow {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            height: 550px;
        }
    </style>
@endsection

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

    <div class="row">
        <div class="col-md-6">
            <div class="card cardShadow">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" id="wordCount" href="#product1"
                                role="tab" aria-selected="false" onclick="showIndex()">
                                Customer Insight
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content  text-muted">
                        {{-- Custommer Insight --}}
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="card-title mb-0 mt-3" id="titleContent">Penilaian Pelanggan /
                                    Kepuasan /
                                    Product</h4>
                            </div>

                            <div class="col-sm-6 text-right">
                                <div style="float: right">
                                    <div class="d-flex align-items-center">
                                        <div class="hamburger">
                                            <button type="button" id="buttonHamburger" class="btn"
                                                onclick="toggleMenu()">
                                                <span class="hamburger-icon">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </span>
                                            </button>
                                            <div class="dropdown-menu" id="menu" style="display: none">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle" type="button"
                                                        onclick="toggleSubMenu()">
                                                        Kepuasan Pelanggan
                                                    </button>
                                                    <div id="dropdownMenu" style="display: none;">
                                                        <a class="dropdown-item"
                                                            onclick="getDataCartKepuasan('product')">Produk</a>
                                                        <a class="dropdown-item"
                                                            onclick="getDataCartKepuasan('promosi')">Promosi</a>
                                                        <a class="dropdown-item"
                                                            onclick="getDataCartKepuasan('kualitas')">Kualitas
                                                            produk</a>
                                                        <a class="dropdown-item"
                                                            onclick="getDataCartKepuasan('layanan')">Layanan
                                                            petugas lapang</a>
                                                        <a class="dropdown-item"
                                                            onclick="getDataCartKepuasan('penanganan')">Penanganan
                                                            komplain pelanggan</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="chartdiv" class="mb-3 d-flex justify-content-center align-items-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row" id="indexAspek">
                <div class="col-lg-12">
                    <div class="card cardShadow">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Perhitungan Aspek Index</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div id="table-search">
                                <div class="table-responsive">

                                    <table class="table table-bordered" id="kepuasanPelanggan">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Pertanyaan</th>
                                                <th class="text-center">Kepuasan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="kepuasaPelanggan">
                                        </tbody>
                                        <thead class="table-light" id="kepuasaPelangganFooter">
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card cardShadow">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" id="penilaianPelanggan" href="#home"
                                role="tab" aria-selected="false" onclick="showIndex()">
                                Competitor Intelegence
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" id="wordCount" href="#product1" role="tab"
                                aria-selected="false" onclick="closeIndex()">
                                Product Intelegence
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content  text-muted">

                        {{-- competitor intellligence --}}
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 id="titleContent1"> Analisis Pesaing
                                    </h6>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <div style="float: right">
                                        <div class="d-flex align-items-center">

                                            <div class="hamburger">
                                                <button type="button" id="buttonHamburger1" class="btn"
                                                    onclick="toggleMenu1()">
                                                    <span class="hamburger-icon">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </span>
                                                </button>
                                                <div class="dropdown-menu menuCompetitive" id="menu1"
                                                    style="display: none">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button"
                                                            onclick="toggleSubMenu1()">
                                                            Analisis Pesaing
                                                        </button>
                                                        <div id="dropdownMenu1" style="display: none;">
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartAnalisisPesaing('perusahaan')">Perusahaan</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartAnalisisPesaing('pendatang_baru')">Pendatang
                                                                Baru</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartAnalisisPesaing('substitusi')">Produk
                                                                Substitusi</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartAnalisisPesaing('pemasok')">Kekuatan
                                                                Menawar
                                                                Pemasok</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartAnalisisPesaing('pembeli')">Kekuatan
                                                                Menawar
                                                                Pembeli</a>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button"
                                                            onclick="toggleSubMenu2()">
                                                            Kekuatan Kelemahan Pesaing
                                                        </button>
                                                        <div id="dropdownMenu2" style="display: none;">
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('product')">Produk</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('distribusi')">Distribusi</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('pemasaran')">Pemasaran</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('operasional')">Operasional</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('riset')">Riset
                                                                dan Pengembangan</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('keuangan')">Keuangan</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('organisasi')">Organisasi</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('manajerial')">Kemampuan
                                                                Manajerial</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('inti')">Kemampuan
                                                                Inti dan Menyesuaikan Diri dengan
                                                                Perubahan</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('portofolio')">Portofolio
                                                                Pesaing</a>
                                                            <a class="dropdown-item"
                                                                onclick="getDataCartKekuatanKelemahan('lainnya')">Lain-lain</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="chartdiv1" class="mb-3 d-flex justify-content-center align-items-center">
                            </div>
                        </div>

                        {{-- Product Intelegence --}}
                        <div class="tab-pane" id="product1" role="tabpanel">
                            <div class="row mb-3">
                                <div class="col-sm-12 d-flex justify-content-between">
                                    <h6 id="titleContent2"> Data Sekunder Permalan Permintaan Produk</h6>
                                    <select id="select_jenis" data-choices data-choices-sorting="true">
                                        @foreach ($jenis_tanaman as $value)
                                            @if ($value === 'JAGUNG HIBRIDA')
                                                <option selected value="{{ $value }}">{{ $value }}
                                                </option>
                                            @else
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <div style="float: right">
                                        <div class="d-flex align-items-center">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <canvas id="graph"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row" id="indexAspek1">
                <div class="col-lg-12">
                    {{-- card index --}}
                    <div class="card cardShadow">
                        <div class="card-header">
                            <h4 class="card-title mb-0 mt-3">Index Kepuasan</h4>
                        </div>
                        <div class="card-body">
                            <div id="table-search">
                                <div class="table-responsive">

                                    <table class="table table-bordered" id="kepuasanPelanggan">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Pertanyaan</th>
                                                <th class="text-center">Kepuasan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="kepuasaPelanggan1">
                                        </tbody>
                                        <thead class="table-light" id="kepuasaPelangganFooter1">
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <div class="row" id="grafikPeramalan" style="display: none;">
                <div class="card cardShadow">
                    <div class="card-header">
                        <h4 class="card-title mb-0 mt-3">Grafik peramalan</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="graph_next_year"></canvas>
                    </div>
                </div>
            </div>
        </div>
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
                    $('#mapAI').html(
                        'Maaf, terjadi kesalahan pada server saat memuat Peta. Silakan segarkan halaman dalam beberapa menit.'
                    );
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
                        const locationName = btoa(value.location.name)
                        const latitude = value.location.latitude
                        const longtitude = value.location.longtitude

                        console.log(value);

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

                        let indexAspek =
                            `<div class="w-100 text-center mt-3"><a class="btn btn-primary btn-sm mx-auto text-white text-capitalize" href="laporanDaerah/${locationName}">index aspek</a></div>`;

                        const containerContent =
                            `<div id="content">${area}${wordCountRetail}${wordCountPotentialArea}${indexAspek}</div>`
                        var marker = L.marker([latitude, longtitude]).addTo(mapAI).bindPopup(
                            containerContent);
                    });
                }

            },
            error: function() {
                console.log('error load maps');
                $('#mapAI').html(
                    'Maaf, terjadi kesalahan pada server saat memuat Peta. Silakan segarkan halaman dalam beberapa menit.'
                );
            },
        });
    }

    function deleteMaps() {
        if (mapAI) {
            mapAI.remove();
        }
    }
</script>

<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Spirited.js"></script>

<script>
    $(document).ready(function() {
        getDataCartKepuasan('product')
        getDataCartAnalisisPesaing('perusahaan')
        startRegretion('JAGUNG HIBRIDA')
    });

    const select_regretion = $('#select_jenis');

    select_regretion.change(function() {
        let value = $(this).val()
        startRegretion(value);
    })

    let chartRegretion;

    let menuVisible = false;
    let menuVisible1 = false;
    let subMenuVisible = false;
    let subMenuVisible1 = false;
    let subMenuVisible2 = false;

    function toggleMenu() {
        if (menuVisible) {
            hideMenu();
        } else {
            showMenu();
        }
    }

    function showMenu() {
        menuVisible = true;
        const menu = document.getElementById('menu');
        menu.style.display = 'block';
    }

    function hideMenu() {
        menuVisible = false;
        const menu = document.getElementById('menu');
        menu.style.display = 'none';
    }

    function toggleMenu1() {
        if (menuVisible1) {
            hideMenu1();
        } else {
            showMenu1();
        }
    }

    function showMenu1() {
        menuVisible1 = true;
        const menu = document.getElementById('menu1');
        menu.style.display = 'block';
    }

    function hideMenu1() {
        menuVisible1 = false;
        const menu = document.getElementById('menu1');
        menu.style.display = 'none';
    }

    function toggleSubMenu() {
        if (subMenuVisible) {
            hideSubmenu();
        } else {
            showSubmenu();
        }
    }

    function showSubmenu() {
        subMenuVisible = true;
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.style.display = 'block';
        // console.log('oke');
    }

    function hideSubmenu() {
        subMenuVisible = false;
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.style.display = 'none';
        // console.log('oke');
    }

    function toggleSubMenu1() {
        if (subMenuVisible1) {
            hideSubmenu1();
        } else {
            showSubmenu1();
            hideSubmenu2();
        }
    }

    function showSubmenu1() {
        subMenuVisible1 = true;
        const dropdownMenu = document.getElementById('dropdownMenu1');
        dropdownMenu.style.display = 'block';
        // console.log('oke');
    }

    function hideSubmenu1() {
        subMenuVisible1 = false;
        const dropdownMenu = document.getElementById('dropdownMenu1');
        dropdownMenu.style.display = 'none';
        // console.log('oke');
    }

    function toggleSubMenu2() {
        if (subMenuVisible2) {
            hideSubmenu2();
        } else {
            showSubmenu2();
            hideSubmenu1();
        }
    }

    function showSubmenu2() {
        subMenuVisible2 = true;
        const dropdownMenu = document.getElementById('dropdownMenu2');
        dropdownMenu.style.display = 'block';
        // console.log('oke');
    }

    function hideSubmenu2() {
        subMenuVisible2 = false;
        const dropdownMenu = document.getElementById('dropdownMenu2');
        dropdownMenu.style.display = 'none';
    }

    function showIndex() {
        const content = document.getElementById('indexAspek1');
        const grafikPeramalan = document.getElementById('grafikPeramalan');

        grafikPeramalan.style.display = "none"
        content.style.display = "block"
    }

    function closeIndex() {
        const content = document.getElementById('indexAspek1');
        const grafikPeramalan = document.getElementById('grafikPeramalan');

        content.style.display = "none"
        grafikPeramalan.style.display = "block"
    }

    function getDataCartKepuasan(kategory) {
        hideMenu();
        hideSubmenu();
        $('#titleContent').html(`Penilaian Pelanggan / Kepuasan / ${kategory}`);

        const urlChart = `{{ url('getPertanyaanKepuasanByRespondentsAll/${kategory}') }}`;
        const urlTable = `{{ url('getPertanyaanKepuasanAll/${kategory}') }}`;
        $.ajax({
            type: "get",
            url: urlChart,
            dataType: "json",
            beforeSend: function() {
                root.dispose();
                $('#chartdiv').html('Loading...');
            },
            success: function(response) {
                startChart(response);
            },
            error: function(params) {
                $('#chartdiv').html('Server error / tidak ada data');
            }
        });

        $.ajax({
            type: "get",
            url: urlTable,
            dataType: "json",
            beforeSend: function() {
                $('#kepuasaPelanggan').html('<tr><td class="text-center" colspan="3">Loading...</td></tr>');
                $('#kepuasaPelangganFooter').html('');
            },
            success: function(response) {
                let contentTable = ''
                let contentTableFooter = ''
                let no = 1;
                $.each(response[1], function(key, value) {
                    contentTable += `<tr>`
                    contentTable += `<td class="text-center">${no}</td>`
                    contentTable += `<td>${key}</td>`
                    contentTable += `<td class="text-center">${value}%</td>`
                    contentTable += `</tr>`
                    no++
                });

                contentTableFooter += `<tr>`
                contentTableFooter += `<th class="text-end" colspan="2">Rata-rata</th>`
                contentTableFooter += `<th class="text-center">${response[0]['Kepuasan']}%</th>`
                contentTableFooter += `</tr>`

                $('#kepuasaPelanggan').html(contentTable);
                $('#kepuasaPelangganFooter').html(contentTableFooter);
            },
            error: function(params) {
                $('#kepuasaPelanggan').html(
                    '<tr><td class="text-center" colspan="3">Server error / tidak ada data</td></tr>');
                $('#kepuasaPelangganFooter').html('');
            }
        });
    }

    function getDataCartKekuatanKelemahan(kategory) {

        hideMenu1();
        hideSubmenu1();
        hideSubmenu2();
        $('#titleContent1').html(`Penilaian Pelanggan / Kekuatan & Kelemahan / ${kategory}`);

        const urlChart = `{{ url('getPertanyaanKekuatanKelemahanByRespondentsAll/${kategory}') }}`;
        const urlTable = `{{ url('getPertanyaanKekuatanKelemahanAll/${kategory}') }}`;
        $.ajax({
            type: "get",
            url: urlChart,
            dataType: "json",
            beforeSend: function() {
                root1.dispose();
                $('#chartdiv1').html('Loading...');
            },
            success: function(response) {
                startChart1(response);
            },
            error: function(params) {
                $('#chartdiv1').html('Server error / tidak ada data');
            }
        });

        $.ajax({
            type: "get",
            url: urlTable,
            dataType: "json",
            beforeSend: function() {
                $('#kepuasaPelanggan1').html(
                    '<tr><td class="text-center" colspan="3">Loading...</td></tr>');
                $('#kepuasaPelangganFooter1').html('');
            },
            success: function(response) {
                let contentTable = ''
                let contentTableFooter = ''
                let no = 1;
                $.each(response[1], function(key, value) {
                    contentTable += `<tr>`
                    contentTable += `<td class="text-center">${no}</td>`
                    contentTable += `<td>${key}</td>`
                    contentTable += `<td class="text-center">${value}%</td>`
                    contentTable += `</tr>`
                    no++
                });

                contentTableFooter += `<tr>`
                contentTableFooter += `<th class="text-end" colspan="2">Rata-rata</th>`
                contentTableFooter += `<th class="text-center">${response[0]['Kepuasan']}%</th>`
                contentTableFooter += `</tr>`

                $('#kepuasaPelanggan1').html(contentTable);
                $('#kepuasaPelangganFooter1').html(contentTableFooter);
            },
            error: function(params) {
                $('#kepuasaPelanggan1').html(
                    '<tr><td class="text-center" colspan="3">Server error / tidak ada data</td></tr>');
                $('#kepuasaPelangganFooter1').html('');
            }
        });
    }

    function getDataCartAnalisisPesaing(kategory) {

        hideMenu1();
        hideSubmenu1();
        hideSubmenu2();
        $('#titleContent1').html(`Analisis Pesaing / ${kategory}`);

        const urlChart = `{{ url('laporanAnalisisPesaingByRespondentsAll/${kategory}') }}`;
        const urlTable = `{{ url('laporanAnalisisPesaingAll/${kategory}') }}`;
        $.ajax({
            type: "get",
            url: urlChart,
            dataType: "json",
            beforeSend: function() {
                root1.dispose();
                $('#chartdiv1').html('Loading...');
            },
            success: function(response) {
                startChart1(response.data);
            },
            error: function(params) {
                $('#chartdiv1').html('Server error / tidak ada data');
            }
        });
        $.ajax({
            type: "get",
            url: urlTable,
            dataType: "json",
            beforeSend: function() {
                $('#kepuasaPelanggan1').html(
                    '<tr><td class="text-center" colspan="3">Loading...</td></tr>');
                $('#kepuasaPelangganFooter1').html('');
            },
            success: function(response) {
                // console.log(response.data);
                let contentTable = ''
                let contentTableFooter = ''
                let no = 1;

                $.each(response.data[1], function(key, value) {
                    contentTable += `<tr>`
                    contentTable += `<td class="text-center">${no}</td>`
                    contentTable += `<td class="text-capitalize">${key}</td>`
                    contentTable += `<td class="text-center">${value}%</td>`
                    contentTable += `</tr>`
                    no++
                });

                contentTableFooter += `<tr>`
                contentTableFooter += `<th class="text-end" colspan="2">Rata-rata</th>`
                contentTableFooter += `<th class="text-center">${response.data[0]}%</th>`
                contentTableFooter += `</tr>`

                $('#kepuasaPelanggan1').html(contentTable);
                $('#kepuasaPelangganFooter1').html(contentTableFooter);
            },
            error: function(params) {
                $('#kepuasaPelanggan1').html(
                    '<tr><td class="text-center" colspan="3">Server error / tidak ada data</td></tr>');
                $('#kepuasaPelangganFooter1').html('');
            }
        });
    }

    function startRegretion(kategory) {
        $.ajax({
            type: "get",
            // url: `{{ url('tes-regretion/${kategory}') }}`,
            url: `{{ url('regretion-non-linier/${kategory}') }}`,
            dataType: "json",
            beforeSend: function() {
                if (chartRegretion) {
                    chartRegretion.destroy();
                    chartRegretionNextYear.destroy();
                }
                $('#graph').html('Loading..');
            },
            success: function(response) {
                $('#loading_graph').hide();
                $('#graph').show();

                let datasets = [];
                let datasetsNextYears = [];

                response.data.forEach((value, index) => {
                    // if (index < 5) {
                    const dataset = [{
                            label: `${value.label}`,
                            data: value.data,
                            fill: false,
                            borderColor: generateRandomColor(),
                            borderWidth: 3
                        },
                        // {
                        //     label: `${value.label}`,
                        //     data: value.data_next_year,
                        //     fill: false,
                        //     borderColor: generateRandomColor(),
                        //     borderWidth: 3
                        // }
                    ];
                    const datasetsNextYear = [{
                            label: `${value.label}`,
                            data: value.data_next_year,
                            fill: false,
                            borderColor: generateRandomColor(),
                            borderWidth: 3
                        },
                        // {
                        //     label: `${value.label}`,
                        //     data: value.data_raw,
                        //     fill: false,
                        //     borderColor: generateRandomColor(),
                        //     borderWidth: 3
                        // }
                    ];

                    dataset.forEach(element => {
                        datasets.push(element);
                    });
                    datasetsNextYear.forEach(element => {
                        datasetsNextYears.push(element);
                    });
                    // }
                });

                // console.log(datasets);\

                if (chartRegretion) {
                    chartRegretionNextYear.destroy();
                    chartRegretion.destroy();
                }

                ctx = document.getElementById('graph');
                ctx2 = document.getElementById('graph_next_year');
                chartRegretion = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep',
                            'Oct', 'Nov', 'Des'
                        ],
                        datasets: datasets
                    }
                })
                chartRegretionNextYear = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep',
                            'Oct', 'Nov', 'Des'
                        ],
                        datasets: datasetsNextYears
                    }
                })
            },
            error: function(params) {
                console.log('error');
                // $('#chartdiv').html('Server error / tidak ada data');
            }
        });
    }

    function generateRandomColor() {
        var red = Math.floor(Math.random() * 256);
        var green = Math.floor(Math.random() * 256);
        var blue = Math.floor(Math.random() * 256);
        var alpha = 0.2; // Set alpha to 0.2 by default

        var rgbaColor = 'rgba(' + red + ', ' + green + ', ' + blue + ', ' + alpha + ')';

        return rgbaColor;
    }

    var root = am5.Root.new("chartdiv");
    var root1 = am5.Root.new("chartdiv1");

    function startChart(response) {
        am5.ready(function() {
            // Data
            var allData = response[0];

            let countData = 0;

            for (var key in allData) {
                if (allData.hasOwnProperty(key)) {
                    countData++;
                }
            }

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            $('#chartdiv').html('');
            root.dispose();
            root = am5.Root.new("chartdiv");

            root.numberFormatter.setAll({
                numberFormat: "#.##'%'",

                // Do not use small number prefixes at all
                smallNumberPrefixes: [],
            });

            var stepDuration = 2000;

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/

            root.setThemes([am5themes_Animated.new(root)]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(
                am5xy.XYChart.new(root, {
                    panX: true,
                    panY: true,
                    wheelX: "none",
                    wheelY: "none",
                })
            );

            // We don't want zoom-out button to appear while animating, so we hide it at all
            chart.zoomOutButton.set("forceHidden", true);

            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var yRenderer = am5xy.AxisRendererY.new(root, {
                minGridDistance: 20,
                inversed: true,
            });
            // hide grid
            yRenderer.grid.template.set("visible", false);

            var yAxis = chart.yAxes.push(
                am5xy.CategoryAxis.new(root, {
                    maxDeviation: 0,
                    categoryField: "network",
                    renderer: yRenderer,
                })
            );

            var xAxis = chart.xAxes.push(
                am5xy.ValueAxis.new(root, {
                    maxDeviation: 0,
                    min: 0,
                    strictMinMax: true,
                    extraMax: 0.1,
                    renderer: am5xy.AxisRendererX.new(root, {}),
                })
            );

            xAxis.set("interpolationDuration", stepDuration / 10);
            xAxis.set("interpolationEasing", am5.ease.linear);

            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(
                am5xy.ColumnSeries.new(root, {
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueXField: "value",
                    categoryYField: "network",
                })
            );

            // Rounded corners for columns
            series.columns.template.setAll({
                cornerRadiusBR: 5,
                cornerRadiusTR: 5,
            });

            // Make each column to be of a different color
            series.columns.template.adapters.add(
                "fill",
                function(fill, target) {
                    return chart
                        .get("colors")
                        .getIndex(series.columns.indexOf(target));
                }
            );

            series.columns.template.adapters.add(
                "stroke",
                function(stroke, target) {
                    return chart
                        .get("colors")
                        .getIndex(series.columns.indexOf(target));
                }
            );

            // Add label bullet
            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    locationX: 1,
                    sprite: am5.Label.new(root, {
                        text: "{valueXWorking.formatNumber('#.##')}%",
                        fill: root.interfaceColors.get("alternativeText"),
                        centerX: am5.p100,
                        centerY: am5.p50,
                        populateText: true,
                    }),
                });
            });

            var label = chart.plotContainer.children.push(
                am5.Label.new(root, {
                    text: "2002",
                    fontSize: "8em",
                    opacity: 0,
                    x: am5.p100,
                    y: am5.p100,
                    centerY: am5.p100,
                    centerX: am5.p100,
                })
            );

            // Get series item by category
            function getSeriesItem(category) {
                for (var i = 0; i < series.dataItems.length; i++) {
                    var dataItem = series.dataItems[i];
                    if (dataItem.get("categoryY") == category) {
                        return dataItem;
                    }
                }
            }

            // Axis sorting
            function sortCategoryAxis() {
                // sort by value
                series.dataItems.sort(function(x, y) {
                    return y.get("valueX") - x.get("valueX"); // descending
                    //return x.get("valueX") - y.get("valueX"); // ascending
                });

                // go through each axis item
                am5.array.each(yAxis.dataItems, function(dataItem) {
                    // get corresponding series item
                    var seriesDataItem = getSeriesItem(dataItem.get("category"));

                    if (seriesDataItem) {
                        // get index of series data item
                        var index = series.dataItems.indexOf(seriesDataItem);
                        // calculate delta position
                        var deltaPosition =
                            (index - dataItem.get("index", 0)) /
                            series.dataItems.length;
                        // set index to be the same as series data item index
                        if (dataItem.get("index") != index) {
                            dataItem.set("index", index);
                            // set deltaPosition instanlty
                            dataItem.set("deltaPosition", -deltaPosition);
                            // animate delta position to 0
                            dataItem.animate({
                                key: "deltaPosition",
                                to: 0,
                                duration: stepDuration / 2,
                                easing: am5.ease.out(am5.ease.cubic),
                            });
                        }
                    }
                });
                // sort axis items by index.
                // This changes the order instantly, but as deltaPosition is set, they keep in the same places and then animate to true positions.
                yAxis.dataItems.sort(function(x, y) {
                    return x.get("index") - y.get("index");
                });
            }

            var year = 0;

            // update data with values each 1.5 sec
            var interval = setInterval(function() {
                year++;

                if (year > countData) {
                    clearInterval(interval);
                    clearInterval(sortInterval);
                    // console.log('Berhasil Masuk Pak Eko');
                }

                updateData();
            }, stepDuration);

            var sortInterval = setInterval(function() {
                sortCategoryAxis();
            }, 100);

            function setInitialData() {
                var d = allData[year];

                for (var n in d) {
                    series.data.push({
                        network: n,
                        value: d[n]
                    });
                    yAxis.data.push({
                        network: n
                    });
                }
            }

            function updateData() {
                var itemsWithNonZero = 0;

                if (allData[year]) {
                    label.set("text", year.toString());

                    am5.array.each(series.dataItems, function(dataItem) {
                        var category = dataItem.get("categoryY");
                        var value = allData[year][category];

                        if (value > 0) {
                            itemsWithNonZero++;
                        }

                        dataItem.animate({
                            key: "valueX",
                            to: value,
                            duration: stepDuration,
                            easing: am5.ease.linear,
                        });
                        dataItem.animate({
                            key: "valueXWorking",
                            to: value,
                            duration: stepDuration,
                            easing: am5.ease.linear,
                        });
                    });

                    yAxis.zoom(0, itemsWithNonZero / yAxis.dataItems.length);
                }
            }

            setInitialData();
            setTimeout(function() {
                year++;
                updateData();
            }, 50);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);
        });
    }

    function startChart1(response) {
        am5.ready(function() {
            // Data
            var allData = response[0];

            let countData = 0;

            for (var key in allData) {
                if (allData.hasOwnProperty(key)) {
                    countData++;
                }
            }

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            $('#chartdiv1').html('');
            root1.dispose();
            root1 = am5.Root.new("chartdiv1");

            root1.numberFormatter.setAll({
                numberFormat: "#.##'%'",

                // Do not use small number prefixes at all
                smallNumberPrefixes: [],
            });

            var stepDuration = 2000;

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/

            root1.setThemes([am5themes_Animated.new(root1)]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root1.container.children.push(
                am5xy.XYChart.new(root1, {
                    panX: true,
                    panY: true,
                    wheelX: "none",
                    wheelY: "none",
                })
            );

            // We don't want zoom-out button to appear while animating, so we hide it at all
            chart.zoomOutButton.set("forceHidden", true);

            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var yRenderer = am5xy.AxisRendererY.new(root1, {
                minGridDistance: 20,
                inversed: true,
            });
            // hide grid
            yRenderer.grid.template.set("visible", false);

            var yAxis = chart.yAxes.push(
                am5xy.CategoryAxis.new(root1, {
                    maxDeviation: 0,
                    categoryField: "network",
                    renderer: yRenderer,
                })
            );

            var xAxis = chart.xAxes.push(
                am5xy.ValueAxis.new(root1, {
                    maxDeviation: 0,
                    min: 0,
                    strictMinMax: true,
                    extraMax: 0.1,
                    renderer: am5xy.AxisRendererX.new(root1, {}),
                })
            );

            xAxis.set("interpolationDuration", stepDuration / 10);
            xAxis.set("interpolationEasing", am5.ease.linear);

            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(
                am5xy.ColumnSeries.new(root1, {
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueXField: "value",
                    categoryYField: "network",
                })
            );

            // Rounded corners for columns
            series.columns.template.setAll({
                cornerRadiusBR: 5,
                cornerRadiusTR: 5,
            });

            // Make each column to be of a different color
            series.columns.template.adapters.add(
                "fill",
                function(fill, target) {
                    return chart
                        .get("colors")
                        .getIndex(series.columns.indexOf(target));
                }
            );

            series.columns.template.adapters.add(
                "stroke",
                function(stroke, target) {
                    return chart
                        .get("colors")
                        .getIndex(series.columns.indexOf(target));
                }
            );

            // Add label bullet
            series.bullets.push(function() {
                return am5.Bullet.new(root1, {
                    locationX: 1,
                    sprite: am5.Label.new(root1, {
                        text: "{valueXWorking.formatNumber('#.##')}%",
                        fill: root1.interfaceColors.get("alternativeText"),
                        centerX: am5.p100,
                        centerY: am5.p50,
                        populateText: true,
                    }),
                });
            });

            var label = chart.plotContainer.children.push(
                am5.Label.new(root1, {
                    text: "2002",
                    fontSize: "8em",
                    opacity: 0,
                    x: am5.p100,
                    y: am5.p100,
                    centerY: am5.p100,
                    centerX: am5.p100,
                })
            );

            // Get series item by category
            function getSeriesItem(category) {
                for (var i = 0; i < series.dataItems.length; i++) {
                    var dataItem = series.dataItems[i];
                    if (dataItem.get("categoryY") == category) {
                        return dataItem;
                    }
                }
            }

            // Axis sorting
            function sortCategoryAxis() {
                // sort by value
                series.dataItems.sort(function(x, y) {
                    return y.get("valueX") - x.get("valueX"); // descending
                    //return x.get("valueX") - y.get("valueX"); // ascending
                });

                // go through each axis item
                am5.array.each(yAxis.dataItems, function(dataItem) {
                    // get corresponding series item
                    var seriesDataItem = getSeriesItem(dataItem.get("category"));

                    if (seriesDataItem) {
                        // get index of series data item
                        var index = series.dataItems.indexOf(seriesDataItem);
                        // calculate delta position
                        var deltaPosition =
                            (index - dataItem.get("index", 0)) /
                            series.dataItems.length;
                        // set index to be the same as series data item index
                        if (dataItem.get("index") != index) {
                            dataItem.set("index", index);
                            // set deltaPosition instanlty
                            dataItem.set("deltaPosition", -deltaPosition);
                            // animate delta position to 0
                            dataItem.animate({
                                key: "deltaPosition",
                                to: 0,
                                duration: stepDuration / 2,
                                easing: am5.ease.out(am5.ease.cubic),
                            });
                        }
                    }
                });
                // sort axis items by index.
                // This changes the order instantly, but as deltaPosition is set, they keep in the same places and then animate to true positions.
                yAxis.dataItems.sort(function(x, y) {
                    return x.get("index") - y.get("index");
                });
            }

            var year = 0;

            // update data with values each 1.5 sec
            var interval = setInterval(function() {
                year++;

                if (year > countData) {
                    clearInterval(interval);
                    clearInterval(sortInterval);
                    // console.log('Berhasil Masuk Pak Eko');
                }

                updateData();
            }, stepDuration);

            var sortInterval = setInterval(function() {
                sortCategoryAxis();
            }, 100);

            function setInitialData() {
                var d = allData[year];

                for (var n in d) {
                    series.data.push({
                        network: n,
                        value: d[n]
                    });
                    yAxis.data.push({
                        network: n
                    });
                }
            }

            function updateData() {
                var itemsWithNonZero = 0;

                if (allData[year]) {
                    label.set("text", year.toString());

                    am5.array.each(series.dataItems, function(dataItem) {
                        var category = dataItem.get("categoryY");
                        var value = allData[year][category];

                        if (value > 0) {
                            itemsWithNonZero++;
                        }

                        dataItem.animate({
                            key: "valueX",
                            to: value,
                            duration: stepDuration,
                            easing: am5.ease.linear,
                        });
                        dataItem.animate({
                            key: "valueXWorking",
                            to: value,
                            duration: stepDuration,
                            easing: am5.ease.linear,
                        });
                    });

                    yAxis.zoom(0, itemsWithNonZero / yAxis.dataItems.length);
                }
            }

            setInitialData();
            setTimeout(function() {
                year++;
                updateData();
            }, 50);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);
        });
    }
</script>
@endsection
