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
                                <h4 class="card-title">Form Pembuatan Data Surat Edaran</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ route('akademik.storeEdaran') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="perihal">Perihal</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('perihal') is-invalid @enderror"
                                                        type="input" name="perihal" id="perihal" autocomplete="off"
                                                        value="{{ old('perihal') }}">
                                                    @error('perihal')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="no">No Edaran</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('no') is-invalid @enderror"
                                                        type="input" name="no" id="no"
                                                        value="{{ old('no') }}">
                                                    @error('no')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="tanggal">Tanggal</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('tanggal') is-invalid @enderror"
                                                        type="date" name="tanggal" id="tanggal"
                                                        value="{{ old('tanggal') }}">
                                                    @error('tanggal')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="file">File</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('file') is-invalid @enderror"
                                                        type="file" name="file" id="file" accept=".pdf">
                                                    @error('file')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('akademik.index') }}"
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
