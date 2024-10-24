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
                                <h4 class="card-title">Form Ubah Data Surat Edaran</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form method="POST" action="{{ route('administrator.edaran.update', $data) }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf @method('PUT')

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="nama">Perihal</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('nama') is-invalid @enderror"
                                                        type="input" name="nama" id="nama" autocomplete="off"
                                                        value="{{ old('nama', $data->nama) }}">
                                                    @error('nama')
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
                                                        value="{{ old('no', $data->no) }}">
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
                                                        value="{{ old('tanggal', $data->tanggal->format('Y-m-d')) }}">
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
                                                    <a href="{{ route('administrator.akademik.index') }}"
                                                        class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col-md-6">
                                        <iframe src="{{ asset('storage/' . $data->file) }}"
                                            style="width:100%; height:500px;" frameborder="0"></iframe>
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
