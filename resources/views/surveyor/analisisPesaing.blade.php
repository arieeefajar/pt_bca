@extends('layout1.app')
@section('title', 'Kuisioner Analisis Pesaing')
@section('menu', 'Analisis Pesaing')
@section('submenu', 'Kuisioner')

@section('content')
    @push('styles')
        <link href="{{ asset('admin_assets/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    {{-- @dd($dataPertanyaan) --}}
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
                                <div class="bg-soft-primary p-2 mb-2">
                                    <h6 class="text-center">Gambaran Umum Situasi Perusahaan</h6>
                                </div>

                                <div class="content mb-3">
                                    <label for="nama">Nama</label>
                                    <ul id="tagList">
                                        <input type="text" class="form-control" id="inputTags">
                                    </ul>
                                </div>

                                <table class="table table-bordered align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr class="bg-soft-primary">
                                            <th class="text-center" colspan="6">Persaingan diantara Perusahaan</th>
                                        </tr>
                                        <tr class="bg-soft-warning">
                                            <th class="text-center">Pertanyaan</th>
                                            <th class="text-center">Ya</th>
                                            <th class="text-center">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Contoh Pertanyaan</td>
                                            <td align="center">
                                                <input type="radio" name="pertanyaan1" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pertanyaan1" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
