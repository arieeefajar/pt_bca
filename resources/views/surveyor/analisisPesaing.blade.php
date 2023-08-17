@extends('layout1.app')
@section('title', 'Kuisioner Analisis Pesaing')
@section('menu', 'Analisis Pesaing')
@section('submenu', 'Kuisioner')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Kuisioner</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <form action="{{ route('analisisPesaing.create') }}" method="POST">
                        @csrf
                        {{-- pertanyaan Gambaran Umum --}}
                        <div class="bg-soft-primary p-2 mb-3">
                            <h6 class="text-center">Gambaran Umum Perusahaan</h6>
                        </div>
                        <div class="mb-2">
                            <label for="">Siapa saja pesaing perusahaan ?</label>
                            <input type="text" class="form-control" name="competitor" id="">
                        </div>
                        <div class="mb-2">
                            <label for="">Siapa saja pendatang baru yang dapat mengancam perusahaan ?</label>
                            <input type="text" class="form-control" name="new_competitor" id="">
                        </div>
                        <div class="mb-2">
                            <label for="">Siapa saja pembuat produk (produsen) substitusi pengganti produk
                                perusahaan ?</label>
                            <input type="text" class="form-control" name="substitution" id="">
                        </div>
                        <div class="mb-2">
                            <label for="">Siapa saja pemasok perusahaan ?</label>
                            <input type="text" class="form-control" name="supplier" id="">
                        </div>
                        <div class="mb-4">
                            <label for="">Siapa saja pembeli perusahaan ?</label>
                            <input type="text" class="form-control" name="buyer" id="">
                        </div>

                        <div class="live-preview">
                            <div class="table-responsive">

                                {{-- pertanyaan Persaingan Perusahaan --}}
                                <table class="table table-bordered align-middle table-nowrap mb-3">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="text-center bg-soft-primary" colspan=3>Persaingan diantara Perusahaan
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Pertanyaan</th>
                                            <th class="text-center">Ya</th>
                                            <th class="text-center">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah terdapat banyak pesaing di dalam pasar ?</td>
                                            <td align="center">
                                                <input type="radio" name="any_competitor" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="any_competitor" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah produk perusahaan dapat dibedakan dengan produk-produk pesaing ?</td>
                                            <td align="center">
                                                <input type="radio" name="difference" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="difference" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah tiap-tiap perusahaan dapat dengan mudah keluar dari persaingan pasar
                                                ?</td>
                                            <td align="center">
                                                <input type="radio" name="easy_out" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="easy_out" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- Ancaman Pendatang Baru --}}
                                <table class="table table-bordered align-middle table-nowrap mb-3">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="text-center bg-soft-primary" colspan=3>Ancaman Pendatang Baru</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Pertanyaan</th>
                                            <th class="text-center">Ya</th>
                                            <th class="text-center">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah diperlukan produksi dalam jumlah besar untuk mencapai skala ekonomis
                                                ?</td>
                                            <td align="center">
                                                <input type="radio" name="quantity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="quantity" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah produk perusahaan dapat dibedakan dengan jelas dibanding produk
                                                pesaing ?</td>
                                            <td align="center">
                                                <input type="radio" name="clear_difference" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="clear_difference" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah diperlukan modal besar untuk memulai bisnis dalam
                                                industri ini ?</td>
                                            <td align="center">
                                                <input type="radio" name="big_capital" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="big_capital" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah perusahaan mempunyai keunggulan biaya yang tidak
                                                tergantung ukuran produksi dibandingkan pendatang baru ?</td>
                                            <td align="center">
                                                <input type="radio" name="cost" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="cost" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah pendatang baru dapat dengan mudah memakai saluran
                                                distribusi yang telah ada ?</td>
                                            <td align="center">
                                                <input type="radio" name="easy_channel" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="easy_channel" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah kebijakan pemerintah memudahkan pendatang baru untuk masuk ke dalam
                                                industri ?</td>
                                            <td align="center">
                                                <input type="radio" name="policy" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="policy" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- Ancaman Produk Substitusi --}}
                                <table class="table table-bordered align-middle table-nowrap mb-3">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="text-center bg-soft-primary" colspan=3>Ancaman Produk Substitusi
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Pertanyaan</th>
                                            <th class="text-center">Ya</th>
                                            <th class="text-center">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah pembeli dapat dengan mudah menemukan barang substitusi yang dapat
                                                menggantikan fungsi dari produk perusahaan di dalam pasar ?</td>
                                            <td align="center">
                                                <input type="radio" name="find_subtitution" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="find_subtitution" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jika ya, apakah harga produk substitusi tersebut bersaing dengan produk
                                                perusahaan ?</td>
                                            <td align="center">
                                                <input type="radio" name="competitive_price" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="competitive_price" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- Kekuatan Menawar Pemasok --}}
                                <table class="table table-bordered align-middle table-nowrap mb-3">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="text-center bg-soft-primary" colspan=3>Kekuatan Menawar Pemasok</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Pertanyaan</th>
                                            <th class="text-center">Ya</th>
                                            <th class="text-center">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah perusahaan memiliki banyak pilihan dalam menentukan pemasok ?</td>
                                            <td align="center">
                                                <input type="radio" name="supplier_choice" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="supplier_choice" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah perusahaan bebas untuk berganti pemasok tanpa konsekuensi tertentu,
                                                seperti biaya perggantian, harga dan kualitas ?</td>
                                            <td align="center">
                                                <input type="radio" name="change_price" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="change_price" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah terdapat barang substitusi tertentu bagi perusahaan selain produk
                                                pemasok ?</td>
                                            <td align="center">
                                                <input type="radio" name="any_substitution" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="any_substitution" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah ada kecenderungan bagi pemasok untuk bersaing secara langsung dengan
                                                cara masuk ke dalam industri ?</td>
                                            <td align="center">
                                                <input type="radio" name="competitive_tendencies" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="competitive_tendencies" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah perusahaan dan/atau industrinya adalah kelompok pembeli dominan bagi
                                                kelompok pemasok ?</td>
                                            <td align="center">
                                                <input type="radio" name="dominant" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="dominant" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- Kekuatan Menawar Pembeli --}}
                                <table class="table table-bordered align-middle table-nowrap mb-3">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="text-center bg-soft-primary" colspan=3>Kekuatan Menawar Pembeli</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Pertanyaan</th>
                                            <th class="text-center">Ya</th>
                                            <th class="text-center">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah tiap pembeli memberikan kontribusi yang besar terhadap total
                                                penjualan perusahaan ?</td>
                                            <td align="center">
                                                <input type="radio" name="contribution" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="contribution" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah pembeli dapat dengan mudah berganti penjual tanpa
                                                konsekuensi tertentu seperti harga dan kualitas ?</td>
                                            <td align="center">
                                                <input type="radio" name="difference_desire" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="difference_desire" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah pembeli sangat sensitif terhadap perubahan harga ?</td>
                                            <td align="center">
                                                <input type="radio" name="customor_movement" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="customor_movement" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah pembeli sangat sensitif terhadap perubahan harga ?</td>
                                            <td align="center">
                                                <input type="radio" name="price_sensitivity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="price_sensitivity" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah calon pembeli lebih mementingkan kualitas daripada harga dalam
                                                pembelian ?</td>
                                            <td align="center">
                                                <input type="radio" name="quality_than_price" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="quality_than_price" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah ada kecenderungan bagi pembeli masuk ke dalam industri perusahaan
                                                untuk bersaing langsung ?</td>
                                            <td align="center">
                                                <input type="radio" name="trend_competition" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" name="trend_competition" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div>
        </div>
    </div>
@endsection
