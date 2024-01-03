<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>Sistem Informasi Akademik Darus Sunnah - SIADS</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- JQUERY JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex align-items-center">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                            href="javascript:void(0);"></a>
                        <div class="responsive-logo">
                            <a href="index.html" class="header-logo">
                                <img src="{{ asset('images/logo.png') }}" class="mobile-logo logo-1" alt="logo">
                                <img src="{{ asset('images/logo.png') }}" class="mobile-logo dark-logo-1"
                                    alt="logo">
                            </a>
                        </div>
                        <!-- sidebar-toggle-->
                        <a class="logo-horizontal " href="index.html">
                            <img src="{{ asset('images/logo.png') }}" class="header-brand-img desktop-logo"
                                alt="logo">
                            <img src="{{ asset('images/logo.png') }}" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <!-- LOGO -->
                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <!-- SEARCH -->
                            <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                                aria-controls="navbarSupportedContent-4" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon fe fe-more-vertical text-dark"></span>
                            </button>
                            <div class="navbar navbar-collapse responsive-navbar p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex order-lg-2">
                                        <div class="dropdown d-md-flex profile-1">
                                            <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                class="nav-link leading-none d-flex px-1">
                                                <span>
                                                    <img src="{{ asset('images/users/8.jpg') }}" alt="profile-user"
                                                        class="avatar  profile-user brround cover-image">
                                                </span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading">
                                                    <div class="text-center">
                                                        <h5 class="text-dark mb-0">Nama Admin</h5>
                                                        <small class="text-muted">Administrator</small>
                                                    </div>
                                                </div>
                                                <div class="dropdown-divider m-0"></div>
                                                <a class="dropdown-item" href="profile.html">
                                                    <i class="dropdown-icon fe fe-user"></i> Profile
                                                </a>
                                                <a class="dropdown-item" href="email.html">
                                                    <i class="dropdown-icon fe fe-mail"></i> Notification
                                                    <span class="badge bg-secondary float-end">3</span>
                                                </a>
                                                <a class="dropdown-item" href="emailservices.html">
                                                    <i class="dropdown-icon fe fe-settings"></i> Settings
                                                </a>
                                                <a class="dropdown-item" href="login.html">
                                                    <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <aside class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="index.html">
                            <img src="{{ asset('images/logo.png') }}" class="header-brand-img desktop-logo"
                                alt="logo">
                            <img src="{{ asset('images/logo-1.png') }}" class="header-brand-img toggle-logo"
                                alt="logo">
                            <img src="{{ asset('images/logo-2.png') }}" class="header-brand-img light-logo"
                                alt="logo">
                            <img src="{{ asset('images/logo.png') }}" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3></h3>
                            </li>

                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide"
                                    href="{{ route('dashboard.index') }}"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Dashboard</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Data
                                        Master</span><i class="angle fa fa-angle-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Data Master</a></li>
                                    <li><a href="{{ route('mahasantri.index') }}" class="slide-item"> Mahasantri</a>
                                    </li>
                                    <li><a href="{{ route('dosen.index') }}" class="slide-item"> Dosen</a></li>
                                    <li><a href="{{ route('mata-kuliah.index') }}" class="slide-item"> Mata
                                            Kuliah</a>
                                    </li>
                                    <li><a href="{{ route('kelas.index') }}" class="slide-item"> Kelas</a>
                                    </li>
                                    <li><a href="cards.html" class="slide-item"> Transkrip Akademik</a></li>
                                    <li><a href="cards.html" class="slide-item"> Riwayat IP</a></li>
                                    <li><a href="cards.html" class="slide-item"> Jadwal Kuliah</a></li>
                                    <li><a href="cards.html" class="slide-item"> Presensi Kuliah</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide"
                                    href="{{ route('akademik.index') }}"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Akademik</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item" href="widgets.html"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Pembayaran</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Wisuda</span><i
                                        class="angle fa fa-angle-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Components</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="side-menu__item" href="widgets.html"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Evaluasi</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item" href="widgets.html"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Notifikasi</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item" href="widgets.html"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Pengaturan</span></a>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                </aside>
            </div>
            {{-- <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <aside class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="index.html">
                            <img src="{{ asset('images/logo.png') }}" class="header-brand-img desktop-logo"
                                alt="logo">
                            <img src="{{ asset('images/logo-1.png') }}" class="header-brand-img toggle-logo"
                                alt="logo">
                            <img src="{{ asset('images/logo-2.png') }}" class="header-brand-img light-logo"
                                alt="logo">
                            <img src="{{ asset('images/logo.png') }}" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3></h3>
                            </li>

                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide"
                                    href="{{ route('dashboard.index') }}"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Dashboard</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Perkuliahan</span><i
                                        class="angle fa fa-angle-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Perkuliahan</a></li>
                                    <li><a href="{{ route('dosen.index') }}" class="slide-item"> Dosen</a></li>
                                    <li><a href="{{ route('mata-kuliah.index') }}" class="slide-item"> Mata
                                            Kuliah</a>
                                    </li>
                                    <li><a href="cards.html" class="slide-item"> Penilaian</a></li>
                                    <li><a href="cards.html" class="slide-item"> Transkrip Akademik</a></li>
                                    <li><a href="cards.html" class="slide-item"> Riwayat IP</a></li>
                                    <li><a href="cards.html" class="slide-item"> Jadwal Kuliah</a></li>
                                    <li><a href="cards.html" class="slide-item"> Presensi Kuliah</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide"
                                    href="{{ route('akademik.index') }}"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Akademik</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item" href="widgets.html"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Pembayaran</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Wisuda</span><i
                                        class="angle fa fa-angle-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Components</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="side-menu__item" href="widgets.html"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Evaluasi</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item" href="widgets.html"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Notifikasi</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item" href="widgets.html"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Pengaturan</span></a>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                </aside>
            </div> --}}
            <!--/APP-SIDEBAR-->

            @yield('content')

            <!-- FOOTER -->
            <footer class="footer">
                <div class="container">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-md-12 col-sm-12 text-center">
                            Copyright © <span id="year">2023</span> <a
                                href="javascript:void(0);">Darus-sunnah</a>. Designed
                            by <a href="javascript:void(0);">
                                Brainwaves Digital
                            </a> All rights reserved
                        </div>
                    </div>
                </div>
            </footer>
            <!-- FOOTER END -->
        </div>

        <!-- BACK-TO-TOP -->
        <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

        <!-- BOOTSTRAP JS -->
        <script src="{{ asset('plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

        <!-- SPARKLINE JS-->
        <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>

        <!-- CHART-CIRCLE JS-->
        <script src="{{ asset('js/circle-progress.min.js') }}"></script>

        <!-- CHARTJS CHART JS-->
        <script src="{{ asset('plugins/chart/Chart.bundle.js') }}"></script>
        <script src="{{ asset('plugins/chart/utils.js') }}"></script>

        <!-- PIETY CHART JS-->
        <script src="{{ asset('plugins/peitychart/jquery.peity.min.js') }}"></script>
        <script src="{{ asset('plugins/peitychart/peitychart.init.js') }}"></script>

        <!-- INTERNAL SELECT2 JS -->
        <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>

        <!-- TIMEPICKER JS -->
		<script src="{{ asset('plugins/time-picker/jquery.timepicker.js') }}"></script>
		<script src="{{ asset('plugins/time-picker/toggles.min.js') }}"></script>

        <!-- ECHART JS-->
        <script src="{{ asset('plugins/echarts/echarts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- SIDE-MENU JS-->
        <script src="{{ asset('plugins/sidemenu/sidemenu.js') }}"></script>

        <!-- Sticky js -->
        <script src="{{ asset('js/sticky.js') }}"></script>

        <!-- SIDEBAR JS -->
        <script src="{{ asset('plugins/sidebar/sidebar.js') }}"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="{{ asset('plugins/p-scroll/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('plugins/p-scroll/pscroll.js') }}"></script>
        <script src="{{ asset('plugins/p-scroll/pscroll-1.js') }}"></script>

        <!-- APEXCHART JS -->
        <script src="{{ asset('js/apexcharts.js') }}"></script>


        <!-- Color Theme js -->
        <script src="{{ asset('js/themeColors.js') }}"></script>

        <!-- swither styles js -->
        <script src="{{ asset('js/swither-styles.js') }}"></script>

        <!-- CUSTOM JS -->
        <script src="{{ asset('js/custom.js') }}"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        @stack('custom')
</body>

</html>
