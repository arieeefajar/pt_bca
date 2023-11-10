<!doctype html>
<html lang="en" data-layout="twocolumn" data-sidebar="light" data-sidebar-size="lg">

<head>

    <meta charset="utf-8" />
    <title>Sistem Informasi Market Intellegence</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/assets/images/logosimi.png') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('admin_assets/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin_assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin_assets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('admin_assets/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />


</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-0 mb-0 text-white-50">
                            <div>
                                <a href="{{ route('login') }}" class="d-inline-block auth-logo">
                                    <img src="{{ asset('admin_assets/assets/images/logosimi.png') }}" alt="120"
                                        height="120">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-0">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to SIMI.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    @if (request()->segment(2))
                                        {{-- login toko --}}
                                        <form action="{{ route('prosesLoginSurvey') }}" class="needs-validation"
                                            novalidate method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="no_telp" class="form-label">No Telepon</label>
                                                <input type="text" class="form-control" id="no_telp"
                                                    placeholder="Masukan Nomor Telepon" name="no_telp" required
                                                    value="{{ old('no_telp') }}"pattern="(\+62|62|0)8[1-9][0-9]{8,9}$"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); validateInput(this);"
                                                    oninvalid="validateInput(this);">
                                                <div class="invalid-feedback" id="validTlp">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="password">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" value="{{ old('password') }}" required
                                                        class="form-control pe-5" placeholder="Enter password"
                                                        id="password" name="password"
                                                        oninvalid="validatePassword(this)">
                                                    <button
                                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                                        type="button" id="password-addon"><i
                                                            class="ri-eye-fill align-middle"></i></button>
                                                    <div class="invalid-feedback" id="validatePassword">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Login</button>
                                            </div>
                                        </form>
                                    @else
                                        {{-- login default --}}
                                        <form action="{{ route('prosesLogin') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nip" class="form-label">NIP</label>
                                                <input type="text" class="form-control" id="email"
                                                    placeholder="Masukan email" name="nip" required
                                                    value="{{ old('nip') }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="password">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" value="{{ old('password') }}" required
                                                        class="form-control pe-5" placeholder="Enter password"
                                                        id="password" name="password">
                                                    <button
                                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                                        type="button" id="password-addon"><i
                                                            class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        @if (request()->segment(2))
                            <div class="mt-4 text-center">
                                <p class="mb-0">Belum punya akun ? <a href="{{ route('register') }}"
                                        class="fw-bold text-primary text-decoration-underline"> Register </a> </p>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> SIMI.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin_assets/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('admin_assets/assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('admin_assets/assets/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('admin_assets/assets/js/pages/password-addon.init.js') }}"></script>

    {{-- form validate --}}
    <script src="{{ asset('admin_assets/assets/js/pages/form-validation.init.js') }}"></script>

    <script>
        function validateInput(input) {
            const noTlp = document.getElementById('validTlp')

            if (input.validity.valueMissing) {
                input.setCustomValidity('No Hp tidak boleh kosong.');
                noTlp.innerHTML = `No Telepon tidak boleh kosong.`;
            } else if (input.validity.patternMismatch) {
                input.setCustomValidity('Nomor telepon tidak valid. Silakan masukkan nomor telepon yang benar.');
                noTlp.innerHTML = `Nomor telepon tidak valid. Silakan masukkan nomor telepon yang benar.`;
            } else {
                input.setCustomValidity('');
            }
        };

        function validatePassword(input) {
            const password = document.getElementById('validatePassword');

            if (input.validity.valueMissing) {
                input.setCustomValidity('Password tidak boleh kosong.');
                password.innerHTML = `Password tidak boleh kosong.`;
            } else {
                input.setCustomValidity('');
            }
        }
    </script>

    @include('sweetalert::alert')
</body>

</html>
