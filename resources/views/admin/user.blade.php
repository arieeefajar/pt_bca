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
                            <div class="col-sm">
                                <div>
                                    <button type="button" class="btn btn-warning add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#modalTambah"><i
                                            class="ri-add-line align-bottom me-1"></i> Tambah Pengguna</button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mb-1 mt-3">
                            <table class="table align-middle mb-0" id="myTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" data-sort="no">No</th>
                                        <th class="text-center" data-sort="customer_name">Name</th>
                                        <th class="text-center" data-sort="email">NIP</th>
                                        <th class="text-center" data-sort="email">Position</th>
                                        <th class="text-center" data-sort="phone">Alamat</th>
                                        <th class="text-center" data-sort="date">No.HP</th>
                                        <th class="text-center" data-sort="date">Role</th>
                                        <th class="text-center" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <th class="text-center">{{ $index + 1 }}</th>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->nip }}</td>
                                            <td class="text-center">{{ !$user->position ? '-' : $user->position }}</td>
                                            <td class="text-center">{{ !$user->alamat ? '-' : $user->alamat }}</td>
                                            <td class="text-center">{{ !$user->no_telp ? '-' : $user->no_telp }}</td>
                                            <td class="text-center">
                                                {{ $user->role === 'user' ? 'surveyor' : $user->role }}
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#showModal"
                                                    onclick="showEdit({{ $user }})">Edit</button>
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    onclick="showDelete({{ $user->id }})">Hapus</button>
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

    {{-- add modal --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form method="POST" action="{{ route('user.index') }}" class="needs-validation" novalidate id="form_add">
                    @csrf
                    <div class="modal-body">

                        {{-- username --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') }}" placeholder="Masukkan Username" required />
                            <div class="invalid-feedback">
                                Name tidak boleh kosong.
                            </div>
                        </div>

                        {{-- nip --}}
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" value="{{ old('nip') }}" id="nip"
                                class="form-control" placeholder="Masukan Nip" required />
                            <div class="invalid-feedback">
                                NIP tidak boleh kosong.
                            </div>
                        </div>

                        {{-- posisi --}}
                        <div class="mb-3">
                            <label for="posisi class="form-label">Posisi</label>
                            <select class="form-select" name="posisi" id="posisi" required>
                                <option value="" selected disabled>Pilih Posisi Pengguna</option>
                                <option value="Marketing Support">Marketing Support</option>
                                <option value="Marketing Executive">Marketing Executive</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        {{-- password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" minlength="8" name="password" id="password" class="form-control"
                                placeholder="Masukan Password" required />
                            <div class="invalid-feedback">
                                Password tidak boleh kosong.
                            </div>
                        </div>

                        {{-- alamat --}}
                        <div class="mb-3">
                            <label class="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control"
                                placeholder="Masukan Alamat" value="{{ old('alamat') }}" required />
                            <div class="invalid-feedback">
                                Alamat tidak boleh kosong.
                            </div>
                        </div>

                        {{-- no hp --}}
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No.Hp</label>
                            <input type="tel" name="no_telp" maxlength="13" id="no_telp" class="form-control"
                                value="{{ old('no_telp') }}" placeholder="Masukan No.HP" required
                                pattern="(\+62|62|0)8[1-9][0-9]{8,9}$"
                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); validateInput(this);"
                                oninvalid="validateInput(this);" />
                            <div class="invalid-feedback">
                                No.Hp tidak boleh kosong.
                            </div>
                        </div>

                        {{-- role --}}
                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Role</label>
                            <select class="form-select" required name="role" id="role"
                                oninvalid="this.setCustomValidity('Harap pilih role pengguna')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih Role Pengguna</option>
                                <option value="supper-admin" {{ old('role') == 'supper-admin' ? 'selected' : '' }}>Supper
                                    Admin</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="executive" {{ old('role') == 'executive' ? 'selected' : '' }}>Executive
                                </option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Surveyor</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Pilih role pengguna.
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah
                                Pengguna</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit-modal -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form action="" id="formEdit" class="needs-validation" novalidate method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name_edit" name="name" class="form-control"
                                placeholder="Masukkan Username" required />
                            <div class="invalid-feedback">
                                Username tidak boleh kosong.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email-field" class="form-label">NIP</label>
                            <input type="text" id="nip_edit" readonly name="nip" class="form-control"
                                placeholder="Masukan NIP" required />
                            <div class="invalid-feedback">
                                NIP tidak boleh kosong.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="posisi class="form-label">Posisi</label>
                            <select class="form-select" name="posisi" id="posisi_edit" required>
                                <option value="" selected disabled>Pilih Posisi Pengguna</option>
                                <option value="Marketing Support">Marketing Support</option>
                                <option value="Marketing Executive">Marketing Executive</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" id="alamat_edit" name="alamat" class="form-control"
                                placeholder="Masukan Alamat" required />
                            <div class="invalid-feedback">
                                Alamat tidak boleh kosong.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone-field" class="form-label">No.Hp</label>
                            <input type="tel" name="no_telp" maxlength="13" id="no_telp_edit" class="form-control"
                                placeholder="Masukan No.HP" pattern="(\+62|62|0)8[1-9][0-9]{9,10}$"
                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); validateInput(this);"
                                oninvalid="validateInput(this);" required />
                            <div class="invalid-feedback">
                                No.Hp tidak boleh kosong.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Role</label>
                            <select class="form-select" required name="role" id="role_edit"
                                oninvalid="this.setCustomValidity('Harap pilih role pengguna')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih Role Pengguna</option>
                                <option value="supper-admin">Supper Admin</option>
                                <option value="admin">Admin</option>
                                <option value="executive">Executive</option>
                                <option value="user">Surveyor</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Pilih role pengguna.
                            </div>
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
    <div class="modal fade zoomIn" id="deleteModal" tabindex="-1" aria-hidden="true">
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
                        <form action="" id="formDelete" method="POST" style="display: inline;">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn w-sm btn-danger">Ya, Hapus!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('otherJs')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                columnDefs: [{
                    targets: '_all', // Menonaktifkan urutan untuk semua kolom
                    sortable: false
                }]
            });
        });

        function showEdit(data) {
            console.log(data);
            const form = document.getElementById("formEdit");
            form.action = "{{ route('user.update', ['id' => '/']) }}/" + data.id;
            form.querySelector("#name_edit").value = data.name;
            form.querySelector("#nip_edit").value = data.nip;
            form.querySelector("#posisi_edit").value = data.position != null ? data.position : '';
            form.querySelector("#alamat_edit").value = data.alamat;
            form.querySelector("#no_telp_edit").value = data.no_telp;
            form.querySelector("#role_edit").value = data.role;
        }

        function showDelete(id) {
            const form = document.getElementById("formDelete");
            form.action = "{{ route('user.destroy', ['id' => '/']) }}/" + id;
        }

        function validateInput(input) {
            if (input.validity.valueMissing) {
                input.setCustomValidity('No Hp tidak boleh kosong.');
            } else if (input.validity.patternMismatch) {
                input.setCustomValidity('Nomor telepon tidak valid. Silakan masukkan nomor telepon yang benar.');
            } else {
                input.setCustomValidity('');
            }
        };

        function validatePassword(input) {
            if (input.validity.valueMissing) {
                input.setCustomValidity('Password tidak boleh kosong.');
            } else if (input.value.length < 8) {
                input.setCustomValidity('Password kurang dari 8 karakter.');
            } else {
                input.setCustomValidity('');
            }
        }
    </script>
@endsection
