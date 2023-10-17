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
                    <form id="form_body" name="form_body" action="{{ !$dataAnswer ? route('kepuasanPelanggan.create') : '' }}"
                        method="POST">
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
                                                <input type="radio" {{ old('information') == '1' ? 'checked' : '' }}
                                                    name="information" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('information') == '2' ? 'checked' : '' }}
                                                    name="information" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('information') == '3' ? 'checked' : '' }}
                                                    name="information" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('information') == '4' ? 'checked' : '' }}
                                                    name="information" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('information') == '5' ? 'checked' : '' }}
                                                    name="information" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harga Produk dibanding dengan kompetitor</td>
                                            <td align="center">
                                                <input type="radio" {{ old('price_comparison') == '1' ? 'checked' : '' }}
                                                    name="price_comparison" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('price_comparison') == '2' ? 'checked' : '' }}
                                                    name="price_comparison" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('price_comparison') == '3' ? 'checked' : '' }}
                                                    name="price_comparison" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('price_comparison') == '4' ? 'checked' : '' }}
                                                    name="price_comparison" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('price_comparison') == '5' ? 'checked' : '' }}
                                                    name="price_comparison" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keunggulan Varietas dibanding kompetitor</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('variety_previlege') == '1' ? 'checked' : '' }}
                                                    name="variety_previlege" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('variety_previlege') == '2' ? 'checked' : '' }}
                                                    name="variety_previlege" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('variety_previlege') == '3' ? 'checked' : '' }}
                                                    name="variety_previlege" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('variety_previlege') == '4' ? 'checked' : '' }}
                                                    name="variety_previlege" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('variety_previlege') == '5' ? 'checked' : '' }}
                                                    name="variety_previlege" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tampilan kemasan produk</td>
                                            <td align="center">
                                                <input type="radio" {{ old('packaging_view') == '1' ? 'checked' : '' }}
                                                    name="packaging_view" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('packaging_view') == '2' ? 'checked' : '' }}
                                                    name="packaging_view" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('packaging_view') == '3' ? 'checked' : '' }}
                                                    name="packaging_view" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('packaging_view') == '4' ? 'checked' : '' }}
                                                    name="packaging_view" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('packaging_view') == '5' ? 'checked' : '' }}
                                                    name="packaging_view" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kemudahan dalam memperoleh / membeli Produk</td>
                                            <td align="center">
                                                <input type="radio" {{ old('getting_easy') == '1' ? 'checked' : '' }}
                                                    name="getting_easy" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('getting_easy') == '2' ? 'checked' : '' }}
                                                    name="getting_easy" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('getting_easy') == '3' ? 'checked' : '' }}
                                                    name="getting_easy" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('getting_easy') == '4' ? 'checked' : '' }}
                                                    name="getting_easy" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('getting_easy') == '5' ? 'checked' : '' }}
                                                    name="getting_easy" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kepuasan memilih produk</td>
                                            <td align="center">
                                                <input type="radio" {{ old('satisfaction') == '1' ? 'checked' : '' }}
                                                    name="satisfaction" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('satisfaction') == '2' ? 'checked' : '' }}
                                                    name="satisfaction" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('satisfaction') == '3' ? 'checked' : '' }}
                                                    name="satisfaction" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('satisfaction') == '4' ? 'checked' : '' }}
                                                    name="satisfaction" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('satisfaction') == '5' ? 'checked' : '' }}
                                                    name="satisfaction" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tampilan gambar pada kemasan produk</td>
                                            <td align="center">
                                                <input type="radio" {{ old('image_view') == '1' ? 'checked' : '' }}
                                                    name="image_view" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('image_view') == '2' ? 'checked' : '' }}
                                                    name="image_view" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('image_view') == '3' ? 'checked' : '' }}
                                                    name="image_view" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('image_view') == '4' ? 'checked' : '' }}
                                                    name="image_view" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('image_view') == '5' ? 'checked' : '' }}
                                                    name="image_view" value="5">
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
                                                <input type="radio" {{ old('material_amount') == '1' ? 'checked' : '' }}
                                                    name="material_amount" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('material_amount') == '2' ? 'checked' : '' }}
                                                    name="material_amount" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('material_amount') == '3' ? 'checked' : '' }}
                                                    name="material_amount" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('material_amount') == '4' ? 'checked' : '' }}
                                                    name="material_amount" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('material_amount') == '5' ? 'checked' : '' }}
                                                    name="material_amount" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kuantitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quantity') == '1' ? 'checked' : '' }}
                                                    name="promotion_quantity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quantity') == '2' ? 'checked' : '' }}
                                                    name="promotion_quantity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quantity') == '3' ? 'checked' : '' }}
                                                    name="promotion_quantity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quantity') == '4' ? 'checked' : '' }}
                                                    name="promotion_quantity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quantity') == '5' ? 'checked' : '' }}
                                                    name="promotion_quantity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kualitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quality') == '1' ? 'checked' : '' }}
                                                    name="promotion_quality" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quality') == '2' ? 'checked' : '' }}
                                                    name="promotion_quality" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quality') == '3' ? 'checked' : '' }}
                                                    name="promotion_quality" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quality') == '4' ? 'checked' : '' }}
                                                    name="promotion_quality" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('promotion_quality') == '5' ? 'checked' : '' }}
                                                    name="promotion_quality" value="5">
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
                                                <input type="radio" {{ old('seed_purity') == '1' ? 'checked' : '' }}
                                                    name="seed_purity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('seed_purity') == '2' ? 'checked' : '' }}
                                                    name="seed_purity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('seed_purity') == '3' ? 'checked' : '' }}
                                                    name="seed_purity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('seed_purity') == '4' ? 'checked' : '' }}
                                                    name="seed_purity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('seed_purity') == '5' ? 'checked' : '' }}
                                                    name="seed_purity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vigor benih produk pada saat dipersemaian</td>
                                            <td align="center">
                                                <input type="radio" {{ old('vigor') == '1' ? 'checked' : '' }}
                                                    name="vigor" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('vigor') == '2' ? 'checked' : '' }}
                                                    name="vigor" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('vigor') == '3' ? 'checked' : '' }}
                                                    name="vigor" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('vigor') == '4' ? 'checked' : '' }}
                                                    name="vigor" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('vigor') == '5' ? 'checked' : '' }}
                                                    name="vigor" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Daya tumbuh benih produk, sesuai dengan standart mutu</td>
                                            <td align="center">
                                                <input type="radio" {{ old('growing_power') == '1' ? 'checked' : '' }}
                                                    name="growing_power" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('growing_power') == '2' ? 'checked' : '' }}
                                                    name="growing_power" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('growing_power') == '3' ? 'checked' : '' }}
                                                    name="growing_power" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('growing_power') == '4' ? 'checked' : '' }}
                                                    name="growing_power" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('growing_power') == '5' ? 'checked' : '' }}
                                                    name="growing_power" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kemurnian genetik sesuai dengan standart mutu</td>
                                            <td align="center">
                                                <input type="radio" {{ old('genetic_purity') == '1' ? 'checked' : '' }}
                                                    name="genetic_purity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('genetic_purity') == '2' ? 'checked' : '' }}
                                                    name="genetic_purity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('genetic_purity') == '3' ? 'checked' : '' }}
                                                    name="genetic_purity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('genetic_purity') == '4' ? 'checked' : '' }}
                                                    name="genetic_purity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('genetic_purity') == '5' ? 'checked' : '' }}
                                                    name="genetic_purity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ketahanan hama dan penyakit produk</td>
                                            <td align="center">
                                                <input type="radio" {{ old('pest_resistance') == '1' ? 'checked' : '' }}
                                                    name="pest_resistance" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('pest_resistance') == '2' ? 'checked' : '' }}
                                                    name="pest_resistance" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('pest_resistance') == '3' ? 'checked' : '' }}
                                                    name="pest_resistance" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('pest_resistance') == '4' ? 'checked' : '' }}
                                                    name="pest_resistance" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('pest_resistance') == '5' ? 'checked' : '' }}
                                                    name="pest_resistance" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kesesuaian gambar produk dengan hasil panen</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_image_result') == '1' ? 'checked' : '' }}
                                                    name="suitablelity_image_result" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_image_result') == '2' ? 'checked' : '' }}
                                                    name="suitablelity_image_result" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_image_result') == '3' ? 'checked' : '' }}
                                                    name="suitablelity_image_result" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_image_result') == '4' ? 'checked' : '' }}
                                                    name="suitablelity_image_result" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_image_result') == '5' ? 'checked' : '' }}
                                                    name="suitablelity_image_result" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kesesuaian hasil panen terhadap permintaan pasar</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_result_request') == '1' ? 'checked' : '' }}
                                                    name="suitablelity_result_request" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_result_request') == '2' ? 'checked' : '' }}
                                                    name="suitablelity_result_request" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_result_request') == '3' ? 'checked' : '' }}
                                                    name="suitablelity_result_request" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_result_request') == '4' ? 'checked' : '' }}
                                                    name="suitablelity_result_request" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('suitablelity_result_request') == '5' ? 'checked' : '' }}
                                                    name="suitablelity_result_request" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kepuasan hasil panen produk</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('satisfaction_result') == '1' ? 'checked' : '' }}
                                                    name="satisfaction_result" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('satisfaction_result') == '2' ? 'checked' : '' }}
                                                    name="satisfaction_result" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('satisfaction_result') == '3' ? 'checked' : '' }}
                                                    name="satisfaction_result" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('satisfaction_result') == '4' ? 'checked' : '' }}
                                                    name="satisfaction_result" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('satisfaction_result') == '5' ? 'checked' : '' }}
                                                    name="satisfaction_result" value="5">
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
                                                <input type="radio"
                                                    {{ old('technical_ability') == '1' ? 'checked' : '' }}
                                                    name="technical_ability" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('technical_ability') == '2' ? 'checked' : '' }}
                                                    name="technical_ability" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('technical_ability') == '3' ? 'checked' : '' }}
                                                    name="technical_ability" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('technical_ability') == '4' ? 'checked' : '' }}
                                                    name="technical_ability" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('technical_ability') == '5' ? 'checked' : '' }}
                                                    name="technical_ability" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Intensitas kunjungan petugas lapang</td>
                                            <td align="center">
                                                <input type="radio" {{ old('visit_intensity') == '1' ? 'checked' : '' }}
                                                    name="visit_intensity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('visit_intensity') == '2' ? 'checked' : '' }}
                                                    name="visit_intensity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('visit_intensity') == '3' ? 'checked' : '' }}
                                                    name="visit_intensity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('visit_intensity') == '4' ? 'checked' : '' }}
                                                    name="visit_intensity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('visit_intensity') == '5' ? 'checked' : '' }}
                                                    name="visit_intensity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Intensitas interaksi dan komunikasi petugas lapang</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_intensity') == '1' ? 'checked' : '' }}
                                                    name="communication_intensity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_intensity') == '2' ? 'checked' : '' }}
                                                    name="communication_intensity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_intensity') == '3' ? 'checked' : '' }}
                                                    name="communication_intensity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_intensity') == '4' ? 'checked' : '' }}
                                                    name="communication_intensity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_intensity') == '5' ? 'checked' : '' }}
                                                    name="communication_intensity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kecakapan dan kredibilitas (dapat dipercaya) petugas lapang</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('skill_credibility') == '1' ? 'checked' : '' }}
                                                    name="skill_credibility" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('skill_credibility') == '2' ? 'checked' : '' }}
                                                    name="skill_credibility" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('skill_credibility') == '3' ? 'checked' : '' }}
                                                    name="skill_credibility" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('skill_credibility') == '4' ? 'checked' : '' }}
                                                    name="skill_credibility" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('skill_credibility') == '5' ? 'checked' : '' }}
                                                    name="skill_credibility" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pengaruh keberadaan petugas lapang</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('influence_of_officer') == '1' ? 'checked' : '' }}
                                                    name="influence_of_officer" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('influence_of_officer') == '2' ? 'checked' : '' }}
                                                    name="influence_of_officer" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('influence_of_officer') == '3' ? 'checked' : '' }}
                                                    name="influence_of_officer" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('influence_of_officer') == '4' ? 'checked' : '' }}
                                                    name="influence_of_officer" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('influence_of_officer') == '5' ? 'checked' : '' }}
                                                    name="influence_of_officer" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kemampuan teknis komunikasi petugas lapang</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_skill') == '1' ? 'checked' : '' }}
                                                    name="communication_skill" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_skill') == '2' ? 'checked' : '' }}
                                                    name="communication_skill" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_skill') == '3' ? 'checked' : '' }}
                                                    name="communication_skill" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_skill') == '4' ? 'checked' : '' }}
                                                    name="communication_skill" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('communication_skill') == '5' ? 'checked' : '' }}
                                                    name="communication_skill" value="5">
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
                                                <input type="radio"
                                                    {{ old('verification_speed') == '1' ? 'checked' : '' }}
                                                    name="verification_speed" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('verification_speed') == '2' ? 'checked' : '' }}
                                                    name="verification_speed" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('verification_speed') == '3' ? 'checked' : '' }}
                                                    name="verification_speed" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('verification_speed') == '4' ? 'checked' : '' }}
                                                    name="verification_speed" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('verification_speed') == '5' ? 'checked' : '' }}
                                                    name="verification_speed" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kecepatan penyelesaian komplain pelanggan</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('completion_speed') == '1' ? 'checked' : '' }}
                                                    name="completion_speed" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('completion_speed') == '2' ? 'checked' : '' }}
                                                    name="completion_speed" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('completion_speed') == '3' ? 'checked' : '' }}
                                                    name="completion_speed" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('completion_speed') == '4' ? 'checked' : '' }}
                                                    name="completion_speed" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('completion_speed') == '5' ? 'checked' : '' }}
                                                    name="completion_speed" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Penanganan komplain pelanggan</td>
                                            <td align="center">
                                                <input type="radio" {{ old('handling') == '1' ? 'checked' : '' }}
                                                    name="handling" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('handling') == '2' ? 'checked' : '' }}
                                                    name="handling" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('handling') == '3' ? 'checked' : '' }}
                                                    name="handling" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('handling') == '4' ? 'checked' : '' }}
                                                    name="handling" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('handling') == '5' ? 'checked' : '' }}
                                                    name="handling" value="5">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- <input type="hidden" name="latitude" id="latitude_field">
                                <input type="hidden" name="longitude" id="longitude_field"> --}}

                                <div class="row g-4 mb-3">
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <a href="{{ route('menu.index') }}" style="margin-right: 10px;">
                                                <button type="button" class="btn btn-primary add-btn">Kembali</button>
                                            </a>
                                            @if (!$dataAnswer)
                                                <button type="button" onclick="submit_form()"
                                                    class="btn btn-success">Submit</button>
                                            @endif
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
        @if ($dataAnswer)
            let dataAnswer = @json($dataAnswer);

            for (var key in dataAnswer) {
                if (dataAnswer.hasOwnProperty(key)) {
                    const inputs = document.querySelectorAll(`input[name="${key}"]`);
                    for (var i = 0; i < inputs.length; i++) {
                        if (inputs[i].value == dataAnswer[key]) {
                            inputs[i].checked = true;
                        }
                    }
                }
            }

            const form = document.getElementById('form_body')
            const radioButtons = form.querySelectorAll('input[type="radio"]');

            radioButtons.forEach((radioButton) => {
                radioButton.disabled = true;
            });
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
