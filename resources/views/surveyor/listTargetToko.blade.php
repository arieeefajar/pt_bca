@extends('layout1.app')
@section('title', 'List Target Toko')
@section('menu', 'List Target Toko')
@section('submenu', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- List Target Toko -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">List Target Toko</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">

                            <div class="table-responsive mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="myTable">
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
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td class="customer_name">{{ $data->nama }}</td>
                                                <td class="email">{{ $data->jenis }}</td>
                                                <td class="phone">{{ $data->provinsi }}</td>
                                                <td class="date">{{ $data->kota }}</td>
                                                <td class="status">{{ $data->wilayah_id }}</td>
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
    </script>
@endsection
