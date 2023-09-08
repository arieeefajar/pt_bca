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
        <col-xxl-6>
            <div class="card">
                <div class="card-body">
                    <div id="formContainer">
                        <form action="{{ route('formPesaing.create') }}" method="POST" id="myForm">
                            @csrf
                            <div id="step1">
                                <div class="card-header">
                                    <div class="progres-bar" role="progressbar">
                                        <h4 class="card-title mb-0">Karakteristik Varietas</h4>
                                    </div>
                                </div><!-- end card header -->
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="mb-3"><label class="form-label">Produk Kami :</label>
                                            <select class="form-select mb-3" required name="produk_kita" id="produkSelect"
                                                onchange="updateSelectedDeskripsi()">
                                                <option value="" selected disabled>Pilih Produk</option>
                                                @foreach ($dataProduk as $value)
                                                    <option value="{{ $value->nama_produk }}"
                                                        data-deskripsi="{{ $value->nama_produk }}">
                                                        {{ $value->nama_produk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <textarea class="form-control" placeholder="Masukan minimal 10 karakter" required name="deskripsi_produk"
                                                id="deskripsiProdukKita" cols="30" minlength="10" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Produk Pesaing</label>
                                            <input type="text" name="produk_pesaing" id="produkPesaing"
                                                class="form-control" required placeholder="Masukan nama produk pesaing">
                                        </div>
                                        <textarea class="form-control" name="deskripsi_produk_pesaing" id="deskripsiProdukPesaing"
                                            placeholder="Masukan minimal 10 karakter" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-primary" id="nextButton"
                                        onclick="nextStep(1)">Next</button>
                                </div>
                            </div>

                            <div id="step2" style="display: none;">
                                <div class="card-header">
                                    <div class="progres-bar" role="progressbar">
                                        <h4 class="card-title mb-0">Keunggulan Kompetitif</h4>
                                    </div>
                                </div><!-- end card header -->

                                <div class="row mt-3">
                                    <div class="content col">
                                        <label class="form-label">Apa saja keunggulan pesaing :</label>
                                        <textarea class="form-control" placeholder="Masukan minimal 10 karakter" name="keunggulan_pesaing"
                                            id="keunggulanPesaing" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Previous</button>
                                    <button type="button" class="btn btn-primary" id="nextButton1"
                                        onclick="nextStep(2)">Next</button>
                                </div>
                            </div>

                            <div id="step3" style="display: none;">
                                <div class="card-header">
                                    <div class="progres-bar" role="progressbar">
                                        <h4 class="card-title mb-0">Aktivitas Pemasaran Pesaing</h4>
                                    </div>
                                </div><!-- end card header -->

                                <div class="row mt-3">
                                    <div class="content col">
                                        <label class="form-label">Apa saja aktivitas pemasaran pesaing :</label>
                                        <textarea class="form-control" name="pemasaran_pesaing" id="pemasaranPesaing" placeholder="Masukan minimal 10 karakter"
                                            cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Previous</button>
                                    <button type="button" onclick="submit_form()" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                            <input type="hidden" name="latitude" id="latitude_field">
                            <input type="hidden" name="longitude" id="longitude_field">
                        </form>
                    </div>
                </div>
            </div>
        </col-xxl-6>
    </div>

    <script>
        const produkSelect = document.getElementById('produkSelect');

        function updateSelectedDeskripsi() {
            var selectedOption = produkSelect.options[produkSelect.selectedIndex];
            var deskripsiProduk = selectedOption.getAttribute('data-deskripsi');

            console.log(deskripsiProduk);

            // selectedDeskripsiProduk.textContent = "Deskripsi Produk: " + deskripsiProduk;
        }

        // function getGeoLocation() {
        //     const successCallback = (position) => {
        //         console.log(position);
        //     };

        //     const errorCallback = (error) => {
        //         console.log(error);
        //     };

        //     navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        // }

        function getLocation() {
            return new Promise((resolve, reject) => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        position => resolve(position.coords),
                        error => reject(error)
                    );
                } else {
                    reject("Geolocation is not supported by this browser.");
                }
            });
        }

        async function submit_form() {
            try {
                const coords = await getLocation();
                document.getElementById("latitude_field").value = coords.latitude;
                document.getElementById("longitude_field").value = coords.longitude;

                var form = document.getElementById('myForm');
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
        // const textarea6 = document.getElementById("pemasaran");
        const nextButton = document.getElementById("nextButton");

        // Fungsi untuk mengatur status tombol "Next"
        function toggleNextButton() {

            // Validasi untuk set pertama input
            const isSet1Valid = !(textarea1.validity.valueMissing || textarea2.validity.valueMissing ||
                textarea3.validity.valueMissing || textarea4.validity.valueMissing);

            // Validasi untuk set kedua input
            const isSet2Valid = !textarea5.validity.valueMissing && textarea5.value.length >= 10;

            // Validasi tambahan untuk memeriksa panjang teks textarea1, textarea3, dan textarea4
            const isSet1LengthValid = textarea2.value.length >= 10 &&
                textarea4.value.length >= 10;

            // Aktifkan atau nonaktifkan tombol "Next" berdasarkan validasi set pertama
            nextButton.disabled = !(isSet1Valid && isSet1LengthValid);

            // Aktifkan atau nonaktifkan tombol "NextButton1" berdasarkan validasi set kedua
            nextButton1.disabled = !isSet2Valid;

        }

        // Panggil fungsi saat textarea diubah
        textarea1.addEventListener("input", toggleNextButton);
        textarea2.addEventListener("input", toggleNextButton);
        textarea3.addEventListener("input", toggleNextButton);
        textarea4.addEventListener("input", toggleNextButton);
        textarea5.addEventListener("input", toggleNextButton);

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
