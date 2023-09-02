@extends('layout1.app')
@section('title', 'Form Pesaing')
@section('menu', 'Pesaing')
@section('submenu', 'Menu')

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
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="perbandingan-tab" data-bs-toggle="tab" href="#perbandingan-produk"
                                role="tab" aria-selected="true">
                                Perbandingan Produk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="keunggulan-tab" data-bs-toggle="tab" href="#keunggulan-kompetitif"
                                role="tab" aria-selected="false">
                                Keunggulan Kompetitif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="aktivitas-tab" data-bs-toggle="tab" href="#aktivitas-pemasaran-pesaing"
                                role="tab" aria-selected="false">
                                Aktivitas Pemasaran Pesaing
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <form action="{{ route('formPesaing.create') }}" method="POST" id="myForm">
                        @csrf
                        <div class="tab-content text-muted">
                            <div class="tab-pane fade show active" id="perbandingan-produk" role="tabpanel"
                                aria-labelledby="perbandingan-tab" style="margin-bottom: 20px;"><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3"><label class="form-label">Produk Kami :</label>
                                            <select class="form-select mb-3" required name="produk_kita" id="produkSelect"
                                                onchange="updateSelectedDeskripsi()">
                                                <option value="" selected disabled>Pilih Produk</option>
                                                @foreach ($dataProduk as $value)
                                                    <option value="{{ $value->nama_produk }}"
                                                        data-deskripsi="{{ $value->nama_produk }}">
                                                        {{ $value->nama_produk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <textarea class="form-control" required name="deskripsi_produk" id="" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Produk Pesaing</label>
                                            <input type="text" name="produk_pesaing" class="form-control" required
                                                placeholder="Masukan nama produk pesaing">
                                        </div>
                                        <textarea class="form-control" name="deskripsi_produk_pesaing" id="" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button class="btn btn-primary" id="next-tab">Next</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="keunggulan-kompetitif" role="tabpanel"
                                aria-labelledby="keunggulan-tab"> <br>
                                <div class="row">
                                    <div class="content col">
                                        <label class="form-label">Apa saja keunggulan pesaing :</label>
                                        {{-- <input type="text" class="form-control" name="keunggulan_pesaing" id=""
                                            required> --}}
                                        <textarea class="form-control" name="keunggulan_pesaing" id="" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button class="btn btn-primary" id="next-tab">Next</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="aktivitas-pemasaran-pesaing" role="tabpanel"
                                aria-labelledby="aktivitas-tab"><br>
                                <div class="row">
                                    <div class="content col">
                                        <label class="form-label">Apa saja aktivitas pemasaran pesaing :</label>
                                        {{-- <input type="text" class="form-control" name="pemasaran_pesaing" id=""
                                            required> --}}
                                        <textarea class="form-control" name="pemasaran_pesaing" id="" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-primary" onclick="submit_form()">Submit</button>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="latitude" id="latitude_field">
                        <input type="hidden" name="longitude" id="longitude_field">
                    </form>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!--end col-->
    </div>

    <script>
        const produkSelect = document.getElementById('produkSelect');

        function updateSelectedDeskripsi() {
            var selectedOption = produkSelect.options[produkSelect.selectedIndex];
            var deskripsiProduk = selectedOption.getAttribute('data-deskripsi');

            console.log(deskripsiProduk);

            // selectedDeskripsiProduk.textContent = "Deskripsi Produk: " + deskripsiProduk;
        }

        // function getGeoLocation() {
        //     const successCallback = (position) => {
        //         console.log(position);
        //     };

        //     const errorCallback = (error) => {
        //         console.log(error);
        //     };

        //     navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        // }

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

                var form = document.getElementById('myForm');
                var inputs = form.querySelectorAll('input, select, textarea');
                var isValid = true;

                inputs.forEach(function(input) {
                    if (input.required && input.value.trim() === '') {
                        isValid = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (form) {
                    if (isValid) {
                        await form.submit();
                    }
                } else {
                    console.log("Form element not found.");
                }
            } catch (error) {
                console.log("Error:", error);
            }
        };

        // Tangkap tombol "Next" dengan menggunakan ID
        var nextButton = document.getElementById('next-tab');

        // Tambahkan event listener untuk mengatur tab berikutnya saat tombol diklik
        nextButton.addEventListener('click', function() {
            // Dapatkan tab aktif saat ini
            var activeTab = document.querySelector('.nav-link.active');

            // Temukan tab berikutnya dengan menggunakan nextElementSibling
            var nextTab = activeTab.nextElementSibling;

            // Jika ada tab berikutnya, pindahkan ke tab tersebut
            if (nextTab) {
                // Hapus kelas "active" dari tab aktif saat ini
                activeTab.classList.remove('active');

                // Tambahkan kelas "active" ke tab berikutnya
                nextTab.classList.add('active');

                // Dapatkan ID tab-pane yang sesuai dengan ID tab yang aktif
                var activeTabId = activeTab.getAttribute('aria-controls');
                var nextTabId = nextTab.getAttribute('aria-controls');

                // Sembunyikan tab-pane yang sesuai dengan tab aktif saat ini
                document.getElementById(activeTabId).classList.remove('show', 'active');

                // Tampilkan tab-pane yang sesuai dengan tab berikutnya
                document.getElementById(nextTabId).classList.add('show', 'active');
            }
        });
    </script>
@endsection
