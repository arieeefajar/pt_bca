@extends('layout.app')
@section('title', 'Data Kuisioner')
@section('menu', 'Data Kuisioner')
@section('submenu', 'Master')

@section('content')

    {{-- @dd($dataKuisioner) --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Kuisioner</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    {{-- add data --}}
                                    <button type="button" class="btn btn-warning add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#modalTambah"><i
                                            class="ri-add-line align-bottom me-1"></i> Tambah Kuisioners</button>
                                </div>
                            </div>
                            <div class="col-sm">
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
                                        <th class="text-center" data-sort="customer_name">Nama Kuisioner</th>
                                        <th class="text-center" data-sort="email">Status</th>
                                        <th class="text-center" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($dataKuisioner as $index => $data)
                                        <tr>
                                            <th class="text-center">{{ $index + 1 }}</th>
                                            <td class="text-center" style="display:none;"><a href="javascript:void(0);"
                                                    class="fw-medium link-primary">#VZ2101</a></td>
                                            <td class="text-center">{{ $data->nama }}</td>
                                            <td class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-success">{{ $data->status == 1 ? 'Ditampilkan' : 'Tidak Ditampilkan' }}</span>
                                            </td>
                                            <td class="text-center">

                                                {{-- edit data --}}
                                                <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#showModal"
                                                    onclick="showEdit({{ $data }})">Edit</button>

                                                {{-- delete data --}}
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRecordModal"
                                                    onclick="showDelete({{ $data->id }})">Remove</button>
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

    {{-- modal tambah --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kuisioner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                <form action="{{ route('kuisioner.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        {{-- <div class="mb-3" id="modal-id" style="display: none;">
                            <label for="id-field" class="form-label">ID</label>
                            <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                        </div> --}}

                        {{-- nama --}}
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Nama Kuisioner</label>
                            <input type="text" id="customername-field" class="form-control"
                                placeholder="Masukkan Nama Kuisioner" required name="nama_quisioner" />
                        </div>

                        {{-- status --}}
                        <div class="mb-3">
                            <label for="email-field" class="form-label">Status</label>
                            <!-- Select -->
                            <div class="input-group">
                                <select class="form-select" id="inputGroupSelect01" name="status_quisioner">
                                    <option selected>Pilih...</option>
                                    <option value="1">Ditampilkan</option>
                                    <option value="2">Tidak Ditampilkan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kuisioner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                <form action="{{ route('kuisioner.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3" id="modal-id" style="display: none;">
                            <label for="id-field-edit" class="form-label">ID</label>
                            <input type="text" id="id-field-edit" name="id" class="form-control"
                                placeholder="ID" readonly />
                        </div>

                        <div class="mb-3">
                            <label for="customername-field-edit" class="form-label">Nama Kuisioner</label>
                            <input type="text" id="customername-field-edit" class="form-control"
                                placeholder="Masukkan Nama Kuisioner" name="nama_quisioner_edit" required />
                        </div>

                        <div class="mb-3">
                            <label for="email-field" class="form-label">Status</label>
                            <!-- Select -->
                            <div class="input-group">
                                <select class="form-select" id="inputGroupSelect01-edit" name="status_quisioner_edit">
                                    <option selected>Pilih...</option>
                                    <option value="1">Ditampilkan</option>
                                    <option value="2">Tidak Ditampilkan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- confirm delete --}}
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>

                <input type="hidden" id="id-destroy" name="id">
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
@endsection

@section('otherJs')
    <script>
        const showEdit = (data) => {
            console.log(data.id);

            // set id
            $('#id-field-edit').val(data.id);
            $('#customername-field-edit').val(data.nama);
            $('#inputGroupSelect01-edit').val(data.status).change();
        }

        const showDelete = (id) => {
            $('#id-destroy').val(id);
            $('#delete-record').click(function(e) {
                e.preventDefault();
                window.location.href = `/kuisioner/destroy/${id}`
            });
        }
    </script>
@endsection
