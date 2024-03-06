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
                                <h4 class="card-title">Form {{isset($data['dosen']) ? "Update" : "Pembuatan"}} Akun Dosen</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ isset($data['dosen']) ? route('dosen.update', ["id" => $data['dosen']->id]) : route('dosen.store') }}" class="form-horizontal"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="nama">Nama</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('nama') is-invalid @enderror"
                                                        type="input" name="nama" id="nama" autocomplete="off"
                                                        value="{{ isset($data['dosen']) ? $data['dosen']->user->name : ''}}">
                                                    @error('nama')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="email">Email</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('email') is-invalid @enderror"
                                                        type="email" name="email" id="email" autocomplete="off"
                                                        value="{{ isset($data['dosen']) ? $data['dosen']->user->email : ''}}">
                                                    @error('email')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="nomor_induk">Nomor Induk</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('nomor_induk') is-invalid @enderror"
                                                        type="input" name="nomor_induk" id="nomor_induk"
                                                        value="{{ isset($data['dosen']) ? $data['dosen']->nomor_induk : ''}}">
                                                    @error('nomor_induk')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="jabatan">Jabatan</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('jabatan') is-invalid @enderror"
                                                        type="input" name="jabatan" id="jabatan"
                                                        value="{{ isset($data['dosen']) ? $data['dosen']->jabatan : ''}}">
                                                    @error('jabatan')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="matkul">Mata Kuliah</label>
                                                <div class="col-md-9">
														<select multiple="multiple" class="filter-multi" name="matkul[]">
                                                            @foreach ($data['matkul'] as $item)
                                                                <option value="{{$item->id}}" {{isset($data['dosen']) ? $data['dosen']->matkul->where('matkul_id', $item->id)->first() != null ? 'selected' : '' : ''}}>{{$item->nama}} smester {{$item->smester}}</option>
                                                            @endforeach

														</select>
                                                    @error('matkul')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="tipe">Tipe</label>
                                                <div class="col-md-9">
                                                    <select class="form-control @error('tipe') is-invalid @enderror"
                                                        name="tipe">
                                                        <option selected disabled>---Pilih Salah Satu---</option>
                                                        <option value="Dosen"
                                                            {{isset($data['dosen']) ? $data['dosen']->tipe == 'Dosen' ? 'selected' : '' : ''}}>Dosen
                                                        </option>
                                                        <option value="Musyrif"
                                                            {{isset($data['dosen']) ? $data['dosen']->tipe == 'Musyrif' ? 'selected' : '' : ''}}>Musyrif
                                                        </option>
                                                    </select>
                                                    @error('tipe')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('dosen.index') }}"
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
