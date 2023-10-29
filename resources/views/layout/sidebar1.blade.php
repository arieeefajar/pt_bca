<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('surveyor.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <!-- <img src="{{ asset('admin_assets/assets/images/logo-sm.png') }}" alt="" height="22"> -->
                <img src="{{ asset('admin_assets/assets/images/logosimi.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <!-- <img src="{{ asset('admin_assets/assets/images/logo-dark.png') }}" alt="" height="17"> -->
                <img src="{{ asset('admin_assets/assets/images/logosimi1.png') }}" alt="" height="100"
                    width="100">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('surveyor.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <!-- <img src="{{ asset('admin_assets/assets/images/logo-sm.png') }}" alt="" height="22"> -->
                <img src="{{ asset('admin_assets/assets/images/logosimi.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <!-- <img src="{{ asset('admin_assets/assets/images/logo-light.png') }}" alt="" height="17"> -->
                <img src="{{ asset('admin_assets/assets/images/logosimi1.png') }}" alt="" height="100"
                    width="100">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            @php
                $selectedTokoId = request()->cookie('selectedTokoId');
                $kategoriToko = request()->cookie('kategoriToko');
            @endphp
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                @if (is_null($selectedTokoId))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('surveyor.dashboard') }}" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                        </a>
                    </li>
                @endif

                @if ($kategoriToko == 'lahan_petani')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarApps1" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarApps">
                            <i class="ri-survey-line"></i> <span data-key="t-apps">Form Survey</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarApps1">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('formPotensiLahan.index') }}" class="nav-link">Potensi Lahan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('formPesaing.index') }}" class="nav-link">Pesaing</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @else
                    @if (!is_null($selectedTokoId))
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-file-text-line"></i> <span data-key="t-apps">Kuisioner</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    @if ($kategoriToko == 'petani_pengguna')
                                        <li class="nav-item">
                                            <a href="{{ route('kepuasanPelanggan.index') }}" class="nav-link">Kepuasan
                                                Pelanggan</a>
                                        </li>
                                    @elseif ($kategoriToko == 'kios' || $kategoriToko == 'master_dealer' || $kategoriToko == 'dealer')
                                        <li class="nav-item">
                                            <a href="{{ route('analisisPesaing.index') }}" class="nav-link">Analisis
                                                Pesaing</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('KekuatanDanKelemahanPesaing.index') }}"
                                                class="nav-link">Kekuatan
                                                dan Kelemahan Pesaing</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('SkalaPasarProduk.index') }}" class="nav-link">Skala
                                                Pasar
                                                Produk</a>
                                        </li>
                                    @else
                                    @endif
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps1" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-survey-line"></i> <span data-key="t-apps">Form Survey</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps1">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('formPotensiLahan.index') }}" class="nav-link">Potensi
                                            Lahan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('formPesaing.index') }}" class="nav-link">Pesaing</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
