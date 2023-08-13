@extends('layout1.app')
@section('title', 'Kuisioner Kepuasan Pelanggan')
@section('menu', 'Kepuasan Pelanggan')
@section('submenu', 'Kuisioner')

@section('content')

    {{-- @dd($dataPertanyaan) --}}
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Kuisioner</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="alert alert-warning text-dark" role="alert">
                        <p><b>Keterangan Isian Jawaban Kuisioner :</b></p>
                        <ul>
                            <li>1 (Sangat Tidak Puas)</li>
                            <li>2 (Tidak Puas)</li>
                            <li>3 (Cukup Puas)</li>
                            <li>4 (Puas)</li>
                            <li>5 (Sangat Puas)</li>
                        </ul>
                    </div>
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle table-nowrap mb-0">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center">Pertanyaan</th>
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kelengkapan informasi pada kemasan</td>
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
                                </tbody>
                            </table>
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div>
        </div>
    </div>
@endsection
