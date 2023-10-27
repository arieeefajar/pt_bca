@extends('layout.app')
@section('title', 'Detail Penyimpanan')
@section('menu', 'Detail Penyimpanan')
@section('submenu')
    <a href="{{ route('byToko.index') }}">Penyimpanan</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Tersimpan</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" data_sort="no">No</th>
                                        <th class="text-center" data-sort="email">Jenis Kuisioner</th>
                                        <th class="text-center" data-sort="phone">Jawaban</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($dataDetail as $index => $data)
                                        <tr>
                                            <th class="text-center">{{ $index + 1 }}</th>
                                            <td class="text-center">
                                                @if ($data->pertanyaan === 'k_kepuasan')
                                                    Kuisoner Kepuasan Pelanggan
                                                @elseif ($data->pertanyaan === 'k_analisis')
                                                    Kuisoner Analisis Pesaing
                                                @elseif ($data->pertanyaan === 'k_kekuatan_kelemahan')
                                                    Kuisoner Kekuatan Dan Kelemahan Pesaing
                                                @elseif ($data->pertanyaan === 'form_lahan')
                                                    Form Potensi Lahan
                                                @elseif ($data->pertanyaan === 'form_pesaing')
                                                    Form Analisis Pesaing
                                                @elseif ($data->pertanyaan === 'skala_pasar')
                                                    Kuisioner Skala Pasar Produk
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($data->pertanyaan === 'k_kepuasan')
                                                    <a href="/jawaban-kepuasan-pelanggan/{{ $idDetail }}/{{ $data->api_id }}"
                                                        class="btn btn-sm btn-primary edit-item-btn">Detail</a>
                                                @elseif ($data->pertanyaan === 'k_analisis')
                                                    <a href="/jawaban-analisis-pesaing/{{ $idDetail }}/{{ $data->api_id }}"
                                                        class="btn btn-sm btn-primary edit-item-btn">Detail</a>
                                                @elseif ($data->pertanyaan === 'k_kekuatan_kelemahan')
                                                    <a href="/jawaban-kekuatan-kelemahan/{{ $idDetail }}/{{ $data->api_id }}"
                                                        class="btn btn-sm btn-primary edit-item-btn">Detail</a>
                                                @elseif ($data->pertanyaan === 'form_lahan')
                                                    <a href="/jawaban-potensi-lahan/{{ $idDetail }}/{{ $data->api_id }}"
                                                        class="btn btn-sm btn-primary edit-item-btn">Detail</a>
                                                @elseif ($data->pertanyaan === 'form_pesaing')
                                                    <a href="/jawaban-form-analisis-pesaing/{{ $idDetail }}/{{ $data->api_id }}"
                                                        class="btn btn-sm btn-primary edit-item-btn">Detail</a>
                                                @elseif ($data->pertanyaan === 'skala_pasar')
                                                    <a href="/jawaban-skala-pasar/{{ $idDetail }}/{{ $data->api_id }}"
                                                        class="btn btn-sm btn-primary edit-item-btn">Detail</a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
