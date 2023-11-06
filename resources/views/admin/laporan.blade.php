@extends('layout.app')
@section('title', 'Laporan')
@section('menu', 'Laporan')
@section('submenu', 'Menu')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="card-title mb-0 mt-3">Penilaian Pelanggan</h4>
                        </div>
                        <div class="col-sm-6 text-right">
                            <div style="float: right">
                                <div class="d-flex align-items-center">

                                    <div class="hamburger">
                                        <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <span class="hamburger-icon">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <nav class="navbar navbar-expand-sm bg-body-tertiary">
                                                <div class="px-1">
                                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                        <ul class="navbar-nav me-auto">
                                                            <li class="nav-item dropdown">
                                                                <a class="nav-link dropdown-toggle" href="#"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false" style="color: black">
                                                                    Kepuasan Pelanggan
                                                                </a>
                                                                <ul class="dropdown-menu kuisioner">
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKepuasan('product', '')">Produk</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKepuasan('promosi', '')">Promosi</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKepuasan('kualitas', '')">Kualitas
                                                                            produk</a></li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKepuasan('layanan', '')">Layanan
                                                                            petugas lapang</a></li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKepuasan('penanganan', '')">Penanganan
                                                                            komplain pelanggan</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </nav>
                                            <nav class="navbar navbar-expand-sm bg-body-tertiary">
                                                <div class="px-1">
                                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                        <ul class="navbar-nav me-auto">
                                                            <li class="nav-item dropdown">
                                                                <a class="nav-link dropdown-toggle" href="#"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false" style="color: black">
                                                                    Kekuatan Kelemahan Pesaing
                                                                </a>
                                                                <ul class="dropdown-menu kuisioner">
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('product', '')">Produk</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('distribusi', '')">Distribusi</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('pemasaran', '')">Pemasaran</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('operasional', '')">Operasional</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('riset', '')">Riset
                                                                            dan Pengembangan</a></li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('keuangan', '')">Keuangan</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('organisasi', '')">Organisasi</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('manajerial', '')">Kemampuan
                                                                            Manajerial</a></li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('inti', '')">Kemampuan
                                                                            Inti dan Menyesuaikan Diri dengan Perubahan</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('portofolio', '')">Portofolio
                                                                            Pesaing</a></li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="getDataCartKekuatanKelemahan('lainnya', '')">Lain-lain</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="chartdiv" class="mb-3"></div>
                    {{-- <div id="table-search">
                        <div class="mb-3">
                            <label class="form-label">Pilih Kuisioner</label>
                            <!-- Select -->
                            <div class="input-group">
                                <select class="form-select" id="kuisioner" onchange="showjawaban(this)">
                                    <option value="" selected disabled>Pilih...</option>
                                    <option value="customer">Kepuasan Pelanggan</option>
                                    <option value="competitor-analys">Analisis Pesaing</option>
                                    <option value="competitor-identifier">Kekuatan Kelemahan Pesaing</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap" id="penilaianPelanggan">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Pertanyaan</th>
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="dataDetail">
                                </tbody>
                            </table>

                            <table class="table table-bordered table-nowrap" id="analisisPenilaianPelanggan"
                                style="display: none">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Pertanyaan</th>
                                        <th class="text-center">Ya</th>
                                        <th class="text-center">Tidak</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="dataDetail">
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Perhitungan Aspek Index</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    {{-- <div id="table-search">
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap" id="aspekIndex">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Pertanyaan</th>
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Index</th>
                                        <th class="text-center">Kepuasan</th>
                                    </tr>
                                </thead>
                                <tbody id="dataDetail1">
                                </tbody>
                            </table>

                            <table class="table table-bordered table-nowrap" id="analisisAspekIndex" style="display: none;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Pertanyaan</th>
                                        <th class="text-center">Ya</th>
                                        <th class="text-center">Tidak</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Index</th>
                                        <th class="text-center">Kepuasan</th>
                                    </tr>
                                </thead>
                                <tbody id="dataDetail1">
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
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
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('otherJs')
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Spirited.js"></script>

    <script>
        // function showjawaban(idJawaban) {
        //     var value = idJawaban.value;
        //     var table1 = document.getElementById('penilaianPelanggan');;
        //     var table2 = document.getElementById('aspekIndex');
        //     var table3 = document.getElementById('analisisPenilaianPelanggan');
        //     var table4 = document.getElementById('analisisAspekIndex');
        //     // console.log(value);

        //     if (value == 'competitor-analys') {
        //         if (table1 && table2) {
        //             table1.style.display = 'none';
        //             table2.style.display = 'none';
        //             table3.style.display = 'table';
        //             table4.style.display = 'table';
        //         } else {
        //             console.log("null");
        //         }
        //     } else {

        //         table1.style.display = 'table';
        //         table2.style.display = 'table';
        //         table3.style.display = 'none';
        //         table4.style.display = 'none';

        //         if (value) {
        //             const url = "{{ route('laporan.jawaban', ['type' => '/']) }}/" + value;
        //             ajax('get', url, function(response) {
        //                 // console.log(response);
        //                 const penilaian_pelanggan = response.penilaian_pelanggan
        //                 const perhitungan_index_aspek = response.perhitungan_index_aspek
        //                 //kosongkan konten sebelumnya
        //                 $('#dataDetail').empty();
        //                 $('#dataDetail1').empty();

        //                 let kontenDataDetail = ''
        //                 let countData = 1
        //                 $.each(penilaian_pelanggan, function(key, value) {
        //                     kontenDataDetail += `<tr>`
        //                     kontenDataDetail += `<td class="text-center">${countData}</td>`
        //                     kontenDataDetail +=
        //                         `<td class="text-center text-capitalize">${key.replace(/_/g, ' ')}</td>`
        //                     kontenDataDetail +=
        //                         `<td class="text-center">${value['1'] != undefined ? value['1'] : '0'}</td>`
        //                     kontenDataDetail +=
        //                         `<td class="text-center">${value['2'] != undefined ? value['2'] : '0'}</td>`
        //                     kontenDataDetail +=
        //                         `<td class="text-center">${value['3'] != undefined ? value['3'] : '0'}</td>`
        //                     kontenDataDetail +=
        //                         `<td class="text-center">${value['4'] != undefined ? value['4'] : '0'}</td>`
        //                     kontenDataDetail +=
        //                         `<td class="text-center">${value['5'] != undefined ? value['5'] : '0'}</td>`
        //                     kontenDataDetail +=
        //                         `<td class="text-center">${value['total'] != undefined ? value['total'] : '0'}</td>`
        //                     kontenDataDetail += `</tr>`
        //                     countData++
        //                 });

        //                 let kontenDataDetail1 = ''
        //                 let countData1 = 1
        //                 $.each(perhitungan_index_aspek, function(key, value) {
        //                     kontenDataDetail1 += `<tr>`
        //                     kontenDataDetail1 += `<td class="text-center">${countData1}</td>`
        //                     kontenDataDetail1 +=
        //                         `<td class="text-center text-capitalize">${key.replace(/_/g, ' ')}</td>`
        //                     kontenDataDetail1 +=
        //                         `<td class="text-center">${value['1'] != undefined ? value['1'] : '0'}</td>`
        //                     kontenDataDetail1 +=
        //                         `<td class="text-center">${value['2'] != undefined ? value['2'] : '0'}</td>`
        //                     kontenDataDetail1 +=
        //                         `<td class="text-center">${value['3'] != undefined ? value['3'] : '0'}</td>`
        //                     kontenDataDetail1 +=
        //                         `<td class="text-center">${value['4'] != undefined ? value['4'] : '0'}</td>`
        //                     kontenDataDetail1 +=
        //                         `<td class="text-center">${value['5'] != undefined ? value['5'] : '0'}</td>`
        //                     kontenDataDetail1 +=
        //                         `<td class="text-center">${value['total'] != undefined ? value['total'] : '0'}</td>`
        //                     kontenDataDetail1 +=
        //                         `<td class="text-center">${value['index'] != undefined ? value['index'] : '0'}</td>`
        //                     kontenDataDetail1 +=
        //                         `<td class="text-center">${value['kepuasan'] != undefined ? value['kepuasan'] : '0%'}</td>`
        //                     kontenDataDetail1 += `</tr>`
        //                     countData1++
        //                 });

        //                 $('#dataDetail').append(kontenDataDetail);
        //                 $('#dataDetail1').append(kontenDataDetail1);
        //             })
        //         }
        //     }
        // }

        am5.ready(function() {
            // Data
            var allData = {
                '2002': {
                    Friendster: 0,
                    Facebook: 0,
                    Flickr: 0,
                    'Google Buzz': 0,
                    'Google+': 0,
                    Hi5: 0,
                    Instagram: 0,
                    MySpace: 0,
                    Orkut: 0,
                    Pinterest: 0,
                    Reddit: 0,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 0,
                    WeChat: 0,
                    Weibo: 0,
                    Whatsapp: 0,
                    YouTube: 0,
                },
                '2003': {
                    Friendster: 4470000,
                    Facebook: 0,
                    Flickr: 0,
                    'Google Buzz': 0,
                    'Google+': 0,
                    Hi5: 0,
                    Instagram: 0,
                    MySpace: 0,
                    Orkut: 0,
                    Pinterest: 0,
                    Reddit: 0,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 0,
                    WeChat: 0,
                    Weibo: 0,
                    Whatsapp: 0,
                    YouTube: 0,
                },
                '2004': {
                    Friendster: 5970054,
                    Facebook: 0,
                    Flickr: 3675135,
                    'Google Buzz': 0,
                    'Google+': 0,
                    Hi5: 0,
                    Instagram: 0,
                    MySpace: 980036,
                    Orkut: 4900180,
                    Pinterest: 0,
                    Reddit: 0,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 0,
                    WeChat: 0,
                    Weibo: 0,
                    Whatsapp: 0,
                    YouTube: 0,
                },
                '2005': {
                    Friendster: 7459742,
                    Facebook: 0,
                    Flickr: 7399354,
                    'Google Buzz': 0,
                    'Google+': 0,
                    Hi5: 9731610,
                    Instagram: 0,
                    MySpace: 19490059,
                    Orkut: 9865805,
                    Pinterest: 0,
                    Reddit: 0,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 0,
                    WeChat: 0,
                    Weibo: 0,
                    Whatsapp: 0,
                    YouTube: 1946322,
                },
                '2006': {
                    Friendster: 8989854,
                    Facebook: 0,
                    Flickr: 14949270,
                    'Google Buzz': 0,
                    'Google+': 0,
                    Hi5: 19932360,
                    Instagram: 0,
                    MySpace: 54763260,
                    Orkut: 14966180,
                    Pinterest: 0,
                    Reddit: 248309,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 0,
                    WeChat: 0,
                    Weibo: 0,
                    Whatsapp: 0,
                    YouTube: 19878248,
                },
                '2007': {
                    Friendster: 24253200,
                    Facebook: 0,
                    Flickr: 29299875,
                    'Google Buzz': 0,
                    'Google+': 0,
                    Hi5: 29533250,
                    Instagram: 0,
                    MySpace: 69299875,
                    Orkut: 26916562,
                    Pinterest: 0,
                    Reddit: 488331,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 0,
                    WeChat: 0,
                    Weibo: 0,
                    Whatsapp: 0,
                    YouTube: 143932250,
                },
                '2008': {
                    Friendster: 51008911,
                    Facebook: 100000000,
                    Flickr: 30000000,
                    'Google Buzz': 0,
                    'Google+': 0,
                    Hi5: 55045618,
                    Instagram: 0,
                    MySpace: 72408233,
                    Orkut: 44357628,
                    Pinterest: 0,
                    Reddit: 1944940,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 0,
                    WeChat: 0,
                    Weibo: 0,
                    Whatsapp: 0,
                    YouTube: 294493950,
                },
                '2009': {
                    Friendster: 28804331,
                    Facebook: 276000000,
                    Flickr: 41834525,
                    'Google Buzz': 0,
                    'Google+': 0,
                    Hi5: 57893524,
                    Instagram: 0,
                    MySpace: 70133095,
                    Orkut: 47366905,
                    Pinterest: 0,
                    Reddit: 3893524,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 0,
                    WeChat: 0,
                    Weibo: 0,
                    Whatsapp: 0,
                    YouTube: 413611440,
                },
                '2010': {
                    Friendster: 0,
                    Facebook: 517750000,
                    Flickr: 54708063,
                    'Google Buzz': 166029650,
                    'Google+': 0,
                    Hi5: 59953290,
                    Instagram: 0,
                    MySpace: 68046710,
                    Orkut: 49941613,
                    Pinterest: 0,
                    Reddit: 0,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 43250000,
                    WeChat: 0,
                    Weibo: 19532900,
                    Whatsapp: 0,
                    YouTube: 480551990,
                },
                '2011': {
                    Friendster: 0,
                    Facebook: 766000000,
                    Flickr: 66954600,
                    'Google Buzz': 170000000,
                    'Google+': 0,
                    Hi5: 46610848,
                    Instagram: 0,
                    MySpace: 46003536,
                    Orkut: 47609080,
                    Pinterest: 0,
                    Reddit: 0,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 0,
                    Twitter: 92750000,
                    WeChat: 47818400,
                    Weibo: 48691040,
                    Whatsapp: 0,
                    YouTube: 642669824,
                },
                '2012': {
                    Friendster: 0,
                    Facebook: 979750000,
                    Flickr: 79664888,
                    'Google Buzz': 170000000,
                    'Google+': 107319100,
                    Hi5: 0,
                    Instagram: 0,
                    MySpace: 0,
                    Orkut: 45067022,
                    Pinterest: 0,
                    Reddit: 0,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 146890156,
                    Twitter: 160250000,
                    WeChat: 118123370,
                    Weibo: 79195730,
                    Whatsapp: 0,
                    YouTube: 844638200,
                },
                '2013': {
                    Friendster: 0,
                    Facebook: 1170500000,
                    Flickr: 80000000,
                    'Google Buzz': 170000000,
                    'Google+': 205654700,
                    Hi5: 0,
                    Instagram: 117500000,
                    MySpace: 0,
                    Orkut: 0,
                    Pinterest: 0,
                    Reddit: 0,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 293482050,
                    Twitter: 223675000,
                    WeChat: 196523760,
                    Weibo: 118261880,
                    Whatsapp: 300000000,
                    YouTube: 1065223075,
                },
                '2014': {
                    Friendster: 0,
                    Facebook: 1334000000,
                    Flickr: 0,
                    'Google Buzz': 170000000,
                    'Google+': 254859015,
                    Hi5: 0,
                    Instagram: 250000000,
                    MySpace: 0,
                    Orkut: 0,
                    Pinterest: 0,
                    Reddit: 135786956,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 388721163,
                    Twitter: 223675000,
                    WeChat: 444232415,
                    Weibo: 154890345,
                    Whatsapp: 498750000,
                    YouTube: 1249451725,
                },
                '2015': {
                    Friendster: 0,
                    Facebook: 1516750000,
                    Flickr: 0,
                    'Google Buzz': 170000000,
                    'Google+': 298950015,
                    Hi5: 0,
                    Instagram: 400000000,
                    MySpace: 0,
                    Orkut: 0,
                    Pinterest: 0,
                    Reddit: 163346676,
                    Snapchat: 0,
                    TikTok: 0,
                    Tumblr: 475923363,
                    Twitter: 304500000,
                    WeChat: 660843407,
                    Weibo: 208716685,
                    Whatsapp: 800000000,
                    YouTube: 1328133360,
                },
                '2016': {
                    Friendster: 0,
                    Facebook: 1753500000,
                    Flickr: 0,
                    'Google Buzz': 0,
                    'Google+': 398648000,
                    Hi5: 0,
                    Instagram: 550000000,
                    MySpace: 0,
                    Orkut: 0,
                    Pinterest: 143250000,
                    Reddit: 238972480,
                    Snapchat: 238648000,
                    TikTok: 0,
                    Tumblr: 565796720,
                    Twitter: 314500000,
                    WeChat: 847512320,
                    Weibo: 281026560,
                    Whatsapp: 1000000000,
                    YouTube: 1399053600,
                },
                '2017': {
                    Friendster: 0,
                    Facebook: 2035750000,
                    Flickr: 0,
                    'Google Buzz': 0,
                    'Google+': 495657000,
                    Hi5: 0,
                    Instagram: 750000000,
                    MySpace: 0,
                    Orkut: 0,
                    Pinterest: 195000000,
                    Reddit: 297394200,
                    Snapchat: 0,
                    TikTok: 239142500,
                    Tumblr: 593783960,
                    Twitter: 328250000,
                    WeChat: 921742750,
                    Weibo: 357569030,
                    Whatsapp: 1333333333,
                    YouTube: 1495657000,
                },
                '2018': {
                    Friendster: 0,
                    Facebook: 2255250000,
                    Flickr: 0,
                    'Google Buzz': 0,
                    'Google+': 430000000,
                    Hi5: 0,
                    Instagram: 1000000000,
                    MySpace: 0,
                    Orkut: 0,
                    Pinterest: 246500000,
                    Reddit: 355000000,
                    Snapchat: 0,
                    TikTok: 500000000,
                    Tumblr: 624000000,
                    Twitter: 329500000,
                    WeChat: 1000000000,
                    Weibo: 431000000,
                    Whatsapp: 1433333333,
                    YouTube: 1900000000,
                },
            }

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new('chartdiv')

            root.numberFormatter.setAll({
                numberFormat: "#.##'%'",

                // Do not use small number prefixes at all
                smallNumberPrefixes: [],
            })

            var stepDuration = 2000

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([am5themes_Animated.new(root)])

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(
                am5xy.XYChart.new(root, {
                    panX: true,
                    panY: true,
                    wheelX: 'none',
                    wheelY: 'none',
                }),
            )

            // We don't want zoom-out button to appear while animating, so we hide it at all
            chart.zoomOutButton.set('forceHidden', true)

            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var yRenderer = am5xy.AxisRendererY.new(root, {
                minGridDistance: 20,
                inversed: true,
            })
            // hide grid
            yRenderer.grid.template.set('visible', false)

            var yAxis = chart.yAxes.push(
                am5xy.CategoryAxis.new(root, {
                    maxDeviation: 0,
                    categoryField: 'network',
                    renderer: yRenderer,
                }),
            )

            var xAxis = chart.xAxes.push(
                am5xy.ValueAxis.new(root, {
                    maxDeviation: 0,
                    min: 0,
                    strictMinMax: true,
                    extraMax: 0.1,
                    renderer: am5xy.AxisRendererX.new(root, {}),
                }),
            )

            xAxis.set('interpolationDuration', stepDuration / 10)
            xAxis.set('interpolationEasing', am5.ease.linear)

            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(
                am5xy.ColumnSeries.new(root, {
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueXField: 'value',
                    categoryYField: 'network',
                }),
            )

            // Rounded corners for columns
            series.columns.template.setAll({
                cornerRadiusBR: 5,
                cornerRadiusTR: 5
            })

            // Make each column to be of a different color
            series.columns.template.adapters.add('fill', function(fill, target) {
                return chart.get('colors').getIndex(series.columns.indexOf(target))
            })

            series.columns.template.adapters.add('stroke', function(
                stroke,
                target,
            ) {
                return chart.get('colors').getIndex(series.columns.indexOf(target))
            })

            // Add label bullet
            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    locationX: 1,
                    sprite: am5.Label.new(root, {
                        text: "{valueXWorking.formatNumber('#.##')}%",
                        fill: root.interfaceColors.get('alternativeText'),
                        centerX: am5.p100,
                        centerY: am5.p50,
                        populateText: true,
                    }),
                })
            })

            var label = chart.plotContainer.children.push(
                am5.Label.new(root, {
                    text: '2002',
                    fontSize: '8em',
                    opacity: 0,
                    x: am5.p100,
                    y: am5.p100,
                    centerY: am5.p100,
                    centerX: am5.p100,
                }),
            )

            // Get series item by category
            function getSeriesItem(category) {
                for (var i = 0; i < series.dataItems.length; i++) {
                    var dataItem = series.dataItems[i]
                    if (dataItem.get('categoryY') == category) {
                        return dataItem
                    }
                }
            }

            // Axis sorting
            function sortCategoryAxis() {
                // sort by value
                series.dataItems.sort(function(x, y) {
                    return y.get('valueX') - x.get('valueX') // descending
                    //return x.get("valueX") - y.get("valueX"); // ascending
                })

                // go through each axis item
                am5.array.each(yAxis.dataItems, function(dataItem) {
                    // get corresponding series item
                    var seriesDataItem = getSeriesItem(dataItem.get('category'))

                    if (seriesDataItem) {
                        // get index of series data item
                        var index = series.dataItems.indexOf(seriesDataItem)
                        // calculate delta position
                        var deltaPosition =
                            (index - dataItem.get('index', 0)) / series.dataItems.length
                        // set index to be the same as series data item index
                        if (dataItem.get('index') != index) {
                            dataItem.set('index', index)
                            // set deltaPosition instanlty
                            dataItem.set('deltaPosition', -deltaPosition)
                            // animate delta position to 0
                            dataItem.animate({
                                key: 'deltaPosition',
                                to: 0,
                                duration: stepDuration / 2,
                                easing: am5.ease.out(am5.ease.cubic),
                            })
                        }
                    }
                })
                // sort axis items by index.
                // This changes the order instantly, but as deltaPosition is set, they keep in the same places and then animate to true positions.
                yAxis.dataItems.sort(function(x, y) {
                    return x.get('index') - y.get('index')
                })
            }

            var year = 2002

            // update data with values each 1.5 sec
            var interval = setInterval(function() {
                year++

                if (year > 2018) {
                    clearInterval(interval)
                    clearInterval(sortInterval)
                }

                updateData()
            }, stepDuration)

            var sortInterval = setInterval(function() {
                sortCategoryAxis()
            }, 100)

            function setInitialData() {
                var d = allData[year]

                for (var n in d) {
                    series.data.push({
                        network: n,
                        value: d[n]
                    })
                    yAxis.data.push({
                        network: n
                    })
                }
            }

            function updateData() {
                var itemsWithNonZero = 0

                if (allData[year]) {
                    label.set('text', year.toString())

                    am5.array.each(series.dataItems, function(dataItem) {
                        var category = dataItem.get('categoryY')
                        var value = allData[year][category]

                        if (value > 0) {
                            itemsWithNonZero++
                        }

                        dataItem.animate({
                            key: 'valueX',
                            to: value,
                            duration: stepDuration,
                            easing: am5.ease.linear,
                        })
                        dataItem.animate({
                            key: 'valueXWorking',
                            to: value,
                            duration: stepDuration,
                            easing: am5.ease.linear,
                        })
                    })

                    yAxis.zoom(0, itemsWithNonZero / yAxis.dataItems.length)
                }
            }

            setInitialData()
            setTimeout(function() {
                year++
                updateData()
            }, 50)

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000)
            chart.appear(1000, 100)
        }) // end am5.ready()
    </script>
@endsection
