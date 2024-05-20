@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="row mt-5">
                    <form method="POST"
                        action="{{ isset($data) ? route('mahasantri.update', ['id' => $data->id]) : route('mahasantri.store') }}"
                        class="form-horizontal" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header border-bottom-0">
                                    <div class="card-title">
                                        Form {{ isset($data) ? 'Update' : 'Pembuatan' }} Akun Mahasantri
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="wizard7">

                                        <h3>Data Diri Mahasantri</h3>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="control-group form-group">
                                                        <label class="form-label">Nama Depan</label>
                                                        <input type="text" class="form-control required"
                                                            name="nama_depan"
                                                            value="{{ isset($data) ? $data->nama_depan : '' }}"
                                                            id="nama_depan">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="control-group form-group">
                                                        <label class="form-label">Nama Belakang</label>
                                                        <input type="text" class="form-control required"
                                                            name="nama_belakang"
                                                            value="{{ isset($data) ? $data->nama_belakang : '' }}"
                                                            id="nama_belakang">
                                                    </div>
                                                </div>
                                            </div>
                                            @if (!isset($data))
                                                <div class="control-group form-group">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <select class="form-control required" name="jenis_kelamin"
                                                        id="jenis_kelamin">
                                                        <option value="">Pilih Salah Satu</option>
                                                        <option value="Laki-laki"
                                                            {{ isset($data) ? ($data->jenis_kelamin == 'Laki-laki' ? 'selected' : '') : '' }}>
                                                            Laki-laki</option>
                                                        <option value="Perempuan"
                                                            {{ isset($data) ? ($data->jenis_kelamin == 'Perempuan' ? 'selected' : '') : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="control-group form-group">
                                                    <label class="form-label">Kelas</label>
                                                    <select class="form-control required" name="kelas_id" id="kelas">
                                                        <option value="">Pilih Salah Satu</option>
                                                    </select>
                                                </div>
                                            @endif

                                            <div class="control-group form-group">
                                                <label class="form-label">NIK</label>
                                                <input type="number" class="form-control required" name="nik"
                                                    id="nik" value="{{ isset($data) ? $data->nik : '' }}">
                                            </div>

                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat Email</label>
                                                <input type="email" class="form-control required" name="email"
                                                    value="{{ isset($data) ? $data->email : '' }}" id="email">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Handphone</label>
                                                <input type="number" class="form-control required"
                                                    placeholder="08xxxxxxxxxx" name="handphone" id="handphone"
                                                    value="{{ isset($data) ? $data->handphone : '' }}">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat</label>
                                                <textarea class="form-control required" name="alamat" id="alamat">{{ isset($data) ? $data->alamat : '' }}</textarea>
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Kode Pos</label>
                                                <input type="number" class="form-control required" name="kode_pos"
                                                    id="kode_pos" value="{{ isset($data) ? $data->kode_pos : '' }}">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control required" name="kode_pos"
                                                    id="tempat_lahir"
                                                    value="{{ isset($data) ? $data->tempat_lahir : '' }}">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control required" name="tanggal_lahir"
                                                    value="{{ isset($data) ? $data->tanggal_lahir : '' }}"
                                                    id="tanggal_lahir">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Suku</label>
                                                <input type="text" class="form-control required" name="suku"
                                                    value="{{ isset($data) ? $data->suku : '' }}" id="suku">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Anak Ke</label>
                                                <input type="text" class="form-control required" name="anak_ke"
                                                    value="{{ isset($data) ? $data->anak_ke : '' }}" id="anak_ke">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Saudara</label>
                                                <input type="text" class="form-control required" name="saudara"
                                                    value="{{ isset($data) ? $data->saudara : '' }}" id="saudara">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Hobi</label>
                                                <input type="text" class="form-control required" name="hobi"
                                                    value="{{ isset($data) ? $data->hobi : '' }}" id="hobi">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Golongan Darah</label>
                                                <select class="form-control required" name="golongan_darah"
                                                    id="golongan_darah">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="A"
                                                        {{ isset($data) ? ($data->golongan_darah == 'A' ? 'selected' : '') : '' }}>
                                                        A</option>
                                                    <option value="B"
                                                        {{ isset($data) ? ($data->golongan_darah == 'B' ? 'selected' : '') : '' }}>
                                                        B</option>
                                                    <option value="AB"
                                                        {{ isset($data) ? ($data->golongan_darah == 'AB' ? 'selected' : '') : '' }}>
                                                        AB</option>
                                                    <option value="O"
                                                        {{ isset($data) ? ($data->golongan_darah == 'O' ? 'selected' : '') : '' }}>
                                                        O</option>
                                                </select>
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Berat Badan</label>
                                                <input type="number" class="form-control required" name="berat_badan"
                                                    value="{{ isset($data) ? $data->berat_badan : '' }}" placeholder="Kg"
                                                    id="berat_badan">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tinggi Badan</label>
                                                <input type="number" class="form-control required" name="tinggi_badan"
                                                    value="{{ isset($data) ? $data->tinggi_badan : '' }}"
                                                    placeholder="cm" id="tinggi_badan">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Riwayat Penyakit</label>
                                                <textarea class="form-control required" name="penyakit" id="penyakit">{{ isset($data) ? $data->penyakit : '' }}</textarea>
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Kondisi Kemampuan</label>
                                                <select class="form-control required" name="kondisi_kemampuan"
                                                    id="kondisi_kemampuan">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="Mampu"
                                                        {{ isset($data) ? ($data->kondisi_kemampuan == 'Mampu' ? 'selected' : '') : '' }}>
                                                        A</option>
                                                    <option value="Berkecukupan"
                                                        {{ isset($data) ? ($data->kondisi_kemampuan == 'Berkecukupan' ? 'selected' : '') : '' }}>
                                                        B</option>
                                                    <option value="Kurang Mampu"
                                                        {{ isset($data) ? ($data->kondisi_kemampuan == 'Kurang Mampu' ? 'selected' : '') : '' }}>
                                                        AB</option>
                                                </select>
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Foto</label>
                                                <input type="file" class="form-control required" name="foto"
                                                    id="foto">
                                            </div>
                                        </div>
                                        <h3>Data Ayah</h3>
                                        <div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control required" name="nama_ayah"
                                                    value="{{ isset($data) ? $data->nama_ayah : '' }}" id="nama_ayah">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control required" name="tempat_ayah"
                                                    value="{{ isset($data) ? $data->tempat_ayah : '' }}"
                                                    id="tempat_ayah">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control required" name="lahir_ayah"
                                                    value="{{ isset($data) ? $data->lahir_ayah : '' }}" id="lahir_ayah">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Pendidikan Terakhir</label>
                                                <select class="form-control required" name="pendidikan_ayah"
                                                    id="pendidikan_ayah">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="SD"
                                                        {{ isset($data) ? ($data->pendidikan_ayah == 'SD' ? 'selected' : '') : '' }}>
                                                        SD</option>
                                                    <option value="SMP"
                                                        {{ isset($data) ? ($data->pendidikan_ayah == 'SMP' ? 'selected' : '') : '' }}>
                                                        SMP</option>
                                                    <option value="SMA"
                                                        {{ isset($data) ? ($data->pendidikan_ayah == 'SMA' ? 'selected' : '') : '' }}>
                                                        SMA</option>
                                                    <option value="S1"
                                                        {{ isset($data) ? ($data->pendidikan_ayah == 'S1' ? 'selected' : '') : '' }}>
                                                        S1</option>
                                                    <option value="S2"
                                                        {{ isset($data) ? ($data->pendidikan_ayah == 'S2' ? 'selected' : '') : '' }}>
                                                        S2</option>
                                                    <option value="S3"
                                                        {{ isset($data) ? ($data->pendidikan_ayah == 'S3' ? 'selected' : '') : '' }}>
                                                        S3</option>
                                                </select>
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Pekerjaan</label>
                                                <input type="text" class="form-control required" name="pekerjaan_ayah"
                                                    value="{{ isset($data) ? $data->pekerjaan_ayah : '' }}"
                                                    id="pekerjaan_ayah">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Penghasilan</label>
                                                <select class="form-control required" name="penghasilan_ayah"
                                                    id=penghasilan_ayah>
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="-"
                                                        {{ isset($data) ? ($data->penghasilan_ayah == '-' ? 'selected' : '') : '' }}>
                                                        -</option>
                                                    <option value="< 1.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ayah == '< 1.000.000' ? 'selected' : '') : '' }}>
                                                        < 1.000.000</option>
                                                    <option value="1.000.000 - 3.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ayah == '1.000.000 - 3.000.000' ? 'selected' : '') : '' }}>
                                                        1.000.000 - 3.000.000</option>
                                                    <option value="3.000.000 - 5.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ayah == '3.000.000 - 5.000.000' ? 'selected' : '') : '' }}>
                                                        3.000.000 - 5.000.000</option>
                                                    <option value="5.000.000 - 10.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ayah == '5.000.000 - 10.000.000' ? 'selected' : '') : '' }}>
                                                        5.000.000 - 10.000.000</option>
                                                    <option value="> 10.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ayah == '> 10.000.000' ? 'selected' : '') : '' }}>
                                                        > 10.000.000</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h3>Data Ibu</h3>
                                        <div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control required" name="nama_ibu"
                                                    value="{{ isset($data) ? $data->nama_ibu : '' }}" id="nama_ibu">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control required" name="tempat_ibu"
                                                    value="{{ isset($data) ? $data->tempat_ibu : '' }}" id="tempat_ibu">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control required" name="lahir_ibu"
                                                    value="{{ isset($data) ? $data->lahir_ibu : '' }}" id="lahir_ibu">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Pendidikan Terakhir</label>
                                                <select class="form-control required" name="pendidikan_ibu"
                                                    id="pendidikan_ibu">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="SD"
                                                        {{ isset($data) ? ($data->pendidikan_ibu == 'SD' ? 'selected' : '') : '' }}>
                                                        SD</option>
                                                    <option value="SMP"
                                                        {{ isset($data) ? ($data->pendidikan_ibu == 'SMP' ? 'selected' : '') : '' }}>
                                                        SMP</option>
                                                    <option value="SMA"
                                                        {{ isset($data) ? ($data->pendidikan_ibu == 'SMA' ? 'selected' : '') : '' }}>
                                                        SMA</option>
                                                    <option value="S1"
                                                        {{ isset($data) ? ($data->pendidikan_ibu == 'S1' ? 'selected' : '') : '' }}>
                                                        S1</option>
                                                    <option value="S2"
                                                        {{ isset($data) ? ($data->pendidikan_ibu == 'S2' ? 'selected' : '') : '' }}>
                                                        S2</option>
                                                    <option value="S3"
                                                        {{ isset($data) ? ($data->pendidikan_ibu == 'S3' ? 'selected' : '') : '' }}>
                                                        S3</option>
                                                </select>
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Pekerjaan</label>
                                                <input type="text" class="form-control required" name="pekerjaan_ibu"
                                                    value="{{ isset($data) ? $data->pekerjaan_ibu : '' }}"
                                                    id="pekerjaan_ibu">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Penghasilan</label>
                                                <select class="form-control required" name="penghasilan_ibu"
                                                    id="penghasilan_ibu">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="-"
                                                        {{ isset($data) ? ($data->penghasilan_ibu == '-' ? 'selected' : '') : '' }}>
                                                        -</option>
                                                    <option value="< 1.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ibu == '< 1.000.000' ? 'selected' : '') : '' }}>
                                                        < 1.000.000</option>
                                                    <option value="1.000.000 - 3.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ibu == '1.000.000 - 3.000.000' ? 'selected' : '') : '' }}>
                                                        1.000.000 - 3.000.000</option>
                                                    <option value="3.000.000 - 5.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ibu == '3.000.000 - 5.000.000' ? 'selected' : '') : '' }}>
                                                        3.000.000 - 5.000.000</option>
                                                    <option value="5.000.000 - 10.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ibu == '5.000.000 - 10.000.000' ? 'selected' : '') : '' }}>
                                                        5.000.000 - 10.000.000</option>
                                                    <option value="> 10.000.000"
                                                        {{ isset($data) ? ($data->penghasilan_ibu == '> 10.000.000' ? 'selected' : '') : '' }}>
                                                        > 10.000.000</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h3>Data Wali</h3>
                                        <div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control required" name="nama_wali"
                                                    value="{{ isset($data) ? $data->nama_wali : '' }}" id="nama_wali">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat</label>
                                                <textarea class="form-control required" name="alamat_wali" id="alamat_wali">{{ isset($data) ? $data->alamat_wali : '' }}</textarea>
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">No Handphone</label>
                                                <input type="number" class="form-control required" name="handphone_wali"
                                                    value="{{ isset($data) ? $data->handphone_wali : '' }}"
                                                    id="handphone_wali" placeholder="08xxxxxxxxxx">
                                            </div>
                                        </div>
                                        <h3>Riwayat Pribadi</h3>
                                        <div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Asal Sekolah</label>
                                                <input type="text" class="form-control required" name="asal_sekolah"
                                                    value="{{ isset($data) ? $data->asal_sekolah : '' }}"
                                                    id="asal_sekolah">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat Sekolah</label>
                                                <textarea class="form-control required" name="alamat_sekolah" id="alamat_sekolah">{{ isset($data) ? $data->alamat_sekolah : '' }}</textarea>
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Nomor Ijazah</label>
                                                <input type="text" class="form-control required" name="nomor_ijazah"
                                                    value="{{ isset($data) ? $data->nomor_ijazah : '' }}"
                                                    id="nomor_ijazah">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Tanggal Ijazah</label>
                                                <input type="date" class="form-control required" name="tanggal_ijazah"
                                                    value="{{ isset($data) ? $data->tanggal_ijazah : '' }}"
                                                    id="tanggal_ijazah">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Asal Pesantren</label>
                                                <input type="text" class="form-control required"
                                                    name="asal_pesantren"value="{{ isset($data) ? $data->asal_pesantren : '' }}"
                                                    id="asal_pesantren">
                                            </div>
                                            <div class="control-group form-group">
                                                <label class="form-label">Alamat Pesantren</label>
                                                <textarea class="form-control required" name="alamat_pesantren" id="alamat_pesantren">{{ isset($data) ? $data->alamat_pesantren : '' }}</textarea>
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
                $("#wizard7").steps({
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
