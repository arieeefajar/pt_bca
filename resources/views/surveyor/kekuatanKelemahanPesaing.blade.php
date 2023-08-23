@extends('layout1.app')
@section('title', 'Kuisioner Kekuatan dan Kelemahan Pesaing')
@section('menu', 'Kekuatan dan Kelemahan Pesaing')
@section('submenu', 'Kuisioner')

@section('content')

{{-- @dd($dataPertanyaan) --}}
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
                <div class="live-preview">
                    <div class="table-responsive">
                        <form id="form_body" action="{{ route('KekuatanDanKelemahanPesaing.create') }}" method="POST">
                            @csrf
                            {{-- pertanyaan Produk --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Produk</th>
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
                                        <td>Kedudukan produk pesaing (dari sudut pandang pengguna) di setiap segmen
                                            pasar</td>
                                        <td align="center">
                                            <input type="radio" name="position_pov" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="position_pov" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="position_pov" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="position_pov" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="position_pov" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Luas dan dalamnya lini produk pesaing</td>
                                        <td align="center">
                                            <input type="radio" name="deep" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="deep" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="deep" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="deep" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="deep" value="5">
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            {{-- pertanyaan Distribusi --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Distribusi</th>
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
                                        <td> Kualitas saluran distribusi pesaing</td>
                                        <td align="center">
                                            <input type="radio" name="distribution_line" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="distribution_line" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="distribution_line" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="distribution_line" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="distribution_line" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Kekuatan hubungan saluran distribusi yang dimiliki pesaing </td>
                                        <td align="center">
                                            <input type="radio" name="line_power" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="line_power" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="line_power" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="line_power" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="line_power" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Kemampuan pesaing untuk melayani saluran distribusi </td>
                                        <td align="center">
                                            <input type="radio" name="line_ability" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="line_ability" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="line_ability" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="line_ability" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="line_ability" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- pertanyaan Pemasaran --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Pemasaran</th>
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
                                        <td>Keterampilan pesaing pada masing-masing aspek bauran pemasaran </td>
                                        <td align="center">
                                            <input type="radio" name="marketing_skill" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="marketing_skill" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="marketing_skill" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="marketing_skill" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="marketing_skill" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Keterampilan pesaing dalam pengembangan produk baru</td>
                                        <td align="center">
                                            <input type="radio" name="dev_skill" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="dev_skill" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="dev_skill" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="dev_skill" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="dev_skill" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- pertanyaan Operasional --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Operasional</th>
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
                                        <td> Kecanggihan teknologi dari fasilitas dan peralatan yang dimiliki pesaing
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="advanced_tech" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="advanced_tech" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="advanced_tech" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="advanced_tech" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="advanced_tech" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Fleksibilitas fasilitas dan peralatan yang dimiliki pesaing </td>
                                        <td align="center">
                                            <input type="radio" name="fasility_flexibility" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="fasility_flexibility" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="fasility_flexibility" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="fasility_flexibility" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="fasility_flexibility" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keterampilan pesaing dalam penambahan kapasitas, pengendalian kualitas,
                                            penggunaan fasilitas,
                                            dan peralatan </td>
                                        <td align="center">
                                            <input type="radio" name="scale_up_skill" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="scale_up_skill" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="scale_up_skill" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="scale_up_skill" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="scale_up_skill" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Akses dan biaya bahan baku yang dialokasikan pesaing </td>
                                        <td align="center">
                                            <input type="radio" name="material_cost" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="material_cost" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="material_cost" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="material_cost" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="material_cost" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- pertanyaan Riset dan Pengembangan (R & D) --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Riset dan Pengembangan (R &
                                            D)</th>
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
                                        <td> Paten dan hak cipta yang dimiliki pesaing </td>
                                        <td align="center">
                                            <input type="radio" name="copyrights" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="copyrights" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="copyrights" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="copyrights" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="copyrights" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Kemampuan internal perusahaan pesaing dalam proses riset dan pengembangan
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="rnd_ability" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="rnd_ability" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="rnd_ability" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="rnd_ability" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="rnd_ability" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Keterampilan staf divisi riset dan pengembangan pesaing </td>
                                        <td align="center">
                                            <input type="radio" name="staff_skill" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="staff_skill" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="staff_skill" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="staff_skill" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="staff_skill" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Akses pesaing ke sumber-sumber eksternal perusahaan untuk penguatan riset
                                            dan pengembangan </td>
                                        <td align="center">
                                            <input type="radio" name="resource_access" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="resource_access" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="resource_access" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="resource_access" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="resource_access" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- pertanyaan Keuangan --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Keuangan</th>
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
                                        <td> Arus kas pesaing </td>
                                        <td align="center">
                                            <input type="radio" name="cash_flow" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="cash_flow" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="cash_flow" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="cash_flow" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="cash_flow" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Kapasitas modal baru yang dimiliki pesaing untuk bisnis masa depan </td>
                                        <td align="center">
                                            <input type="radio" name="capital_capacity" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="capital_capacity" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="capital_capacity" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="capital_capacity" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="capital_capacity" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Kemampuan manajemen keuangan pesaing, termasuk negosiasi, mendapatkan
                                            modal, kredit,
                                            persediaan, serta piutang </td>
                                        <td align="center">
                                            <input type="radio" name="trust_management" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="trust_management" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="trust_management" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="trust_management" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="trust_management" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- pertanyaan Organisasi --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Organisasi</th>
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
                                        <td> Keseragaman nilai dan kejelasan misi dan tujuan organisasi pesaing </td>
                                        <td align="center">
                                            <input type="radio" name="vision_mission" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="vision_mission" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="vision_mission" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="vision_mission" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="vision_mission" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Konsistensi struktur organisasi dengan strategi bisnis pesaing </td>
                                        <td align="center">
                                            <input type="radio" name="consistency_organization_structure" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="consistency_organization_structure" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="consistency_organization_structure" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="consistency_organization_structure" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="consistency_organization_structure" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- pertanyaan Kemampuan Manajerial --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Kemampuan Manajerial</th>
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
                                        <td> Kualitas kepemimpinan CEO pesaing - kemampuan Direktur Utama untuk
                                            memotivasi </td>
                                        <td align="center">
                                            <input type="radio" name="lead_quality" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lead_quality" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lead_quality" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lead_quality" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lead_quality" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Kemampuan manajemen perusahaan pesaing untuk mengkoordinasi fungsi atau
                                            kelompok fungsi tertentu
                                            (misalnyakoordinasi pengembangan produk dengan riset) </td>
                                        <td align="center">
                                            <input type="radio" name="management_ability" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="management_ability" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="management_ability" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="management_ability" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="management_ability" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- pertanyaan Kemampuan Inti dan Menyesuaikan Diri dengan Perubahan --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Kemampuan Inti dan
                                            Menyesuaikan Diri dengan Perubahan</th>
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
                                        <td> Kemampuan pesaing dalam bidang fungsional </td>
                                        <td align="center">
                                            <input type="radio" name="functional_ability" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="functional_ability" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="functional_ability" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="functional_ability" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="functional_ability" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Kemampuan pesaing mengukur konsistensi dari strateginya
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="measurement_ability" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="measurement_ability" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="measurement_ability" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="measurement_ability" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="measurement_ability" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Kapasitas pesaing dalam menanggapi gerakan pihak lain
                                            (misalnya produk baru yang belum diperkenalkan,
                                            tetapi sudah siap untuk diluncurkan) </td>
                                        <td align="center">
                                            <input type="radio" name="movement_response" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="movement_response" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="movement_response" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="movement_response" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="movement_response" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kemampuan pesaing dalam menyesuaikan diri dan merespon
                                            kondisi yang berubah di setiap bidang fungsional (misalnya menyesuaikan diri
                                            untuk bersaing dalam harga,
                                            mengelola lini produk yang lebih kompleks, menambah produk baru, bersaing
                                            dalam layanan, meningkatkan kegiatan pemasaran) </td>
                                        <td align="center">
                                            <input type="radio" name="response_to_change" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="response_to_change" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="response_to_change" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="response_to_change" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="response_to_change" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kemampuan pesaing untuk bertahan dari perang persaingan
                                            yang berkepanjangan,
                                            yang mungkin akan menekan laba dan arus kas </td>
                                        <td align="center">
                                            <input type="radio" name="competition_ability" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="competition_ability" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="competition_ability" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="competition_ability" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="competition_ability" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- pertanyaan Portofolio Pesaing --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Portofolio Pesaing</th>
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
                                        <td> Kemampuan pesaing untuk mendukung perubahan yang terencana dalam semua unit
                                            bisnisnya dalam bentuk sumber dana dan sumber daya lain </td>
                                        <td align="center">
                                            <input type="radio" name="support_change" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="support_change" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="support_change" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="support_change" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="support_change" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Kemampuan pesaing untuk melengkapi atau memperkokoh kekuatan unit bisnisnya
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="strengthening_ability" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="strengthening_ability" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="strengthening_ability" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="strengthening_ability" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="strengthening_ability" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- pertanyaan Lain-Lain --}}
                            <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Lain-lain</th>
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
                                        <td> Perlakuan khusus atau akses pesaing ke lembaga pemerintahan </td>
                                        <td align="center">
                                            <input type="radio" name="special_treatment" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="special_treatment" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="special_treatment" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="special_treatment" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="special_treatment" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <input type="hidden" name="latitude" id="latitude_field">
                            <input type="hidden" name="longitude" id="longitude_field">

                            <div class="text-center mt-3">
                                <button type="button" onclick="submit_form()" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
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
            const coords = await getLocation();
            document.getElementById("latitude_field").value = coords.latitude;
            document.getElementById("longitude_field").value = coords.longitude;

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