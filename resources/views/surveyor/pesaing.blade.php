@extends('layout1.app')
@section('title', 'Form Pesaing')
@section('menu', 'Pesaing')
@section('submenu', 'Menu')

@section('content')

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Error",
                    text: "{{ $errors->all()[0] }}",
                    icon: "error",
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    buttonsStyling: false,
                    showCloseButton: true
                });
            });
        </script>
    @endif

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div id="formContainer">
                    <form action="{{ route('formPesaing.create') }}" method="POST" id="myFormPesaing">
                        @csrf
                        <div id="step1">
                            <div class="card-header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-selected="true">
                                            Perbandingan Produk
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="keunggulan-tab" data-bs-toggle="tab"
                                            href="#keunggulan-kompetitif" role="tab" aria-selected="false">
                                            Keunggulan Kompetitif
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="aktivitas-tab" data-bs-toggle="tab"
                                            href="#aktivitas-pemasaran-pesaing" role="tab" aria-selected="false">
                                            Aktivitas Pemasaran Pesaing
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3"><label class="form-label">Produk Kami :</label>
                                            <select class="form-select mb-3" required name="produk_kita" id="produkSelect"
                                                onchange="updateSelectedDeskripsi()">
                                                <option value="" selected disabled>Pilih Produk</option>
                                                @foreach ($dataProduk as $value)
                                                    <option
                                                        {{ old('produk_kita') == $value->nama_produk ? 'selected' : '' }}
                                                        value="{{ $value->id }}"
                                                        data-deskripsi="{{ $value->nama_produk }}">
                                                        {{ $value->nama_produk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <textarea class="form-control" maxlength="1000" placeholder="Masukan minimal 10 karakter" required
                                                name="deskripsi_produk" id="deskripsiProdukKita" cols="30" minlength="10" rows="5">{{ old('deskripsi_produk') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Produk Pesaing</label>
                                            <input type="text" name="produk_pesaing" id="produkPesaing"
                                                class="form-control" value="{{ old('produk_pesaing') }}" required
                                                placeholder="Masukan nama produk pesaing">
                                        </div>
                                        <textarea class="form-control" maxlength="1000" name="deskripsi_produk_pesaing" id="deskripsiProdukPesaing"
                                            placeholder="Masukan minimal 10 karakter" cols="30" rows="5" required>{{ old('deskripsi_produk_pesaing') }}</textarea>
                                    </div>
                                </div>
                                <div class="row g-4 mt-3 mb-3">
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <a href="{{ route('menu.index') }}" style="margin-right: 10px;">
                                                <button type="button" class="btn btn-primary add-btn">Kembali</button>
                                            </a>
                                            <button type="button" class="btn btn-success" id="nextButton"
                                                onclick="nextStep(1)">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="step2" style="display: none;">
                            <div class="card-header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link disabled" data-bs-toggle="tab" role="tab"
                                            aria-selected="true">
                                            Perbandingan Produk
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="keunggulan-tab" data-bs-toggle="tab"
                                            href="#keunggulan-kompetitif" role="tab" aria-selected="false">
                                            Keunggulan Kompetitif
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="aktivitas-tab" data-bs-toggle="tab"
                                            href="#aktivitas-pemasaran-pesaing" role="tab" aria-selected="false">
                                            Aktivitas Pemasaran Pesaing
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="content col">
                                        <label class="form-label">Apa saja keunggulan pesaing :</label>
                                        <textarea class="form-control" maxlength="1000" placeholder="Masukan minimal 10 karakter" name="keunggulan_pesaing"
                                            id="keunggulanPesaing" cols="30" rows="5" required>{{ old('keunggulan_pesaing') }}</textarea>
                                    </div>
                                </div>
                                <div class="row g-4 mt-3">
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <button type="button" class="btn btn-secondary" style="margin-right: 10px;"
                                                onclick="prevStep(1)">Previous</button>
                                            <button type="button" class="btn btn-success" id="nextButton1"
                                                onclick="nextStep(2)">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="step3" style="display: none;">
                            <div class="card-header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link disabled" data-bs-toggle="tab" role="tab"
                                            aria-selected="true">
                                            Perbandingan Produk
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="keunggulan-tab" data-bs-toggle="tab"
                                            href="#keunggulan-kompetitif" role="tab" aria-selected="false">
                                            Keunggulan Kompetitif
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="aktivitas-tab" data-bs-toggle="tab"
                                            href="#aktivitas-pemasaran-pesaing" role="tab" aria-selected="false">
                                            Aktivitas Pemasaran Pesaing
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="content col">
                                        <label class="form-label">Apa saja aktivitas pemasaran pesaing :</label>
                                        <textarea class="form-control" maxlength="1000" name="pemasaran_pesaing" id="pemasaranPesaing"
                                            placeholder="Masukan minimal 10 karakter" cols="30" rows="5" required>{{ old('pemasaran_pesaing') }}</textarea>
                                    </div>
                                </div>
                                <div class="row g-4 mt-3">
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <button type="button" class="btn btn-secondary" style="margin-right: 10px;"
                                                onclick="prevStep(2)">Previous</button>
                                            <button type="button" id="submitButton" onclick="submit_form()"
                                                class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="latitude" id="latitude_field">
                        <input type="hidden" name="longitude" id="longitude_field">
                    </form>
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-body">
                    <div id="formContainer">
                        <form action="{{ route('formPesaing.create') }}" method="POST" id="myFormPesaing">
                            @csrf
                            <input type="hidden" name="latitude" id="latitude_field">
                            <input type="hidden" name="longitude" id="longitude_field">
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <script>
        const produkSelect = document.getElementById('produkSelect');

        function updateSelectedDeskripsi() {
            // var selectedOption = produkSelect.options[produkSelect.selectedIndex];
            // var deskripsiProduk = selectedOption.getAttribute('data-deskripsi');

            // console.log(deskripsiProduk);

            // selectedDeskripsiProduk.textContent = "Deskripsi Produk: " + deskripsiProduk;
        }

        // function getLocation() {
        //     return new Promise((resolve, reject) => {
        //         if (navigator.geolocation) {
        //             navigator.geolocation.getCurrentPosition(
        //                 position => resolve(position.coords),
        //                 error => reject(error)
        //             );
        //         } else {
        //             reject("Geolocation is not supported by this browser.");
        //         }
        //     });
        // }

        async function submit_form() {
            // alert('wokdowakodkawodkoaw')
            try {
                // const coords = await getLocation();
                // document.getElementById("latitude_field").value = coords.latitude;
                // document.getElementById("longitude_field").value = coords.longitude;

                var form = document.getElementById('myFormPesaing');
                var inputs = form.querySelectorAll('input, select, textarea');
                var isValid = true;

                inputs.forEach(function(input) {
                    if (input.required && input.value.trim() === '') {
                        isValid = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (form) {
                    if (isValid) {
                        await form.submit();
                    }
                } else {
                    console.log("Form element not found.");
                }
            } catch (error) {
                console.log("Error:", error);
            }
        };

        let currentStep = 1;

        const textarea1 = document.getElementById("produkSelect");
        const textarea2 = document.getElementById("deskripsiProdukKita");
        const textarea3 = document.getElementById("produkPesaing");
        const textarea4 = document.getElementById("deskripsiProdukPesaing");
        const textarea5 = document.getElementById("keunggulanPesaing");
        const textarea6 = document.getElementById("pemasaranPesaing");
        const nextButton = document.getElementById("nextButton");

        // Fungsi untuk mengatur status tombol "Next"
        function toggleNextButton() {

            // Validasi untuk set pertama input
            const isSet1Valid = !(textarea1.validity.valueMissing || textarea2.validity.valueMissing ||
                textarea3.validity.valueMissing || textarea4.validity.valueMissing);

            // Validasi untuk set kedua input
            const isSet2Valid = !textarea5.validity.valueMissing && textarea5.value.length >= 10;
            const isSet3Valid = !textarea6.validity.valueMissing && textarea6.value.length >= 10;

            // Validasi tambahan untuk memeriksa panjang teks textarea1, textarea3, dan textarea4
            const isSet1LengthValid = textarea2.value.length >= 10 &&
                textarea4.value.length >= 10;

            // Aktifkan atau nonaktifkan tombol "Next" berdasarkan validasi set pertama
            nextButton.disabled = !(isSet1Valid && isSet1LengthValid);

            // Aktifkan atau nonaktifkan tombol "NextButton1" berdasarkan validasi set kedua
            nextButton1.disabled = !isSet2Valid;

            submitButton.disabled = !isSet3Valid;

        }

        // Panggil fungsi saat textarea diubah
        textarea1.addEventListener("input", toggleNextButton);
        textarea2.addEventListener("input", toggleNextButton);
        textarea3.addEventListener("input", toggleNextButton);
        textarea4.addEventListener("input", toggleNextButton);
        textarea5.addEventListener("input", toggleNextButton);
        textarea6.addEventListener("input", toggleNextButton);

        // Panggil fungsi saat halaman dimuat untuk mengatur status awal
        toggleNextButton();

        function nextStep(step) {
            if (step === 1) {
                document.getElementById("step1").style.display = "none";
                document.getElementById("step2").style.display = "block";
                currentStep = 2;
            } else if (step === 2) {
                document.getElementById("step2").style.display = "none";
                document.getElementById("step3").style.display = "block";
                currentStep = 3;
            }
        }

        function prevStep(step) {
            if (step === 1) {
                document.getElementById("step2").style.display = "none";
                document.getElementById("step3").style.display = "none";
                document.getElementById("step1").style.display = "block";
                currentStep = 1;
            } else if (step === 2) {
                document.getElementById("step2").style.display = "block";
                document.getElementById("step1").style.display = "none";
                document.getElementById("step3").style.display = "none";
                currentStep = 2;
            } else if (step === 3) {
                document.getElementById("step3").style.display = "block";
                document.getElementById("step2").style.display = "none";
                document.getElementById("step1").style.display = "none";
                currentStep = 3;
            }
        }
    </script>
@endsection
