@extends('layout.app')
@section('title', 'Data Survey Toko')
@section('menu', 'Data Survey Toko')
@section('submenu', 'Dashboard')

@section('content')

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Good job!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-danger w-xs mt-2",
                    buttonsStyling: false,
                    showCloseButton: true
                });
            });
        </script>
    @elseif ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Error",
                    text: "{{ $errors->all()[0] }}",
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-danger w-xs mt-2",
                    buttonsStyling: false,
                    showCloseButton: true
                });
            });
        </script>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Data Target Toko</h4>
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
                                            <th class="text-center">No</th>
                                            <th class="sort" data-sort="customer_name">Nama</th>
                                            <th class="sort" data-sort="email">Jenis</th>
                                            <th class="sort" data-sort="phone">Provinsi</th>
                                            <th class="sort" data-sort="date">Kota</th>
                                            <th class="sort" data-sort="date">Wilayah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($dataPerusahaan as $index => $data)
                                            <tr>
                                                <th class="text-center">{{ $index + 1 }}</th>
                                                <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                        class="fw-medium link-primary">#VZ2101</a></td>
                                                <td class="customer_name">{{ $data->nama }}</td>
                                                <td class="email">{{ $data->jenis }}</td>
                                                <td class="phone">{{ $data->provinsi }}</td>
                                                <td class="date">{{ $data->kota }}</td>
                                                <td class="wilayah">{{ $data->wilayah_nama }}</td>
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
        <!-- end row -->
    </div>

    <script>
        document
            .querySelector(".pagination-next")
            .addEventListener("click", function() {
                !document.querySelector(".pagination.listjs-pagination") ||
                    (document
                        .querySelector(".pagination.listjs-pagination")
                        .querySelector(".active") &&
                        document
                        .querySelector(".pagination.listjs-pagination")
                        .querySelector(".active")
                        .nextElementSibling.children[0].click());
            }),
            document
            .querySelector(".pagination-prev")
            .addEventListener("click", function() {
                !document.querySelector(".pagination.listjs-pagination") ||
                    (document
                        .querySelector(".pagination.listjs-pagination")
                        .querySelector(".active") &&
                        document
                        .querySelector(".pagination.listjs-pagination")
                        .querySelector(".active")
                        .previousSibling.children[0].click());
            });
    </script>
@endsection
