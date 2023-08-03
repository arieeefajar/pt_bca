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
                        <input type="text" class="form-control" id="placeholderInput" placeholder="Search...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Kuisioner</label>
                        <!-- Select -->
                        <div class="input-group">
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Pilih...</option>
                                <option value="1">Analisis Kompetitor</option>
                                <option value="2">Kepuasan Pelanggan</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered border-secondary table-secondary table-nowrap">
                            <thead>
                                <th class="text-center">No</th>
                                <th class="text-center">Jenis Pertanyaan</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                                <th class="text-center">5</th>
                                <th class="text-center">Total</th>
                            </thead>
                            <tbody>

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
                        <table class="table table-bordered border-secondary table-secondary table-nowrap">
                            <thead>
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
                            </thead>
                            <tbody>

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