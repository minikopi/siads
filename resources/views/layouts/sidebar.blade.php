<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="index.html">
                <img src="{{ asset('images/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ asset('images/logo-1.png') }}" class="header-brand-img toggle-logo" alt="logo">
                <img src="{{ asset('images/logo-2.png') }}" class="header-brand-img light-logo" alt="logo">
                <img src="{{ asset('images/logo.png') }}" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3></h3>
                </li>

                <li class="slide">
                    <a class="side-menu__item  {{ request()->is('dashboard') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{ route('dashboard.index') }}"><i class="side-menu__icon fe fe-home"></i><span
                            class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('master*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('master*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Data
                            Master</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Data Master</a></li>
                        @if (Auth::user()->role != 'Mahasantri')
                            <li><a href="{{ route('mahasantri.index') }}"
                                    class="slide-item {{ request()->is('master/mahasantri') ? 'active' : '' }}">
                                    Mahasantri</a>
                            </li>
                            <li><a href="{{ route('dosen.index') }}"
                                    class="slide-item {{ request()->is('master/dosen') ? 'active' : '' }}"> Dosen</a>
                            </li>
                            <li><a href="{{ route('mata-kuliah.index') }}"
                                    class="slide-item {{ request()->is('master/mata-kuliah') ? 'active' : '' }}"> Mata
                                    Kuliah</a>
                            </li>
                            <li><a href="{{ route('kelas.index') }}"
                                    class="slide-item {{ request()->is('master/kelas') ? 'active' : '' }}"> Kelas</a>
                            </li>
                            <li><a href="#" class="slide-item"> Transkrip Akademik</a></li>
                            <li><a href="{{ route('ipk.index') }}"
                                    class="slide-item {{ request()->is('ipk') ? 'active' : '' }}"> Riwayat IP</a>
                            </li>
                        @endif
                        <li><a href="{{ Auth::user()->role == 'Mahasantri' ? route('schedule.detail', ['id' => Auth::user()->mahasantri->kelas_id]) : route('schedule.index') }}"
                                class="slide-item {{ request()->is('master/jadwal-kuliah') ? 'active' : '' }}"> Jadwal
                                Kuliah</a></li>
                        <li><a href="{{ Auth::user()->role == 'Mahasantri' ? route('absent.mahasantri.index') : route('absent.index') }}"
                                class="slide-item {{ request()->is('master/persensi*') ? 'active' : '' }}"> Presensi
                                Kuliah</a></li>
                        <li><a href="{{ Auth::user()->role == 'Mahasantri' ? route('score.mahasantri.index') : route('score.index') }}"
                                class="slide-item {{ request()->is('master/score*') ? 'active' : '' }}"> Penilaian</a>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item  {{ request()->is('akademik') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{ route('akademik.index') }}"><i class="side-menu__icon fe fe-grid"></i><span
                            class="side-menu__label">Akademik</span></a>
                </li>
                {{-- <li>
                    <a class="side-menu__item  {{ request()->is('pembayaran') ? 'active' : '' }}"
                        href="{{ route('pembayaran.index') }}"><i class="side-menu__icon fe fe-grid"></i><span
                            class="side-menu__label">Pembayaran</span></a>
                </li> --}}
                <li class="slide {{ request()->is('pembayaran*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('pembayaran*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Pembayaran</span><i
                            class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('paymentType.index') }}"
                                class="slide-item {{ request()->is('pembayaran/master') ? 'active' : '' }}">
                                Master Pembayaran</a>
                        </li>
                        <li><a href="{{ route('pembayaran.index') }}"
                                class="slide-item {{ request()->is('pembayaran/mahasiswa') ? 'active' : '' }}">
                                Pembayaran Mahasiswa</a>
                        </li>
                    </ul>
                </li>
                <li class="slide {{ request()->is('wisuda*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('wisuda*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Wisuda</span><i
                            class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('sidang.index') }}"
                                class="slide-item {{ request()->is('wisuda/mahasantri') ? 'active' : '' }}">
                                Daftar Sidang</a>
                        </li>
                        <li><a href="{{ route('wisuda.index') }}"
                                class="slide-item {{ request()->is('wisuda/dosen') ? 'active' : '' }}"> Daftar
                                Wisuda</a></li>
                        <li><a href="{{ route('prestasi.index') }}"
                                class="slide-item {{ request()->is('wisuda/mata-kuliah') ? 'active' : '' }}"> Upload
                                Prestasi Akademik</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="side-menu__item" href="widgets.html"><i class="side-menu__icon fe fe-grid"></i><span
                            class="side-menu__label">Evaluasi</span></a>
                </li>
                <li>
                    <a class="side-menu__item" href="widgets.html"><i class="side-menu__icon fe fe-grid"></i><span
                            class="side-menu__label">Notifikasi</span></a>
                </li>
                <li>
                    <a class="side-menu__item" href="widgets.html"><i class="side-menu__icon fe fe-grid"></i><span
                            class="side-menu__label">Pengaturan</span></a>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </aside>
</div>
