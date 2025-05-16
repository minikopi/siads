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
                                <h4 class="card-title">{{ $title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form method="POST" action="{{ route('mahasantri.import.upload') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Tahun ajaran</label>
                                                <div class="col-md-9">
                                                    <input type="input"
                                                        class="form-control @error('tahun_ajaran') is-invalid @enderror" name="tahun_ajaran"
                                                        id="tahun_ajaran">
                                                        @error('tahun_ajaran')
                                                        <div class="invalid-feedback" style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row
                                                        mb-4">
                                                    <label class="col-md-3 form-label">Upload File</label>
                                                    <div class="col-md-9">
                                                        <input type="file"
                                                            class="form-control @error('excel') is-invalid @enderror" name="excel"
                                                        id="excel">
                                                        @error('excel')
                                                        <div class="invalid-feedback" style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-0
                                                            mt-4 row justify-content-end">
                                                        <div class="col-md-9">
                                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                            <a href="{{ route('mahasantri.index') }}"
                                                                class="btn btn-sm btn-secondary">Cancel</a>
                                                        </div>
                                                    </div>
                                        </form>

                                    </div>

                                    <div class="col-md-6">
                                        <h3>Baca Dahulu</h3>
                                        <ol>
                                            <li>Data pertama selalu dimulai dari baris ke-7.</li>
                                            <li>Jangan pernah hapus data baris ke-6.</li>
                                            <li>Baris ketiga adalah contoh data atau opsi data yang bisa diinput.</li>
                                            <li>Seluruh kolom wajib diisi, meski hanya garis (-).</li>
                                        </ol>

                                        <h4>Unduh berkas import</h4>
                                        <a href="{{ asset('import/mahasantri.xlsx') }}" class="btn btn-sm btn-primary"
                                            download="">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            Unduh
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
