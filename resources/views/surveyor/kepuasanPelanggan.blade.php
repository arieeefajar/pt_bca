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
                <form action="">
                    <div class="live-preview">
                        <!-- <div class="table-responsive"> -->
                        <!-- <table class="table table-bordered align-middle table-nowrap mb-3"> -->

                        <!-- {{-- Bagaimana tingkat kepuasan Anda pada produk-produk --}}
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Harga Produk dibanding dengan kompetitor</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keunggulan Varietas dibanding kompetitor</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tampilan kemasan produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kemudahan dalam memperoleh/membeli Produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kepuasan memilih produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tampilan gambar pada kemasan produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                </tbody>

                                {{-- Bagaimana tingkat kepuasan Anda pada kegiatan promosi produk --}}
                                <thead>
                                    <tr>
                                        <th style="border: none;" colspan="6"></th>
                                    </tr>
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                            kegiatan promosi produk
                                        </th>
                                    </tr>
                                    <tr class="bg-soft-warning">
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kuantitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kualitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                </tbody>

                                {{-- Bagaimana tingkat kepuasan Anda pada kualitas produk-produk --}}
                                <thead>
                                    <tr>
                                        <th style="border: none;" colspan="6"></th>
                                    </tr>
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                            kualitas produk-produk
                                        </th>
                                    </tr>
                                    <tr class="bg-soft-warning">
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vigor benih produk pada saat dipersemaian</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daya tumbuh benih produk, sesuai dengan standart mutu</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kemurnian genetik sesuai dengan standart mutu</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketahanan hama dan penyakit produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kesesuaian gambar produk dengan hasil panen</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kesesuaian hasil panen terhadap permintaan pasar</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kepuasan hasil panen produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                </tbody>

                                {{-- Bagaimana tingkat kepuasan Anda pada layanan petugas lapangan --}}
                                <thead>
                                    <tr>
                                        <th style="border: none;" colspan="6"></th>
                                    </tr>
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                            layanan petugas lapangan
                                        </th>
                                    </tr>
                                    <tr class="bg-soft-warning">
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Intensitas kunjungan petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Intensitas interaksi dan komunikasi petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kecakapan dan kredibilitas (dapat dipercaya) petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pengaruh keberadaan petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kemampuan teknis komunikasi petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                </tbody>

                                {{-- Bagaimana tingkat kepuasan Anda pada penanganan komplain pelanggan --}}
                                <thead>
                                    <tr>
                                        <th style="border: none;" colspan="6"></th>
                                    </tr>
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                            penanganan komplain pelanggan
                                        </th>
                                    </tr>
                                    <tr class="bg-soft-warning">
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kecepatan penyelesaian komplain pelanggan</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Penanganan komplain pelanggan</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                </tbody>

                                {{-- Bagaimana tingkat kepuasan Anda pada penanganan komplain pelanggan --}}
                                <thead>
                                    <tr>
                                        <th style="border: none;" colspan="6"></th>
                                    </tr>
                                    <tr>
                                        <th class="bg-soft-primary" colspan=6>Bagaimana tingkat kepuasan Anda pada
                                            penanganan komplain pelanggan
                                        </th>
                                    </tr>
                                    <tr class="bg-soft-warning">
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kecepatan penyelesaian komplain pelanggan</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Penanganan komplain pelanggan</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table> -->
                        <!-- </div> -->

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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Harga Produk dibanding dengan kompetitor</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keunggulan Varietas dibanding kompetitor</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tampilan kemasan produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kemudahan dalam memperoleh / membeli Produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kepuasan memilih produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tampilan gambar pada kemasan produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kuantitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kualitas kegiatan promosi yang dilaksanakan oleh petugas</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vigor benih produk pada saat dipersemaian</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daya tumbuh benih produk, sesuai dengan standart mutu</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kemurnian genetik sesuai dengan standart mutu</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketahanan hama dan penyakit produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kesesuaian gambar produk dengan hasil panen</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kesesuaian hasil panen terhadap permintaan pasar</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kepuasan hasil panen produk</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Intensitas kunjungan petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Intensitas interaksi dan komunikasi petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kecakapan dan kredibilitas (dapat dipercaya) petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pengaruh keberadaan petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kemampuan teknis komunikasi petugas lapang</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
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
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kecepatan penyelesaian komplain pelanggan</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Penanganan komplain pelanggan</td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="2">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="3">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="4">
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="pertanyaan1" value="5">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div class="text-center mt-3">
                                <button type="button" class="btn btn-primary">Submit</button>
                            </div> -->
                        </div>

                        <div class="text-center mt-3">
                            <button type="button" onclick="submit_form()" class="btn btn-primary">Submit</button>
                        </div>
                    </div> <!-- end responsive -->
                </form>
            </div><!-- end card-body -->
        </div>
    </div>
</div>
@endsection