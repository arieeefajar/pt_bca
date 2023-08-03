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
                                    <th class="text-center" data-sort="customer_name">Nama</th>
                                    <th class="text-center" data-sort="email">Alamat</th>
                                    <th class="text-center" data-sort="phone">Umur</th>
                                    <th class="text-center" data-sort="date">No.Telepon</th>
                                    <th class="text-center" data-sort="date">Daerah</th>
                                    <th class="text-center" data-sort="date">Perusahaan</th>
                                    <th class="text-center" data-sort="date">Posisi</th>
                                    <th class="text-center" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                <tr>
                                    <th class="text-center">1</th>
                                    <td class="text-center" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                    <td class="text-center">Mary Cousar</td>
                                    <td class="text-center">Mastrip</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">580-464-4694</td>
                                    <td class="text-center">Jember</td>
                                    <td class="text-center">PT BISI Internasional Tbk</td>
                                    <td class="text-center">Master Dealer</td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2">
                                            <div class="detail">
                                                <a href="/detail-penyimpanan" class="btn btn-sm btn-primary edit-item-btn">Detail</a>
                                            </div>
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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

<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
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
@endsection