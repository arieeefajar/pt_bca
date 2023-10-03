@extends('layout.app')
@section('title', 'Data Customer')
@section('menu', 'Data Customer')
@section('submenu', 'Master')

@section('content')
    {{-- @dd($dataPerusahaan); --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Customer</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-warning add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#modalTambah"><i
                                            class="ri-add-line align-bottom me-1"></i> Tambah Customer</button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mb-1 mt-3">
                            <table class="table align-middle mb-0" id="myTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" data_sort="no">No</th>
                                        <th class="text-center" data-sort="customer_name">Nama Customer</th>
                                        <th class="text-center" data-sort="customer_name">Jenis</th>
                                        <th class="text-center" data-sort="customer_name">Provinsi</th>
                                        <th class="text-center" data-sort="customer_name">Kelurahan</th>
                                        <th class="text-center" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPerusahaan as $key => $data)
                                        <tr>
                                            <th class="text-center">{{ $key + 1 }}</th>
                                            <td class="text-center">{{ $data->nama }}</td>
                                            <td class="text-center">{{ $data->jenis }}</td>
                                            <td class="text-center">{{ $data->provinsi }}</td>
                                            <td class="text-center">{{ $data->kelurahan->nama }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit"
                                                    onclick="setEdit({{ $data }})">Edit</button>
                                                <button class="btn btn-sm btn-info edit-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#showDetail{{ $data['id'] }}">Detail</button>
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRecordModal{{ $data['id'] }}">Hapus</button>
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

    {{-- modal add --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                <form action="{{ route('customer.create') }}" class="needs-validation" novalidate method="POST"
                    id="myForm">
                    @csrf
                    <div class="modal-body">

                        {{-- nama cus --}}
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Nama Customer</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" id="customername-field"
                                class="form-control" placeholder="Masukan Nama Customer..." required />
                            <div class="invalid-feedback">
                                Harap isi nama customer.
                            </div>
                        </div>

                        {{-- jenis --}}
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <select required class="form-select" name="jenis" id="jenis">
                                <option value="" selected disabled>Pilih Jenis</option>
                                <option value="dealer" {{ old('jenis') == 'dealer' ? 'selected' : '' }}>Dealer</option>
                                <option value="master_dealer" {{ old('jenis') == 'master_dealer' ? 'selected' : '' }}>
                                    Master Dealer</option>
                                <option value="lainnya" {{ old('jenis') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih jenis customer.
                            </div>
                        </div>

                        {{-- provinsi --}}
                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <select required class="form-select" name="provinsi" id="add_provinsi"
                                oninvalid="this.setCustomValidity('Harap pilih provinsi customer')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsi as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih provinsi.
                            </div>
                        </div>

                        {{-- kota --}}
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <select required class="form-select" name="kota" id="add_kota">
                                <option value="" disabled selected>Pilih Provinsi Terlebih Dahulu</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih kota.
                            </div>
                        </div>

                        {{-- kecamatan --}}
                        <div class="mb-3">
                            <label class="form-label">Kecamatan</label>
                            <select required class="form-select" name="kecamatan" id="add_kecamatan"
                                oninvalid="this.setCustomValidity('Harap pilih area customer')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih Kota Terlebih Dahulu</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih kecamatan.
                            </div>
                        </div>

                        {{-- Kelurahan --}}
                        <div class="mb-3">
                            <label class="form-label">Kelurahan</label>
                            <select required class="form-select" name="kelurahan" id="add_kelurahan"
                                oninvalid="this.setCustomValidity('Harap pilih area customer')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih kecamatan Terlebih Dahulu</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih Kelurahan.
                            </div>
                        </div>

                        {{-- koordinat --}}
                        <div class="mb-3">
                            <label class="form-label">Koordinat</label>
                            <textarea required class="form-control" maxlength="1000" name="koordinat" id="evet" cols="30"
                                rows="5">{{ old('koordinat') }}</textarea>
                            <div class="invalid-feedback mb-3">
                                Harap masukan titik koordinat.
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
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Perusahaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form id="formEdit" action="" class="needs-validation" novalidate method="POST">
                    @csrf
                    <div class="modal-body">

                        {{-- nama cus --}}
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Nama Customer</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" id="edit_custommer"
                                class="form-control"required />
                            <div class="invalid-feedback">
                                Harap isi nama customer.
                            </div>
                        </div>

                        {{-- jenis --}}
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <select required class="form-select" name="jenis" id="edit_jenis">
                                <option value="" selected disabled>Pilih Jenis</option>
                                <option value="dealer">Dealer</option>
                                <option value="master_dealer">Master Dealer</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih jenis customer.
                            </div>
                        </div>

                        {{-- provinsi --}}
                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <select required class="form-select" name="provinsi" id="edit_provinsi"
                                oninvalid="this.setCustomValidity('Harap pilih provinsi customer')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsi as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih provinsi.
                            </div>
                        </div>

                        {{-- kota --}}
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <select required class="form-select" name="kota" id="edit_kota">
                                <option value="" disabled selected>Pilih Provinsi Terlebih Dahulu</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih kota.
                            </div>
                        </div>

                        {{-- kecamatan --}}
                        <div class="mb-3">
                            <label class="form-label">Kecamatan</label>
                            <select required class="form-select" name="kecamatan" id="edit_kecamatan"
                                oninvalid="this.setCustomValidity('Harap pilih area customer')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih Kota Terlebih Dahulu</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih kecamatan.
                            </div>
                        </div>

                        {{-- Kelurahan --}}
                        <div class="mb-3">
                            <label class="form-label">Kelurahan</label>
                            <select required class="form-select" name="kelurahan" id="edit_kelurahan"
                                oninvalid="this.setCustomValidity('Harap pilih area customer')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih kecamatan Terlebih Dahulu</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih Kelurahan.
                            </div>
                        </div>

                        {{-- koordinat --}}
                        <div class="mb-3">
                            <label class="form-label">Koordinat</label>
                            <textarea required class="form-control" maxlength="1000" name="koordinat" id="edit_koordinat" cols="30"
                                rows="5">{{ old('koordinat') }}</textarea>
                            <div class="invalid-feedback mb-3">
                                Harap masukan titik koordinat.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="edit-btn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($dataPerusahaan as $data)
        {{-- modal detail --}}
        <div class="modal fade" id="showDetail{{ $data['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Perusahaan</h5>
                        <button type="button" onclick="clearEdit()" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close" id="close-modal"></button>
                    </div>

                    <div class="modal-body">

                        {{-- Area --}}
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Wilayah</label>
                            <input type="text" name="nama" value="" id="nama" class="form-control"
                                placeholder="Masukan Nama Customer..." required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Koordinat</label>
                            <textarea class="form-control" name="koordinat" required id="evet" cols="30" rows="5">{{ $data->koordinat }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- modal delete --}}
        <div class="modal fade zoomIn" id="deleteRecordModal{{ $data['id'] }}" tabindex="-1" aria-hidden="true">
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
                            <form action="{{ route('customer.destroy', $data->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn w-sm btn-danger">Ya,Hapus!</button>
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
        $(document).ready(function() {
            $('#myTable').DataTable({
                columnDefs: [{
                    targets: '_all', // Menonaktifkan urutan untuk semua kolom
                    sortable: false
                }]
            });
        });

        /////////////////// this function for add data ///////////////////
        // set provinsi
        $("#add_provinsi").change(function() {
            setProvinsi('#add_provinsi', "#add_kota") // format paramater : "#idElement"
        });

        // set kota
        $("#add_kota").change(function() {
            setKota('#add_kota', "#add_kecamatan") // format paramater : "#idElement"
        });

        // set kecamatan
        $("#add_kecamatan").change(function() {
            setKecamatan('#add_kecamatan', "#add_kelurahan") // format paramater : "#idElement"
        });
        /////////////////// end function add data ///////////////////

        /////////////////// this function for edtit data ///////////////////
        function setEdit(data) {
            // set action url form
            document.getElementById('formEdit').action = "{{ route('customer.update', ['id' => '/']) }}/" + data.id;

            // set value in modal edit


            ajax('get', "{{ route('getAllLocation', ['id_kelurahan' => '/']) }}/" + data.kelurahan_id, function(
                response) { //  ajax(methos, url, callback)

                if (response.success) {
                    const dataSelect = response.data // get data array

                    const dataKota = dataSelect.allData.kota
                    const dataKecamatan = dataSelect.allData.kecamatan
                    const dataKelurahan = dataSelect.allData.kelurahan

                    /////////////////// fill in the dropdown data ///////////////////
                    // kota
                    let bodyKota = '<option value="" selected disabled>Pilih Kota</option>';
                    for (let index = 0; index < dataKota.length; index++) {
                        bodyKota += `<option value="${dataKota[index].id}">${dataKota[index].nama}</option>`
                    }
                    $('#edit_kota').html(bodyKota);

                    // kecamatan
                    let bodyKecamatan = '<option value="" selected disabled>Pilih Kecamatan</option>';
                    for (let index = 0; index < dataKecamatan.length; index++) {
                        bodyKecamatan +=
                            `<option value="${dataKecamatan[index].id}">${dataKecamatan[index].nama}</option>`
                    }
                    $('#edit_kecamatan').html(bodyKecamatan);

                    // kelurahan
                    let bodyKelurahan = '<option value="" selected disabled>Pilih Kelurahan</option>';
                    for (let index = 0; index < dataKelurahan.length; index++) {
                        bodyKelurahan +=
                            `<option value="${dataKelurahan[index].id}">${dataKelurahan[index].nama}</option>`
                    }
                    $('#edit_kelurahan').html(bodyKelurahan);
                    /////////////////// end fill in the dropdown data ///////////////////


                    /////////////////// set data ///////////////////
                    $("#edit_custommer").val(data.nama);
                    $("#edit_jenis").val(data.jenis);
                    $("#edit_provinsi").val(dataSelect.provinsi);
                    $("#edit_kota").val(dataSelect.kota);
                    $("#edit_kecamatan").val(dataSelect.kecamatan);
                    $("#edit_kelurahan").val(dataSelect.kelurahan);
                    $("#edit_koordinat").html(data.koordinat);
                    /////////////////// end set data selected dropdown ///////////////////

                }
            })
        }

        $("#edit_provinsi").change(function() {
            setProvinsi('#edit_provinsi', "#edit_kota") // format paramater : "#idElement"
        });

        // set kota
        $("#edit_kota").change(function() {
            setKota('#edit_kota', "#edit_kecamatan") // format paramater : "#idElement"
        });

        // set kecamatan
        $("#edit_kecamatan").change(function() {
            setKecamatan('#edit_kecamatan', "#edit_kelurahan") // format paramater : "#idElement"
        });
        /////////////////// end function edtit data ///////////////////

        function setProvinsi(idElement, idElementSet) {
            const selectedItem = $(idElement).children("option:selected").val(); // get value select
            const url = "{{ route('getkota', '') }}" + "/" + selectedItem; // url route

            ajax('get', url, function(response) { //  ajax(methos, url, callback)
                if (response.success) {
                    const data = response.data // get data array
                    let bodyKota = '<option value="" selected disabled>Pilih Kota</option>'; // content html
                    for (let index = 0; index < data.length; index++) {
                        bodyKota += `<option value="${data[index].id}">${data[index].nama}</option>`
                    }
                    $(idElementSet).html(bodyKota); // set content
                }
            })
        }

        function setKota(idElement, idElementSet) {
            const selectedItem = $(idElement).children("option:selected").val(); // get value select
            const url = "{{ route('getkecamatan', '') }}" + "/" + selectedItem; // url route

            ajax('get', url, function(response) { //  ajax(methos, url, callback)

                if (response.success) {
                    const data = response.data // get data array
                    let bodyKecamatan =
                        '<option value="" selected disabled>Pilih Kecamatan</option>'; // content html
                    for (let index = 0; index < data.length; index++) {
                        bodyKecamatan += `<option value="${data[index].id}">${data[index].nama}</option>`
                    }
                    $(idElementSet).html(bodyKecamatan); // set content
                }
            })
        }

        function setKecamatan(idElement, idElementSet) {
            const selectedItem = $(idElement).children("option:selected").val(); // get value select
            const url = "{{ route('getkelurahan', '') }}" + "/" + selectedItem; // url route

            ajax('get', url, function(response) { //  ajax(methos, url, callback)

                if (response.success) {
                    const data = response.data // get data array
                    let bodyKelurahan =
                        '<option value="" selected disabled>Pilih Kelurahan</option>'; // content html
                    for (let index = 0; index < data.length; index++) {
                        bodyKelurahan += `<option value="${data[index].id}">${data[index].nama}</option>`
                    }
                    $(idElementSet).html(bodyKelurahan); // set content
                }
            })
        }
    </script>
@endsection
