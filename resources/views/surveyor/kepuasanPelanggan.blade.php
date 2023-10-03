@extends('layout1.app')
@section('title', 'Kuisioner Kepuasan Pelanggan')
@section('menu', 'Kepuasan Pelanggan')
@section('submenu', 'Kuisioner')

@section('content')
    <style>
        @media(max-width:480px) {

            .th_pertanyaan_kk {
                width: 130px;
            }

            td {
                font-size: 12px;
            }
        }
    </style>

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
        <div class="col">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Kuisioner</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="alert alert-warning text-dark" role="alert">
                        <p><b>Keterangan Isian Jawaban Kuisioner :</b></p>
                        <ul>
                            <li>1 (Sangat Tidak Puas)</li>
                            <li>2 (Tidak Puas)</li>
                            <li>3 (Cukup Puas)</li>
                            <li>4 (Puas)</li>
                            <li>5 (Sangat Puas)</li>
                        </ul>
                    </div>
                    <form id="form_body" action="{{ route('kepuasanPelanggan.create') }}" method="POST">
                        @csrf
                        <div class="live-preview">

                            <div class="table-responsive">

                                <table class="table table-bordered align-middle table_nowrap mb-3 ">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                                produk-produk
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="th_pertanyaan_kk">Pertanyaan</th>
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kelengkapan informasi pada kemasan</td>
                                            <td align="center">
                                                <input type="radio" name="information" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="information" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="information" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="information" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="information" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harga Produk dibanding dengan kompetitor</td>
                                            <td align="center">
                                                <input type="radio" name="price_comparison" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="price_comparison" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="price_comparison" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="price_comparison" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="price_comparison" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keunggulan Varietas dibanding kompetitor</td>
                                            <td align="center">
                                                <input type="radio" name="variety_previlege" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="variety_previlege" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="variety_previlege" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="variety_previlege" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="variety_previlege" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tampilan kemasan produk</td>
                                            <td align="center">
                                                <input type="radio" name="packaging_view" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="packaging_view" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="packaging_view" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="packaging_view" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="packaging_view" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kemudahan dalam memperoleh / membeli Produk</td>
                                            <td align="center">
                                                <input type="radio" name="getting_easy" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="getting_easy" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="getting_easy" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="getting_easy" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="getting_easy" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kepuasan memilih produk</td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tampilan gambar pada kemasan produk</td>
                                            <td align="center">
                                                <input type="radio" name="image_view" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="image_view" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="image_view" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="image_view" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="image_view" value="5">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered align-middle table_nowrap mb-3 ">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                                kegiatan promosi produk
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="th_pertanyaan_kk">Pertanyaan</th>
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kecukupan jumlah material promosi</td>
                                            <td align="center">
                                                <input type="radio" name="material_amount" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="material_amount" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="material_amount" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="material_amount" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="material_amount" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kuantitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quantity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quantity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quantity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quantity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quantity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kualitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quality" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quality" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quality" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quality" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="promotion_quality" value="5">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered align-middle table_nowrap mb-3 ">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                                kualitas produk-produk
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="th_pertanyaan_kk">Pertanyaan</th>
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kemurnian fisik benih produk sesuai dengan standart mutu</td>
                                            <td align="center">
                                                <input type="radio" name="seed_purity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="seed_purity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="seed_purity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="seed_purity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="seed_purity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vigor benih produk pada saat dipersemaian</td>
                                            <td align="center">
                                                <input type="radio" name="vigor" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="vigor" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="vigor" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="vigor" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="vigor" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Daya tumbuh benih produk, sesuai dengan standart mutu</td>
                                            <td align="center">
                                                <input type="radio" name="growing_power" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="growing_power" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="growing_power" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="growing_power" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="growing_power" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kemurnian genetik sesuai dengan standart mutu</td>
                                            <td align="center">
                                                <input type="radio" name="genetic_purity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="genetic_purity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="genetic_purity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="genetic_purity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="genetic_purity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ketahanan hama dan penyakit produk</td>
                                            <td align="center">
                                                <input type="radio" name="pest_resistance" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pest_resistance" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pest_resistance" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pest_resistance" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="pest_resistance" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kesesuaian gambar produk dengan hasil panen</td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_image_result" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_image_result" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_image_result" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_image_result" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_image_result" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kesesuaian hasil panen terhadap permintaan pasar</td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_result_request" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_result_request" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_result_request" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_result_request" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="suitablelity_result_request" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kepuasan hasil panen produk</td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction_result" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction_result" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction_result" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction_result" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="satisfaction_result" value="5">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered align-middle table_nowrap mb-3 ">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                                layanan petugas lapangan
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="th_pertanyaan_kk">Pertanyaan</th>
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kemampuan teknis budidaya petugas lapang</td>
                                            <td align="center">
                                                <input type="radio" name="technical_ability" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="technical_ability" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="technical_ability" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="technical_ability" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="technical_ability" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Intensitas kunjungan petugas lapang</td>
                                            <td align="center">
                                                <input type="radio" name="visit_intensity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="visit_intensity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="visit_intensity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="visit_intensity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="visit_intensity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Intensitas interaksi dan komunikasi petugas lapang</td>
                                            <td align="center">
                                                <input type="radio" name="communication_intensity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="communication_intensity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="communication_intensity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="communication_intensity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="communication_intensity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kecakapan dan kredibilitas (dapat dipercaya) petugas lapang</td>
                                            <td align="center">
                                                <input type="radio" name="skill_credibility" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="skill_credibility" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="skill_credibility" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="skill_credibility" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="skill_credibility" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pengaruh keberadaan petugas lapang</td>
                                            <td align="center">
                                                <input type="radio" name="influence_of_officer" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="influence_of_officer" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="influence_of_officer" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="influence_of_officer" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="influence_of_officer" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kemampuan teknis komunikasi petugas lapang</td>
                                            <td align="center">
                                                <input type="radio" name="communication_skill" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="communication_skill" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="communication_skill" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="communication_skill" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="communication_skill" value="5">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered align-middle table_nowrap mb-3 ">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                                penanganan komplain pelanggan
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="th_pertanyaan_kk">Pertanyaan</th>
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kecepatan verifikasi komplain pelanggan</td>
                                            <td align="center">
                                                <input type="radio" name="verification_speed" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="verification_speed" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="verification_speed" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="verification_speed" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="verification_speed" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kecepatan penyelesaian komplain pelanggan</td>
                                            <td align="center">
                                                <input type="radio" name="completion_speed" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="completion_speed" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="completion_speed" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="completion_speed" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="completion_speed" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Penanganan komplain pelanggan</td>
                                            <td align="center">
                                                <input type="radio" name="handling" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="handling" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="handling" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="handling" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="handling" value="5">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <input type="hidden" name="latitude" id="latitude_field">
                                <input type="hidden" name="longitude" id="longitude_field">

                                <div class="row g-4 mb-3">
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <a href="{{ route('menu.index') }}" style="margin-right: 10px;">
                                                <button type="button" class="btn btn-primary add-btn">Kembali</button>
                                            </a>
                                            <button type="button" onclick="submit_form()"
                                                class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end responsive -->
                    </form>
                </div><!-- end card-body -->
            </div>
        </div>
    </div>

    <script>
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
                // const coords = await getLocation();
                // document.getElementById("latitude_field").value = coords.latitude;
                // document.getElementById("longitude_field").value = coords.longitude;

                // Pastikan elemen dengan ID form_body adalah elemen <form> yang benar
                const form = document.getElementById("form_body");
                if (form) {
                    await form.submit();
                } else {
                    console.log("Form element not found.");
                }
            } catch (error) {
                console.log("Error:", error);
            }
        }
    </script>
@endsection
