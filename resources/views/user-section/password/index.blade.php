@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <form method="POST" action="{{ route('user.password.store') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row mt-5">
                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Ubah Kata Sandi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="current_password">Password Lama</label>
                                                <input class="form-control @error('current_password') is-invalid @enderror"
                                                    type="password" name="current_password" id="current_password"
                                                    autocomplete="off" value="{{ old('current_password') }}">
                                                @error('current_password')
                                                    <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="password">Password Baru</label>
                                                <input class="form-control @error('password') is-invalid @enderror"
                                                    type="password" name="password" id="password" autocomplete="off"
                                                    value="{{ old('password') }}">
                                                @error('password')
                                                    <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="password_confirmation">Konfirmasi Password Baru</label>
                                                <input
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    type="password" name="password_confirmation" id="password_confirmation"
                                                    autocomplete="off" value="{{ old('password_confirmation') }}">
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-sm">Ubah Password</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>
@endsection
