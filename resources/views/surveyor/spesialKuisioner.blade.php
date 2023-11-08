@extends('layout1.app')
@section('content')
    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Spesial Kuisioner</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            {{-- <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode"> --}}
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="javascript:void(0);">
                            <div class="row">
                                {{-- produk benih --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Produk Benih</label>
                                        <select id="" class="form-select" data-choices data-choices-sorting="true">
                                            <option selected disabled>Pilih produk benih</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Pangan --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Pangan</label>
                                        <select id="" class="form-select" data-choices data-choices-sorting="true">
                                            <option selected disabled>Pilih pangan</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Jagung Hibrida --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Jagung Hibrida</label>
                                        <select id="" class="form-select" data-choices data-choices-sorting="true">
                                            <option selected disabled>Pilih jagung hibrida</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Padi --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Padi</label>
                                        <select id="" class="form-select" data-choices data-choices-sorting="true">
                                            <option selected disabled>Pilih padi</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Padi Hibrida --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Padi Hibrida</label>
                                        <select id="" class="form-select" data-choices data-choices-sorting="true">
                                            <option selected disabled>Pilih padi hibrida</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Padi Inhibrida --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Padi Inhibrida</label>
                                        <select id="" class="form-select" data-choices data-choices-sorting="true">
                                            <option selected disabled>Pilih padi inhibrida</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- end pangan --}}

                                {{-- Hortikultura --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Hortikultura</label>
                                        <select id="" class="form-select" data-choices data-choices-sorting="true">
                                            <option selected disabled>Pilih hortikultura</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Buah Semusim --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Buah Semusim</label>
                                        <select id="" class="form-select" data-choices data-choices-sorting="true">
                                            <option selected disabled>Pilih buah semusim</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Cabai --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Cabai</label>
                                        <select id="" class="form-select" data-choices data-choices-sorting="true">
                                            <option selected disabled>Pilih cabai</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Cabai Besar --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Cabai Besar</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih cabai besar</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Cabai Rawit --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Cabai Rawit</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih cabai rawit</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Cabai Keriting --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Cabai Keriting</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih cabai keriting</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- end cabai --}}

                                {{-- Jagung Manis --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Jagung Manis</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih jagung manis</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Kacang Panjang --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Kacang Panjang</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih kacang panjang</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Oyong --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Oyong</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih oyong</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Labu --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Labu</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih labu</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Mentimun --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Mentimun</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih mentimun</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Paria --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Paria</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih paria</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Blewah --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Blewah</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih paria</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Melon --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Melon</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih melon</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Tomat --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Tomat</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih tomat</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Labu Air --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Labu Air</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih labu air</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Buncis --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Buncis</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih buncis</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Ciplukan --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Ciplukan</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih ciplukan</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Okra --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Okra</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih ciplukan</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Pepaya --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Pepaya</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih pepaya</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Waluh --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Waluh</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih waluh</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Zuccini --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Zuccini</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih zuccini</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- end buah semusim --}}

                                {{-- Sayur Semisim --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sayur Semisim</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih sayur semusim</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Selada --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Selada</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih selada</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Sawi --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sawi</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih sawi</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Sawi Hijau --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sawi Hijau</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih sawi hijau</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Sawi Pahit --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sawi Pahit</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih sawi pahit</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- end sawi --}}

                                {{-- Kangkung --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Kangkung</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih kangkung</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Bayam --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Bayam</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih bayam</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Kabocha --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Kabocha</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih kabocha</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Kailan --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Kailan</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih kailan</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Pak Coy --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Pak Coy</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih pak coy</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Kubis --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Kubis</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih kubis</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Seledri --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Seledri</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih seledri</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Bawang Daun --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Bawang Daun</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih bawang daun</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Bawang Merah --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Bawang Merah</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih bawang merah</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- end sayur semusim --}}

                                {{-- Bunga --}}
                                <div class="col-md-12" style="display: none">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Bunga</label>
                                        <select id="" class="form-select" data-choices
                                            data-choices-sorting="true">
                                            <option selected disabled>Pilih bunga</option>
                                            <option value="contoh">contoh</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- end bunga --}}

                                {{-- Lainya --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Lainya</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                {{-- end lainya --}}

                                {{-- button --}}
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div><!--end row-->
@endsection
