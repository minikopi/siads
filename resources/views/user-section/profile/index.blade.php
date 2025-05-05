@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <form method="POST" action="{{ route('user.profile.store') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row mt-5">
                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Profil</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        @if (!$data['mahasantri'])
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                        type="text" name="name" id="name" autocomplete="off"
                                                        value="{{ old('name', $data['name']) }}">
                                                    @error('name')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="nama_depan">Nama Depan</label>
                                                    <input class="form-control @error('nama_depan') is-invalid @enderror"
                                                        type="text" name="nama_depan" id="nama_depan" autocomplete="off"
                                                        value="{{ old('nama_depan', $data['nama_depan']) }}">
                                                    @error('nama_depan')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="nama_belakang">Nama Belakang</label>
                                                    <input class="form-control @error('nama_belakang') is-invalid @enderror"
                                                        type="text" name="nama_belakang" id="nama_belakang"
                                                        autocomplete="off"
                                                        value="{{ old('nama_belakang', $data['nama_belakang']) }}">
                                                    @error('nama_belakang')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="nik">NIK</label>
                                                    <input class="form-control @error('nik') is-invalid @enderror"
                                                        type="text" name="nik" id="nik" autocomplete="off"
                                                        value="{{ old('nik', $data['nik']) }}">
                                                    @error('nik')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="nim">NIM</label>
                                                    <input class="form-control @error('nim') is-invalid @enderror"
                                                        type="text" name="nim" id="nim" autocomplete="off"
                                                        value="{{ old('nim', $data['nim']) }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="handphone">Handphone</label>
                                                    <input class="form-control @error('handphone') is-invalid @enderror"
                                                        type="text" name="handphone" id="handphone" autocomplete="off"
                                                        value="{{ old('handphone', $data['handphone']) }}">
                                                    @error('handphone')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                    type="email" name="email" id="email" autocomplete="off"
                                                    value="{{ old('email', $data['email']) }}">
                                                @error('email')
                                                    <span class="small text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="dosen" value="0">
                    @if ($data['dosen'])
                        <input type="hidden" name="dosen" value="1">
                        <div class="row mt-5">
                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Data Profil Dosen</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="jabatan">Jabatan</label>
                                                    <input class="form-control @error('jabatan') is-invalid @enderror"
                                                        type="input" name="jabatan" id="jabatan" autocomplete="off"
                                                        value="{{ old('jabatan', $data['jabatan']) }}" readonly disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="nomor_induk">Nomor Induk</label>
                                                    <input class="form-control @error('nomor_induk') is-invalid @enderror"
                                                        type="input" name="nomor_induk" id="nomor_induk"
                                                        autocomplete="off"
                                                        value="{{ old('nomor_induk', $data['nomor_induk']) }}" readonly
                                                        disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <input type="hidden" name="mahasantri" value="0">
                    @if ($data['mahasantri'])
                        <input type="hidden" name="mahasantri" value="1">
                        <div class="row mt-5">
                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Data Profil Mahasantri</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input class="form-control @error('alamat') is-invalid @enderror"
                                                        type="text" name="alamat" id="alamat" autocomplete="off"
                                                        value="{{ old('alamat', $data['alamat']) }}">
                                                    @error('alamat')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="kode_pos">Kode Pos</label>
                                                    <input class="form-control @error('kode_pos') is-invalid @enderror"
                                                        type="text" name="kode_pos" id="kode_pos" autocomplete="off"
                                                        value="{{ old('kode_pos', $data['kode_pos']) }}">
                                                    @error('kode_pos')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <input
                                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                        type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                        autocomplete="off"
                                                        value="{{ old('tanggal_lahir', $data['tanggal_lahir']) }}">
                                                    @error('tamggal_lahir')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <input
                                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                        type="text" name="tempat_lahir" id="tempat_lahir"
                                                        autocomplete="off"
                                                        value="{{ old('tempat_lahir', $data['tempat_lahir']) }}">
                                                    @error('tempat_lahir')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="suku">Suku</label>
                                                    <input class="form-control @error('suku') is-invalid @enderror"
                                                        type="text" name="suku" id="suku" autocomplete="off"
                                                        value="{{ old('suku', $data['suku']) }}">
                                                    @error('suku')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="anak_ke">Anak ke-</label>
                                                    <input class="form-control @error('anak_ke') is-invalid @enderror"
                                                        type="text" name="anak_ke" id="anak_ke" autocomplete="off"
                                                        value="{{ old('anak_ke', $data['anak_ke']) }}">
                                                    @error('anak_ke')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="saudara">Jumlah Saudara</label>
                                                    <input class="form-control @error('saudara') is-invalid @enderror"
                                                        type="text" name="saudara" id="saudara" autocomplete="off"
                                                        value="{{ old('saudara', $data['saudara']) }}">
                                                    @error('saudara')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                                    <input class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                        type="text" name="jenis_kelamin" id="jenis_kelamin" autocomplete="off"
                                                        value="{{ old('jenis_kelamin', $data['jenis_kelamin']) }}">
                                                    @error('jenis_kelamin')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="hobi">Hobi </label>
                                                    <input class="form-control @error('hobi') is-invalid @enderror"
                                                        type="text" name="hobi" id="hobi" autocomplete="off"
                                                        value="{{ old('hobi', $data['hobi']) }}">
                                                    @error('hobi')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="golongan_darah">Golongan Darah</label>
                                                    <input class="form-control @error('golongan_darah') is-invalid @enderror"
                                                        type="text" name="golongan_darah" id="golongan_darah" autocomplete="off"
                                                        value="{{ old('golongan_darah', $data['golongan_darah']) }}">
                                                    @error('golongan_darah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="berat_badan">Berat Badan</label>
                                                    <input class="form-control @error('berat_badan') is-invalid @enderror"
                                                        type="text" name="berat_badan" id="berat_badan" autocomplete="off"
                                                        value="{{ old('berat_badan', $data['berat_badan']) }}">
                                                    @error('berat_badan')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="tinggi_badan">Tinggi Badan</label>
                                                    <input class="form-control @error('tinggi_badan') is-invalid @enderror"
                                                        type="text" name="tinggi_badan" id="tinggi_badan" autocomplete="off"
                                                        value="{{ old('tinggi_badan', $data['tinggi_badan']) }}">
                                                    @error('tinggi_badan')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="penyakit">Riwayat Penyakit</label>
                                                    <input class="form-control @error('penyakit') is-invalid @enderror"
                                                        type="text" name="penyakit" id="penyakit" autocomplete="off"
                                                        value="{{ old('penyakit', $data['penyakit']) }}">
                                                    @error('penyakit')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                &nbsp;
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="asal_pesantren">Asal Pesantren</label>
                                                    <input class="form-control @error('asal_pesantren') is-invalid @enderror"
                                                        type="text" name="asal_pesantren" id="asal_pesantren" autocomplete="off"
                                                        value="{{ old('asal_pesantren', $data['asal_pesantren']) }}">
                                                    @error('asal_pesantren')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="alamat_pesantren">Alamat Pesantren</label>
                                                    <input class="form-control @error('alamat_pesantren') is-invalid @enderror"
                                                        type="text" name="alamat_pesantren" id="alamat_pesantren" autocomplete="off"
                                                        value="{{ old('alamat_pesantren', $data['alamat_pesantren']) }}">
                                                    @error('alamat_pesantren')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="asal_sekolah">Asal Sekolah Umum</label>
                                                    <input class="form-control @error('asal_sekolah') is-invalid @enderror"
                                                        type="text" name="asal_sekolah" id="asal_sekolah" autocomplete="off"
                                                        value="{{ old('asal_sekolah', $data['asal_sekolah']) }}">
                                                    @error('asal_sekolah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="alamat_sekolah">Alamat Sekolah Umum</label>
                                                    <input class="form-control @error('alamat_sekolah') is-invalid @enderror"
                                                        type="text" name="alamat_sekolah" id="alamat_sekolah" autocomplete="off"
                                                        value="{{ old('alamat_sekolah', $data['alamat_sekolah']) }}">
                                                    @error('alamat_sekolah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="nomor_ijazah">Nomor Ijazah</label>
                                                    <input class="form-control @error('nomor_ijazah') is-invalid @enderror"
                                                        type="text" name="nomor_ijazah" id="nomor_ijazah" autocomplete="off"
                                                        value="{{ old('nomor_ijazah', $data['nomor_ijazah']) }}">
                                                    @error('nomor_ijazah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="tanggal_ijazah">Tanggal Ijazah</label>
                                                    <input class="form-control @error('tanggal_ijazah') is-invalid @enderror"
                                                        type="date" name="tanggal_ijazah" id="tanggal_ijazah" autocomplete="off"
                                                        value="{{ old('tanggal_ijazah', $data['tanggal_ijazah']) }}">
                                                    @error('tanggal_ijazah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Data Orang Tua / Wali</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="nama_ayah">Nama Ayah</label>
                                                    <input class="form-control @error('nama_ayah') is-invalid @enderror"
                                                        type="text" name="nama_ayah" id="nama_ayah" autocomplete="off"
                                                        value="{{ old('nama_ayah', $data['nama_ayah']) }}">
                                                    @error('nama_ayah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="pendidikan_ayah">Pendidikan Terakhir Ayah</label>
                                                    <input class="form-control @error('pendidikan_ayah') is-invalid @enderror"
                                                        type="text" name="pendidikan_ayah" id="pendidikan_ayah" autocomplete="off"
                                                        value="{{ old('pendidikan_ayah', $data['pendidikan_ayah']) }}">
                                                    @error('pendidikan_ayah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="tempat_ayah">Tempat Lahir Ayah</label>
                                                    <input class="form-control @error('tempat_ayah') is-invalid @enderror"
                                                        type="text" name="tempat_ayah" id="tempat_ayah" autocomplete="off"
                                                        value="{{ old('tempat_ayah', $data['tempat_ayah']) }}">
                                                    @error('tempat_ayah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="lahir_ayah">Tanggal Lahir Ayah</label>
                                                    <input class="form-control @error('lahir_ayah') is-invalid @enderror"
                                                        type="date" name="lahir_ayah" id="lahir_ayah" autocomplete="off"
                                                        value="{{ old('lahir_ayah', $data['lahir_ayah']) }}">
                                                    @error('lahir_ayah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                                    <input class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                                        type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" autocomplete="off"
                                                        value="{{ old('pekerjaan_ayah', $data['pekerjaan_ayah']) }}">
                                                    @error('pekerjaan_ayah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="penghasilan_ayah">Penghasilan Ayah</label>
                                                    <input class="form-control @error('penghasilan_ayah') is-invalid @enderror"
                                                        type="text" name="penghasilan_ayah" id="penghasilan_ayah" autocomplete="off"
                                                        value="{{ old('penghasilan_ayah', $data['penghasilan_ayah']) }}">
                                                    @error('penghasilan_ayah')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="nama_ibu">Nama Ibu</label>
                                                    <input class="form-control @error('nama_ibu') is-invalid @enderror"
                                                        type="text" name="nama_ibu" id="nama_ibu" autocomplete="off"
                                                        value="{{ old('nama_ibu', $data['nama_ibu']) }}">
                                                    @error('nama_ibu')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="pendidikan_ibu">Pendidikan Terakhir Ibu</label>
                                                    <input class="form-control @error('pendidikan_ibu') is-invalid @enderror"
                                                        type="text" name="pendidikan_ibu" id="pendidikan_ibu" autocomplete="off"
                                                        value="{{ old('pendidikan_ibu', $data['pendidikan_ibu']) }}">
                                                    @error('pendidikan_ibu')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="tempat_ibu">Tempat Lahir Ibu</label>
                                                    <input class="form-control @error('tempat_ibu') is-invalid @enderror"
                                                        type="text" name="tempat_ibu" id="tempat_ibu" autocomplete="off"
                                                        value="{{ old('tempat_ibu', $data['tempat_ibu']) }}">
                                                    @error('tempat_ibu')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="lahir_ibu">Tanggal Lahir Ibu</label>
                                                    <input class="form-control @error('lahir_ibu') is-invalid @enderror"
                                                        type="date" name="lahir_ibu" id="lahir_ibu" autocomplete="off"
                                                        value="{{ old('lahir_ibu', $data['lahir_ibu']) }}">
                                                    @error('lahir_ibu')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                                    <input class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                                        type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" autocomplete="off"
                                                        value="{{ old('pekerjaan_ibu', $data['pekerjaan_ibu']) }}">
                                                    @error('pekerjaan_ibu')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="penghasilan_ibu">Penghasilan Ibu</label>
                                                    <input class="form-control @error('penghasilan_ibu') is-invalid @enderror"
                                                        type="text" name="penghasilan_ibu" id="penghasilan_ibu" autocomplete="off"
                                                        value="{{ old('penghasilan_ibu', $data['penghasilan_ibu']) }}">
                                                    @error('penghasilan_ibu')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="nama_wali">Nama Wali</label>
                                                    <input class="form-control @error('nama_wali') is-invalid @enderror"
                                                        type="text" name="nama_wali" id="nama_wali" autocomplete="off"
                                                        value="{{ old('nama_wali', $data['nama_wali']) }}">
                                                    @error('nama_wali')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="alamat_wali">Alamat Wali</label>
                                                    <input class="form-control @error('alamat_wali') is-invalid @enderror"
                                                        type="text" name="alamat_wali" id="alamat_wali" autocomplete="off"
                                                        value="{{ old('alamat_wali', $data['alamat_wali']) }}">
                                                    @error('alamat_wali')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="handphone_wali">Handphone Wali</label>
                                                    <input class="form-control @error('handphone_wali') is-invalid @enderror"
                                                        type="text" name="handphone_wali" id="handphone_wali" autocomplete="off"
                                                        value="{{ old('handphone_wali', $data['handphone_wali']) }}">
                                                    @error('handphone_wali')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="whatsapp_wali">WhatsApp Wali</label>
                                                    <input class="form-control @error('whatsapp_wali') is-invalid @enderror"
                                                        type="text" name="whatsapp_wali" id="whatsapp_wali" autocomplete="off"
                                                        value="{{ old('whatsapp_wali', $data['whatsapp_wali']) }}">
                                                    @error('whatsapp_wali')
                                                        <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </form>

            </div>
        </div>
    </div>
@endsection
