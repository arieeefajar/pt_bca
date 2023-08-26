@extends('layout.app')
@section('title', 'Data Produk')
@section('menu', 'Data Produk')
@section('submenu', 'Master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Produk</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-warning add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#modalTambah"><i
                                            class="ri-add-line align-bottom me-1"></i> Tambah Produk</button>
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

                        <div class="table-responsive table-card mb-1 mt-3">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
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
                                    <tr>
                                        <th class="text-center" data_sort="no">No</th>
                                        <th class="text-center" data-sort="customer_name">Nama Produk</th>
                                        <th class="text-center" data-sort="email">Jenis</th>
                                        <th class="text-center" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataProduct as $index => $data)
                                        <tr>
                                            <th class="text-center">{{ $index + 1 }}</th>
                                            <td class="text-center" style="display:none;"><a href="javascript:void(0);"
                                                    class="fw-medium link-primary">#VZ2101</a></td>
                                            <td class="text-center">{{ $data->nama_produk }}</td>
                                            <td class="text-center">{{ $data->jenis }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#showModal{{ $data->id }}">Edit</button>
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRecordModal{{ $data->id }}"
                                                    onclick="deleteData({{ $data['id'] }})">Remove</button>
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

    <!-- add-modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form method="POST" action="{{ route('product.create') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Nama Produk</label>
                            <input type="text" id="nama_produk" name="nama_produk"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Masukkan nama produk" required />
                        </div>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Jenis</label>
                            <select class="form-select mb-3" name="jenis_tanaman" id="jenis_tanaman">
                                <option selected disabled>Pilih jenis produk</option>
                                @foreach ($dataJenisTanaman as $data)
                                    <option value="{{ $data->id }}">{{ $data->jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah Produk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit-modal -->
    @foreach ($dataProduct as $data)
        <div class="modal fade" id="showModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="{{ route('product.update', $data->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="mb-3">

                                <div class="mb-3" id="modal-id" style="display: none;">
                                    <label for="id-field" class="form-label">ID</label>
                                    <input type="text" name="id" id="id" value="{{ $data['id'] }}"
                                        class="form-control" placeholder="ID" readonly />
                                </div>

                                <label for="customername-field" class="form-label">Nama Produk</label>
                                <input type="text" id="nama_produk" name="nama_produk"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $data->nama_produk }}" placeholder="Masukkan nama produk" required />
                            </div>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="mb-3">
                                <label for="phone-field" class="form-label">Jenis</label>
                                <select class="form-select mb-3" name="jenis_tanaman" id="jenis_tanaman">
                                    <option selected disabled>Pilih jenis produk</option>
                                    @foreach ($dataJenisTanaman as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="edit-btn">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- delete-modal -->
        <div class="modal fade zoomIn" id="deleteRecordModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
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
                            <form action="{{ route('product.destroy', $data->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type=" submit" class="btn w-sm btn-danger "
                                    id="delete-record{{ $data->id }}">Ya, Hapus!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('otherJs')
    <script>
        const setEdit = (data) => {
            console.log(data);
            $('#id-edit').val(data.id);
            $('#nama-edit').val(data.nama);
        }

        const clearEdit = () => {
            $('#id-edit').val(data.id);
            $('#nama-edit').val(data.nama);
        }

        const deleteData = (id) => {
            console.log(id);
            $('#confirm-delete-data').click(function(e) {
                e.preventDefault();
                window.location.href = `/customer/destroy/${id}`
            });
        }
    </script>
@endsection
