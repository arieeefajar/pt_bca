@extends('layout1.app')
@section('title', 'Form Potensi Lahan')
@section('menu', 'Potensi Lahan')
@section('submenu', 'Form Survey')

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
                            <a class="nav-link active" id="perbandingan-tab" data-bs-toggle="tab"
                                href="#karakteristik-varietas" role="tab" aria-selected="true">
                                Karakteristik Varietas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="keunggulan-tab" data-bs-toggle="tab" href="#musim-tanam" role="tab"
                                aria-selected="false">
                                Musim Tanam
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <form action="{{ route('formPotensiLahan.create') }}" method="POST" id="myForm">
                        @csrf
                        <div class="tab-content text-muted">
                            <div class="tab-pane fade show active" id="karakteristik-varietas" role="tabpanel"
                                aria-labelledby="perbandingan-tab" style="margin-bottom: 20px;"><br>
                                <div class="content col">
                                    <label class="form-label">Standar Keunggulan Umum</label>
                                    {{-- <input type="text" class="form-control" required name="keunggulan_umum"
                                        id="keunggulan_umum"> --}}
                                    <textarea class="form-control" name="keunggulan_umum" id="keunggulan_umum" cols="30" rows="5" required></textarea>
                                </div>
                                <div class="content col"><br>
                                    <label class="form-label">Keunggulan Produk Kita</label>
                                    {{-- <input type="text" class="form-control" required name="keunggulan_produk"
                                        id="keunggulan_produk"> --}}
                                    <textarea class="form-control" name="keunggulan_produk" id="keunggulan_produk" cols="30" rows="5" required></textarea>
                                </div>
                                <div class="content col"><br>
                                    <label class="form-label">Keunggulan Kompetitor</label>
                                    {{-- <input type="text" class="form-control" required name="keunggulan_kompetitor"
                                        id="keunggulan_kompetitor"> --}}
                                    <textarea class="form-control" name="keunggulan_kompetitor" id="keunggulan_kompetitor" cols="30" rows="5"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="musim-tanam" role="tabpanel" aria-labelledby="keunggulan-tab">
                                <br>
                                <div class="row mb-3">
                                    <div class="content col">
                                        <label class="form-label">Iklim</label>
                                        {{-- <input type="text" class="form-control" required name="iklim" id="iklim"> --}}
                                        <textarea class="form-control" name="iklim" id="iklim" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="content col">
                                        <label class="form-label">Event pasar atau perayaan</label>
                                        {{-- <input type="text" class="form-control" required name="event" id="event"> --}}
                                        <textarea class="form-control" name="event" id="evet" cols="30" rows="5" required></textarea>
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
            // alert('aowkoakwokwa');
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
