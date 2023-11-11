@extends('layout1.app')
@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Kuisioner Online Survey Stok Toko</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            {{-- <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode"> --}}
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            {{-- produk benih --}}
                            <div class="col-md-12" id="pilih_jenis">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Jenis</label>
                                    <select class="form-select" data-choices data-choices-sorting="true">
                                        <option value="" disabled selected>Pilih jenis</option>
                                        <option value="horti">Horti</option>
                                        <option value="pangan">Pangan</option>
                                    </select>
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

                            {{-- satuan --}}
                            <div class="col-md-6" id="pilih_produsen">
                                <div class="mb-3">
                                    <label class="form-label">Pilih satuan</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            aria-label="Text input with dropdown button">
                                        <select class="form-select-sm">
                                            <option selected disabled>Pilih satuan</option>
                                            <option value="">Pilih satuan</option>
                                            <option value="">Pilih satuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div><!--end row-->

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div><!--end row-->
@endsection

@section('otherJs')
    <script>
        const container_jenis = $('#pilih_jenis');
        const select_jenis = container_jenis.find('select');

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
        })

        // select benih (padi hibrida dll)
        select_benih.change(function() {
            let value = $(this).val()
            const url = `{{ url('get-data/nama-benih/${value}') }}`

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
        })

        // select nama (madrid, betras)
        select_nama_produk.change(function() {
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
        })

        function reset_all() {
            container_produk_benih.css('display', 'none');
            container_benih.css('display', 'none');
            container_nama_produk.css('display', 'none');
            container_produsen.css('display', 'none');

            choices_instance_produk_benih ? choices_instance_produk_benih.destroy() : ''
            choices_instance_benih ? choices_instance_benih.destroy() : ''
            choices_instance_nama_produk ? choices_instance_nama_produk.destroy() : ''
            choices_instance_produsen ? choices_instance_produsen.destroy() : ''
        }

        function reset_benih_produk() {
            container_benih.css('display', 'none');
            container_nama_produk.css('display', 'none');
            container_produsen.css('display', 'none');

            choices_instance_benih ? choices_instance_benih.destroy() : ''
            choices_instance_nama_produk ? choices_instance_nama_produk.destroy() : ''
            choices_instance_produsen ? choices_instance_produsen.destroy() : ''
        }

        function reset_produk() {
            container_nama_produk.css('display', 'none');
            container_produsen.css('display', 'none');

            choices_instance_nama_produk ? choices_instance_nama_produk.destroy() : ''
            choices_instance_produsen ? choices_instance_produsen.destroy() : ''
        }

        function reset_nama_produk() {
            container_produsen.css('display', 'none');

            choices_instance_produsen ? choices_instance_produsen.destroy() : ''
        }
    </script>
@endsection
