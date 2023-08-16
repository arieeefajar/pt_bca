@extends('layout.app')
@section('title', 'Data User')
@section('menu', 'Data User')
@section('submenu', 'Master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data User</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-warning add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#modalTambah"><i
                                            class="ri-add-line align-bottom me-1"></i> Tambah Pengguna</button>
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
                                        <th class="text-center" data-sort="customer_name">Username</th>
                                        <th class="text-center" data-sort="email">Email</th>
                                        <th class="text-center" data-sort="phone">Alamat</th>
                                        <th class="text-center" data-sort="date">No.HP</th>
                                        <th class="text-center" data-sort="date">Role</th>
                                        <th class="text-center" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <th class="text-center">{{ $index + 1 }}</th>
                                            <td class="text-center" style="display:none;"><a href="javascript:void(0);"
                                                    class="fw-medium link-primary">#VZ2101</a></td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">{{ $user->alamat }}</td>
                                            <td class="text-center">{{ $user->no_telp }}</td>
                                            <td class="text-center">{{ $user->role }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#showModal{{ $user->id }}">Edit</button>
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRecordModal{{ $user->id }}">Remove</button>
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

    <!-- add-modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form method="POST" action="{{ route('user.index') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Username</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Masukkan Username" required />
                        </div>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="mb-3">
                            <label for="email-field" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Masukan Email" required />
                        </div>

                        <div class="mb-3">
                            <label for="email-field" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukan Password" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control"
                                placeholder="Masukan Alamat" required />
                        </div>

                        <div class="mb-3">
                            <label for="phone-field" class="form-label">No.Hp</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control"
                                placeholder="Masukan No.HP" required />
                        </div>

                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Role</label>
                            <select class="form-select mb-3" name="role" id="role">
                                <option selected disabled>Pilih Role Pengguna</option>
                                <option value="supper-admin">Supper Admin</option>
                                <option value="admin">Admin</option>
                                <option value="executive">Executive</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit-modal -->
    @foreach ($users as $user)
        <div class="modal fade" id="showModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Username</label>
                                <input type="text" id="customername-field" name="name"
                                    value="{{ $user->name }}" class="form-control" placeholder="Masukkan Username"
                                    required />
                            </div>

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Email</label>
                                <input type="email" id="email-field" name="email" value="{{ $user->email }}"
                                    class="form-control" placeholder="Masukan Email" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" id="alamat-field" name="alamat" value="{{ $user->alamat }}"
                                    class="form-control" placeholder="Masukan Alamat" required />
                            </div>

                            <div class="mb-3">
                                <label for="phone-field" class="form-label">No.Hp</label>
                                <input type="text" id="phone-field" name="no_telp" value="{{ $user->no_telp }}"
                                    class="form-control" placeholder="Masukan No.HP" required />
                            </div>

                            <div class="mb-3">
                                <label for="phone-field" class="form-label">Role</label>
                                <select class="form-select mb-3" name="role" id="role">
                                    <option selected disabled>Pilih Role Pengguna</option>
                                    <option value="supper-admin" {{ $user->role === 'supper-admin' ? 'selected' : '' }}>
                                        Supper Admin</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="executive" {{ $user->role === 'executive' ? 'selected' : '' }}>
                                        Executive</option>
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Surveyor
                                    </option>
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
        <div class="modal fade zoomIn" id="deleteRecordModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
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
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type=" button" class="btn w-sm btn-danger "
                                    id="delete-record{{ $user->id }}">Ya, Hapus!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
