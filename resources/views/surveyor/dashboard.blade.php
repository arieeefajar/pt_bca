@extends('layout1.app')
@section('title', 'Dashboard')
@section('menu', 'dashboard')
@section('submenu', 'Analytics')

@section('content')
{{-- <style>
    .select-box{
        margin-top: 150px;
        width: 380px;
        position: relative;
    }

    .select-option{
        position: relative;
    }

    .select-option input{
        width: 100%;
        background-color: #fff;
        color: #000;
        border-radius: 7px;
        cursor: pointer;
        font-size: 22px;
        padding: 15px 20px;
        border: 0 !important;
        outline: 0 !important;
    }

    .select-option::after{
        content: "";
        border-top: 12px solid #000;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        position: absolute;
        right: 15px;
        top: 50%;
        margin-top: -8px;
    }

    .content{
        background-color: #fff;
        position: absolute;
        color: #000;
        border-radius: 7px;
        margin-top: 15px;
        width: 100%;
        z-index: 999;
        padding: 20px;
        display: none;
    }

    .search input{
        width: 100%;
        font-size: 17px;
        padding: 15px;
        outline: 0;
        border: 1px solid #b3b3b3;
        border-radius: 5px;
    }

    .options{
        margin-top: 10px;
        max-height: 250px;
        overflow-y: auto;
        padding: 0;
    }

    .options li{
        padding: 10px 15px;
        font-size: 21px;
        cursor: pointer;
        border-bottom: 1px solid gray;
    }

    .options li:hover{
        background-color: #f2f2f2;
    }

    .select-box.active .content{
        display: block;
    }

    .select-box.active .select-option:after{
        transform: rotate(-180deg);
    }
</style> --}}
<div class="row project-wrapper">
    <div class="col-xxl-8">
        <div class="row">
            <div class="col-xl-12 mb-3">
                {{-- <div class="select-box">
                    <div class="select-option">
                        <input type="text" placeholder="Pilih toko yang akan dikunjungi" id="soValue" readonly name="">
                    </div>
                    <div class="content">
                        <div class="search">
                            <input type="text" id="optionSearch" placeholder="Cari" name="">
                        </div>
                        <ul class="options">
                            <li>Toko 1</li>
                            <li>Toko 2</li>
                            <li>Toko 3</li>
                            <li>Toko 4</li>
                        </ul>
                    </div>
                </div> --}}
                <label for="toko">Pilih Toko:</label>
                <select class="form-select mb-3" name="store" id="toko">
                    <option selected disabled>Pilih toko yang akan dikunjungi:</option>
                    <option value="toko1">Contoh 1</option>
                    <option value="toko2">Contoh 2</option>
                    <!-- Tambahkan pilihan toko lain sesuai kebutuhan -->
                </select>
            </div>
        </div><!-- end row -->

            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Custom DataLabels Bar</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div id="custom_datalabels_bar"
                                data-colors='["--vz-primary", "--vz-secondary", "--vz-success", "--vz-info", "--vz-warning", "--vz-danger", "--vz-dark", "--vz-primary", "--vz-success", "--vz-secondary"]'
                                class="apex-charts" dir="ltr"></div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
            </div> <!-- .card-->
        </div> <!-- .col-->
    </div><!-- end col -->
</div><!-- end row -->

{{-- <script>
    const selectBox = document.querySelector('.select-box');
    const selectOption = document.querySelector('.select-option');
    const soValue = document.querySelector('#soValue');
    const optionSearch = document.querySelector('#optionSearch');
    const options = document.querySelector('.option');
    const optionList = document.querySelector('.options li');

    selectOption.addEventListener('click',function(){
        selectBox.classList.toggle('active');
    });

    optionsList.forEach(function(optionsListSingle){
        optionsListSingle.addEventListener('click',function(){
            text = this.textContent;
            soValue.value = text;
            selectBox.classList.remove('active');
        })
    });
</script> --}}


<script>
    document.getElementById("toko").addEventListener("change", function() {
        var selectedStore = this.value;
        window.location.href = "{{ route('surveyor.setStore') }}?store=" + selectedStore;
    });
</script>
@endsection
