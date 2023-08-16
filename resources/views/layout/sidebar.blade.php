<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin_assets/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin_assets/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin_assets/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin_assets/assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                @if(Auth::user()->role == 'supper-admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('superAdmin.dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                @elseif(Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('superAdmin.dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                @elseif(Auth::user()->role == 'executive')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('superAdmin.dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role != 'executive')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Master</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->role == 'supper-admin')
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link"> <i class="ri-user-line"></i>User</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('jenisKuisioner.index') }}" class="nav-link" data-key="t-chat"> <i class="ri-honour-line"></i>Jenis Kuisioner</a>
                            </li>
                            <li class="nav-item">
                                <a href={{ route('kuisioner.index') }} class="nav-link" data-key="t-mailbox"> <i class="ri-file-3-line"></i><span><span></span>Kuisioner</a>
                            </li>
                            <li class="nav-item">
                                <a href={{ route('detailKuisioner.index') }} class="nav-link" data-key="t-ecommerce"> <i class="ri-file-text-line"></i>Detail Kuisioner</a>
                            </li>
                            <li class="nav-item">
                                <a  href={{ route('perusahaan.index') }} class="nav-link" data-key="t-projects"> <i class="ri-home-3-line"></i>Perusahaan</a>
                            </li>
                            <li class="nav-item">
                                <a href={{ route('posisi.index') }} class="nav-link" data-key="t-tasks"> <i class="ri-vip-crown-line"></i>Posisi</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('penyimpanan.index') }}">
                        <i class="ri-database-2-line"></i> <span data-key="t-layouts">Penyimpanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('laporan.index') }}">
                        <i class="bx bxs-report"></i><span data-key="t-tables">Laporan</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
