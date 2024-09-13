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
                                <h4 class="card-title">Form Update Data Tahun Ajaran
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ route('academic-year.update', $data) }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf @method('PUT')

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="start_year">Tahun Awal</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('start_year') is-invalid @enderror"
                                                        type="input" name="start_year" id="start_year" autocomplete="off"
                                                        value="{{ old('start_year', $data->start_year) }}">
                                                    @error('start_year')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="end_year">Tahun Akhir</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('end_year') is-invalid @enderror"
                                                        type="input" name="end_year" id="end_year" autocomplete="off"
                                                        value="{{ old('end_year', $data->end_year) }}">
                                                    @error('end_year')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="visible">&nbsp;</label>
                                                <div class="col-md-9">
                                                    <div class="form-check">
                                                        @if ($data->visible)
                                                            <input type="hidden" name="visible" value="0">
                                                        @endif
                                                        <input class="form-check-input" name="visible" type="checkbox"
                                                            value="1" id="visible" @checked(old('visible', $data->visible) == 1)>
                                                        <label class="form-check-label" for="visible">
                                                            Aktif
                                                        </label>
                                                    </div>
                                                    @error('visible')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="active">&nbsp;</label>
                                                <div class="col-md-9">
                                                    <div class="form-check">
                                                        @if ($data->active)
                                                            <input type="hidden" name="active" value="0">
                                                        @endif
                                                        <input class="form-check-input" name="active" type="checkbox"
                                                            value="1" id="active" @checked(old('active', $data->active) == 1)>
                                                        <label class="form-check-label" for="active">
                                                            Tahun Ajaran Berjalan
                                                        </label>
                                                    </div>
                                                    @error('active')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="registration">&nbsp;</label>
                                                <div class="col-md-9">
                                                    <div class="form-check">
                                                        @if ($data->registration)
                                                            <input type="hidden" name="registration" value="0">
                                                        @endif
                                                        <input class="form-check-input" name="registration" type="checkbox"
                                                            value="1" id="registration" @checked(old('registration', $data->registration) == 1)>
                                                        <label class="form-check-label" for="registration">
                                                            Tahun Ajaran Baru
                                                        </label>
                                                    </div>
                                                    @error('registration')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('academic-year.index') }}"
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
@endsection
