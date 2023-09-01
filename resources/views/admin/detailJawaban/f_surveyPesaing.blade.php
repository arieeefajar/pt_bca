@extends('layout.app')
@section('title', 'Jawaban Survey Pesaing')
@section('menu', 'Survey Pesaing')
@section('submenu', 'Detail Jawaban')

@section('content')
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
                <form action="{{ route('formPesaing.create') }}" method="POST" id="myForm">
                    @csrf
                    <div class="tab-content text-muted">
                        <div class="tab-pane fade show active" id="perbandingan-produk" role="tabpanel" aria-labelledby="perbandingan-tab" style="margin-bottom: 20px;"><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Produk Kami :</label>
                                        {{-- <select class="form-select mb-3" required name="produk_kita" id="produkSelect" onchange="updateSelectedDeskripsi()"> --}}
                                        {{-- <option value="" selected disabled>Pilih Produk</option>
                                            @foreach ($dataProduk as $value)
                                            <option value="{{ $value->nama_produk }}" data-deskripsi="{{ $value->nama_produk }}">
                                        {{ $value->nama_produk }}
                                        </option>
                                        @endforeach --}}
                                        {{-- </select> --}}
                                        <textarea class="form-control" required name="deskripsi_produk" id="" cols="30" rows="5" readonly></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{--<div class="mb-3">--}}
                                    <label class="form-label">Produk Pesaing</label>
                                    {{-- <input type="text" name="produk_pesaing" class="form-control" required placeholder="Masukan nama produk pesaing"> --}}
                                    {{--</div> --}}
                                    <textarea class="form-control" name="deskripsi_produk_pesaing" id="" cols="30" rows="5" required readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="keunggulan-kompetitif" role="tabpanel" aria-labelledby="keunggulan-tab"> <br>
                            <div class="row">
                                <div class="content col">
                                    <label class="form-label">Apa saja keunggulan pesaing :</label>
                                    {{-- <input type="text" class="form-control" name="keunggulan_pesaing" id=""
                                            required> --}}
                                    <textarea class="form-control" name="keunggulan_pesaing" id="" cols="30" rows="5" required readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="aktivitas-pemasaran-pesaing" role="tabpanel" aria-labelledby="aktivitas-tab"><br>
                            <div class="row">
                                <div class="content col">
                                    <label class="form-label">Apa saja aktivitas pemasaran pesaing :</label>
                                    {{-- <input type="text" class="form-control" name="pemasaran_pesaing" id=""
                                            required> --}}
                                    <textarea class="form-control" name="pemasaran_pesaing" id="" cols="30" rows="5" required readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="latitude" id="latitude_field">
                    <input type="hidden" name="longitude" id="longitude_field">

                    {{-- <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" onclick="submit_form()">Submit</button>
                    </div> --}}
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!--end col-->
</div>
@endsection
