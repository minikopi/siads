<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ url('/') }}">
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

                @role('admin')
                    <li class="slide {{ request()->is('master*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ request()->is('master*') ? 'active is-expanded' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Data
                                Master</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Data Master</a></li>
                            @if (Auth::user()->role != 'Mahasantri')
                                <li>
                                    <a href="{{ route('mahasantri.index') }}"
                                        class="slide-item {{ request()->is('master/mahasantri/*', 'master/mahasantri') ? 'active' : '' }}">
                                        Mahasantri</a>
                                </li>
                                <li>
                                    <a href="{{ route('dosen.index') }}"
                                        class="slide-item {{ request()->is('master/dosen') ? 'active' : '' }}">
                                        Dosen
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('mata-kuliah.index') }}"
                                        class="slide-item {{ request()->is('master/mata-kuliah') ? 'active' : '' }}">
                                        Mata Kuliah
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('academic-year.index') }}"
                                        class="slide-item {{ request()->is('master/academic-year*') ? 'active' : '' }}">
                                        Tahun Ajaran
                                    </a>
                                </li>
                                <li><a href="{{ route('kelas.index') }}"
                                        class="slide-item {{ request()->is('master/kelas') ? 'active' : '' }}"> Kelas</a>
                                </li>
                                {{-- <li><a href="#" class="slide-item"> Transkrip Akademik</a></li> --}}
                            @endif
                            @if (Auth::user()->role == 'Mahasantri')
                                <li>
                                    <a href="{{ route('ipk.index') }}"
                                        class="slide-item {{ request()->is('master/akademik') ? 'active' : '' }}">
                                        Riwayat IP
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ Auth::user()->role == 'Mahasantri' ? route('schedule.detail', ['id' => Auth::user()->mahasantri->kelas_id]) : route('schedule.index') }}"
                                    class="slide-item {{ request()->is('master/jadwal-kuliah') ? 'active' : '' }}">
                                    Jadwal Kuliah
                                </a>
                            </li>
                            <li>
                                <a href="{{ Auth::user()->role == 'Mahasantri' ? route('absent.mahasantri.index') : route('absent.index') }}"
                                    class="slide-item {{ request()->is('master/persensi*') ? 'active' : '' }}">
                                    Presensi Kuliah
                                </a>
                            </li>
                            <li>
                                <a href="{{ Auth::user()->role == 'Mahasantri' ? route('score.mahasantri.index') : route('score.index') }}"
                                    class="slide-item {{ request()->is('master/score*') ? 'active' : '' }}">
                                    Penilaian
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item  {{ request()->is('administrator/akademik*', 'administrator/edaran*') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="{{ route('administrator.akademik.index') }}">
                            <i class="side-menu__icon fe fe-grid"></i>
                            <span class="side-menu__label">Akademik</span>
                        </a>
                    </li>
                @endrole

                @role('dosen')
                    @php
                        $menuDosen = request()->is(
                            'dosen/dosen*',
                            'dosen/nilai*',
                            'dosen/musyrif*',
                            'dosen/jadwal-kuliah*',
                            'dosen/presensi*',
                            'dosen/ipk*',
                            'dosen/mata-kuliah*',
                            'dosen/transkrip-nilai*',
                        );
                    @endphp
                    <li class="slide {{ $menuDosen ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ $menuDosen ? 'active is-expanded' : '' }}" data-bs-toggle="slide"
                            href="javascript:void(0);">
                            <i class="side-menu__icon fe fe-grid"></i>
                            <span class="side-menu__label">Perkuliahan Dosen</span>
                            <i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li>
                                <a href="{{ route('dosen.dosen.index') }}"
                                    class="slide-item {{ request()->is('dosen/dosen*') ? 'active' : '' }}">
                                    Nama Dosen
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('dosen.mata-kuliah.index') }}"
                                    class="slide-item {{ request()->is('dosen/mata-kuliah*') ? 'active' : '' }}">
                                    Mata Kuliah
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('dosen.jadwal-kuliah.index') }}"
                                    class="slide-item {{ request()->is('dosen/jadwal-kuliah*') ? 'active' : '' }}">
                                    Jadwal Kuliah
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole

                @role('mahasantri')
                    @php
                        $menuMahasantri = request()->is(
                            'mahasantri/dosen*',
                            'mahasantri/nilai*',
                            'mahasantri/musyrif*',
                            'mahasantri/jadwal-kuliah*',
                            'mahasantri/presensi*',
                            'mahasantri/ipk*',
                            'mahasantri/mata-kuliah*',
                            'mahasantri/transkrip-nilai*',
                            'mahasantri/tahfidz*',
                        );
                    @endphp
                    <li class="slide {{ $menuMahasantri ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ $menuMahasantri ? 'active is-expanded' : '' }}" data-bs-toggle="slide"
                            href="javascript:void(0);">
                            <i class="side-menu__icon fe fe-grid"></i>
                            <span class="side-menu__label">Perkuliahan</span>
                            <i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li>
                                <a href="{{ route('mahasantri.dosen.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/dosen*') ? 'active' : '' }}">
                                    Nama Dosen
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('mahasantri.mata-kuliah.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/mata-kuliah*') ? 'active' : '' }}">
                                    Mata Kuliah
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('mahasantri.ipk.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/ipk*') ? 'active' : '' }}">
                                    Riwayat IP
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('mahasantri.nilai.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/nilai*') ? 'active' : '' }}">
                                    Penilaian
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('mahasantri.transkrip-nilai.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/transkrip-nilai*') ? 'active' : '' }}">
                                    Transkrip Nilai
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('mahasantri.jadwal.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/jadwal-kuliah*') ? 'active' : '' }}">
                                    Jadwal Kuliah
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('mahasantri.presensi.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/presensi*') ? 'active' : '' }}">
                                    Presensi Kuliah
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('mahasantri.tahfidz.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/tahfidz*') ? 'active' : '' }}">
                                    Data Tahfidz
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole

                {{-- <li>
                    <a class="side-menu__item  {{ request()->is('pembayaran') ? 'active' : '' }}"
                        href="{{ route('pembayaran.index') }}"><i class="side-menu__icon fe fe-grid"></i><span
                            class="side-menu__label">Pembayaran</span></a>
                </li> --}}

                @role('admin')
                    <li
                        class="slide {{ request()->is('pembayaran*', 'bendahara/payment-history*', 'bendahara/master-payment*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ request()->is('pembayaran*', 'bendahara/payment-history*', 'bendahara/master-payment*') ? 'active is-expanded' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Pembayaran</span><i
                                class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li>
                                <a href="{{ route('paymentType.index') }}"
                                    class="slide-item {{ request()->is('pembayaran/master/type*') ? 'active' : '' }}">
                                    Master Pembayaran
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pembayaran.ListSiswa') }}"
                                    class="slide-item {{ request()->is('pembayaran', 'pembayaran/*', 'bendahara/master-payment*') ? 'active' : '' }}">
                                    Pembayaran Mahasantri
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bendahara.payment-history.index') }}"
                                    class="slide-item {{ request()->is('bendahara/payment-history*') ? 'active' : '' }}">
                                    Data Transaksi
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole

                @role('mahasantri')
                    <li class="slide {{ request()->is('mahasantri/pembayaran*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ request()->is('mahasantri/pembayaran*') ? 'active is-expanded' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Pembayaran</span><i
                                class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li>
                                <a href="{{ route('mahasantri.pembayaran.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/pembayaran') ? 'active' : '' }}">
                                    Tagihan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mahasantri.pembayaran.riwayat.index') }}"
                                    class="slide-item {{ request()->is('mahasantri/pembayaran/riwayat') ? 'active' : '' }}">
                                    Riwayat
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole

                <li class="slide {{ request()->is('wisuda*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('wisuda*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Wisuda</span><i
                            class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('sidang.index') }}"
                                class="slide-item {{ request()->is('wisuda/sidang') ? 'active' : '' }}">
                                Daftar Sidang</a>
                        </li>
                        <li><a href="{{ route('wisuda.index') }}"
                                class="slide-item {{ request()->is('wisuda/wisuda') ? 'active' : '' }}"> Daftar
                                Wisuda</a></li>
                        <li><a href="{{ route('prestasi.index') }}"
                                class="slide-item {{ request()->is('wisuda/prestasi') ? 'active' : '' }}"> Upload
                                Prestasi Akademik</a>
                        </li>
                    </ul>
                </li>

                @role('tahfidz')
                    @php
                        $menuUserSetting = request()->is('tahfidz/setoran*', 'tahfidz/data*');
                    @endphp
                    <li
                        class="slide {{ $menuUserSetting ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ $menuUserSetting ? 'active is-expanded' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fe fe-grid"></i>
                            <span class="side-menu__label">Tahfidz</span>
                            <i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li>
                                <a href="{{ route('tahfidz.setoran.index') }}"
                                    class="slide-item {{ request()->is('tahfidz/setoran*') ? 'active' : '' }}">
                                    Setoran
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('tahfidz.data.index') }}"
                                    class="slide-item {{ request()->is('tahfidz/data*') ? 'active' : '' }}">
                                    Data Tahfidz
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole

                @role('admin')
                    @php
                        $menuUserSetting = request()->is('administrator/roles*', 'administrator/user-role*');
                    @endphp
                    <li
                        class="slide {{ $menuUserSetting ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ $menuUserSetting ? 'active is-expanded' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fe fe-grid"></i>
                            <span class="side-menu__label">Pengaturan User</span>
                            <i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li>
                                <a href="{{ route('administrator.roles.index') }}"
                                    class="slide-item {{ request()->is('administrator/roles*') ? 'active' : '' }}">
                                    Role
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('administrator.user-role.index') }}"
                                    class="slide-item {{ request()->is('administrator/user-role*') ? 'active' : '' }}">
                                    User Role
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </aside>
</div>
