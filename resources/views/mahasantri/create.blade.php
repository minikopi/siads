@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="row mt-5">
                    <form method="POST" action="{{ route('mahasantri.store') }}"
                                            class="form-horizontal" enctype="multipart/form-data" id="form">
                                            @csrf
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header border-bottom-0">
                                <div class="card-title">
                                    Form Pembuatan Akun Mahasantri
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
                                                    <input type="text" class="form-control required" name="nama_depan"
                                                        id="nama_depan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="control-group form-group">
                                                    <label class="form-label">Nama Belakang</label>
                                                    <input type="text" class="form-control required" name="nama_belakang"
                                                        id="nama_belakang">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select class="form-control required" name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Kelas</label>
                                            <select class="form-control required" name="kelas_id" id="kelas">
                                                <option value="">Pilih Salah Satu</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat Email</label>
                                            <input type="email" class="form-control required" name="email"
                                                id="email">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Handphone</label>
                                            <input type="number" class="form-control required" placeholder="08xxxxxxxxxx"
                                                name="handphone" id="handphone">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat</label>
                                            <textarea class="form-control required" name="alamat" id="alamat"></textarea>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Kode Pos</label>
                                            <input type="number" class="form-control required" name="kode_pos"
                                                id="kode_pos">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control required" name="tanggal_lahir"
                                                id="tanggal_lahir">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Suku</label>
                                            <input type="text" class="form-control required" name="suku"
                                                id="suku">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Saudara</label>
                                            <input type="text" class="form-control required" name="saudara"
                                                id="saudara">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Hobi</label>
                                            <input type="text" class="form-control required" name="hobi"
                                                id="hobi">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Golongan Darah</label>
                                            <select class="form-control required" name="golongan_darah" id="golongan_darah">
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
                                                placeholder="Kg" id="berat_badan">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tinggi Badan</label>
                                            <input type="number" class="form-control required" name="tinggi_badan"
                                                placeholder="cm" id="tinggi_badan">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Riwayat Penyakit</label>
                                            <textarea class="form-control required" name="penyakit" id="penyakit"></textarea>
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
                                                id="nama_ayah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control required" name="tempat_ayah"
                                                id="tempat_ayah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control required" name="lahir_ayah"
                                                id="lahir_ayah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Pendidikan Terakhir</label>
                                            <select class="form-control required" name="pendidikan_ayah"
                                                id="pendidikan_ayah">
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
                                            <select class="form-control required" name="pekerjaan_ayah"
                                                id="pekerjaan_ayah">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
                                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                <option value="Wirausaha">Wirausaha</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Penghasilan</label>
                                            <select class="form-control required" name="penghasilan_ayah"
                                                id=penghasilan_ayah>
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
                                            <input type="text" class="form-control required" name="nama_ibu"
                                                id="nama_ibu">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control required" name="tempat_ibu"
                                                id="tempat_ibu">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control required" name="lahir_ibu"
                                                id="lahir_ibu">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Pendidikan Terakhir</label>
                                            <select class="form-control required" name="pendidikan_ibu"
                                                id="pendidikan_ibu">
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
                                            <select class="form-control required" name="pekerjaan_ibu"
                                                id="pekerjaan_ibu">
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
                                            <select class="form-control required" name="penghasilan_ibu"
                                                id="penghasilan_ibu">
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
                                            <input type="text" class="form-control required" name="nama_wali"
                                                id="nama_wali">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat</label>
                                            <textarea class="form-control required" name="alamat_wali" id="alamat_wali"></textarea>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">No Handphone</label>
                                            <input type="number" class="form-control required" name="handphone_wali"
                                                id="handphone_wali" placeholder="08xxxxxxxxxx">
                                        </div>
                                    </div>
                                    <h3>Riwayat Pribadi</h3>
                                    <div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Asal Sekolah</label>
                                            <input type="text" class="form-control required" name="asal_sekolah"
                                                id="asal_sekolah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat Sekolah</label>
                                            <textarea class="form-control required" name="alamat_sekolah" id="alamat_sekolah"></textarea>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Nomor Ijazah</label>
                                            <input type="text" class="form-control required" name="nomor_ijazah"
                                                id="nomor_ijazah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Tanggal Ijazah</label>
                                            <input type="date" class="form-control required" name="tanggal_ijazah"
                                                id="tanggal_ijazah">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Asal Pesantren</label>
                                            <input type="text" class="form-control required" name="asal_pesantren"
                                                id="asal_pesantren">
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">Alamat Pesantren</label>
                                            <textarea class="form-control required" name="alamat_pesantren" id="alamat_pesantren"></textarea>
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
                titleTemplate:
                    '<span class="number">#index#</span> <span class="title">#title#</span>',
                stepsOrientation: 1,
                    onFinished: function(event, currentIndex) {
                        $("#form").submit();
                    }
                });

                $("#jenis_kelamin").change(function(){
                    var gender = $(this).val();
                    $('#kelas').empty();
                    $.ajax({
                        url: '{{route("kelas.jsonClass")}}?gender='+gender,  // Ganti dengan URL endpoint Anda
                        type: 'GET',  // Atur sesuai dengan metode yang dibutuhkan (GET, POST, dll.)
                        success: function(response, xhr) {
                            $("#kelas").append('<option value="">Pilih Salah Satu</option>');
                            $.each(response, function(index, element) {
                                console.log(element)
                                $("#kelas").append('<option value="' + element.id + '">' + element.nama + '</option>');
                            });
                        }
                    });
                })
            });



        </script>
        <script>

        </script>

        <!-- INTERNAL Jquery.steps js -->
        <script src="{{ asset('plugins/jquery-steps/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

        <!-- INTERNAL Accordion-Wizard-Form js-->
        <script src="{{ asset('plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
        <script src="{{ asset('js/form-wizard.js') }}"></script>

        <!-- FORM WIZARD JS-->
		<script src="{{ asset('plugins/formwizard/jquery.smartWizard.js')}}"></script>
		<script src="{{ asset('plugins/formwizard/fromwizard.js')}}"></script>
    @endpush
@endsection
