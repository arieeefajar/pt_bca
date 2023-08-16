@extends('layout1.app')
@section('title', 'Form Potensi Lahan')
@section('menu', 'Potensi Lahan')
@section('submenu', 'Form Survey')

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
                            Karakteristik Varietas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keunggulan-tab" data-bs-toggle="tab" href="#keunggulan-kompetitif" role="tab" aria-selected="false">
                            Musing Tanam
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <div class="tab-pane fade show active" id="perbandingan-produk" role="tabpanel" aria-labelledby="perbandingan-tab" style="margin-bottom: 20px;"><br>
                        <form action="">
                            <div class="content col">
                                <label class="form-label">Standar Keunggulan Umum</label>
                                <input type="text" class="form-control" name="" id="">
                                <!-- <ul id="tagList">
                                    <input type="text" class="form-control" id="inputTags">
                                </ul> -->
                            </div>
                            <div class="content col"><br>
                                <label class="form-label">Keunggulan Produk Kita</label>
                                <input type="text" class="form-control" name="" id="">
                                <!-- <ul id="tagList1">
                                    <input type="text" class="form-control" id="inputTags1">
                                </ul> -->
                            </div>
                            <div class="content col"><br>
                                <label class="form-label">Keunggulan Kompetitor</label>
                                <input type="text" class="form-control" name="" id="">
                                <!-- <ul id="tagList2">
                                    <input type="text" class="form-control" id="inputTags2">
                                </ul> -->
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="keunggulan-kompetitif" role="tabpanel" aria-labelledby="keunggulan-tab"> <br>
                        <form action="">
                            <div class="content col">
                                <label class="form-label">Iklim</label>
                                <input type="text" class="form-control" name="" id="">
                                <!-- <ul id="tagList3">
                                    <input type="text" class="form-control" id="inputTags3">
                                </ul> -->
                            </div><br>
                            <div class="content col">
                                <label class="form-label">Event pasar atau perayaan</label>
                                <input type="text" class="form-control" name="" id="">
                                <!-- <ul id="tagList4">
                                    <input type="text" class="form-control" id="inputTags4">
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