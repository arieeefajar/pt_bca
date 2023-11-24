@extends('layout1.app')
@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Kuisioner Online Survey Stok Toko</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button type="button" onclick="showModal()"
                                class="btn btn-warning btn-label waves-effect waves-light rounded-pill"data-bs-toggle="modal"
                                data-bs-target="#modalKeranjang"><i
                                    class="ri-shopping-cart-2-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                Keranjang</button>
                            {{-- <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode"> --}}
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            {{-- produk benih --}}
                            <div class="col-md-12" id="pilih_jenis" style="display: block">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Jenis</label>
                                    <select class="form-select"></select>
                                </div>
                            </div>

                            {{-- jenis benih --}}
                            <div class="col-md-6" id="pilih_produk_benih" style="display: none">
                                <div class="mb-3 select-wrap">
                                    <label class="form-label">Pilih Jenis Benih</label>
                                    <select class="form-select"></select>
                                </div>
                            </div>

                            {{-- benih --}}
                            <div class="col-md-6" id="pilih_benih" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Benih</label>
                                    <select class="form-select"></select>
                                </div>
                            </div>

                            {{-- nama --}}
                            <div class="col-md-6" id="pilih_nama_produk" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Produk</label>
                                    <select class="form-select"></select>
                                </div>
                            </div>

                            {{-- produsen --}}
                            <div class="col-md-6" id="pilih_produsen" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Produsen</label>
                                    <select class="form-select"></select>
                                </div>
                            </div>

                            {{-- input_lainnya_produk jenis benih --}}
                            <div class="col-md-6" id="lainnya_jenis" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label">Masukan Jenis Benih</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            {{-- Lainnya Benih --}}
                            <div class="col-md-6" id="lainnya_benih" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label">Masukan Nama Benih</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            {{-- Lainnya Produk --}}
                            <div class="col-md-6" id="lainnya_produk" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label">Masukan Nama Produk</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            {{-- Lainnya Produsen --}}
                            <div class="col-md-6" id="lainnya_produsen" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label">Masukan Nama Produsen</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            {{-- satuan --}}
                            <div class="col-md-6" id="satuan" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label">Pilih satuan</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            aria-label="Text input with dropdown button">
                                        <select class="form-select-sm">
                                            <option value="" selected disabled>Pilih satuan</option>
                                            <option value="saset">Saset</option>
                                            <option value="pack">Pack</option>
                                            <option value="kerdus">Kerdus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div><!--end row-->
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-primary" id="tambah" disabled onclick="tambahData()">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div><!--end row-->

    {{-- keranjangModal --}}
    <div class="modal fade" id="modalKeranjang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Nama Produk</label>
                                </div>
                                <div class="col-sm-7 text-center">
                                    <label for="" class="form-label">Produsen</label>
                                </div>
                                <div class="col-sm-2 text-end">
                                    <label for="" class="form-label">Stok</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="detailData">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="submit_suevey()" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('otherJs')
    <script>
        const container_jenis = $('#pilih_jenis');
        const select_jenis = container_jenis.find('select');
        let choices_instance_jenis;
        setJenis();

        const container_produk_benih = $('#pilih_produk_benih');
        const select_produk_benih = container_produk_benih.find('select');
        let choices_instance_produk_benih;

        const container_benih = $('#pilih_benih');
        const select_benih = container_benih.find('select');
        let choices_instance_benih;

        const container_nama_produk = $('#pilih_nama_produk');
        const select_nama_produk = container_nama_produk.find('select');
        let choices_instance_nama_produk;

        const container_produsen = $('#pilih_produsen');
        const select_produsen = container_produsen.find('select');
        let choices_instance_produsen;

        const satuan = $('#satuan');
        const input_satuan = satuan.find('input');
        const select_satuan = satuan.find('select');

        const lainnya_jenis = $('#lainnya_jenis');
        const input_lainnya_jenis = lainnya_jenis.find('input');

        const lainnya_benih = $('#lainnya_benih');
        const input_lainnya_benih = lainnya_benih.find('input');

        const lainnya_produk = $('#lainnya_produk');
        const input_lainnya_produk = lainnya_produk.find('input');

        const lainnya_produsen = $('#lainnya_produsen');
        const input_lainnya_produsen = lainnya_produsen.find('input');

        // select jenis (horti, pangan dll)
        select_jenis.change(function() {
            let value = $(this).val()
            const url = `{{ url('get-data/produk-benih/${value}') }}`

            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                beforeSend: function() {
                    reset_all();
                    Swal.fire({
                        title: "Loading...",
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function(response) {
                    Swal.close();
                    container_produk_benih.css('display', 'block');

                    let choicesArray = [{
                        value: '',
                        label: 'Pilih Jenis Benih',
                        selected: true,
                        disabled: true
                    }, {
                        value: 'lainnya',
                        label: 'Lainnya'
                    }];
                    $.each(response, function(index, value) {
                        choicesArray.push({
                            value: value.id,
                            label: value.nama,
                            selected: false,
                            disabled: false
                        });
                    });

                    if (choices_instance_produk_benih) {
                        choices_instance_produk_benih.destroy();
                    }

                    // Panggil setChoices dengan shouldSort: false
                    choices_instance_produk_benih = new Choices(select_produk_benih[0], {
                        choices: choicesArray,
                        shouldSort: false,
                    });

                },
                error: function(request) {
                    reset_all();
                    Swal.close();
                    console.log('error');
                },
            });
        })

        // select produk benih (jagung / padi)
        select_produk_benih.change(function() {
            let value = $(this).val()
            const url = `{{ url('get-data/jenis-benih/${value}') }}`

            if (value === 'lainnya') {
                reset_benih_produk()
                lainnya_jenis.css('display', 'block');
                lainnya_benih.css('display', 'block');
                satuan.css('display', 'block');
                callProdusen();
                lainnya_produk.css('display', 'block');
            } else {
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    beforeSend: function() {
                        reset_benih_produk();
                        Swal.fire({
                            title: "Loading...",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        container_benih.css('display', 'block');

                        let choicesArray = [{
                            value: '',
                            label: 'Pilih Benih',
                            selected: true,
                            disabled: true
                        }, {
                            value: 'lainnya',
                            label: 'Lainnya'
                        }];
                        $.each(response, function(index, value) {
                            choicesArray.push({
                                value: value.id,
                                label: value.nama,
                                selected: false,
                                disabled: false
                            });
                        });

                        if (choices_instance_benih) {
                            choices_instance_benih.destroy();
                        }

                        // Panggil setChoices dengan shouldSort: false
                        choices_instance_benih = new Choices(select_benih[0], {
                            choices: choicesArray,
                            shouldSort: false,
                        });

                    },
                    error: function(request) {
                        reset_benih_produk();
                        Swal.close();
                        console.log('error');
                    },
                });
            }
        })

        // select benih (padi hibrida dll)
        select_benih.change(function() {
            let value = $(this).val()
            const url = `{{ url('get-data/nama-benih/${value}') }}`

            if (value === 'lainnya') {
                reset_produk();
                lainnya_benih.css('display', 'block');
                satuan.css('display', 'block');
                callProdusen();
                lainnya_produk.css('display', 'block');
            } else {
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    beforeSend: function() {
                        reset_produk();
                        Swal.fire({
                            title: "Loading...",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        container_nama_produk.css('display', 'block');

                        let choicesArray = [{
                            value: '',
                            label: 'Pilih Produk',
                            selected: true,
                            disabled: true
                        }, {
                            value: 'lainnya',
                            label: 'Lainnya'
                        }];
                        $.each(response, function(index, value) {
                            choicesArray.push({
                                value: value.id,
                                label: value.nama,
                                selected: false,
                                disabled: false
                            });
                        });

                        if (choices_instance_nama_produk) {
                            choices_instance_nama_produk.destroy();
                        }

                        // Panggil setChoices dengan shouldSort: false
                        choices_instance_nama_produk = new Choices(select_nama_produk[0], {
                            choices: choicesArray,
                            shouldSort: false,
                        });

                    },
                    error: function(request) {
                        reset_produk();
                        Swal.close();
                        console.log('error');
                    },
                });
            }
        })

        // select nama (madrid, betras)
        select_nama_produk.change(function() {
            let value = $(this).val()
            const url = `{{ url('get-data/produsen-benih/') }}`

            if (value === 'lainnya') {
                reset_nama_produk();
                satuan.css('display', 'block');
                callProdusen();
                lainnya_produk.css('display', 'block');
            } else {
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    beforeSend: function() {
                        reset_nama_produk();
                        Swal.fire({
                            title: "Loading...",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        container_produsen.css('display', 'block');

                        let choicesArray = [{
                            value: '',
                            label: 'Pilih Produsen',
                            selected: true,
                            disabled: true
                        }, {
                            value: 'lainnya',
                            label: 'Lainnya'
                        }];
                        $.each(response, function(index, value) {
                            choicesArray.push({
                                value: value.id,
                                label: value.nama,
                                selected: false,
                                disabled: false
                            });
                        });

                        if (choices_instance_produsen) {
                            choices_instance_produsen.destroy();
                        }

                        // Panggil setChoices dengan shouldSort: false
                        choices_instance_produsen = new Choices(select_produsen[0], {
                            choices: choicesArray,
                            shouldSort: false,
                        });

                    },
                    error: function(request) {
                        reset_nama_produk();
                        Swal.close();
                        console.log('error');
                    },
                });
            }
        })

        // select_produsen (pt bca)
        select_produsen.change(function() {
            let value = $(this).val()

            if (value === 'lainnya') {
                // reset_nama_produk();
                lainnya_produsen.css('display', 'block')
                satuan.css('display', 'block')
            } else {
                satuan.css('display', 'block')
                lainnya_produsen.css('display', 'none')
                input_lainnya_produsen.val('')
            }
        })

        //select_satuan (saset, dll)
        select_satuan.change(function() {
            const button = $('#tambah')
            button.prop('disabled', false);
        })

        function callProdusen() {
            const url = `{{ url('get-data/produsen-benih/') }}`

            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                beforeSend: function() {
                    reset_nama_produk();
                    Swal.fire({
                        title: "Loading...",
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function(response) {
                    Swal.close();
                    container_produsen.css('display', 'block');

                    let choicesArray = [{
                        value: '',
                        label: 'Pilih Produsen',
                        selected: true,
                        disabled: true
                    }, {
                        value: 'lainnya',
                        label: 'Lainnya',
                    }];
                    $.each(response, function(index, value) {
                        choicesArray.push({
                            value: value.id,
                            label: value.nama,
                            selected: false,
                            disabled: false
                        });
                    });

                    if (choices_instance_produsen) {
                        choices_instance_produsen.destroy();
                    }

                    // Panggil setChoices dengan shouldSort: false
                    choices_instance_produsen = new Choices(select_produsen[0], {
                        choices: choicesArray,
                        shouldSort: false,
                    });

                },
                error: function(request) {
                    reset_nama_produk();
                    Swal.close();
                    console.log('error');
                },
            });
        }

        function reset_all() {
            container_produk_benih.css('display', 'none');
            container_benih.css('display', 'none');
            container_nama_produk.css('display', 'none');
            container_produsen.css('display', 'none');
            lainnya_jenis.css('display', 'none');
            lainnya_benih.css('display', 'none');
            lainnya_produk.css('display', 'none');
            lainnya_produsen.css('display', 'none');
            satuan.css('display', 'none');

            choices_instance_produk_benih ? choices_instance_produk_benih.destroy() : ''
            choices_instance_benih ? choices_instance_benih.destroy() : ''
            choices_instance_nama_produk ? choices_instance_nama_produk.destroy() : ''
            choices_instance_produsen ? choices_instance_produsen.destroy() : ''
            input_satuan.val("")
            select_satuan.val("")
            input_lainnya_jenis.val("")
            input_lainnya_benih.val("")
            input_lainnya_produk.val("")
            input_lainnya_produsen.val("")

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Data berhasil ditambahkan',
                showConfirmButton: false,
                timer: 1500
            });
        }

        function reset_benih_produk() {
            container_benih.css('display', 'none');
            container_nama_produk.css('display', 'none');
            container_produsen.css('display', 'none');
            lainnya_jenis.css('display', 'none');
            lainnya_benih.css('display', 'none');
            lainnya_produk.css('display', 'none');
            lainnya_produsen.css('display', 'none');
            satuan.css('display', 'none');

            choices_instance_benih ? choices_instance_benih.destroy() : ''
            choices_instance_nama_produk ? choices_instance_nama_produk.destroy() : ''
            choices_instance_produsen ? choices_instance_produsen.destroy() : ''
            input_satuan.val("")
            select_satuan.val("")
            input_lainnya_jenis.val("")
            input_lainnya_benih.val("")
            input_lainnya_produk.val("")
            input_lainnya_produsen.val("")
        }

        function reset_produk() {
            container_nama_produk.css('display', 'none');
            container_produsen.css('display', 'none');
            lainnya_produk.css('display', 'none');
            lainnya_benih.css('display', 'none');
            lainnya_produsen.css('display', 'none');
            satuan.css('display', 'none');

            choices_instance_nama_produk ? choices_instance_nama_produk.destroy() : ''
            choices_instance_produsen ? choices_instance_produsen.destroy() : ''
            input_lainnya_produk.val("")
            input_satuan.val("")
            input_lainnya_produsen.val("")
            input_lainnya_benih.val("")
            select_satuan.val("")
        }

        function reset_nama_produk() {
            container_produsen.css('display', 'none');
            lainnya_produsen.css('display', 'none');
            lainnya_produk.css('display', 'none');

            choices_instance_produsen ? choices_instance_produsen.destroy() : ''
            input_lainnya_produsen.val("")
            input_lainnya_produk.val("")
        }

        function tambahData() {

            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }

            let penyimpanan = JSON.parse(localStorage.getItem('data'));
            let idProduk = select_nama_produk.val();
            let idProdusen = select_produsen.val();
            let inputSatuan = input_satuan.val();
            let selectSatuan = select_satuan.val();

            let input_jenis = input_lainnya_jenis.val();
            let input_benih = input_lainnya_benih.val();
            let input_produk = input_lainnya_produk.val();
            let input_produsen = input_lainnya_produsen.val();
            let token = '{{ csrf_token() }}'

            let dataBaru = {};

            if (input_jenis != '' && input_benih != '' && input_produk != '' && input_produsen != '') {
                console.log('add_other_4_table');

                let formData = new FormData()
                formData.append('_token', token)
                formData.append('jenis', select_jenis.val())
                formData.append('jenis_benih', input_jenis)
                formData.append('benih', input_benih)
                formData.append('nama_produk', input_produk)
                formData.append('nama_produsen', input_produsen)

                $.ajax({
                    type: "post",
                    url: "{{ url('add-data/other_4_table') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: "Loading...",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        console.log(response);
                        dataBaru = {
                            id_produk: response.produk,
                            id_produsen: response.produsen,
                            input_satuan: inputSatuan,
                            select_satuan: selectSatuan
                        };
                        penyimpanan.push(dataBaru);
                        localStorage.setItem('data', JSON.stringify(penyimpanan));
                    },
                    error: function(request) {
                        Swal.close();
                        console.log('error');
                    },
                });
            } else if (input_jenis != '' && input_benih != '' && input_produk != '') {
                console.log('add_other_3_table');

                let formData = new FormData()
                formData.append('_token', token)
                formData.append('jenis', select_jenis.val())
                formData.append('jenis_benih', input_jenis)
                formData.append('benih', input_benih)
                formData.append('nama_produk', input_produk)
                formData.append('nama_produsen', input_produsen ? input_produsen : select_produsen.val())

                $.ajax({
                    type: "post",
                    url: "{{ url('add-data/other_3_table') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: "Loading...",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        console.log(response.produk);
                        dataBaru = {
                            id_produk: response.produk,
                            id_produsen: response.produsen,
                            input_satuan: inputSatuan,
                            select_satuan: selectSatuan
                        };
                        penyimpanan.push(dataBaru);
                        localStorage.setItem('data', JSON.stringify(penyimpanan));
                    },
                    error: function(request) {
                        Swal.close();
                        console.log('error');
                    },
                });
            } else if (input_benih != '' && input_produk != '') {
                console.log('add_other_2_table');
                let formData = new FormData()
                formData.append('_token', token)
                formData.append('jenis_benih', select_produk_benih.val())
                formData.append('benih', input_benih)
                formData.append('nama_produk', input_produk)
                formData.append('nama_produsen', input_produsen ? input_produsen : select_produsen.val())

                $.ajax({
                    type: "post",
                    url: "{{ url('add-data/other_2_table') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: "Loading...",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        console.log(response);
                        dataBaru = {
                            id_produk: response.produk,
                            id_produsen: response.produsen,
                            input_satuan: inputSatuan,
                            select_satuan: selectSatuan
                        };
                        penyimpanan.push(dataBaru);
                        localStorage.setItem('data', JSON.stringify(penyimpanan));
                    },
                    error: function(request) {
                        Swal.close();
                        console.log('error');
                    },
                });
            } else if (input_produk != '') {
                console.log('add_other_1_table');
                let formData = new FormData()
                formData.append('_token', token)
                formData.append('benih', select_benih.val())
                formData.append('nama_produk', input_produk)
                formData.append('nama_produsen', input_produsen ? input_produsen : select_produsen.val())

                $.ajax({
                    type: "post",
                    url: "{{ url('add-data/other_1_table') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: "Loading...",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        console.log(response);
                        dataBaru = {
                            id_produk: response.produk,
                            id_produsen: response.produsen,
                            input_satuan: inputSatuan,
                            select_satuan: selectSatuan
                        };
                        penyimpanan.push(dataBaru);
                        localStorage.setItem('data', JSON.stringify(penyimpanan));
                    },
                    error: function(request) {
                        Swal.close();
                        console.log('error');
                    },
                });
            } else {
                dataBaru = {
                    id_produk: idProduk,
                    id_produsen: idProdusen,
                    input_satuan: inputSatuan,
                    select_satuan: selectSatuan
                };
                penyimpanan.push(dataBaru);
                localStorage.setItem('data', JSON.stringify(penyimpanan));
            }

            reset_all()
            const button = $('#tambah')
            button.prop('disabled', true);

            setJenis();

        }

        function setJenis() {
            const choicesArray = [{
                value: '',
                label: 'Pilih Jenis',
                selected: true,
                disabled: true
            }, {
                value: 'horti',
                label: 'Horti',
                selected: false,
                disabled: false
            }, {
                value: 'pangan',
                label: 'Pangan',
                selected: false,
                disabled: false
            }];

            if (choices_instance_jenis) {
                choices_instance_jenis.destroy();
            }

            // Panggil setChoices dengan shouldSort: false
            choices_instance_jenis = new Choices(select_jenis[0], {
                choices: choicesArray,
                shouldSort: false,
            });
        }

        function showModal() {
            let allDatas = JSON.parse(localStorage.getItem('data'));
            const keranjang = $('#detailData')
            if (allDatas && allDatas.length > 0) {

                allDatas.forEach(data => {
                    let row = $('<div>')
                    row.addClass('row');

                    let col1 = $('<div>')
                    col1.addClass('col-sm-3')
                    col1.text(`${data.id_produk}`);

                    let col2 = $('<div>')
                    col2.addClass('col-sm-7 text-center')
                    col2.text(`${data.id_produsen}`);

                    let col3 = $('<div>')
                    col3.addClass('col-sm-2 text-end')
                    col3.text(`${data.input_satuan}, ${data.select_satuan}`);

                    row.append(col1)
                    row.append(col2)
                    row.append(col3)
                    keranjang.append(row);
                });
            }
        }

        function submit_suevey() {
            let allDatas = JSON.parse(localStorage.getItem('data'));
            // console.log(allDatas);
            let token = '{{ csrf_token() }}'
            let formData = new FormData()
            formData.append('_token', token)
            formData.append('_token', allDatas)

            $.ajax({
                type: "post",
                url: "{{ url('add-data/submit') }}",
                data: "data",
                dataType: "dataType",
                success: function(response) {

                }
            });
        }
    </script>
@endsection
