@extends('layout1.app')
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
                <div id="step1">
                    <div class="card-body">
                        <form action="">
                            <div class="col-md-12">
                                <label for="">Bagaimana sistem penjualan produk benih jagung di kios ini?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa merek benih jagung yang dijual?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa sachet dari setiap merek benih jagung yang dijual?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Kapan periode setiap merek benih jagung dipasok?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            {{-- <div class="col-md-12 mt-3">
                                <label for="">Darimana sajakah asal produsen pemasok benih jagung yang dijual di
                                    kios ini?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div> --}}
                            <div class="col-md-12 mt-3 mb-3">
                                <div class="d-flex justify-content-sm-end">
                                    <a href="{{ route('menu.index') }}" style="margin-right: 10px;">
                                        <button type="button" class="btn btn-primary add-btn">Kembali</button>
                                    </a>
                                    <button type="button" class="btn btn-success" id="nextButton"
                                        onclick="nextStep(1)">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="step2" style="display: none;">
                    <div class="card-body">
                        <form action="">
                            <div class="col-md-12">
                                <label for="">Darimana sajakah asal produsen pemasok benih jagung yang dijual di
                                    kios ini?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa gram rata-rata berat per sachet benih jagung?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa harga eceran terendah per sachet dari setiap benih jagung yang
                                    dijual?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah saudara mengenal distributor yang menitipkan produknya? (Nama &
                                    Alamat)
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <div class="d-flex justify-content-sm-end">
                                    <button type="button" class="btn btn-secondary" style="margin-right: 10px;"
                                        onclick="prevStep(1)">Previous</button>
                                    <button type="button" class="btn btn-success" id="nextButton1"
                                        onclick="nextStep(2)">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="step3" style="display: none;">
                    <div class="card-body">
                        <form action="">
                            <div class="col-md-12">
                                <label for="">Apakah distributor merek benih jagung menawarkan program tertentu
                                    yang terkait dengan bonus penjualan (reward) atau potongan harga (cost discount)?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah saudara menerapkan program khusus terkait sistem penjualan
                                    benih jagung?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah saudara menerapkan program volume matriks pada penjualan benih
                                    jagung? (Bonus sachet)
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah kios ini menerima pasokan benih jagung hanya pada saat
                                    mendekati musim tanam saja atau jangka waktu tertentu (bulan)?
                                </label>
                                <textarea name="" id="" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan minimal 10 karakter" maxlength="1000" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <div class="d-flex justify-content-sm-end">
                                    <button type="button" class="btn btn-secondary" style="margin-right: 10px;"
                                        onclick="prevStep(2)">Previous</button>
                                    <button type="button" id="submitButton" onclick="submit_form()"
                                        class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
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
