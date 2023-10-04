@extends('layout.app')
@section('title', 'Data Surveyor')
@section('menu', 'Data Surveyor')
@section('submenu', 'Master')

@section('content')

    {{-- @dd($provinsi) --}}

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
                                            <th class="sort" data-sort="customer_name">Username</th>
                                            <th class="sort" data-sort="email">Email</th>
                                            <th class="sort" data-sort="date">Wilayah</th>
                                            <th class="sort" data-sort="date">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($dataSurveyor as $index => $data)
                                            <tr>
                                                <th class="text-center">{{ $index + 1 }}</th>
                                                <td class="customer_name">{{ $data->name }}</td>
                                                <td class="email">{{ $data->email }}</td>
                                                <td class="">{{ $data->wilayah === null ? '-' : $data->wilayah }}</td>
                                                <td class="date">
                                                    <button class="btn btn-sm btn-primary edit-item-btn"
                                                        data-bs-toggle="modal" data-bs-target="#showModal"
                                                        onclick="getWilayah({{ $data }})">Set</button>
                                                    <button class="btn btn-sm btn-success edit-item-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $data->id }}">Detail</button>
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

    <!-- edit-modal -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Set Wilayah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form action="" id="formEdit" class="needs-validation" novalidate method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" id="name_surveyor" name="name_surveyor" class="form-control"
                                value="" readonly placeholder="Masukkan Username" required />
                            <div class="invalid-feedback">
                                Username tidak boleh kosong.
                            </div>
                        </div>

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
                                <option selected disabled>Pilih Kota</option>
                                <option value="">...</option>
                            </select>
                            <div class="invalid-feedback mb-3">
                                Pilih Kota.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submit_button">Set</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($dataSurveyor as $user)
        <!-- detail-modal -->
        <div class="modal fade" id="detailModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Surveyor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="" class="needs-validation" novalidate method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $user->name }}" readonly placeholder="Masukkan Username" required />
                                <div class="invalid-feedback">
                                    Username tidak boleh kosong.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email-field" class="form-label">Email</label>
                                <input type="email" id="email-field" name="email" value="{{ $user->email }}"
                                    class="form-control" readonly placeholder="Masukan Email" required />
                                <div class="invalid-feedback">
                                    Email tidak boleh kosong. Masukkan email yang berisi &quot@&quot. Contoh: Raju@gmail.com
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" id="alamat-field" name="alamat" value="{{ $user->alamat }}"
                                    class="form-control" readonly placeholder="Masukan Alamat" required />
                                <div class="invalid-feedback">
                                    Alamat tidak boleh kosong.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone-field" class="form-label">No.Hp</label>
                                <input type="tel" readonly name="no_telp" maxlength="13" id="no_telp"
                                    class="form-control" placeholder="Masukan No.HP" value="{{ $user->no_telp }}"
                                    required pattern="(\+62|62|0)8[1-9][0-9]{9,10}$"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); validateInput(this);"
                                    oninvalid="validateInput(this);" />
                                <div class="invalid-feedback">
                                    No.Hp tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
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

        function getWilayah(data) {
            console.log(data);

            // set action url form
            document.getElementById('formEdit').action = "{{ route('dataSurveyor.create', ['id' => '/']) }}/" + data.id;
            // setdata
            $('#name_surveyor').val(data.name);

            if (data.provinsi_id == null) {
                $("#set_provinsi").prop("selectedIndex", 0).val();
            } else {
                $('#set_provinsi').val(data.provinsi_id);
            }

            getKota(data.provinsi_id, data.kota_id);

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
