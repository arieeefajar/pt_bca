@extends('layout.app')
@section('title', 'Laporan')
@section('menu', 'Laporan')
@section('submenu', 'Menu')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Penilaian Pelanggan</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="table-search">
                        <div class="mb-3">
                            <label class="form-label">Pilih Kuisioner</label>
                            <!-- Select -->
                            <div class="input-group">
                                <select class="form-select" id="kuisioner" onchange="showjawaban(this)">
                                    <option selected>Pilih...</option>
                                    <option value="customer">Kepuasan Pelanggan</option>
                                    <option value="competitor-analys">Analisis Pesaing</option>
                                    <option value="competitor-identifier">Kekuatan Kelemahan Pesaing</option>
                                    <option value="competitor-questionnaire">Skala Pasar Produk</option>
                                    {{-- @foreach ($dataKuisioner as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap">
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
                        </div>
                    </div>
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
                    <div id="table-search">
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap">
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
    <script>
        function showjawaban(idJawaban) {
            var value = idJawaban.value;
            // console.log(value);

            if (value) {
                const url = "{{ route('laporan.jawaban', ['type' => '/']) }}/" + value;
                ajax('get', url, function(response) {
                    // console.log(response);
                    //kosongkan konten sebelumnya
                    $('#dataDetail').empty();
                    $('#dataDetail1').empty();

                })
            }
        }
    </script>
@endsection
