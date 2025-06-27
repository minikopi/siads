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
                                <h4 class="card-title">Form Pembuatan Data Kalender Akademik</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ route('administrator.akademik.store') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="nama">Nama Agenda</label>
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
                                                <label class="col-md-3 form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                        type="date" name="tanggal_mulai" id="tanggal_mulai"
                                                        value="{{ old('tanggal_mulai') }}">
                                                    @error('tanggal_mulai')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="tanggal_akhir">Tanggal Akhir</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('tanggal_akhir') is-invalid @enderror"
                                                        type="date" name="tanggal_akhir" id="tanggal_akhir"
                                                        value="{{ old('tanggal_akhir') }}">
                                                    @error('tanggal_akhir')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="semester">Semester</label>
                                                <div class="col-md-9">
                                                    <select class="form-select @error('semester') is-invalid @enderror"
                                                        name="semester" id="semester">
                                                        <option value="">--- Pilih Salah Satu ---</option>
                                                        <option value="Ganjil"
                                                            @if (old('semester') == 'Ganjil') selected @endif>Ganjil
                                                        </option>
                                                        <option value="Genap"
                                                            @if (old('semester') == 'Genap') selected @endif>Genap</option>
                                                    </select>
                                                    @error('semester')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="tahun_ajaran">Tahun Ajaran</label>
                                                <div class="col-md-9">
                                                    <select class="form-select @error('tahun_ajaran') is-invalid @enderror"
                                                        name="tahun_ajaran" id="tahun_ajaran">
                                                        <option value="">--- Pilih Tahun Ajaran ---</option>
                                                        @foreach ($academic_years as $academic_year)
                                                            <option
                                                                value="{{ $academic_year->full_year }}"
                                                                @selected(old('tahun_ajaran') == $academic_year->full_year)
                                                            >
                                                                {{ $academic_year->full_year }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('tahun_ajaran')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="keterangan">Keterangan</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('keterangan') is-invalid @enderror"
                                                        type="input" name="keterangan" id="keterangan"
                                                        value="{{ old('keterangan') }}">
                                                    @error('keterangan')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                    <a href="{{ route('administrator.akademik.index') }}"
                                                        class="btn btn-sm btn-secondary">Cancel</a>
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
@endsection
