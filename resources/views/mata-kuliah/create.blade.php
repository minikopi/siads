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
                                <h4 class="card-title">Form {{isset($data) ? 'Update' : 'Pembuatan'}} Data Mata Kuliah</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ isset($data) ? route('mata-kuliah.update', ["id"=>$data->id]):route('mata-kuliah.store') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="nama">Nama</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('nama') is-invalid @enderror"
                                                        type="input" name="nama" id="nama" autocomplete="off"
                                                        value="{{ isset($data) ? $data->nama : '' }}">
                                                    @error('nama')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="kode">Kode</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('kode') is-invalid @enderror"
                                                        type="input" name="kode" id="nomor_induk"
                                                        value="{{ isset($data) ? $data->kode : '' }}">
                                                    @error('kode')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="sks">SKS</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('sks') is-invalid @enderror"
                                                        type="input" name="sks" id="sks"
                                                        value="{{ isset($data) ? $data->sks : '' }}">
                                                    @error('sks')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="smester">Semester</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('smester') is-invalid @enderror"
                                                        type="number" name="smester" id="smester"
                                                        value="{{ isset($data) ? $data->smester : '' }}">
                                                    @error('smester')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                    <a href="{{ route('mata-kuliah.index') }}"
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
