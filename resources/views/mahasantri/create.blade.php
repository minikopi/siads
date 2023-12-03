@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header border-bottom-0">
                                <div class="card-title">
                                    Form Pembuatan Akun Mahasantri
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="wizard3">
                                    <h3>Data Diri Mahasantri</h3>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="control-group form-group">
                                                    <label class="form-label">Nama Depan</label>
                                                    <input type="text" class="form-control required" name="nama_depan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="control-group form-group">
                                                    <label class="form-label">Nama Belakang</label>
                                                    <input type="text" class="form-control required"
                                                        name="nama_belakang">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select class="form-control required" name="jenis_kelamin">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat Email</label>
                                            <input type="email" class="form-control required" name="email">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Handphone</label>
                                            <input type="number" class="form-control required" placeholder="08xxxxxxxxxx"
                                                name="handphone">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat</label>
                                            <textarea class="form-control required" name="alamat"></textarea>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Kode Pos</label>
                                            <input type="number" class="form-control required" name="kode_pos">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control required" name="tanggal_lahir">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Suku</label>
                                            <input type="text" class="form-control required" name="suku">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Saudara</label>
                                            <input type="text" class="form-control required" name="saudara">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Hobi</label>
                                            <input type="text" class="form-control required" name="hobi">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Golongan Darah</label>
                                            <select class="form-control required" name="golongan_darah">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Berat Badan</label>
                                            <input type="number" class="form-control required" name="berat_badan"
                                                placeholder="Kg">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tinggi Badan</label>
                                            <input type="number" class="form-control required" name="tinggi_badan"
                                                placeholder="cm">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Riwayat Penyakit</label>
                                            <textarea class="form-control required" name="penyakit"></textarea>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Foto</label>
                                            <input type="file" class="form-control required" name="foto">
                                        </div>
                                    </div>
                                    <h3>Data Ayah</h3>
                                    <div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Nama</label>
                                            <input type="text" class="form-control required" name="nama_ayah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control required" name="tempat_ayah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control required" name="lahir_ayah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Pendidikan Terakhir</label>
                                            <select class="form-control required" name="pendidikan_ayah">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Pekerjaan</label>
                                            <select class="form-control required" name="pekerjaan_ayah">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
                                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                <option value="Wirausaha">Wirausaha</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Penghasilan</label>
                                            <select class="form-control required" name="penghasilan_ayah">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="-">-</option>
                                                <option value="< 1.000.000">
                                                    < 1.000.000</option>
                                                <option value="1.000.000 - 3.000.000">1.000.000 - 3.000.000</option>
                                                <option value="3.000.000 - 6.000.000">3.000.000 - 6.000.000</option>
                                                <option value="6.000.000 - 10.000.000">6.000.000 - 10.000.000</option>
                                                <option value="> 10.000.000"> > 10.000.000</option>
                                            </select>
                                        </div>
                                    </div>
                                    <h3>Data Ibu</h3>
                                    <div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Nama</label>
                                            <input type="text" class="form-control required" name="nama_ibu">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control required" name="tempat_ibu">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control required" name="lahir_ibu">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Pendidikan Terakhir</label>
                                            <select class="form-control required" name="pendidikan_ibu">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Pekerjaan</label>
                                            <select class="form-control required" name="pekerjaan_ibu">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
                                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                <option value="Wirausaha">Wirausaha</option>
                                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Penghasilan</label>
                                            <select class="form-control required" name="penghasilan_ibu">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="-">-</option>
                                                <option value="< 1.000.000">
                                                    < 1.000.000</option>
                                                <option value="1.000.000 - 3.000.000">1.000.000 - 3.000.000</option>
                                                <option value="3.000.000 - 6.000.000">3.000.000 - 6.000.000</option>
                                                <option value="6.000.000 - 10.000.000">6.000.000 - 10.000.000</option>
                                                <option value="> 10.000.000"> > 10.000.000</option>
                                            </select>
                                        </div>
                                    </div>
                                    <h3>Data Wali</h3>
                                    <div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Nama</label>
                                            <input type="text" class="form-control required" name="nama_wali">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat</label>
                                            <textarea class="form-control required" name="alamat_wali"></textarea>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">No Handphone</label>
                                            <input type="number" class="form-control required" name="handphone_wali"
                                                placeholder="08xxxxxxxxxx">
                                        </div>
                                    </div>
                                    <h3>Riwayat Pribadi</h3>
                                    <div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Asal Sekolah</label>
                                            <input type="text" class="form-control required" name="asal_sekolah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat Sekolah</label>
                                            <textarea class="form-control required" name="alamat_sekolah"></textarea>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Nomor Ijazah</label>
                                            <input type="text" class="form-control required" name="nomor_ijazah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tanggal Ijazah</label>
                                            <input type="date" class="form-control required" name="tanggal_ijazah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Asal Pesantren</label>
                                            <input type="text" class="form-control required" name="asal_pesantren">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat Pesantren</label>
                                            <textarea class="form-control required" name="alamat_pesantren"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>
    @push('custom')
        @php
            $mahasantriStoreRoute = route('mahasantri.store');
        @endphp

        <script>
            var mahasantriStoreRoute = '{{ $mahasantriStoreRoute }}';
        </script>
        <!-- INTERNAL Jquery.steps js -->
        <script src="{{ asset('plugins/jquery-steps/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

        <!-- INTERNAL Accordion-Wizard-Form js-->
        <script src="{{ asset('plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
        <script src="{{ asset('js/form-wizard.js') }}"></script>
    @endpush
@endsection
