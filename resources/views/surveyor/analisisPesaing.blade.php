@extends('layout1.app')
@section('title', 'Kuisioner Analisis Pesaing')
@section('menu', 'Analisis Pesaing')
@section('submenu', 'Kuisioner')

@section('content')

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
                    <form id="form_body" action="{{ !$dataAnswer ? route('analisisPesaing.create') : '' }}" method="POST">
                        @csrf
                        {{-- pertanyaan Gambaran Umum --}}
                        <div class="bg-soft-primary p-2 mb-3">
                            <h6 class="">Gambaran Umum Perusahaan</h6>
                        </div>
                        <div class="mb-2">
                            <label for="">Siapa saja pesaing perusahaan ?</label>
                            <input type="text" value="{{ old('competitor') }}" class="form-control" name="competitor"
                                id="">
                        </div>
                        <div class="mb-2">
                            <label for="">Siapa saja pendatang baru yang dapat mengancam perusahaan ?</label>
                            <input type="text" value="{{ old('new_competitor') }}" class="form-control"
                                name="new_competitor" id="">
                        </div>
                        <div class="mb-2">
                            <label for="">Siapa saja pembuat produk (produsen) substitusi pengganti produk
                                perusahaan ?</label>
                            <input type="text" value="{{ old('substitution') }}" class="form-control" name="substitution"
                                id="">
                        </div>
                        <div class="mb-2">
                            <label for="">Siapa saja pemasok perusahaan ?</label>
                            <input type="text" value="{{ old('supplier') }}" class="form-control" name="supplier"
                                id="">
                        </div>
                        <div class="mb-4">
                            <label for="">Siapa saja pembeli perusahaan ?</label>
                            <input type="text" value="{{ old('buyer') }}" class="form-control" name="buyer"
                                id="">
                        </div>

                        <div class="live-preview">
                            <div class="table-responsive">

                                {{-- pertanyaan Persaingan Perusahaan --}}
                                <table class="table table-bordered align-middle mb-3 table_nowrap">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="bg-soft-primary" colspan=3>Persaingan diantara Perusahaan
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="th_pertanyaan">Pertanyaan</th>
                                            <th class="text-center th_dua">Ya</th>
                                            <th class="text-center th_dua">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah terdapat banyak pesaing di dalam pasar ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('any_competitor') == '1' ? 'checked' : '' }}
                                                    name="any_competitor" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('any_competitor') == '2' ? 'checked' : '' }}
                                                    name="any_competitor" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah produk perusahaan dapat dibedakan dengan produk-produk pesaing ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('difference') == '1' ? 'checked' : '' }}
                                                    name="difference" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('difference') == '2' ? 'checked' : '' }}
                                                    name="difference" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah tiap-tiap perusahaan dapat dengan mudah keluar dari persaingan pasar
                                                ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('easy_out') == '1' ? 'checked' : '' }}
                                                    name="easy_out" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('easy_out') == '2' ? 'checked' : '' }}
                                                    name="easy_out" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- Ancaman Pendatang Baru --}}
                                <table class="table table-bordered align-middle mb-3 table_nowrap">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="bg-soft-primary" colspan=3>Ancaman Pendatang Baru</th>
                                        </tr>
                                        <tr>
                                            <th class="th_pertanyaan">Pertanyaan</th>
                                            <th class="text-center th_dua">Ya</th>
                                            <th class="text-center th_dua">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah diperlukan produksi dalam jumlah besar untuk mencapai skala ekonomis
                                                ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('quantity') == '1' ? 'checked' : '' }}
                                                    name="quantity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('quantity') == '2' ? 'checked' : '' }}
                                                    name="quantity" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah produk perusahaan dapat dibedakan dengan jelas dibanding produk
                                                pesaing ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('clear_difference') == '1' ? 'checked' : '' }}
                                                    name="clear_difference" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('clear_difference') == '2' ? 'checked' : '' }}
                                                    name="clear_difference" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah diperlukan modal besar untuk memulai bisnis dalam
                                                industri ini ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('big_capital') == '1' ? 'checked' : '' }}
                                                    name="big_capital" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('big_capital') == '2' ? 'checked' : '' }}
                                                    name="big_capital" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah perusahaan mempunyai keunggulan biaya yang tidak
                                                tergantung ukuran produksi dibandingkan pendatang baru ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('cost') == '1' ? 'checked' : '' }}
                                                    name="cost" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('cost') == '2' ? 'checked' : '' }}
                                                    name="cost" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah pendatang baru dapat dengan mudah memakai saluran
                                                distribusi yang telah ada ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('easy_channel') == '1' ? 'checked' : '' }}
                                                    name="easy_channel" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('easy_channel') == '2' ? 'checked' : '' }}
                                                    name="easy_channel" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah kebijakan pemerintah memudahkan pendatang baru untuk masuk ke dalam
                                                industri ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('policy') == '1' ? 'checked' : '' }}
                                                    name="policy" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('policy') == '2' ? 'checked' : '' }}
                                                    name="policy" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- Ancaman Produk Substitusi --}}
                                <table class="table table-bordered align-middle mb-3 table_nowrap">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="bg-soft-primary" colspan=3>Ancaman Produk Substitusi
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="th_pertanyaan">Pertanyaan</th>
                                            <th class="text-center th_dua">Ya</th>
                                            <th class="text-center th_dua">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah pembeli dapat dengan mudah menemukan barang substitusi yang dapat
                                                menggantikan fungsi dari produk perusahaan di dalam pasar ?</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('find_subtitution') == '1' ? 'checked' : '' }}
                                                    name="find_subtitution" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('find_subtitution') == '2' ? 'checked' : '' }}
                                                    name="find_subtitution" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jika ya, apakah harga produk substitusi tersebut bersaing dengan produk
                                                perusahaan ?</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('competitive_price') == '1' ? 'checked' : '' }}
                                                    name="competitive_price" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('competitive_price') == '2' ? 'checked' : '' }}
                                                    name="competitive_price" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- Kekuatan Menawar Pemasok --}}
                                <table class="table table-bordered align-middle mb-3 table_nowrap">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class=" bg-soft-primary" colspan=3>Kekuatan Menawar Pemasok</th>
                                        </tr>
                                        <tr>
                                            <th class=" th_pertanyaan">Pertanyaan</th>
                                            <th class="text-center th_dua">Ya</th>
                                            <th class="text-center th_dua">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah perusahaan memiliki banyak pilihan dalam menentukan pemasok ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('supplier_choice') == '1' ? 'checked' : '' }}
                                                    name="supplier_choice" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('supplier_choice') == '2' ? 'checked' : '' }}
                                                    name="supplier_choice" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah perusahaan bebas untuk berganti pemasok tanpa konsekuensi tertentu,
                                                seperti biaya perggantian, harga dan kualitas ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('change_price') == '1' ? 'checked' : '' }}
                                                    name="change_price" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('change_price') == '2' ? 'checked' : '' }}
                                                    name="change_price" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah terdapat barang substitusi tertentu bagi perusahaan selain produk
                                                pemasok ?</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('any_substitution') == '1' ? 'checked' : '' }}
                                                    name="any_substitution" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('any_substitution') == '2' ? 'checked' : '' }}
                                                    name="any_substitution" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah ada kecenderungan bagi pemasok untuk bersaing secara langsung dengan
                                                cara masuk ke dalam industri ?</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('competitive_tendencies') == '1' ? 'checked' : '' }}
                                                    name="competitive_tendencies" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('competitive_tendencies') == '2' ? 'checked' : '' }}
                                                    name="competitive_tendencies" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah perusahaan dan/atau industrinya adalah kelompok pembeli dominan bagi
                                                kelompok pemasok ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('dominant') == '1' ? 'checked' : '' }}
                                                    name="dominant" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('dominant') == '2' ? 'checked' : '' }}
                                                    name="dominant" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- Kekuatan Menawar Pembeli --}}
                                <table class="table table-bordered align-middle mb-3 table_nowrap">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="bg-soft-primary" colspan=3>Kekuatan Menawar Pembeli</th>
                                        </tr>
                                        <tr>
                                            <th class="th_pertanyaan">Pertanyaan</th>
                                            <th class="text-center th_dua">Ya</th>
                                            <th class="text-center th_dua">Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apakah tiap pembeli memberikan kontribusi yang besar terhadap total
                                                penjualan perusahaan ?</td>
                                            <td align="center">
                                                <input type="radio" {{ old('contribution') == '1' ? 'checked' : '' }}
                                                    name="contribution" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio" {{ old('contribution') == '2' ? 'checked' : '' }}
                                                    name="contribution" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah produk yang diinginkan oleh calon pembeli tidak berbeda
                                                jauh di antara pesaing-pesaing di dalam industri perusahaan ?</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('difference_desire') == '1' ? 'checked' : '' }}
                                                    name="difference_desire" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('difference_desire') == '2' ? 'checked' : '' }}
                                                    name="difference_desire" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah pembeli dapat dengan mudah berganti penjual tanpa
                                                konsekuensi tertentu seperti harga dan kualitas ?</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('customor_movement') == '1' ? 'checked' : '' }}
                                                    name="customor_movement" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('customor_movement') == '2' ? 'checked' : '' }}
                                                    name="customor_movement" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah pembeli sangat sensitif terhadap perubahan harga ?</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('price_sensitivity') == '1' ? 'checked' : '' }}
                                                    name="price_sensitivity" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('price_sensitivity') == '2' ? 'checked' : '' }}
                                                    name="price_sensitivity" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah calon pembeli lebih mementingkan kualitas daripada harga dalam
                                                pembelian ?</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('quality_than_price') == '1' ? 'checked' : '' }}
                                                    name="quality_than_price" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('quality_than_price') == '2' ? 'checked' : '' }}
                                                    name="quality_than_price" value="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apakah ada kecenderungan bagi pembeli masuk ke dalam industri perusahaan
                                                untuk bersaing langsung ?</td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('trend_competition') == '1' ? 'checked' : '' }}
                                                    name="trend_competition" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="radio"
                                                    {{ old('trend_competition') == '2' ? 'checked' : '' }}
                                                    name="trend_competition" value="2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- geolocation --}}
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
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div>
        </div>
    </div>

    <script>
        @if ($dataAnswer)
            let dataAnswer = @json($dataAnswer);

            // console.log(typeof(dataAnswer.buyer) == "object" && ('awjdioawjdoiawj'));
            // console.log(typeof(dataAnswer.any_competitor) == "boolean" && ('awjdioawjdoiawj'));
            for (var key in dataAnswer) {
                if (dataAnswer.hasOwnProperty(key)) {
                    const inputs = document.querySelectorAll(`input[name="${key}"]`);
                    if (typeof(dataAnswer[key]) == "boolean") {
                        for (var i = 0; i < inputs.length; i++) {
                            if (inputs[i].value == (dataAnswer[key] ? '1' : '2')) {
                                inputs[i].checked = true;
                            }
                        }
                    } else if (typeof(dataAnswer[key]) == "object") {
                        for (var i = 0; i < inputs.length; i++) {
                            inputs[i].value = dataAnswer[key].join(', ');
                        }
                    }
                }
            }

            const form = document.getElementById('form_body')
            const radioButtons = form.querySelectorAll('input[type="radio"]');
            const texts = form.querySelectorAll('input[type="text"]');

            radioButtons.forEach((radioButton) => {
                radioButton.disabled = true;
            });

            texts.forEach((input) => {
                input.readOnly = true
            })
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
