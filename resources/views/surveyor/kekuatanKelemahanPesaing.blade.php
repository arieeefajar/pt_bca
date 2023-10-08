@extends('layout1.app')
@section('title', 'Kuisioner Kekuatan dan Kelemahan Pesaing')
@section('menu', 'Kekuatan dan Kelemahan Pesaing')
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
                                                <input type="radio" {{ old('position_pov') == '1' ? 'checked' : '' }}
                                                    name="position_pov" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('position_pov') == '2' ? 'checked' : '' }}
                                                    name="position_pov" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('position_pov') == '3' ? 'checked' : '' }}
                                                    name="position_pov" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('position_pov') == '4' ? 'checked' : '' }}
                                                    name="position_pov" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('position_pov') == '5' ? 'checked' : '' }}
                                                    name="position_pov" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Luas dan dalamnya lini produk pesaing</td>
                                            <td align="center">
                                                <input type="radio" {{ old('deep') == '1' ? 'checked' : '' }}
                                                    name="deep" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('deep') == '2' ? 'checked' : '' }}
                                                    name="deep" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('deep') == '3' ? 'checked' : '' }}
                                                    name="deep" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('deep') == '4' ? 'checked' : '' }}
                                                    name="deep" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('deep') == '5' ? 'checked' : '' }}
                                                    name="deep" value="5">
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
                                                <input type="radio"
                                                    {{ old('distribution_line') == '1' ? 'checked' : '' }}
                                                    name="distribution_line" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('distribution_line') == '2' ? 'checked' : '' }}
                                                    name="distribution_line" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('distribution_line') == '3' ? 'checked' : '' }}
                                                    name="distribution_line" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('distribution_line') == '4' ? 'checked' : '' }}
                                                    name="distribution_line" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('distribution_line') == '5' ? 'checked' : '' }}
                                                    name="distribution_line" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Kekuatan hubungan saluran distribusi yang dimiliki pesaing </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_power') == '1' ? 'checked' : '' }}
                                                    name="line_power" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_power') == '2' ? 'checked' : '' }}
                                                    name="line_power" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_power') == '3' ? 'checked' : '' }}
                                                    name="line_power" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_power') == '4' ? 'checked' : '' }}
                                                    name="line_power" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_power') == '5' ? 'checked' : '' }}
                                                    name="line_power" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Kemampuan pesaing untuk melayani saluran distribusi </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_ability') == '1' ? 'checked' : '' }}
                                                    name="line_ability" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_ability') == '2' ? 'checked' : '' }}
                                                    name="line_ability" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_ability') == '3' ? 'checked' : '' }}
                                                    name="line_ability" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_ability') == '4' ? 'checked' : '' }}
                                                    name="line_ability" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('line_ability') == '5' ? 'checked' : '' }}
                                                    name="line_ability" value="5">
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
                                                <input type="radio" {{ old('marketing_skill') == '1' ? 'checked' : '' }}
                                                    name="marketing_skill" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('marketing_skill') == '2' ? 'checked' : '' }}
                                                    name="marketing_skill" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('marketing_skill') == '3' ? 'checked' : '' }}
                                                    name="marketing_skill" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('marketing_skill') == '4' ? 'checked' : '' }}
                                                    name="marketing_skill" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('marketing_skill') == '5' ? 'checked' : '' }}
                                                    name="marketing_skill" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Keterampilan pesaing dalam pengembangan produk baru</td>
                                            <td align="center">
                                                <input type="radio" {{ old('dev_skill') == '1' ? 'checked' : '' }}
                                                    name="dev_skill" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('dev_skill') == '2' ? 'checked' : '' }}
                                                    name="dev_skill" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('dev_skill') == '3' ? 'checked' : '' }}
                                                    name="dev_skill" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('dev_skill') == '4' ? 'checked' : '' }}
                                                    name="dev_skill" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('dev_skill') == '5' ? 'checked' : '' }}
                                                    name="dev_skill" value="5">
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
                                                <input type="radio" {{ old('advanced_tech') == '1' ? 'checked' : '' }}
                                                    name="advanced_tech" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('advanced_tech') == '2' ? 'checked' : '' }}
                                                    name="advanced_tech" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('advanced_tech') == '3' ? 'checked' : '' }}
                                                    name="advanced_tech" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('advanced_tech') == '4' ? 'checked' : '' }}
                                                    name="advanced_tech" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('advanced_tech') == '5' ? 'checked' : '' }}
                                                    name="advanced_tech" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Fleksibilitas fasilitas dan peralatan yang dimiliki pesaing </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('fasility_flexibility') == '1' ? 'checked' : '' }}
                                                    name="fasility_flexibility" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('fasility_flexibility') == '2' ? 'checked' : '' }}
                                                    name="fasility_flexibility" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('fasility_flexibility') == '3' ? 'checked' : '' }}
                                                    name="fasility_flexibility" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('fasility_flexibility') == '4' ? 'checked' : '' }}
                                                    name="fasility_flexibility" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('fasility_flexibility') == '5' ? 'checked' : '' }}
                                                    name="fasility_flexibility" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keterampilan pesaing dalam penambahan kapasitas, pengendalian kualitas,
                                                penggunaan fasilitas,
                                                dan peralatan </td>
                                            <td align="center">
                                                <input type="radio" {{ old('scale_up_skill') == '1' ? 'checked' : '' }}
                                                    name="scale_up_skill" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('scale_up_skill') == '2' ? 'checked' : '' }}
                                                    name="scale_up_skill" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('scale_up_skill') == '3' ? 'checked' : '' }}
                                                    name="scale_up_skill" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('scale_up_skill') == '4' ? 'checked' : '' }}
                                                    name="scale_up_skill" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('scale_up_skill') == '5' ? 'checked' : '' }}
                                                    name="scale_up_skill" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Akses dan biaya bahan baku yang dialokasikan pesaing </td>
                                            <td align="center">
                                                <input type="radio" {{ old('material_cost') == '1' ? 'checked' : '' }}
                                                    name="material_cost" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('material_cost') == '2' ? 'checked' : '' }}
                                                    name="material_cost" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('material_cost') == '3' ? 'checked' : '' }}
                                                    name="material_cost" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('material_cost') == '4' ? 'checked' : '' }}
                                                    name="material_cost" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('material_cost') == '5' ? 'checked' : '' }}
                                                    name="material_cost" value="5">
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
                                                <input type="radio" {{ old('copyrights') == '1' ? 'checked' : '' }}
                                                    name="copyrights" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('copyrights') == '2' ? 'checked' : '' }}
                                                    name="copyrights" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('copyrights') == '3' ? 'checked' : '' }}
                                                    name="copyrights" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('copyrights') == '4' ? 'checked' : '' }}
                                                    name="copyrights" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('copyrights') == '5' ? 'checked' : '' }}
                                                    name="copyrights" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Kemampuan internal perusahaan pesaing dalam proses riset dan pengembangan
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('rnd_ability') == '1' ? 'checked' : '' }}
                                                    name="rnd_ability" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('rnd_ability') == '2' ? 'checked' : '' }}
                                                    name="rnd_ability" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('rnd_ability') == '3' ? 'checked' : '' }}
                                                    name="rnd_ability" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('rnd_ability') == '4' ? 'checked' : '' }}
                                                    name="rnd_ability" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('rnd_ability') == '5' ? 'checked' : '' }}
                                                    name="rnd_ability" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Keterampilan staf divisi riset dan pengembangan pesaing </td>
                                            <td align="center">
                                                <input type="radio" {{ old('staff_skill') == '1' ? 'checked' : '' }}
                                                    name="staff_skill" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('staff_skill') == '2' ? 'checked' : '' }}
                                                    name="staff_skill" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('staff_skill') == '3' ? 'checked' : '' }}
                                                    name="staff_skill" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('staff_skill') == '4' ? 'checked' : '' }}
                                                    name="staff_skill" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('staff_skill') == '5' ? 'checked' : '' }}
                                                    name="staff_skill" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Akses pesaing ke sumber-sumber eksternal perusahaan untuk penguatan riset
                                                dan pengembangan </td>
                                            <td align="center">
                                                <input type="radio" {{ old('resource_access') == '1' ? 'checked' : '' }}
                                                    name="resource_access" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('resource_access') == '2' ? 'checked' : '' }}
                                                    name="resource_access" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('resource_access') == '3' ? 'checked' : '' }}
                                                    name="resource_access" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('resource_access') == '4' ? 'checked' : '' }}
                                                    name="resource_access" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('resource_access') == '5' ? 'checked' : '' }}
                                                    name="resource_access" value="5">
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
                                                <input type="radio" {{ old('cash_flow') == '1' ? 'checked' : '' }}
                                                    name="cash_flow" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('cash_flow') == '2' ? 'checked' : '' }}
                                                    name="cash_flow" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('cash_flow') == '3' ? 'checked' : '' }}
                                                    name="cash_flow" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('cash_flow') == '4' ? 'checked' : '' }}
                                                    name="cash_flow" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('cash_flow') == '5' ? 'checked' : '' }}
                                                    name="cash_flow" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Kapasitas modal baru yang dimiliki pesaing untuk bisnis masa depan </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('capital_capacity') == '1' ? 'checked' : '' }}
                                                    name="capital_capacity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('capital_capacity') == '2' ? 'checked' : '' }}
                                                    name="capital_capacity" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('capital_capacity') == '3' ? 'checked' : '' }}
                                                    name="capital_capacity" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('capital_capacity') == '4' ? 'checked' : '' }}
                                                    name="capital_capacity" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('capital_capacity') == '5' ? 'checked' : '' }}
                                                    name="capital_capacity" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Kemampuan manajemen keuangan pesaing, termasuk negosiasi, mendapatkan
                                                modal, kredit,
                                                persediaan, serta piutang </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('trust_management') == '1' ? 'checked' : '' }}
                                                    name="trust_management" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('trust_management') == '2' ? 'checked' : '' }}
                                                    name="trust_management" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('trust_management') == '3' ? 'checked' : '' }}
                                                    name="trust_management" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('trust_management') == '4' ? 'checked' : '' }}
                                                    name="trust_management" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('trust_management') == '5' ? 'checked' : '' }}
                                                    name="trust_management" value="5">
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
                                                <input type="radio" {{ old('vision_mission') == '1' ? 'checked' : '' }}
                                                    name="vision_mission" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('vision_mission') == '2' ? 'checked' : '' }}
                                                    name="vision_mission" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('vision_mission') == '3' ? 'checked' : '' }}
                                                    name="vision_mission" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('vision_mission') == '4' ? 'checked' : '' }}
                                                    name="vision_mission" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('vision_mission') == '5' ? 'checked' : '' }}
                                                    name="vision_mission" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Konsistensi struktur organisasi dengan strategi bisnis pesaing </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('consistency_organization_structure') == '1' ? 'checked' : '' }}
                                                    name="consistency_organization_structure" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('consistency_organization_structure') == '2' ? 'checked' : '' }}
                                                    name="consistency_organization_structure" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('consistency_organization_structure') == '3' ? 'checked' : '' }}
                                                    name="consistency_organization_structure" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('consistency_organization_structure') == '4' ? 'checked' : '' }}
                                                    name="consistency_organization_structure" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('consistency_organization_structure') == '5' ? 'checked' : '' }}
                                                    name="consistency_organization_structure" value="5">
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
                                                <input type="radio" {{ old('lead_quality') == '1' ? 'checked' : '' }}
                                                    name="lead_quality" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('lead_quality') == '2' ? 'checked' : '' }}
                                                    name="lead_quality" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('lead_quality') == '3' ? 'checked' : '' }}
                                                    name="lead_quality" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('lead_quality') == '4' ? 'checked' : '' }}
                                                    name="lead_quality" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('lead_quality') == '5' ? 'checked' : '' }}
                                                    name="lead_quality" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Kemampuan manajemen perusahaan pesaing untuk mengkoordinasi fungsi atau
                                                kelompok fungsi tertentu
                                                (misalnya koordinasi pengembangan produk dengan riset) </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('management_ability') == '1' ? 'checked' : '' }}
                                                    name="management_ability" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('management_ability') == '2' ? 'checked' : '' }}
                                                    name="management_ability" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('management_ability') == '3' ? 'checked' : '' }}
                                                    name="management_ability" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('management_ability') == '4' ? 'checked' : '' }}
                                                    name="management_ability" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('management_ability') == '5' ? 'checked' : '' }}
                                                    name="management_ability" value="5">
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
                                                <input type="radio"
                                                    {{ old('functional_ability') == '1' ? 'checked' : '' }}
                                                    name="functional_ability" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('functional_ability') == '2' ? 'checked' : '' }}
                                                    name="functional_ability" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('functional_ability') == '3' ? 'checked' : '' }}
                                                    name="functional_ability" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('functional_ability') == '4' ? 'checked' : '' }}
                                                    name="functional_ability" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('functional_ability') == '5' ? 'checked' : '' }}
                                                    name="functional_ability" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Kemampuan pesaing mengukur konsistensi dari strateginya
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('measurement_ability') == '1' ? 'checked' : '' }}
                                                    name="measurement_ability" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('measurement_ability') == '2' ? 'checked' : '' }}
                                                    name="measurement_ability" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('measurement_ability') == '3' ? 'checked' : '' }}
                                                    name="measurement_ability" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('measurement_ability') == '4' ? 'checked' : '' }}
                                                    name="measurement_ability" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('measurement_ability') == '5' ? 'checked' : '' }}
                                                    name="measurement_ability" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Kapasitas pesaing dalam menanggapi gerakan pihak lain
                                                (misalnya produk baru yang belum diperkenalkan,
                                                tetapi sudah siap untuk diluncurkan) </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('movement_response') == '1' ? 'checked' : '' }}
                                                    name="movement_response" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('movement_response') == '2' ? 'checked' : '' }}
                                                    name="movement_response" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('movement_response') == '3' ? 'checked' : '' }}
                                                    name="movement_response" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('movement_response') == '4' ? 'checked' : '' }}
                                                    name="movement_response" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('movement_response') == '5' ? 'checked' : '' }}
                                                    name="movement_response" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kemampuan pesaing dalam menyesuaikan diri dan merespon
                                                kondisi yang berubah di setiap bidang fungsional (misalnya menyesuaikan diri
                                                untuk bersaing dalam harga,
                                                mengelola lini produk yang lebih kompleks, menambah produk baru, bersaing
                                                dalam layanan, meningkatkan kegiatan pemasaran) </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('response_to_change') == '1' ? 'checked' : '' }}
                                                    name="response_to_change" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('response_to_change') == '2' ? 'checked' : '' }}
                                                    name="response_to_change" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('response_to_change') == '3' ? 'checked' : '' }}
                                                    name="response_to_change" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('response_to_change') == '4' ? 'checked' : '' }}
                                                    name="response_to_change" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('response_to_change') == '5' ? 'checked' : '' }}
                                                    name="response_to_change" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kemampuan pesaing untuk bertahan dari perang persaingan
                                                yang berkepanjangan,
                                                yang mungkin akan menekan laba dan arus kas </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('competition_ability') == '1' ? 'checked' : '' }}
                                                    name="competition_ability" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('competition_ability') == '2' ? 'checked' : '' }}
                                                    name="competition_ability" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('competition_ability') == '3' ? 'checked' : '' }}
                                                    name="competition_ability" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('competition_ability') == '4' ? 'checked' : '' }}
                                                    name="competition_ability" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('competition_ability') == '5' ? 'checked' : '' }}
                                                    name="competition_ability" value="5">
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
                                                <input type="radio" {{ old('support_change') == '1' ? 'checked' : '' }}
                                                    name="support_change" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('support_change') == '2' ? 'checked' : '' }}
                                                    name="support_change" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('support_change') == '3' ? 'checked' : '' }}
                                                    name="support_change" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('support_change') == '4' ? 'checked' : '' }}
                                                    name="support_change" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('support_change') == '5' ? 'checked' : '' }}
                                                    name="support_change" value="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Kemampuan pesaing untuk melengkapi atau memperkokoh kekuatan unit bisnisnya
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('strengthening_ability') == '1' ? 'checked' : '' }}
                                                    name="strengthening_ability" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('strengthening_ability') == '2' ? 'checked' : '' }}
                                                    name="strengthening_ability" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('strengthening_ability') == '3' ? 'checked' : '' }}
                                                    name="strengthening_ability" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('strengthening_ability') == '4' ? 'checked' : '' }}
                                                    name="strengthening_ability" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('strengthening_ability') == '5' ? 'checked' : '' }}
                                                    name="strengthening_ability" value="5">
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
                                                <input type="radio"
                                                    {{ old('special_treatment') == '1' ? 'checked' : '' }}
                                                    name="special_treatment" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('special_treatment') == '2' ? 'checked' : '' }}
                                                    name="special_treatment" value="2">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('special_treatment') == '3' ? 'checked' : '' }}
                                                    name="special_treatment" value="3">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('special_treatment') == '4' ? 'checked' : '' }}
                                                    name="special_treatment" value="4">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('special_treatment') == '5' ? 'checked' : '' }}
                                                    name="special_treatment" value="5">
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
                                            <button type="button" onclick="submit_form()"
                                                class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div>
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
