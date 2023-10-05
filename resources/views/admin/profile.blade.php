@extends('layout.app')
@section('title', 'Profile')
@section('menu', 'Ubah Profile')
@section('submenu', 'Profile')

@section('content')

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Data Diri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                Ubah Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="firstnameInput"
                                                placeholder="Enter your firstname" name="name"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phonenumberInput" class="form-label">No.Hp</label>
                                            <input type="text" class="form-control" id="phonenumberInput"
                                                placeholder="Enter your phone number" name="no_telp"
                                                value="{{ Auth::user()->no_telp }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">NIP</label>
                                            <input type="text" class="form-control" readonly id="emailInput"
                                                placeholder="Enter your nip"
                                                value="{{ Auth::user()->nip }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5"
                                                placeholder="Masukan alamat anda">{{ Auth::user()->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                            <button type="button" class="btn btn-soft-danger">Batal</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{ route('password.update', Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="oldpasswordInput" class="form-label">Password Lama*</label>
                                            <input type="password" name="old_password" class="form-control"
                                                id="oldpasswordInput" placeholder="Masukan password sebelumnya">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">Password Baru*</label>
                                            <input type="password" name="new_password" class="form-control"
                                                id="newpasswordInput" placeholder="Masukan password baru">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">Konfirmasi
                                                Password*</label>
                                            <input type="password" name="confirm_password" class="form-control"
                                                id="confirmpasswordInput" placeholder="Konfirmasi password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    {{-- <div class="col-lg-12">
                                        <div class="mb-3">
                                            <a href="javascript:void(0);"
                                                class="link-primary text-decoration-underline">Lupa
                                                Password ?</a>
                                        </div>
                                    </div> --}}
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Ubah Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
