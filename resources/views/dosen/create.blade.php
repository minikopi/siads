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
                                <h4 class="card-title">Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ route('dosen.store') }}" class="form-horizontal"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="email">Nama</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="input" name="email"
                                                        id="email">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="email">Email</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="email" name="email"
                                                        id="email">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="nomor_induk">Nomor Induk</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="input" name="nomor_induk"
                                                        id="nomor_induk">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="jabatan">Jabatan</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="input" name="jabatan"
                                                        id="jabatan">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="tipe">Tipe</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="tipe">
                                                        <option selected disabled>---Pilih Salah Satu---</option>
                                                        <option value="Dosen">Ustadz</option>
                                                        <option value="Ustadz">Musyrif</option>
                                                    </select>
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
