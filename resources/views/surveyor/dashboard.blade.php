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

                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Simple Pie Chart</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div id="simple_pie_chart"
                                data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'
                                class="apex-charts" dir="ltr"></div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-soft-info btn-sm">
                                <i class="ri-file-list-3-line align-bottom"></i> Generate Report
                            </button>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html"
                                                class="fw-medium link-primary">#VZ2112</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-1.jpg" alt=""
                                                        class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Alex Smith</div>
                                            </div>
                                        </td>
                                        <td>Clothes</td>
                                        <td>
                                            <span class="text-success">$109.00</span>
                                        </td>
                                        <td>Zoetic Fashion</td>
                                        <td>
                                            <span class="badge badge-soft-success">Paid</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">5.0<span class="text-muted fs-13 ms-1">(61
                                                    votes)</span></h5>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html"
                                                class="fw-medium link-primary">#VZ2111</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-2.jpg" alt=""
                                                        class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Jansh Brown</div>
                                            </div>
                                        </td>
                                        <td>Kitchen Storage</td>
                                        <td>
                                            <span class="text-success">$149.00</span>
                                        </td>
                                        <td>Micro Design</td>
                                        <td>
                                            <span class="badge badge-soft-warning">Pending</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">4.5<span class="text-muted fs-13 ms-1">(61
                                                    votes)</span></h5>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html"
                                                class="fw-medium link-primary">#VZ2109</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-3.jpg" alt=""
                                                        class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Ayaan Bowen</div>
                                            </div>
                                        </td>
                                        <td>Bike Accessories</td>
                                        <td>
                                            <span class="text-success">$215.00</span>
                                        </td>
                                        <td>Nesta Technologies</td>
                                        <td>
                                            <span class="badge badge-soft-success">Paid</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">4.9<span class="text-muted fs-13 ms-1">(89
                                                    votes)</span></h5>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html"
                                                class="fw-medium link-primary">#VZ2108</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-4.jpg" alt=""
                                                        class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Prezy Mark</div>
                                            </div>
                                        </td>
                                        <td>Furniture</td>
                                        <td>
                                            <span class="text-success">$199.00</span>
                                        </td>
                                        <td>Syntyce Solutions</td>
                                        <td>
                                            <span class="badge badge-soft-danger">Unpaid</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">4.3<span class="text-muted fs-13 ms-1">(47
                                                    votes)</span></h5>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html"
                                                class="fw-medium link-primary">#VZ2107</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-6.jpg" alt=""
                                                        class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Vihan Hudda</div>
                                            </div>
                                        </td>
                                        <td>Bags and Wallets</td>
                                        <td>
                                            <span class="text-success">$330.00</span>
                                        </td>
                                        <td>iTest Factory</td>
                                        <td>
                                            <span class="badge badge-soft-success">Paid</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">4.7<span class="text-muted fs-13 ms-1">(161
                                                    votes)</span></h5>
                                        </td>
                                    </tr><!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>
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
