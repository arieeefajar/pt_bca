@extends('layout.app')
@section('title', 'Data Surveyor')
@section('menu', 'Data Surveyor')
@section('submenu', 'Master')

@section('content')

    {{-- @dd($dataSurveyor) --}}

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

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Data Surveyor</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">

                            <div class="table-responsive mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="myTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="sort" data-sort="customer_name">Name</th>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($dataSurveyor as $index => $data)
                                            <tr>
                                                <th class="text-center">{{ $index + 1 }}</th>
                                                <td class="customer_name">{{ $data->name }}</td>
                                                <td class="text-center">{{ $data->nip }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-primary edit-item-btn"
                                                        data-bs-toggle="modal" data-bs-target="#showDetail"
                                                        onclick="getDetailWilayah({{ $data }})">Set Wilayah</button>
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
        <!-- end row -->
    </div>

    <!-- show-detail-wilayah-set -->
    <div class="modal fade" id="showDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="tittleSetWilayah"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#showModal">Set
                            Wilayah</button>
                    </div>

                    <div class="table-responsive mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="myTable">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-left">Provinsi</th>
                                    <th class="text-center">Kota</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="content_detail_wilayah">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- set-wilayah -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title">Set Wilayah</h5>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#showDetail"
                        aria-label="Close" id="close-modal"></button>
                </div>
                <form action="" id="formAdd" class="needs-validation" novalidate method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Provinsi</label>
                            <select class="form-select" required name="set_provinsi" id="set_provinsi"
                                oninvalid="this.setCustomValidity('Harap pilih role pengguna')"
                                oninput="setCustomValidity('')">
                                <option selected disabled value="">Pilih Provinsi</option>
                                @foreach ($provinsi as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback mb-3">
                                Pilih Provinsi.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Kota</label>
                            <select class="form-select" required name="kota" id="set_kota"
                                oninvalid="this.setCustomValidity('Harap pilih role pengguna')"
                                oninput="setCustomValidity('')">
                            </select>
                            <div class="invalid-feedback mb-3">
                                Pilih Kota.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#showDetail">Close</button>
                            <button type="submit" class="btn btn-primary" id="submit_button">Set</button>
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
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#showDetail"
                        aria-label="Close" id="btn-close"></button>
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
                        <button type="button" class="btn w-sm btn-light" data-bs-toggle="modal"
                            data-bs-target="#showDetail">Tutup</button>
                        <form action="" id="formDelete" method="POST" style="display: inline;">
                            @method('DELETE')
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

        function getDetailWilayah(data) {
            console.log(data);
            showSetWilayah(data)

            let content_body = ''

            if (data.wilayah) {
                const dataLoop = data.wilayah

                for (let i = 0; i < dataLoop.length; i++) {
                    console.log(dataLoop[i].kota);
                    content_body += `<tr>`
                    content_body += `<th class="text-left">${dataLoop[i].provinsi}</th>`
                    content_body += `<th class="text-center">${dataLoop[i].kota}</th>`
                    content_body += `<td class="text-center">`
                    content_body += `<button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDelete('${dataLoop[i].id_survey}')">Hapus</button>`
                    content_body += `</td>`
                    content_body += `</tr>`
                }

                $('#content_detail_wilayah').html(content_body);
            } else {
                console.log('gaada');
            }

        }

        function showSetWilayah(data) {
            // set action url form
            document.getElementById('formAdd').action = "{{ route('dataSurveyor.create', ['id' => '/']) }}/" + data.id;
            // setdata
            $('#tittleSetWilayah').html(data.name);
            $("#set_provinsi").prop("selectedIndex", 0).val();
            $('#set_kota').html('<option selected disabled>Pilih Kota</option><option value="">...</option>');

            $("#set_provinsi").change(function() {
                getKota($("#set_provinsi").val()) // format paramater : "#idElement"
            });

        }

        function getKota(idProvinsi, idKota) {
            const url = "{{ route('getkota', '') }}" + "/" + idProvinsi; // url route
            ajax('get', url, function(response) { //  ajax(methos, url, callback)
                if (response.success) {
                    const data = response.data // get data array
                    let bodyKota = '<option value="" selected disabled>Pilih Kota</option>'; // content html
                    for (let index = 0; index < data.length; index++) {
                        bodyKota += `<option value="${data[index].id}">${data[index].nama}</option>`
                    }
                    $('#set_kota').html(bodyKota); // set content

                    if (idKota) {
                        $('#set_kota').val(idKota);
                    }
                }
            })
        }

        function setDelete(id_survey) {
            document.getElementById('formDelete').action = "{{ route('dataSurveyor.delete', ['id' => '/']) }}/" + id_survey;
        }


        document.querySelector(".pagination-next").addEventListener("click", function() {
                !document.querySelector(".pagination.listjs-pagination") ||
                    (document
                        .querySelector(".pagination.listjs-pagination")
                        .querySelector(".active") &&
                        document
                        .querySelector(".pagination.listjs-pagination")
                        .querySelector(".active")
                        .nextElementSibling.children[0].click());
            }),

            document.querySelector(".pagination-prev").addEventListener("click", function() {
                !document.querySelector(".pagination.listjs-pagination") ||
                    (document
                        .querySelector(".pagination.listjs-pagination")
                        .querySelector(".active") &&
                        document
                        .querySelector(".pagination.listjs-pagination")
                        .querySelector(".active")
                        .previousSibling.children[0].click());
            });
    </script>
@endsection
