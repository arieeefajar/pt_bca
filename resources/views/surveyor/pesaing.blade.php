@extends('layout1.app')
@section('title', 'Form Pesaing')
@section('menu', 'Pesaing')
@section('submenu', 'Menu')

@section('content')
@push('styles')
<link href="{{ asset('admin_assets/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="perbandingan-tab" data-bs-toggle="tab" href="#perbandingan-produk" role="tab" aria-selected="true">
                            Perbandingan Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keunggulan-tab" data-bs-toggle="tab" href="#keunggulan-kompetitif" role="tab" aria-selected="false">
                            Keunggulan Kompetitif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="aktivitas-tab" data-bs-toggle="tab" href="#aktivitas-pemasaran-pesaing" role="tab" aria-selected="false">
                            Aktivitas Pemasaran Pesaing
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <div class="tab-pane fade show active" id="perbandingan-produk" role="tabpanel" aria-labelledby="perbandingan-tab" style="margin-bottom: 20px;"><br>
                        <form action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Produk Kami :</label>
                                        <select class="form-select mb-3" name="" id="">
                                            <option selected disabled>Pilih Produk</option>
                                            <option value="">Contoh Produk 1</option>
                                            <option value="">Contoh Produk 2</option>
                                            <option value="">Contoh Produk 3</option>
                                            <option value="">Contoh Produk 4</option>
                                        </select>
                                        <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Produk Pesaing</label>
                                        <input type="text" class="form-control" placeholder="Masukan nama produk pesaing">
                                    </div>
                                    <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="keunggulan-kompetitif" role="tabpanel" aria-labelledby="keunggulan-tab"> <br>
                        <form action="">
                            <div class="content col">
                                <label class="form-label">Apa saja keunggulan pesaing :</label>
                                <input type="text" class="form-control" name="" id="">
                                <!-- {{-- <ul id="tagList">
                                    <input type="text" class="form-control" id="inputTags" onkeyup="addTag(event,'inputTags')">
                                </ul> --}}
                                {{-- <ul id="tagList">
                                    <input type="text" class="form-control" id="{{ $data['id'] }}" onkeyup="addTag({{ $data['id'] }})">
                                </ul> --}} -->
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="aktivitas-pemasaran-pesaing" role="tabpanel" aria-labelledby="aktivitas-tab"><br>
                        <form action="">
                            <div class="content col">
                                <label class="form-label">Apa saja aktivitas pemasaran pesaing :</label>
                                <input type="text" class="form-control" name="" id="">
                                <!-- <ul id="tagList1">
                                    <input type="text" class="form-control" id="inputTags1">
                                </ul> -->
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="tab-pane active" id="home" role="tabpanel">
                    </div> -->
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!--end col-->
</div>
@push('scripts')
<script src="{{ asset('admin_assets/assets/js/script.js') }}"></script>
@endpush
@endsection