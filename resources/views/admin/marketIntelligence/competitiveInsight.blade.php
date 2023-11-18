@extends('layout.app')
@section('title', 'Competitive Insight')
@section('menu', 'Competitive Insight')
@section('submenu', 'Menu')


@section('content')
@section('otherStyle')
    <style>
        #chartdiv {
            width: 100%;
            height: 350px;
        }

        .dropdown-hover:hover .kuisioner {
            display: block;
            right: 0;
            left: 0;
        }

        .dropdown-menu.kuisioner li {
            white-space: normal;
        }

        .dropdown-menu.kuisioner a.dropdown-item {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block;
        }

        .cardWord {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
<div class="row">
    <div class="col-xxl-12">
        <div class="card">
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
                                <h6 id="titleContent"> Analisis Pesaing
                                </h6>
                            </div>
                            <div class="col-sm-6 text-right">
                                <div style="float: right">
                                    <div class="d-flex align-items-center">

                                        <div class="hamburger">
                                            <button type="button" class="btn" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="hamburger-icon">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->

                                                {{-- analisis pesaing --}}
                                                <div class="dropdown-item dropdown-hover">
                                                    <span class="align-middle dropdown-toggle">Analisis
                                                        Pesaing</span>
                                                    <div class="nav-item dropdown">
                                                        <ul class="dropdown-menu kuisioner">
                                                            <li><a class="dropdown-item">Perusahaan</a>
                                                            </li>
                                                            <li><a class="dropdown-item">Pendatang
                                                                    Baru</a>
                                                            </li>
                                                            <li><a class="dropdown-item">Produk
                                                                    Substitusi</a>
                                                            </li>
                                                            <li><a class="dropdown-item">Kekuatan
                                                                    Menawar
                                                                    Pemasok</a>
                                                            </li>
                                                            <li><a class="dropdown-item">Kekuatan
                                                                    Menawar
                                                                    Pembeli</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                {{-- kekuatan kelemahan pesaing --}}
                                                <div class="dropdown-item dropdown-hover">
                                                    <span class="align-middle dropdown-toggle">Kekuatan Kelemahan
                                                        Pesaing</span>
                                                    <div class="nav-item dropdown">
                                                        <ul class="dropdown-menu kuisioner">
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('product')">Produk</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('distribusi')">Distribusi</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('pemasaran')">Pemasaran</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('operasional')">Operasional</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('riset')">Riset
                                                                    dan Pengembangan</a></li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('keuangan')">Keuangan</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('organisasi')">Organisasi</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('manajerial')">Kemampuan
                                                                    Manajerial</a></li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('inti')">Kemampuan
                                                                    Inti dan Menyesuaikan Diri dengan
                                                                    Perubahan</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('portofolio')">Portofolio
                                                                    Pesaing</a></li>
                                                            <li><a class="dropdown-item"
                                                                    onclick="getDataCartKekuatanKelemahan('lainnya')">Lain-lain</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="chartdiv" class="mb-3 d-flex justify-content-center align-items-center">
                        </div>
                    </div>

                    {{-- Product Intelegence --}}
                    <div class="tab-pane" id="product1" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <h6 id="titleContent1"> Data Sekunder Permalan Permintaan Produk</h6>
                            </div>
                            <div class="col-sm-6 text-right">
                                <div style="float: right">
                                    <div class="d-flex align-items-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="chartdiv" class="mb-3 d-flex justify-content-center align-items-center"></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- index kepuasan --}}
<div class="row" id="indexAspek">
    <div class="col-lg-12">
        {{-- card index --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0 mt-3">Index Kepuasan</h4>
            </div>
            <div class="card-body">
                <div id="table-search">
                    <div class="table-responsive">

                        <table class="table table-bordered table-nowrap" id="kepuasanPelanggan">
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
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

<div class="row">
    <div class="text-center mt-3 mb-3">
        <form action="{{ route('laporan.index') }}">
            @csrf
            <button class="btn btn-primary">Kembali</button>
        </form>
    </div>
</div>
@endsection

@section('otherJs')
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Spirited.js"></script>

<!-- Chart code -->
<script>
    $(document).ready(function() {
        // getDataCartKepuasan('perusahaan')
        $('#titleContent').html(`Analisis Pesaing`);
        $('#chartdiv').html('Server error / tidak ada data');
    });

    function showIndex() {
        const indexAspek = document.getElementById('indexAspek');
        indexAspek.style.display = "block"
    }

    function closeIndex() {
        const content = document.getElementById('indexAspek');
        content.style.display = "none"
    }

    function getDataCartKepuasan(kategory, daerah) {

        $('#titleContent').html(`Kepuasan / ${kategory}`);

        const area = btoa(daerah)
        const urlChart = `{{ url('getPertanyaanKepuasanByRespondents/${kategory}/${area}') }}`;
        const urlTable = `{{ url('getPertanyaanKepuasan/${kategory}/${area}') }}`;
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
        $('#titleContent').html(`Penilaian Pelanggan / Kekuatan & Kelemahan / ${kategory}`);

        const urlChart = `{{ url('getPertanyaanKekuatanKelemahanByRespondentsAll/${kategory}') }}`;
        const urlTable = `{{ url('getPertanyaanKekuatanKelemahanAll/${kategory}') }}`;


        var chartDiv = document.getElementById('chartdiv');
        chartDiv.classList.remove('d-block');

        const indexAspek = document.getElementById('indexAspek');
        indexAspek.style.display = "block";

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
    var root = am5.Root.new("chartdiv");

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

    function getWord(kategory) {
        let url;
        // const area = btoa(daerah)

        if (kategory == "retail") {
            url = `{{ url('getRetail') }}`;

            $('#titleContent').html(`Survai Pesaing / Gambaran Umum`);

            const workCount = document.getElementById('wordCountView');
            workCount.classList.remove('d-none');

            var chartDiv = document.getElementById('chartdiv');
            chartDiv.classList.add('d-none');

            const indexAspek = document.getElementById('indexAspek');
            indexAspek.style.display = "none";

        } else if (kategory == "potentional") {
            url = `{{ url('getPotentionalArea') }}`;

            $('#titleContent1').html(`Potensi Lahan / Gambaran Umum`);
            const workCount1 = document.getElementById('wordCountView1');
            workCount1.classList.remove('d-none');
        }

        $.ajax({
            type: "get",
            url: url,
            dataType: "json",
            beforeSend: function() {
                $('#ranking').html('<li class="list-group-item">Loading...</li>');
                $('#deskripsi').html('<li class="list-group-item">Loading...</li>');
            },
            success: function(res) {
                let ranking = '';
                let suggestions = '';
                $.each(res.ranking, function(index, val) {
                    if (index < 3) {
                        ranking += `<li class="list-group-item">${val.word}.</li>`
                    }
                });
                $.each(res.suggestions, function(index, val) {
                    suggestions += `<li class="list-group-item">${val}.</li>`
                });

                $('#ranking').html(ranking);
                $('#deskripsi').html(suggestions);
            },
            error: function(params) {
                $('#ranking').html('<li class="list-group-item">Server error / tidak ada data</li>');
                $('#deskripsi').html('<li class="list-group-item">Server error / tidak ada data</li>');
            }
        });
    }
</script>
@endsection
