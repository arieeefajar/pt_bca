@extends('layout.app')
@section('title', 'Kuisioner Skala Pasar Produk')
@section('menu', 'Skala Pasar Produk')
@section('submenu', 'Kuisioner')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Kuisioner</h4>
                </div><!-- end card header -->
                <form action="{{ !$dataAnswer ? route('SkalaPasarProduk.create') : '' }}" method="POST" id="myForm">
                    @csrf
                    <div id="step1">
                        <div class="card-body">
                            <div class="col-md-12">
                                <label for="">Bagaimana sistem penjualan produk benih jagung di kios ini?
                                </label>
                                <textarea name="sales_system" id="BagaimanaSistem" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('sales_system') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa merek benih jagung yang dijual?
                                </label>
                                <textarea name="how_many_brands" id="BerapaMerek" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('how_many_brands') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa sachet dari setiap merek benih jagung yang dijual?
                                </label>
                                <textarea name="quantity_of_product" id="BerapaSachet" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('quantity_of_product') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Kapan periode setiap merek benih jagung dipasok?
                                </label>
                                <textarea name="supply_period" id="KapanPeriode" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('supply_period') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
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
                    <div id="step2" style="display: none;">
                        <div class="card-body">
                            <div class="col-md-12">
                                <label for="">Darimana sajakah asal produsen pemasok benih jagung yang dijual di
                                    kios ini?
                                </label>
                                <textarea name="producer_locaitons" id="DarimanaSajakah" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('producer_locaitons') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa gram rata-rata berat per sachet benih jagung?
                                </label>
                                <textarea name="weight_product" id="BerapaGram" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('weight_product') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa harga eceran terendah per sachet dari setiap benih jagung
                                    yang
                                    dijual?
                                </label>
                                <textarea name="lowest_price" id="BerapaHarga" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('lowest_price') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah saudara mengenal distributor yang menitipkan produknya?
                                    (Nama &
                                    Alamat)
                                </label>
                                <textarea name="know_distributor" id="ApakahSaudara" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('know_distributor') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <div class="d-flex justify-content-sm-end">
                                    <button type="button" class="btn btn-secondary" style="margin-right: 10px;"
                                        onclick="prevStep(1)">Previous</button>
                                    <button type="button" class="btn btn-success" id="nextButton1"
                                        onclick="nextStep(2)">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="step3" style="display: none;">
                        <div class="card-body">
                            <div class="col-md-12">
                                <label for="">Apakah distributor merek benih jagung menawarkan program tertentu
                                    yang terkait dengan bonus penjualan (reward) atau potongan harga (cost discount)?
                                </label>
                                <textarea name="rewards_or_discount" id="ApakahDistributor" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('rewards_or_discount') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah saudara menerapkan program khusus terkait sistem penjualan
                                    benih jagung?
                                </label>
                                <textarea name="sales_system_application" id="BenihJagung" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('sales_system_application') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah saudara menerapkan program volume matriks pada penjualan
                                    benih
                                    jagung? (Bonus sachet)
                                </label>
                                <textarea name="matrix_volume" id="BonusSachet" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('matrix_volume') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah kios ini menerima pasokan benih jagung hanya pada saat
                                    mendekati musim tanam saja atau jangka waktu tertentu (bulan)?
                                </label>
                                <textarea name="suply_term" id="ApakahKios" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ old('suply_term') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <div class="d-flex justify-content-sm-end">
                                    <button type="button" class="btn btn-secondary" style="margin-right: 10px;"
                                        onclick="prevStep(2)">Previous</button>
                                    @if (!$dataAnswer)
                                        <button type="button" id="submitButton" onclick="submit_form()"
                                            class="btn btn-success">Submit</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="latitude" id="latitude_field">
                    <input type="hidden" name="longitude" id="longitude_field">
                </form>
            </div>
        </div>
    </div>

    <script>
        @if ($dataAnswer)
            let dataAnswer = @json($dataAnswer);

            for (var key in dataAnswer) {
                if (dataAnswer.hasOwnProperty(key)) {
                    const inputs = document.querySelectorAll(`textarea[name="${key}"]`);
                    for (var i = 0; i < inputs.length; i++) {
                        inputs[i].value = dataAnswer[key];
                        inputs[i].readOnly = true;
                    }
                }
            }
        @endif

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

        const textarea1 = document.getElementById("BagaimanaSistem");
        const textarea2 = document.getElementById("BerapaMerek");
        const textarea3 = document.getElementById("BerapaSachet");
        const textarea4 = document.getElementById("KapanPeriode");
        const textarea5 = document.getElementById("DarimanaSajakah");
        const textarea6 = document.getElementById("BerapaGram");
        const textarea7 = document.getElementById("BerapaHarga");
        const textarea8 = document.getElementById("ApakahSaudara");
        const textarea9 = document.getElementById("ApakahDistributor");
        const textarea10 = document.getElementById("BenihJagung");
        const textarea11 = document.getElementById("BonusSachet");
        const textarea12 = document.getElementById("ApakahKios");
        const nextButton = document.getElementById("nextButton");
        const nextButton1 = document.getElementById("nextButton1");
        const submitButton = document.getElementById("submitButton");

        function toggleNextButton() {
            const isTextarea1Valid = textarea1.value.length > 0;
            const isTextarea2Valid = textarea2.value.length > 0;
            const isTextarea3Valid = textarea3.value.length > 0;
            const isTextarea4Valid = textarea4.value.length > 0;
            const isTextarea5Valid = textarea5.value.length > 0;
            const isTextarea6Valid = textarea6.value.length > 0;
            const isTextarea7Valid = textarea7.value.length > 0;
            const isTextarea8Valid = textarea8.value.length > 0;
            const isTextarea9Valid = textarea9.value.length > 0;
            const isTextarea10Valid = textarea10.value.length > 0;
            const isTextarea11Valid = textarea11.value.length > 0;
            const isTextarea12Valid = textarea12.value.length > 0;

            // Tombol akan aktif jika semua textarea memenuhi validasi
            nextButton.disabled = !(isTextarea1Valid && isTextarea2Valid && isTextarea3Valid && isTextarea4Valid);

            // Tombol akan aktif jika semua textarea memenuhi validasi
            nextButton1.disabled = !(isTextarea5Valid && isTextarea6Valid && isTextarea7Valid && isTextarea8Valid);

            submitButton.disabled = !(isTextarea9Valid && isTextarea10Valid && isTextarea11Valid && isTextarea12Valid);
        }

        textarea1.addEventListener("input", toggleNextButton);
        textarea2.addEventListener("input", toggleNextButton);
        textarea3.addEventListener("input", toggleNextButton);
        textarea4.addEventListener("input", toggleNextButton);
        textarea5.addEventListener("input", toggleNextButton);
        textarea6.addEventListener("input", toggleNextButton);
        textarea7.addEventListener("input", toggleNextButton);
        textarea8.addEventListener("input", toggleNextButton);
        textarea9.addEventListener("input", toggleNextButton);
        textarea10.addEventListener("input", toggleNextButton);
        textarea11.addEventListener("input", toggleNextButton);
        textarea12.addEventListener("input", toggleNextButton);

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
