@extends('layout1.app')
@section('title', 'List Hasil Survey')
@section('menu', 'List Hasil Survey')
@section('submenu', 'Dashboard')

@section('content')
<!-- List Hasil Survey -->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">List Hasil Survey</h4>
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
                                <thead class="table-light text-center">
                                    <tr>
                                        <th scope="col" data-sort="no">No</th>
                                        <th class="sort" data-sort="customer_name">Nama</th>
                                        <th class="sort" data-sort="email">Jenis</th>
                                        <th class="sort" data-sort="phone">Provinsi</th>
                                        <th class="sort" data-sort="date">Kota</th>
                                        <th class="sort" data-sort="status">Wilayah</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all text-center">
                                    @foreach ($dataPerusahaan as $index => $data)
                                    <tr>
                                        <th scope="row">{{ $index+1 }}</th>
                                        <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                        <td class="customer_name">{{ $data->nama }}</td>
                                        <td class="email">{{ $data->jenis }}</td>
                                        <td class="phone">{{ $data->provinsi }}</td>
                                        <td class="date">{{ $data->kota }}</td>
                                        <td class="status">{{ $data->wilayah_id }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
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
    <!-- end row -->
</div>
@endsection