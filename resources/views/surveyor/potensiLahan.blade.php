@extends('layout1.app')
@section('title', 'Form Potensi Lahan')
@section('menu', 'Potensi Lahan')
@section('submenu', 'Form Survey')

@section('content')
    {{-- @push('styles')
<link href="{{ asset('admin_assets/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
@endpush --}}
    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="perbandingan-tab" data-bs-toggle="tab" href="#perbandingan-produk"
                                role="tab" aria-selected="true">
                                Karakteristik Varietas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="keunggulan-tab" data-bs-toggle="tab" href="#keunggulan-kompetitif"
                                role="tab" aria-selected="false">
                                Musim Tanam
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <form action="{{ route('formPotensiLahan.create') }}" method="POST" id="myForm">
                        @csrf
                        <div class="tab-content text-muted">
                            <div class="tab-pane fade show active" id="perbandingan-produk" role="tabpanel"
                                aria-labelledby="perbandingan-tab" style="margin-bottom: 20px;"><br>
                                <div class="content col">
                                    <label class="form-label">Standar Keunggulan Umum</label>
                                    <input type="text" class="form-control" required name="keunggulan_umum"
                                        id="keunggulan_umum">
                                </div>
                                <div class="content col"><br>
                                    <label class="form-label">Keunggulan Produk Kita</label>
                                    <input type="text" class="form-control" required name="keunggulan_produk"
                                        id="keunggulan_produk">
                                </div>
                                <div class="content col"><br>
                                    <label class="form-label">Keunggulan Kompetitor</label>
                                    <input type="text" class="form-control" required name="keunggulan_kompetitor"
                                        id="keunggulan_kompetitor">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="keunggulan-kompetitif" role="tabpanel"
                                aria-labelledby="keunggulan-tab"> <br>
                                <div class="row">
                                    <div class="content col">
                                        <label class="form-label">Iklim</label>
                                        <input type="text" class="form-control" required name="iklim" id="iklim">
                                    </div><br>
                                    <div class="content col">
                                        <label class="form-label">Event pasar atau perayaan</label>
                                        <input type="text" class="form-control" required name="event" id="event">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="latitude" id="latitude_field">
                        <input type="hidden" name="longitude" id="longitude_field">

                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-primary" onclick="submit_form()">Submit</button>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!--end col-->
    </div>
    {{-- @push('scripts')
        <script src="{{ asset('admin_assets/assets/js/script.js') }}"></script>
    @endpush --}}
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
        }
    </script>
@endsection
