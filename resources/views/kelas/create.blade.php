@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="row mt-5">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Pembuatan Data Mata Kuliah</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ route('kelas.store') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="nama">Nama</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('nama') is-invalid @enderror"
                                                        type="input" name="nama" id="nama" autocomplete="off"
                                                        value="{{ old('nama') }}">
                                                    @error('nama')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Tahun ajaran</label>
                                                <div class="col-md-9">
                                                    <input type="input" class="form-control required" name="tahun_ajaran"
                                                    id="tahun_ajaran">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="smester">Smester</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('smester') is-invalid @enderror"
                                                        type="number" name="smester" id="smester"
                                                        value="{{ old('smester') }}">
                                                    @error('smester')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Jenis Kelamin</label>
                                                <div class="col-md-9">
                                                <select class="form-control required" name="gender" id="gender">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('kelas.index') }}"
                                                        class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>

    @push('custom')
        <script>
            $(function() {
                $("#tahun_ajaran").datepicker({
                    format: "yyyy",
                    startView: "years",
                    minViewMode: "years",
                    autoclose: true
                });

                $('#tahun_ajaran').on('input', function() {
                    var inputValue = $(this).val();
                    var numericRegex = /^[0-9]+$/;

                    if (!numericRegex.test(inputValue)) {
                        // Jika karakter yang dimasukkan bukan angka, hapus karakter terakhir
                        $(this).val(inputValue.slice(0, -1));
                    }
                });
            });


        </script>
    @endpush
@endsection
