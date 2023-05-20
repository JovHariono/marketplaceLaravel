<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a href="/home">
            <img src="{{ asset('argon') }}/img/brand/LogoCM.png" style="width: 180px; height: 70px;" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <!-- <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a> -->
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('home*') ? 'active' : '' }}" href="{{ url('/home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>
            <!-- <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Laravel Examples') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Master</h6>
            <ul class="navbar-nav">
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon" href="#" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ni ni-app text-primary"></i><span class="nav-link-text">Master Wilayah</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                        <a class="dropdown-item {{ request()->is('admin/provinsi*') ? 'active' : '' }}" href="{{ url('admin/provinsi') }}"><i class="fas fa-users text-primary"></i><span class="nav-link-text">Provinsi</span></a>
                        <a class="dropdown-item {{ request()->is('admin/kabupaten*') ? 'active' : '' }}" href="{{ url('admin/kabupaten') }}"><i class="ni ni-hat-3 text-primary"></i><span class="nav-link-text">Kabupaten / Kota</span></a>
                        <a class="dropdown-item {{ request()->is('admin/report/pembayaran*') ? 'active' : '' }}" href="{{ url('admin/report/pembayaran') }}"><i class="fas fa-money-bill-wave text-primary"></i><span class="nav-link-text">kecamatan</span></a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="ni ni-planet text-blue"></i>
                        <span class="nav-link-text">User</span>
                    </a>
                </li> -->
                @if (Auth::user()->level_id == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/category*') ? 'active' : '' }}"
                            href="{{ url('/admin/category') }}">
                            <i class="far fa-newspaper text-blue"></i>Category
                        </a>
                    </li>
                @endif

                @if (Auth::user()->level_id == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/artikel*') ? 'active' : '' }}"
                            href="{{ url('/admin/artikel') }}">
                            <i class="far fa-newspaper text-blue"></i>Artikel
                        </a>
                    </li>
                @endif

                @if (Auth::user()->level_id == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/kelas*') ? 'active' : '' }}"
                            href="{{ url('/admin/kelas') }}">
                            <i class="fas fa-book text-blue"></i>Kelas
                        </a>
                    </li>
                @endif

                @if (Auth::user()->level_id == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/report*') ? 'active' : '' }}"
                            href="{{ url('/admin/report') }}">
                            <i class="fas fa-book text-blue"></i>Report Pembayaran
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/list-kelas*') ? 'active' : '' }}"
                        href="{{ url('/siswa/list-kelas') }}">
                        <i class="fas fa-list text-blue"></i>List Kelas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/pembayaran*') ? 'active' : '' }}"
                        href="{{ url('/siswa/pembayaran') }}">
                        <i class="fas fa-list text-blue"></i>Pembayaran
                    </a>
                </li>

                @if (Auth::user()->level_id == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/role-akses*') ? 'active' : '' }}"
                            href="{{ url('/admin/role-akses') }}">
                            <i class="far fa-newspaper text-blue"></i>Role Akses
                        </a>
                    </li>
                @endif

                <!-- <li class="nav-item">
                    <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                        <i class="fas fa-briefcase text-primary"></i>
                        <span class="nav-link-text" >Management Front End</span>
                    </a>

                    <div class="collapse" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/jenis_konten*') ? 'active' : '' }}" href="{{ url('/admin/jenis_konten') }}">
                                    <span class="nav-link-text">Jenis Konten</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/group*') ? 'active' : '' }}" href="{{ url('/admin/group') }}">
                                    Konten MDD
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void" onclick="document.getElementById('logout').submit();">
                        <i class="ni ni-user-run text-primary"></i>
                        <span class="nav-link-text">Keluar</span>
                    </a>
                </li>
                <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</nav>
