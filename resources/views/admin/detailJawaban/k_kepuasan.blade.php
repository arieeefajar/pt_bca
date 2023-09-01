@extends('layout.app')
@section('title', 'Jawaban Kepuasan Pelanggan')
@section('menu', 'Kepuasan Pelanggan')
@section('submenu', 'Detail Jawaban')

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
                    <form id="form_body" action="{{ route('kepuasanPelanggan.create') }}" method="POST">
                        @csrf
                        <div class="live-preview">

                            <div class="table-responsive">
                                @foreach ($dataAnswer as $data)
                                    <table class="table table-bordered align-middle table_nowrap mb-3 ">
                                        <thead class="table-warning">
                                            <tr>
                                                <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                                    produk-produk
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2>Kelengkapan informasi pada kemasan</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['information'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Harga Produk dibanding dengan kompetitor</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['price_comparison'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Keunggulan Varietas dibanding kompetitor</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['variety_previlege'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Tampilan kemasan produk</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['packaging_view'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kemudahan dalam memperoleh / membeli Produk</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['getting_easy'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kepuasan memilih produk</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['satisfaction'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Tampilan gambar pada kemasan produk</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['image_view'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2>Kecukupan jumlah material promosi</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['material_amount'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kuantitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['promotion_quantity'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kualitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['promotion_quality'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2>Kemurnian fisik benih produk sesuai dengan standart mutu</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['seed_purity'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Vigor benih produk pada saat dipersemaian</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['vigor'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Daya tumbuh benih produk, sesuai dengan standart mutu</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['growing_power'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kemurnian genetik sesuai dengan standart mutu</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['genetic_purity'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Ketahanan hama dan penyakit produk</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['pest_resistance'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kesesuaian gambar produk dengan hasil panen</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['suitablelity_image_result'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kesesuaian hasil panen terhadap permintaan pasar</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['suitablelity_result_request'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kepuasan hasil panen produk</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['satisfaction_result'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2>Kemampuan teknis budidaya petugas lapang</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['technical_ability'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Intensitas kunjungan petugas lapang</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['visit_intensity'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Intensitas interaksi dan komunikasi petugas lapang</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['communication_intensity'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kecakapan dan kredibilitas (dapat dipercaya) petugas lapang
                                                </td>
                                                <td align="center" colspan=4>
                                                    {{ $data['skill_credibility'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Pengaruh keberadaan petugas lapang</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['influence_of_officer'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kemampuan teknis komunikasi petugas lapang</td>
                                                <td align="center">
                                                    {{ $data['communication_skill'] }}
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
                                                <th class="th_pertanyaan_kk" colspan=2>Pertanyaan</th>
                                                <th class="text-center" colspan=4>Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=2>Kecepatan verifikasi komplain pelanggan</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['verification_speed'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Kecepatan penyelesaian komplain pelanggan</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['completion_speed'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>Penanganan komplain pelanggan</td>
                                                <td align="center" colspan=4>
                                                    {{ $data['handling'] }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <input type="hidden" name="latitude" id="latitude_field">
                                    <input type="hidden" name="longitude" id="longitude_field">
                                @endforeach
                            </div>
                        </div> <!-- end responsive -->
                    </form>
                </div><!-- end card-body -->
            </div>
        </div>
    </div>
@endsection
