@extends('layout.app')
@section('title', 'Jawaban Potensi Lahan')
@section('menu', 'Potensi Lahan')
@section('submenu', 'Detail Jawaban')

@section('content')
    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Detail Jawaban</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="perbandingan-tab" data-bs-toggle="tab"
                                href="#perbandingan-produk" role="tab" aria-selected="true">
                                Karakteristik Varietas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="keunggulan-tab" data-bs-toggle="tab" href="#keunggulan-kompetitif"
                                role="tab" aria-selected="false">
                                Musim Tanam
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    @foreach ($dataAnswer as $data)
                        <form action="{{ route('formPotensiLahan.create') }}" method="POST" id="myForm">
                            @csrf
                            <div class="tab-content text-muted">
                                <div class="tab-pane fade show active" id="perbandingan-produk" role="tabpanel"
                                    aria-labelledby="perbandingan-tab" style="margin-bottom: 20px;"><br>
                                    <div class="content col">
                                        <label class="form-label">Standar Keunggulan Umum</label>
                                        {{-- <input type="text" class="form-control" required name="keunggulan_umum"
                                        id="keunggulan_umum"> --}}
                                        <textarea class="form-control" name="keunggulan_umum" id="keunggulan_umum" cols="30" rows="5" required
                                            readonly>{{ $data['answer'][0] }}</textarea>
                                    </div>
                                    <div class="content col"><br>
                                        <label class="form-label">Keunggulan Produk Kita</label>
                                        {{-- <input type="text" class="form-control" required name="keunggulan_produk"
                                        id="keunggulan_produk"> --}}
                                        <textarea class="form-control" name="keunggulan_produk" id="keunggulan_produk" cols="30" rows="5" required
                                            readonly>{{ $data['answer'][1] }}</textarea>
                                    </div>
                                    <div class="content col"><br>
                                        <label class="form-label">Keunggulan Kompetitor</label>
                                        {{-- <input type="text" class="form-control" required name="keunggulan_kompetitor"
                                        id="keunggulan_kompetitor"> --}}
                                        <textarea class="form-control" name="keunggulan_kompetitor" id="keunggulan_kompetitor" cols="30" rows="5"
                                            required readonly>{{ $data['answer'][2] }}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="keunggulan-kompetitif" role="tabpanel"
                                    aria-labelledby="keunggulan-tab"> <br>
                                    <div class="row mb-3">
                                        <div class="content col">
                                            <label class="form-label">Iklim</label>
                                            {{-- <input type="text" class="form-control" required name="iklim" id="iklim"> --}}
                                            <textarea class="form-control" name="iklim" id="iklim" cols="30" rows="5" required readonly>{{ $data['answer'][3] }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="content col">
                                            <label class="form-label">Event pasar atau perayaan</label>
                                            {{-- <input type="text" class="form-control" required name="event" id="event"> --}}
                                            <textarea class="form-control" name="evet" id="evet" cols="30" rows="5" required readonly>{{ $data['answer'][4] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="latitude" id="latitude_field">
                            <input type="hidden" name="longitude" id="longitude_field">

                            <!-- <div class="text-center mt-3">
                                <button type="button" class="btn btn-primary" onclick="submit_form()">Submit</button>
                            </div> -->
                        </form>
                    @endforeach
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!--end col-->
    </div>
@endsection
