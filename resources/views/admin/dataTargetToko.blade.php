@extends('layout.app')
@section('title', 'Data Target Toko')
@section('menu', 'Data Target Toko')
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
                            <div class="table-responsive mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="myTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Provinsi</th>
                                            <th>Kota</th>
                                            <th>Surveyor</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($dataPerusahaan as $index => $data)
                                            <tr>
                                                <th class="text-center">{{ $index + 1 }}</th>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ formatJenis($data->jenis) }}</td>
                                                <td>{{ $data->kota->provinsi->nama }}</td>
                                                <td>{{ $data->kota->nama }}</td>
                                                <td>{{ $data->surveyor }}</td>
                                                <td>
                                                    @if ($data->status == 1)
                                                        <span class="badge rounded-pill bg-success">Selesai</span>
                                                    @elseif ($data->status == 2)
                                                        <span class="badge rounded-pill bg-warning">Belum Selesai Mengisi</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-danger">Belum Mengisi</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        $(document).ready(function() {
            $('#myTable').DataTable({
                columnDefs: [{
                    targets: '_all', // Menonaktifkan urutan untuk semua kolom
                    sortable: false
                }]
            });
        });
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
