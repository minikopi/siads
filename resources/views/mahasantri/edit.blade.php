@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="row mt-5">
                    <form method="POST" action="{{ route('mahasantri.update', $data->id) }}" class="form-horizontal"
                        enctype="multipart/form-data" id="form">
                        @csrf @method('PUT')
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header border-bottom-0">
                                    <div class="card-title">
                                        Form Update Akun Mahasantri
                                    </div>
                                </div>
                                <div class="card-body">
                                    @php
                                        foreach ($errors->all() as $message) {
                                            echo $message;
                                        }
                                    @endphp
                                    <div id="wizard-mahasantri">

                                        <h3>Data Diri Mahasantri</h3>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="control-group form-group">
                                                        <label class="form-label">Nama Depan</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_depan') is-invalid @enderror"
                                                            name="nama_depan"
                                                            value="{{ old('nama_depan', $data->nama_depan) }}"
                                                            id="nama_depan">
                                                        @error('nama_depan')
                                                            <div class="invalid-feedback" style="color: red;">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="control-group form-group">
                                                        <label class="form-label">Nama Belakang</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_belakang') is-invalid @enderror"
                                                            name="nama_belakang"
                                                            value="{{ old('nama_belakang', $data->nama_belakang) }}"
                                                            id="nama_belakang">
                                                        @error('nama_belakang')
                                                            <div class="invalid-feedback" style="color: red;">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group form-group">
                                                <label class="form-label">NIK</label>
                                                <input type="text"
                                                    class="form-control @error('nik') is-invalid @enderror" name="nik"
                                                    id="nik" value="{{ old('nik', $data->nik) }}">
                                                @error('nik')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email', $data->email) }}" id="email">
                                                @error('email')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Handphone</label>
                                                <input type="text"
                                                    class="form-control @error('handphone') is-invalid @enderror"
                                                    placeholder="08xxxxxxxxxx" name="handphone" id="handphone"
                                                    value="{{ old('handphone', $data->handphone) }}">
                                                @error('handphone')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat</label>
                                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat">{{ old('alamat', $data->alamat) }}</textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Kode Pos</label>
                                                <input type="text"
                                                    class="form-control @error('kode_pos') is-invalid @enderror"
                                                    name="kode_pos" id="kode_pos"
                                                    value="{{ old('kode_pos', $data->kode_pos) }}">
                                                @error('kode_pos')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text"
                                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    name="tempat_lahir" id="tempat_lahir"
                                                    value="{{ old('tempat_lahir', $data->tempat_lahir) }}">
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    name="tanggal_lahir"
                                                    value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}"
                                                    id="tanggal_lahir">
                                                @error('tanggal_lahir')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Suku</label>
                                                <input type="text"
                                                    class="form-control @error('suku') is-invalid @enderror"
                                                    name="suku" value="{{ old('suku', $data->suku) }}"
                                                    id="suku">
                                                @error('suku')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Anak Ke</label>
                                                <input type="text"
                                                    class="form-control @error('anak_ke') is-invalid @enderror"
                                                    name="anak_ke" value="{{ old('anak_ke', $data->anak_ke) }}"
                                                    id="anak_ke">
                                                @error('anak_ke')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Saudara</label>
                                                <input type="text"
                                                    class="form-control @error('saudara') is-invalid @enderror"
                                                    name="saudara" value="{{ old('saudara', $data->saudara) }}"
                                                    id="saudara">
                                                @error('saudara')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Hobi</label>
                                                <input type="text"
                                                    class="form-control @error('hobi') is-invalid @enderror"
                                                    name="hobi" value="{{ old('hobi', $data->hobi) }}"
                                                    id="hobi">
                                                @error('hobi')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Golongan Darah</label>
                                                <select class="form-control @error('golongan_darah') is-invalid @enderror"
                                                    name="golongan_darah" id="golongan_darah">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="A" @selected(old('golongan_darah', $data->golongan_darah) == 'A')>
                                                        A</option>
                                                    <option value="B" @selected(old('golongan_darah', $data->golongan_darah) == 'B')>
                                                        B</option>
                                                    <option value="AB" @selected(old('golongan_darah', $data->golongan_darah) == 'AB')>
                                                        AB</option>
                                                    <option value="O" @selected(old('golongan_darah', $data->golongan_darah) == 'O')>
                                                        O</option>
                                                </select>
                                                @error('golongan_darah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Berat Badan</label>
                                                <input type="text"
                                                    class="form-control @error('berat_badan') is-invalid @enderror"
                                                    name="berat_badan"
                                                    value="{{ old('berat_badan', $data->berat_badan) }}" placeholder="Kg"
                                                    id="berat_badan">
                                                @error('berat_badan')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tinggi Badan</label>
                                                <input type="text"
                                                    class="form-control @error('tinggi_badan') is-invalid @enderror"
                                                    name="tinggi_badan"
                                                    value="{{ old('tinggi_badan', $data->tinggi_badan) }}"
                                                    placeholder="cm" id="tinggi_badan">
                                                @error('tinggi_badan')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Riwayat Penyakit</label>
                                                <textarea class="form-control @error('penyakit') is-invalid @enderror" name="penyakit" id="penyakit">{{ old('penyakit', $data->penyakit) }}</textarea>
                                                @error('penyakit')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Kondisi Kemampuan</label>
                                                <select
                                                    class="form-control @error('kondisi_kemampuan') is-invalid @enderror"
                                                    name="kondisi_kemampuan" id="kondisi_kemampuan">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="Mampu" @selected(old('kondisi_kemampuan', $data->kondisi_kemampuan) == 'Mampu')>
                                                        A</option>
                                                    <option value="Berkecukupan" @selected(old('kondisi_kemampuan', $data->kondisi_kemampuan) == 'Berkecukupan')>
                                                        B</option>
                                                    <option value="Kurang Mampu" @selected(old('kondisi_kemampuan', $data->kondisi_kemampuan) == 'Kurang Mampu')>
                                                        AB</option>
                                                </select>
                                                @error('kondisi_kemampuan')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Foto</label>
                                                <input type="file"
                                                    class="form-control @error('foto') is-invalid @enderror"
                                                    name="foto" id="foto">
                                                @if ($data->foto)
                                                    <img src="{{ asset('storage/' . $data->foto) }}" width="300" alt="{{ $data->nama_lengkap }}">
                                                @endif
                                                @error('foto')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <h3>Data Ayah</h3>
                                        <div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Nama</label>
                                                <input type="text"
                                                    class="form-control @error('nama_ayah') is-invalid @enderror"
                                                    name="nama_ayah" value="{{ old('nama_ayah', $data->nama_ayah) }}"
                                                    id="nama_ayah">
                                                @error('nama_ayah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text"
                                                    class="form-control @error('tempat_ayah') is-invalid @enderror"
                                                    name="tempat_ayah"
                                                    value="{{ old('tempat_ayah', $data->tempat_ayah) }}"
                                                    id="tempat_ayah">
                                                @error('tempat_ayah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date"
                                                    class="form-control @error('lahir_ayah') is-invalid @enderror"
                                                    name="lahir_ayah" value="{{ old('lahir_ayah', $data->lahir_ayah) }}"
                                                    id="lahir_ayah">
                                                @error('lahir_ayah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Pendidikan Terakhir</label>
                                                <select
                                                    class="form-control @error('pendidikan_ayah') is-invalid @enderror"
                                                    name="pendidikan_ayah" id="pendidikan_ayah">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="SD" @selected(old('pendidikan_ayah', $data->pendidikan_ayah) == 'SD')>
                                                        SD</option>
                                                    <option value="SMP" @selected(old('pendidikan_ayah', $data->pendidikan_ayah) == 'SMP')>
                                                        SMP</option>
                                                    <option value="SMA" @selected(old('pendidikan_ayah', $data->pendidikan_ayah) == 'SMA')>
                                                        SMA</option>
                                                    <option value="S1" @selected(old('pendidikan_ayah', $data->pendidikan_ayah) == 'S1')>
                                                        S1</option>
                                                    <option value="S2" @selected(old('pendidikan_ayah', $data->pendidikan_ayah) == 'S2')>
                                                        S2</option>
                                                    <option value="S3" @selected(old('pendidikan_ayah', $data->pendidikan_ayah) == 'S3')>
                                                        S3</option>
                                                </select>
                                                @error('pendidikan_ayah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Pekerjaan</label>
                                                <input type="text"
                                                    class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                                    name="pekerjaan_ayah"
                                                    value="{{ old('pekerjaan_ayah', $data->pekerjaan_ayah) }}"
                                                    id="pekerjaan_ayah">
                                                @error('pekerjaan_ayah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Penghasilan</label>
                                                <select
                                                    class="form-control @error('penghasilan_ayah') is-invalid @enderror"
                                                    name="penghasilan_ayah" id="penghasilan_ayah">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="-" @selected(old('penghasilan_ayah', $data->penghasilan_ayah) == '-')>
                                                        -</option>
                                                    <option value="< 1.000.000" @selected(old('penghasilan_ayah', $data->penghasilan_ayah) == '< 1.000.000')>
                                                        < 1.000.000</option>
                                                    <option value="1.000.000 - 3.000.000" @selected(old('penghasilan_ayah', $data->penghasilan_ayah) == '1.000.000 - 3.000.000')>
                                                        1.000.000 - 3.000.000</option>
                                                    <option value="3.000.000 - 5.000.000" @selected(old('penghasilan_ayah', $data->penghasilan_ayah) == '3.000.000 - 5.000.000')>
                                                        3.000.000 - 5.000.000</option>
                                                    <option value="5.000.000 - 10.000.000" @selected(old('penghasilan_ayah', $data->penghasilan_ayah) == '5.000.000 - 10.000.000')>
                                                        5.000.000 - 10.000.000</option>
                                                    <option value="> 10.000.000" @selected(old('penghasilan_ayah', $data->penghasilan_ayah) == '> 10.000.000')>
                                                        > 10.000.000</option>
                                                </select>
                                                @error('penghasilan_ayah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <h3>Data Ibu</h3>
                                        <div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Nama</label>
                                                <input type="text"
                                                    class="form-control @error('nama_ibu') is-invalid @enderror"
                                                    name="nama_ibu" value="{{ old('nama_ibu', $data->nama_ibu) }}"
                                                    id="nama_ibu">
                                                @error('nama_ibu')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text"
                                                    class="form-control @error('tempat_ibu') is-invalid @enderror"
                                                    name="tempat_ibu" value="{{ old('tempat_ibu', $data->tempat_ibu) }}"
                                                    id="tempat_ibu">
                                                @error('tempat_ibu')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date"
                                                    class="form-control @error('lahir_ibu') is-invalid @enderror"
                                                    name="lahir_ibu" value="{{ old('lahir_ibu', $data->lahir_ibu) }}"
                                                    id="lahir_ibu">
                                                @error('lahir_ibu')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Pendidikan Terakhir</label>
                                                <select class="form-control @error('pendidikan_ibu') is-invalid @enderror"
                                                    name="pendidikan_ibu" id="pendidikan_ibu">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="SD" @selected(old('pendidikan_ibu', $data->pendidikan_ibu) == 'SD')>
                                                        SD</option>
                                                    <option value="SMP" @selected(old('pendidikan_ibu', $data->pendidikan_ibu) == 'SMP')>
                                                        SMP</option>
                                                    <option value="SMA" @selected(old('pendidikan_ibu', $data->pendidikan_ibu) == 'SMA')>
                                                        SMA</option>
                                                    <option value="S1" @selected(old('pendidikan_ibu', $data->pendidikan_ibu) == 'S1')>
                                                        S1</option>
                                                    <option value="S2" @selected(old('pendidikan_ibu', $data->pendidikan_ibu) == 'S2')>
                                                        S2</option>
                                                    <option value="S3" @selected(old('pendidikan_ibu', $data->pendidikan_ibu) == 'S3')>
                                                        S3</option>
                                                </select>
                                                @error('pendidikan_ibu')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Pekerjaan</label>
                                                <input type="text"
                                                    class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                                    name="pekerjaan_ibu"
                                                    value="{{ old('pekerjaan_ibu', $data->pekerjaan_ibu) }}"
                                                    id="pekerjaan_ibu">
                                                @error('pekerjaan_ibu')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Penghasilan</label>
                                                <select
                                                    class="form-control @error('penghasilan_ibu') is-invalid @enderror"
                                                    name="penghasilan_ibu" id="penghasilan_ibu">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="-" @selected(old('penghasilan_ibu', $data->penghasilan_ibu) == '-')>
                                                        -</option>
                                                    <option value="< 1.000.000" @selected(old('penghasilan_ibu', $data->penghasilan_ibu) == '< 1.000.000')>
                                                        < 1.000.000</option>
                                                    <option value="1.000.000 - 3.000.000" @selected(old('penghasilan_ibu', $data->penghasilan_ibu) == '1.000.000 - 3.000.000')>
                                                        1.000.000 - 3.000.000</option>
                                                    <option value="3.000.000 - 5.000.000" @selected(old('penghasilan_ibu', $data->penghasilan_ibu) == '3.000.000 - 5.000.000')>
                                                        3.000.000 - 5.000.000</option>
                                                    <option value="5.000.000 - 10.000.000" @selected(old('penghasilan_ibu', $data->penghasilan_ibu) == '5.000.000 - 10.000.000')>
                                                        5.000.000 - 10.000.000</option>
                                                    <option value="> 10.000.000" @selected(old('penghasilan_ibu', $data->penghasilan_ibu) == '> 10.000.000')>
                                                        > 10.000.000</option>
                                                </select>
                                                @error('penghasilan_ibu')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <h3>Data Wali</h3>
                                        <div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Nama</label>
                                                <input type="text"
                                                    class="form-control @error('nama_wali') is-invalid @enderror"
                                                    name="nama_wali" value="{{ old('nama_wali', $data->nama_wali) }}"
                                                    id="nama_wali">
                                                @error('nama_wali')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat</label>
                                                <textarea class="form-control @error('alamat_wali') is-invalid @enderror" name="alamat_wali" id="alamat_wali">{{ old('alamat_wali', $data->alamat_wali) }}</textarea>
                                                @error('alamat_wali')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">No Handphone</label>
                                                <input type="number"
                                                    class="form-control @error('handphone_wali') is-invalid @enderror"
                                                    name="handphone_wali"
                                                    value="{{ old('handphone_wali', $data->handphone_wali) }}"
                                                    id="handphone_wali" placeholder="08xxxxxxxxxx">
                                                @error('handphone_wali')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <h3>Riwayat Pribadi</h3>
                                        <div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Asal Sekolah</label>
                                                <input type="text"
                                                    class="form-control @error('asal_sekolah') is-invalid @enderror"
                                                    name="asal_sekolah"
                                                    value="{{ old('asal_sekolah', $data->asal_sekolah) }}"
                                                    id="asal_sekolah">
                                                @error('asal_sekolah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat Sekolah</label>
                                                <textarea class="form-control @error('alamat_sekolah') is-invalid @enderror" name="alamat_sekolah"
                                                    id="alamat_sekolah">{{ old('alamat_sekolah', $data->alamat_sekolah) }}</textarea>
                                                @error('alamat_sekolah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Nomor Ijazah</label>
                                                <input type="text"
                                                    class="form-control @error('nomor_ijazah') is-invalid @enderror"
                                                    name="nomor_ijazah"
                                                    value="{{ old('nomor_ijazah', $data->nomor_ijazah) }}"
                                                    id="nomor_ijazah">
                                                @error('nomor_ijazah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tanggal Ijazah</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_ijazah') is-invalid @enderror"
                                                    name="tanggal_ijazah"
                                                    value="{{ old('tanggal_ijazah', $data->tanggal_ijazah) }}"
                                                    id="tanggal_ijazah">
                                                @error('tanggal_ijazah')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Asal Pesantren</label>
                                                <input type="text"
                                                    class="form-control @error('asal_pesantren') is-invalid @enderror"
                                                    name="asal_pesantren"value="{{ old('asal_pesantren', $data->asal_pesantren) }}"
                                                    id="asal_pesantren">
                                                @error('asal_pesantren')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat Pesantren</label>
                                                <textarea class="form-control @error('alamat_pesantren') is-invalid @enderror" name="alamat_pesantren"
                                                    id="alamat_pesantren">{{ old('alamat_pesantren', $data->alamat_pesantren) }}</textarea>
                                                @error('alamat_pesantren')
                                                    <div class="invalid-feedback" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

            <!-- /Row -->
        </div>
    </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>
    @push('custom')
        <script>
            $(document).ready(function() {
                $("#wizard-mahasantri").steps({
                    headerTag: "h3",
                    bodyTag: "div",
                    autoFocus: true,
                    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                    stepsOrientation: 1,
                    onFinished: function(event, currentIndex) {
                        $("#form").submit();
                    }
                });

                $("#jenis_kelamin").change(function() {
                    var gender = $(this).val();
                    $('#kelas').empty();
                    $.ajax({
                        url: '{{ route('kelas.jsonClass') }}?gender=' +
                            gender, // Ganti dengan URL endpoint Anda
                        type: 'GET', // Atur sesuai dengan metode yang dibutuhkan (GET, POST, dll.)
                        success: function(response, xhr) {
                            $("#kelas").append('<option value="">Pilih Salah Satu</option>');
                            $.each(response, function(index, element) {
                                console.log(element)
                                $("#kelas").append('<option value="' + element.id + '">' +
                                    element.nama + '</option>');
                            });
                        }
                    });
                })
            });
        </script>
        <script></script>

        <!-- INTERNAL Jquery.steps js -->
        <script src="{{ asset('plugins/jquery-steps/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

        <!-- INTERNAL Accordion-Wizard-Form js-->
        <script src="{{ asset('plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
        <script src="{{ asset('js/form-wizard.js') }}"></script>

        <!-- FORM WIZARD JS-->
        <script src="{{ asset('plugins/formwizard/jquery.smartWizard.js') }}"></script>
        <script src="{{ asset('plugins/formwizard/fromwizard.js') }}"></script>
    @endpush
@endsection
