@extends('layout.app')
@section('title', 'Laporan')
@section('menu', 'Laporan')
@section('submenu', 'Menu')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Penilaian Pelanggan / {{ $location_name }}</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="table-search">
                        <div class="mb-3">
                            <label class="form-label">Pilih Kuisioner</label>
                            <!-- Select -->
                            <div class="input-group">
                                <select class="form-select" id="kuisioner" onchange="showjawaban(this)">
                                    <option value="" selected disabled>Pilih...</option>
                                    <option value="customer">Kepuasan Pelanggan</option>
                                    {{-- <option value="competitor-analys">Analisis Pesaing</option> --}}
                                    <option value="competitor-identifier">Kekuatan Kelemahan Pesaing
                                    </option>
                                    {{-- <option value="competitor-questionnaire">Skala Pasar Produk</option> --}}
                                    {{-- @foreach ($dataKuisioner as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">

                            {{-- table kepuasan --}}
                            <table class="table table-bordered table-nowrap" id="kepuasanPelanggan" style="display: none">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Pertanyaan</th>
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($customer_data) > 0)
                                        @php
                                            $num = 1;
                                        @endphp
                                        @foreach ($customer_data['penilaian_pelanggan'] as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ $num }}</td>
                                                <td class="text-center text-capitalize">{{ Str::replace('_', ' ', $key) }}
                                                </td>
                                                <td class="text-center">{{ isset($item['1']) ? $item['1'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['2']) ? $item['2'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['3']) ? $item['3'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['4']) ? $item['4'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['5']) ? $item['5'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['total']) ? $item['total'] : '0' }}
                                                </td>
                                            </tr>
                                            @php
                                                $num++;
                                            @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            {{-- table kekuatan kelemahan --}}
                            <table class="table table-bordered table-nowrap" id="kekuatanKelemahan" style="display: none">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Pertanyaan</th>
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($competitor_identifier_data) > 0)
                                        @php
                                            $num = 1;
                                        @endphp
                                        @foreach ($competitor_identifier_data['penilaian_pelanggan'] as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ $num }}</td>
                                                <td class="text-center text-capitalize">{{ Str::replace('_', ' ', $key) }}
                                                </td>
                                                <td class="text-center">{{ isset($item['1']) ? $item['1'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['2']) ? $item['2'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['3']) ? $item['3'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['4']) ? $item['4'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['5']) ? $item['5'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['total']) ? $item['total'] : '0' }}
                                                </td>
                                            </tr>
                                            @php
                                                $num++;
                                            @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Perhitungan Aspek Index / {{ $location_name }}</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="table-search">
                        <div class="table-responsive">
                            {{-- aspek kepuasan --}}
                            <table class="table table-bordered table-nowrap" id="aspekKepuasan" style="display: none">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Pertanyaan</th>
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Index</th>
                                        <th class="text-center">Kepuasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($customer_data) > 0)
                                        @php
                                            $num = 1;
                                        @endphp
                                        @foreach ($customer_data['perhitungan_index_aspek'] as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ $num }}</td>
                                                <td class="text-center text-capitalize">{{ Str::replace('_', ' ', $key) }}
                                                </td>
                                                <td class="text-center">{{ isset($item['1']) ? $item['1'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['2']) ? $item['2'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['3']) ? $item['3'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['4']) ? $item['4'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['5']) ? $item['5'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['total']) ? $item['total'] : '0' }}
                                                </td>
                                                <td class="text-center">{{ isset($item['index']) ? $item['index'] : '0' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ isset($item['kepuasan']) ? $item['kepuasan'] : '0' }}</td>
                                            </tr>
                                            @php
                                                $num++;
                                            @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            {{-- aspek kekuatan kelemahan --}}
                            <table class="table table-bordered table-nowrap" id="aspekKekuatanKelemahan"
                                style="display: none">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Pertanyaan</th>
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Index</th>
                                        <th class="text-center">Kepuasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($competitor_identifier_data) > 0)
                                        @php
                                            $num = 1;
                                        @endphp
                                        @foreach ($competitor_identifier_data['perhitungan_index_aspek'] as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ $num }}</td>
                                                <td class="text-center text-capitalize">{{ Str::replace('_', ' ', $key) }}
                                                </td>
                                                <td class="text-center">{{ isset($item['1']) ? $item['1'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['2']) ? $item['2'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['3']) ? $item['3'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['4']) ? $item['4'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['5']) ? $item['5'] : '0' }}</td>
                                                <td class="text-center">{{ isset($item['total']) ? $item['total'] : '0' }}
                                                </td>
                                                <td class="text-center">{{ isset($item['index']) ? $item['index'] : '0' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ isset($item['kepuasan']) ? $item['kepuasan'] : '0' }}</td>
                                            </tr>
                                            @php
                                                $num++;
                                            @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('otherJs')
    <script>
        $(document).ready(function() {
            var table1 = document.getElementById('kepuasanPelanggan');;
            var table2 = document.getElementById('kekuatanKelemahan');
            var table3 = document.getElementById('aspekKepuasan');
            var table4 = document.getElementById('aspekKekuatanKelemahan');

            table1.style.display = 'table';
            table3.style.display = 'table';
            table2.style.display = 'none';
            table4.style.display = 'none';

            $('#kuisioner').val('customer');
        });

        function showjawaban(idJawaban) {
            var value = idJawaban.value;
            var table1 = document.getElementById('kepuasanPelanggan');;
            var table2 = document.getElementById('kekuatanKelemahan');
            var table3 = document.getElementById('aspekKepuasan');
            var table4 = document.getElementById('aspekKekuatanKelemahan');
            // console.log(value);

            if (value == 'customer') {
                table1.style.display = 'table';
                table3.style.display = 'table';
                table2.style.display = 'none';
                table4.style.display = 'none';
            } else {
                table2.style.display = 'table';
                table4.style.display = 'table';
                table1.style.display = 'none';
                table3.style.display = 'none';
            }
        }
    </script>
@endsection
