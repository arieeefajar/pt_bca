@extends('layout.app')
@section('title', 'Dashboard')
@section('menu', 'dashboard')
@section('submenu', 'Analytics')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted mb-0">Users</p>
                            <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value" data-target="28.05">0</span>k
                            </h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                    <i class="ri-arrow-up-line align-middle"></i> 16.24 %
                                </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                    <i data-feather="users" class="text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted mb-0">Sessions</p>
                            <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value" data-target="97.66">0</span>k
                            </h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                    <i class="ri-arrow-down-line align-middle"></i> 3.96 %
                                </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                    <i data-feather="activity" class="text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->

    <div class="row">
        <div class="col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted mb-0">Avg. Visit Duration</p>
                            <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value" data-target="3">0</span>m
                                <span class="counter-value" data-target="40">0</span>sec
                            </h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                    <i class="ri-arrow-down-line align-middle"></i> 0.24 %
                                </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                    <i data-feather="clock" class="text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted mb-0">Bounce Rate</p>
                            <h2 class="mt-4 ff-secondary fw-bold"><span class="counter-value" data-target="33.48">0</span>%
                            </h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                    <i class="ri-arrow-up-line align-middle"></i> 7.05 %
                                </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                    <i data-feather="external-link" class="text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->

    <div class="row">
        <div class="col-xl-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Custom DataLabels Bar</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="custom_datalabels_bar" data-colors='["--vz-primary", "--vz-secondary", "--vz-success", "--vz-info", "--vz-warning", "--vz-danger", "--vz-dark", "--vz-primary", "--vz-success", "--vz-secondary"]' class="apex-charts" dir="ltr"></div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>

        <div class="col-xl-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Simple Pie Chart</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="simple_pie_chart" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
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
                                    <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2112</a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle" />
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
                                    <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2111</a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle" />
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
                                    <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2109</a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle" />
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
                                    <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2108</a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-circle" />
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
                                    <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2107</a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle" />
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
</div>
@endsection