@extends('template')

@section('content')
    <div>
        <!-- CONTAINER OPEN -->
        <div class="col col-login mx-auto mt-7">
            <div class="text-center">
                <!-- <img src="../assets/images/brand/logo.png" class="header-brand-img" alt=""> -->
            </div>
        </div>
        <div class="container-login100">
            <div class="wrap-login100 p-0">
                <div class="card-body">
                    <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <span class="login100-form-title">
                            <img src="{{ asset('images/logo.png') }}" class="mobile-logo logo-1" alt="logo">
                        </span>
                        <div class="wrap-input100 validate-input" data-bs-validate = "Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="email" placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="zmdi zmdi-email" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-bs-validate = "Password is required">
                            <input class="input100" type="password" name="password" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        {{-- <div class="text-end pt-1">
                        <p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">Forgot Password?</a></p>
                    </div> --}}
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn btn-primary">
                                Login
                            </button>
                        </div>
                        {{-- <div class="text-center pt-3">
                        <p class="text-dark mb-0">Not a member?<a href="register.html" class="text-primary ms-1">Create an Account</a></p>
                    </div> --}}
                    </form>
                </div>
                {{-- <div class="card-footer">
                <div class="d-flex justify-content-center my-3">
                    <a href="" class="social-login  text-center me-4">
                        <i class="fa fa-google"></i>
                    </a>
                    <a href="" class="social-login  text-center me-4">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="" class="social-login  text-center">
                        <i class="fa fa-twitter"></i>
                    </a>
                </div>
            </div> --}}
            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>






    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
