@extends('layout.app')
@section('title', 'Jawaban Skala Pasar Produk')
@section('menu', 'Skala Pasar Produk')
@section('submenu')
    <a href="{{ route('detailPenyimpanan.index', ['id' => $idDetail]) }}">Detail Jawaban</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Kuisioner Skala Pasar Produk</h4>
                </div><!-- end card header -->
                <form action="">
                    <div id="step1">
                        <div class="card-body">
                            <div class="col-md-12">
                                <label for="">Bagaimana sistem penjualan produk benih jagung
                                    di kios ini?
                                </label>
                                <textarea name="sales_system" id="BagaimanaSistem" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['sales_system'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa merek benih jagung yang dijual?
                                </label>
                                <textarea name="how_many_brands" id="BerapaMerek" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['how_many_brands'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa sachet dari setiap merek benih jagung
                                    yang dijual?
                                </label>
                                <textarea name="quantity_of_product" id="BerapaSachet" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['quantity_of_product'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Kapan periode setiap merek benih jagung dipasok?
                                </label>
                                <textarea name="supply_period" id="KapanPeriode" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['supply_period'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <div class="d-flex justify-content-sm-end">
                                    <a href="{{ route('detailPenyimpanan.index', ['id' => $idDetail]) }}" style="margin-right: 10px;">
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
                                <label for="">Darimana sajakah asal produsen pemasok benih
                                    jagung yang dijual di
                                    kios ini?
                                </label>
                                <textarea name="producer_locaitons" id="DarimanaSajakah" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['producer_locaitons'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa gram rata-rata berat per sachet benih
                                    jagung?
                                </label>
                                <textarea name="weight_product" id="BerapaGram" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['weight_product'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Berapa harga eceran terendah per sachet dari
                                    setiap benih jagung
                                    yang
                                    dijual?
                                </label>
                                <textarea name="lowest_price" id="BerapaHarga" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['lowest_price'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah saudara mengenal distributor yang
                                    menitipkan produknya?
                                    (Nama &
                                    Alamat)
                                </label>
                                <textarea name="know_distributor" id="ApakahSaudara" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['know_distributor'] }}</textarea>
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
                                <label for="">Apakah distributor merek benih jagung menawarkan
                                    program tertentu
                                    yang terkait dengan bonus penjualan (reward) atau potongan harga
                                    (cost discount)?
                                </label>
                                <textarea name="rewards_or_discount" id="ApakahDistributor" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['rewards_or_discount'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah saudara menerapkan program khusus terkait
                                    sistem penjualan
                                    benih jagung?
                                </label>
                                <textarea name="sales_system_application" id="BenihJagung" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['sales_system_application'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah saudara menerapkan program volume matriks
                                    pada penjualan
                                    benih
                                    jagung? (Bonus sachet)
                                </label>
                                <textarea name="matrix_volume" id="BonusSachet" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['matrix_volume'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Apakah kios ini menerima pasokan benih jagung
                                    hanya pada saat
                                    mendekati musim tanam saja atau jangka waktu tertentu (bulan)?
                                </label>
                                <textarea name="suply_term" id="ApakahKios" cols="30" rows="5" maxlength="1000"
                                    placeholder="Masukan jawaban disini" maxlength="1000" class="form-control">{{ $dataAnswer[0]['suply_term'] }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <div class="d-flex justify-content-sm-end">
                                    <button type="button" class="btn btn-secondary" style="margin-right: 10px;"
                                        onclick="prevStep(2)">Previous</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('otherJs')
    <script>
        let currentStep = 1;

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

        function disableAllTextarea() {
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.disabled = true;
            });
        }

        // Panggil fungsi untuk menonaktifkan semua textarea
        disableAllTextarea();
    </script>
@endsection
