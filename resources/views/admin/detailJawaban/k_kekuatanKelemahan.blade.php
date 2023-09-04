@extends('layout.app')
@section('title', 'Jawaban Kekuatan Kelemahan Pesaing')
@section('menu', 'Kekuatan Kelemahan Pesaing')
@section('submenu')
    <a href="{{ route('detailPenyimpanan.index', ['id' => $idDetail]) }}">Detail Jawaban</a>
@endsection

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

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Detail Jawaban</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            {{-- @dd($dataAnswer) --}}
                            @foreach ($dataAnswer as $data)
                                <form id="form_body" action="{{ route('KekuatanDanKelemahanPesaing.create') }}"
                                    method="POST">
                                    @csrf
                                    {{-- pertanyaan Produk --}}
                                    <table class="table table-bordered align-middle  mb-3 table_nowrap">
                                        <thead class="table-warning">
                                            <tr>
                                                <th class="bg-soft-primary" colspan=6>Produk</th>
                                            </tr>
                                            <tr>
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2>Kedudukan produk pesaing (dari sudut pandang pengguna) di
                                                    setiap
                                                    segmen
                                                    pasar</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['position_pov'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Luas dan dalamnya lini produk pesaing</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['deep'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2> Kualitas saluran distribusi pesaing</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['distribution_line'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Kekuatan hubungan saluran distribusi yang dimiliki pesaing
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['line_power'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Kemampuan pesaing untuk melayani saluran distribusi </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['line_ability'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2>Keterampilan pesaing pada masing-masing aspek bauran pemasaran
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['marketing_skill'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Keterampilan pesaing dalam pengembangan produk baru</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['dev_skill'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2> Kecanggihan teknologi dari fasilitas dan peralatan yang
                                                    dimiliki
                                                    pesaing
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['advanced_tech'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Fleksibilitas fasilitas dan peralatan yang dimiliki pesaing
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['fasility_flexibility'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Keterampilan pesaing dalam penambahan kapasitas, pengendalian
                                                    kualitas,
                                                    penggunaan fasilitas,
                                                    dan peralatan </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['scale_up_skill'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Akses dan biaya bahan baku yang dialokasikan pesaing </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['material_cost'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2> Paten dan hak cipta yang dimiliki pesaing </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['copyrights'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Kemampuan internal perusahaan pesaing dalam proses riset dan
                                                    pengembangan
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['rnd_ability'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Keterampilan staf divisi riset dan pengembangan pesaing </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['staff_skill'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Akses pesaing ke sumber-sumber eksternal perusahaan untuk
                                                    penguatan riset
                                                    dan pengembangan </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['resource_access'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2> Arus kas pesaing </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['cash_flow'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Kapasitas modal baru yang dimiliki pesaing untuk bisnis masa
                                                    depan </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['capital_capacity'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Kemampuan manajemen keuangan pesaing, termasuk negosiasi,
                                                    mendapatkan
                                                    modal, kredit, persediaan, serta piutang </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['trust_management'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2> Keseragaman nilai dan kejelasan misi dan tujuan organisasi
                                                    pesaing </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['vision_mission'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Konsistensi struktur organisasi dengan strategi bisnis
                                                    pesaing
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['consistency_organization_structure'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2> Kualitas kepemimpinan CEO pesaing - kemampuan Direktur Utama
                                                    untuk
                                                    memotivasi </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['lead_quality'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Kemampuan manajemen perusahaan pesaing untuk mengkoordinasi
                                                    fungsi atau
                                                    kelompok fungsi tertentu
                                                    (misalnya koordinasi pengembangan produk dengan riset)
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['management_ability'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2> Kemampuan pesaing dalam bidang fungsional </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['functional_ability'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Kemampuan pesaing mengukur konsistensi dari strateginya
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['measurement_ability'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Kapasitas pesaing dalam menanggapi gerakan pihak lain
                                                    (misalnya produk baru yang belum diperkenalkan,
                                                    tetapi sudah siap untuk diluncurkan) </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['movement_response'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kemampuan pesaing dalam menyesuaikan diri dan merespon
                                                    kondisi yang berubah di setiap bidang fungsional (misalnya menyesuaikan
                                                    diri
                                                    untuk bersaing dalam harga,
                                                    mengelola lini produk yang lebih kompleks, menambah produk baru,
                                                    bersaing
                                                    dalam layanan, meningkatkan kegiatan pemasaran) </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['response_to_change'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kemampuan pesaing untuk bertahan dari perang persaingan
                                                    yang berkepanjangan,
                                                    yang mungkin akan menekan laba dan arus kas </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['competition_ability'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2> Kemampuan pesaing untuk mendukung perubahan yang terencana
                                                    dalam
                                                    semua unit
                                                    bisnisnya dalam bentuk sumber dana dan sumber daya lain </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['support_change'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2> Kemampuan pesaing untuk melengkapi atau memperkokoh kekuatan
                                                    unit
                                                    bisnisnya
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['strengthening_ability'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2> Perlakuan khusus atau akses pesaing ke lembaga pemerintahan
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['special_treatment'] }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <input type="hidden" name="latitude" id="latitude_field">
                                    <input type="hidden" name="longitude" id="longitude_field">
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div>
        </div>
    </div>
@endsection
