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
                            {{-- <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div class="table-responsive mb-1 mt-3">
                            <table class="table align-middle mb-0" id="myTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" data_sort="no">No</th>
                                        <th class="text-center" data-sort="customer_name">Nama Customer</th>
                                        <th class="text-center" data-sort="customer_name">Jenis</th>
                                        <th class="text-center" data-sort="customer_name">Provinsi</th>
                                        <th class="text-center" data-sort="customer_name">Kota</th>
                                        <th class="text-center" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPerusahaan as $key => $data)
                                        <tr>
                                            <th class="text-center">{{ $key + 1 }}</th>
                                            <td class="text-center">{{ $data['nama'] }}</td>
                                            <td class="text-center">{{ formatJenis($data->jenis) }}</td>
                                            <td class="text-center">{{ $data['provinsi'] }}</td>
                                            <td class="text-center">{{ $data['kota'] }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#showModal{{ $data['id'] }}"
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

                        {{-- profinsi --}}
                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <select required class="form-select" name="provinsi" id="provinsi"
                                oninvalid="this.setCustomValidity('Harap pilih provinsi customer')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih Provinsi</option>
                                <option value="JAWA TIMUR" {{ old('provinsi') == 'JAWA TIMUR' ? 'selected' : '' }}>JAWA
                                    TIMUR</option>
                                {{-- @foreach ($dataProvinsi as $value)
                                    <option idProvinsi="{{ $value['id'] }}" value="{{ $value['name'] }}">
                                        {{ $value['name'] }}</option>
                                @endforeach --}}
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih provinsi.
                            </div>
                        </div>

                        {{-- kota --}}
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <select required class="form-select" name="kota" id="add_kota">
                                {{-- <option value="" disabled selected>Pilih Provinsi Terlebih Dahulu</option> --}}
                                <option value="" selected disabled>Pilih Kota</option>
                                @foreach ($dataKota as $value)
                                    <option value="{{ $value['name'] }}"
                                        {{ old('kota') == $value['name'] ? 'selected' : '' }}>{{ $value['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih kota.
                            </div>
                        </div>

                        {{-- area --}}
                        <div class="mb-3">
                            <label class="form-label">Area</label>
                            <select required class="form-select" name="area" id="area"
                                oninvalid="this.setCustomValidity('Harap pilih area customer')"
                                oninput="setCustomValidity('')">
                                <option value="" selected disabled>Pilih Area</option>
                                @foreach ($dataArea as $data)
                                    <option value="{{ $data->id }}" {{ old('area') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback mb-3">
                                Harap pilih area.
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

    @foreach ($dataPerusahaan as $data)
        {{-- modal edit --}}
        <div class="modal fade" id="showModal{{ $data['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Perusahaan</h5>
                        <button type="button" onclick="clearEdit()" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close" id="close-modal"></button>
                    </div>
                    <form action="{{ route('customer.update', $data->id) }}" class="needs-validation" novalidate
                        method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Nama Customer</label>
                                <input type="text" name="nama" value="{{ $data['nama'] }}" id="nama"
                                    class="form-control" placeholder="Masukan Nama Customer..." required />
                                <div class="invalid-feedback">
                                    Harap isi nama customer.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis</label>
                                <select class="form-select" name="jenis" id="jenis" required>
                                    <option selected disabled>Pilih Jenis</option>
                                    <option value="dealer" {{ $data->jenis === 'dealer' ? 'selected' : '' }}>Dealer
                                    </option>
                                    <option value="master_dealer"
                                        {{ $data->jenis === 'master_dealer' ? 'selected' : '' }}>Master Dealer</option>
                                    <option value="lainnya" {{ $data->jenis === 'lainnya' ? 'selected' : '' }}>Lainnya
                                    </option>
                                </select>
                                <div class="invalid-feedback mb-3">
                                    Harap pilih jenis customer.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Provinsi</label>
                                <select class="form-select" name="provinsi" id="provinsi" required>
                                    <option disabled>Pilih Provinsi</option>
                                    <option selected value="Jawa Timur">JAWA TIMUR</option>
                                </select>
                                <div class="invalid-feedback mb-3">
                                    Harap pilih provinsi.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <select required class="form-select" name="kota" id="edit_kota" required>
                                    <option value="" disabled>Pilih Kota</option>
                                    @foreach ($dataKota as $value)
                                        <option value="{{ $value['name'] }}"
                                            {{ $data->kota === $value['name'] ? 'selected' : '' }}>{{ $value['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback mb-3">
                                    Harap pilih kota.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Area</label>
                                <select class="form-select" name="area" id="area" required>
                                    <option selected disabled>Pilih Area</option>
                                    @foreach ($dataArea as $valueArea)
                                        <option value="{{ $valueArea->id }}"
                                            {{ $valueArea->id === $data->wilayah_id ? 'selected' : '' }}>
                                            {{ $valueArea->nama }}</option>
                                    @endforeach
                                    </option>
                                </select>
                                <div class="invalid-feedback mb-3">
                                    Harap pilih area.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Koordinat</label>
                                <textarea class="form-control" name="koordinat" required id="evet" cols="30" rows="5">{{ $data->koordinat }}</textarea>
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
                            <input type="text" name="nama" value="{{ $data->wilayah->nama }}" id="nama"
                                class="form-control" placeholder="Masukan Nama Customer..." required />
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


    {{-- JANGAN DIHAPUS --}}

    {{-- <script>
        const provinsi = document.getElementById('provinsi');

        function setKota() {
            var selectedOption = provinsi.options[provinsi.selectedIndex];
            var idProvinsi = selectedOption.getAttribute('idProvinsi');

            $.ajax({
                type: "get",
                url: "{{ route('getkota', '') }}" + "/" + idProvinsi,
                dataType: "json",
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        allowOutsideClick: false,
                        showConfirmButton: false,

                    });
                },
                success: function(response) {
                    var bodyKota = '<option value="" selected disabled>Pilih Kota</option>';
                    for (let index = 0; index < response.length; index++) {
                        bodyKota += `<option value="${response[index].name}">${response[index].name}</option>`
                    }
                    $('#add_kota').html(bodyKota);
                    Swal.close();
                }
            });
        }
    </script> --}}
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
