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
                            <li><a href="#" class="slide-item"> Transkrip Akademik</a></li>
                            <li><a href="cards.html" class="slide-item"> Riwayat IP</a></li>
                            <li><a href="{{route('schedule.index')}}" class="slide-item"> Jadwal Kuliah</a></li>
                            <li><a href="{{route('absent.index')}}" class="slide-item"> Presensi Kuliah</a></li>
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
