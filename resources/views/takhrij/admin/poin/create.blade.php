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
                                <h4 class="card-title">Form {{isset($data) ? 'Update' : 'Pembuatan'}} Poin Syarat Sidang</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ isset($data) ? route('takhrij.points.update', ["id"=>$data->id]):route('takhrij.points.store') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="name">Poin</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                        type="input" name="name" id="name" autocomplete="off"
                                                        value="{{ isset($data) ? old('name', $data->name) : old('name') }}">
                                                    @error('name')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="code">Kode</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('code') is-invalid @enderror"
                                                        type="input" name="code" id="nomor_induk"
                                                        value="{{ isset($data) ? old('code', $data->code) : old('code') }}">
                                                    @error('code')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="sequence">Urutan</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('sequence') is-invalid @enderror"
                                                        type="number" name="sequence" id="sequence"
                                                        value="{{ isset($data) ? old('sequence', $data->sequence) : old('sequence') }}">
                                                    @error('sequence')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                    <a href="{{ route('takhrij.points.index') }}"
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
