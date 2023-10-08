@extends('layout1.app')
@section('title', 'Form Potensi Lahan')
@section('menu', 'Potensi Lahan')
@section('submenu', 'Form Survey')

@section('content')

    {{-- <style>
        .btn-blue {
            background-color: blue !important;
            color: white !important;
        }
    </style> --}}

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
                    <form action="{{ route('formPotensiLahan.create') }}" method="POST" id="myForm">
                        @csrf
                        <div id="step1">
                            <div class="card-header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="perbandingan-tab" data-bs-toggle="tab"
                                            href="#perbandingan-produk" role="tab" aria-selected="true">
                                            Karakteristik Varietas
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="keunggulan-tab" data-bs-toggle="tab"
                                            href="#keunggulan-kompetitif" role="tab" aria-selected="false">
                                            Musim Tanam
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="content col">
                                    <label class="form-label">Standar Keunggulan Umum</label>
                                    <textarea class="form-control" maxlength="1000" placeholder="Masukan minimal 10 karakter" name="keunggulan_umum"
                                        id="keunggulan_umum" cols="30" rows="5" required>{{ old('keunggulan_umum') }}</textarea>
                                </div>
                                <div class="content col mt-3">
                                    <label class="form-label">Keunggulan Produk Kita</label>
                                    <textarea class="form-control" maxlength="1000" placeholder="Masukan minimal 10 karakter" name="keunggulan_produk"
                                        id="keunggulan_produk" cols="30" rows="5" required>{{ old('keunggulan_produk') }}</textarea>
                                </div>
                                <div class="content col mt-3">
                                    <label class="form-label">Keunggulan Kompetitor</label>
                                    <textarea class="form-control" maxlength="1000" placeholder="Masukan minimal 10 karakter" name="keunggulan_kompetitor"
                                        id="keunggulan_kompetitor" cols="30" rows="5" required>{{ old('keunggulan_kompetitor') }}</textarea>
                                </div>
                                <div class="row g-4 mt-3">
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
                                        <a class="nav-link disabled" id="perbandingan-tab" data-bs-toggle="tab"
                                            href="#perbandingan-produk" role="tab" aria-selected="true">
                                            Karakteristik Varietas
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="keunggulan-tab" data-bs-toggle="tab"
                                            href="#keunggulan-kompetitif" role="tab" aria-selected="false">
                                            Musim Tanam
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="content col">
                                        <label class="form-label">Iklim</label>
                                        <textarea class="form-control" maxlength="1000" placeholder="Masukan minimal 10 karakter" name="iklim" id="iklim"
                                            cols="30" rows="5" required>{{ old('iklim') }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="content col">
                                        <label class="form-label">Event pasar atau perayaan</label>
                                        <textarea class="form-control" maxlength="1000" placeholder="Masukan minimal 10 karakter" name="event"
                                            id="event" cols="30" rows="5" required>{{ old('event') }}</textarea>
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
                        <form action="{{ route('formPotensiLahan.create') }}" method="POST" id="myForm">
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
            // alert('aowkoakwokwa');
            try {
                // const coords = await getLocation();
                // document.getElementById("latitude_field").value = coords.latitude;
                // document.getElementById("longitude_field").value = coords.longitude;

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

        function setProgress(value) {
            const progressBar = document.querySelector(".progress-bar");
            progressBar.style.width = value + "%";
            progressBar.setAttribute("aria-valuenow", value);

            // Mengubah warna tombol sesuai dengan progres
            const buttons = document.querySelectorAll(".btn-ku");
            const buttonsLength = buttons.length;
            for (let i = 0; i < buttonsLength; i++) {
                if (i * 50 < value) {
                    buttons[i].classList.remove("btn-light");
                    buttons[i].classList.add("btn-primary");
                } else if (i * 50 === value) {
                    buttons[i].classList.remove("btn-primary");
                    buttons[i].classList.add("btn-light");
                } else {
                    buttons[i].classList.remove("btn-primary");
                    buttons[i].classList.remove("btn-light");
                }
            }
        }

        const textarea1 = document.getElementById("keunggulan_umum");
        const textarea2 = document.getElementById("keunggulan_produk");
        const textarea3 = document.getElementById("keunggulan_kompetitor");
        const textarea4 = document.getElementById("iklim");
        const textarea5 = document.getElementById("event");
        const nextButton = document.getElementById("nextButton");
        const submitButton = document.getElementById("submitButton");

        // Fungsi untuk mengatur status tombol "Next"
        function toggleNextButton() {

            // Validasi untuk set pertama input
            const isSet1Valid = !(textarea1.validity.valueMissing || textarea2.validity.valueMissing || textarea3
                .validity.valueMissing);

            const isSet2Valid = !(textarea4.validity.valueMissing || textarea5.validity.valueMissing);

            // Validasi panjang teks untuk textarea1, textarea2, dan textarea3
            const isSet1LengthValid = textarea1.value.length >= 10 &&
                textarea2.value.length >= 10 &&
                textarea3.value.length >= 10;

            const isSet2LengthValid = textarea4.value.length >= 10 && textarea5.value.length >= 10;

            // Aktifkan atau nonaktifkan tombol "Next" berdasarkan validasi set pertama
            nextButton.disabled = !(isSet1Valid && isSet1LengthValid);
            submitButton.disabled = !(isSet2Valid && isSet2LengthValid);
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
                setProgress(50);
            } else if (step === 2) {
                document.getElementById("step2").style.display = "none";
                document.getElementById("step3").style.display = "block";
                currentStep = 3;
                setProgress(100);
            }
        }

        function prevStep(step) {
            if (step === 1) {
                document.getElementById("step2").style.display = "none";
                document.getElementById("step1").style.display = "block";
                currentStep = 1;
                setProgress(0);
            } else if (step === 2) {
                document.getElementById("step2").style.display = "none";
                document.getElementById("step1").style.display = "block";
                currentStep = 1;
                setProgress(0);
            } else if (step === 3) {
                document.getElementById("step3").style.display = "none";
                document.getElementById("step2").style.display = "block";
                currentStep = 2;
                setProgress(50);
            }
        }
    </script>
@endsection
