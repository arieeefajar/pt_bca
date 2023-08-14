@extends('layout1.app')
@section('title', 'Kuisioner Analisis Pesaing')
@section('menu', 'Analisis Pesaing')
@section('submenu', 'Kuisioner')

@section('content')
{{-- @dd($dataPertanyaan) --}}
@push('styles')
<link href="{{ asset('admin_assets/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Form Kuisioner</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive">
                        <form action="" method="POST">

                            {{-- struktur array: section-->jenis jawaban-->data pertanyaan --}}

                            {{-- extrack section --}}
                            @foreach ($dataPertanyaan as $section => $jenisPertanyaan)
                            <div class="bg-soft-primary p-2">
                                <h6 class="text-center">{{ $section }}</h6>
                            </div>

                            {{-- extrack jenis jawaban --}}
                            @foreach ($jenisPertanyaan as $idJenisPertanyaan => $datapertanyaan)
                            {{-- pecah pertanyaan berdasarkan jenis jawabannya --}}
                            @if ($idJenisPertanyaan == '1')
                            {{-- skala evaluasi (1-5) --}}
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr class="bg-soft-warning">
                                            <th class="text-center">Pertanyaan</th>
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- extrack data pertanyaan --}}
                                        @foreach ($datapertanyaan as $data)
                                        <tr>
                                            <td>{{ $data['pertanyaan'] }}</td>
                                            <td align="center">
                                                <input type="radio" name="pertanyaan1" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pertanyaan1" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pertanyaan1" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pertanyaan1" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pertanyaan1" value="5">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @elseif ($idJenisPertanyaan == '2')
                            {{-- skala pendapat (ya/tidak) --}}
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr class="bg-soft-warning">
                                            <th class="text-left">Pertanyaan</th>
                                            <th class="text-center">Ya</th>
                                            <th class="text-center">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- extrack data pertanyaan --}}
                                        @foreach ($datapertanyaan as $data)
                                        <tr>
                                            <td>{{ $data['pertanyaan'] }}</td>
                                            <td align="center">
                                                <input type="radio" name="pertanyaan1" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pertanyaan1" value="2">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @elseif($idJenisPertanyaan == '3')
                            {{-- tanggapan terbuka (field) --}}
                            <div class="mb-3">
                                {{-- extrack data pertanyaan --}}
                                @foreach ($datapertanyaan as $data)
                                <div class="content mt-2">
                                    <label for="nama">{{ $data['pertanyaan'] }}</label>
                                    <ul id="tagList">
                                        <input type="text" class="form-control" id="{{ $data['id'] }}" onkeyup="addTag({{ $data['id'] }})">
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            @endforeach
                            @endforeach
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('admin_assets/assets/js/script.js') }}"></script>
@endpush
@endsection