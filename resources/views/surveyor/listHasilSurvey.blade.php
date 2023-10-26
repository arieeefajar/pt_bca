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

                            <div class="table-responsive mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="myTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama</th>
                                            <th>Provinsi</th>
                                            <th>Kota</th>
                                            <th>Suerveyor</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($dataPerusahaan as $index => $data)
                                            @if ($data->status == 2)
                                                <tr>
                                                    <th>{{ $index + 1 }}</th>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->kota->provinsi->nama }}</td>
                                                    <td>{{ $data->kota->nama }}</td>
                                                    <td>{{ $data->surveyor }}</td>
                                                    <td>
                                                        <span class="badge rounded-pill bg-warning">Belum Selesai
                                                            Mengisi</span>
                                                    </td>
                                                </tr>
                                            @endif
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
