@extends('layout.app')
@section('title', 'Data Tersimpan')
@section('menu', 'Data Tersimpan')
@section('submenu', 'Menu')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Tersimpan</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="customerList">

                        <div class="table-responsive mb-1 mt-3">
                            <table class="table align-middle mb-0 text-capitalize" id="myTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal Survey</th>
                                        <th class="text-center">Surveyor</th>
                                        <th class="text-center">Customer</th>
                                        <th class="text-center">Provinsi</th>
                                        <th class="text-center">Kota</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPenyimpanan as $index => $data)
                                        <tr>
                                            <th class="text-center">{{ $index + 1 }}</th>
                                            <td class="text-center">{{ $data->updated_at }}</td>
                                            <td class="text-center">{{ $data->surveyor }}</td>
                                            <td class="text-center">{{ $data->customer }}</td>
                                            <td class="text-center">{{ $data->provinsi }}</td>
                                            <td class="text-center">{{ $data->kota }}</td>
                                            <td class="text-center">{{ Str::replace('_', ' ', $data->jenis) }}</td>
                                            <td class="text-center">
                                                @if ($data->status === '1')
                                                    <span class="badge rounded-pill bg-success">Lengkap</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">Belum Lengkap</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <div class="detail">
                                                        <a href="/detail-penyimpanan/{{ $data->id }}"
                                                            class="btn btn-sm btn-primary edit-item-btn">Detail</a>
                                                    </div>
                                                </div>
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

    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Anda Yakin ?</h4>
                            <p class="text-muted mx-4 mb-0">Anda Yakin Mau Menghapus Data Ini ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-record">Ya, Hapus!</button>
                    </div>
                </div>
            </div>
        </div>
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
