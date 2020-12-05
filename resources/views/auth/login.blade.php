@extends('layouts.app')

@section('content')

<div class="content-body"><!-- login page start -->

<section id="auth-login" class="row flexbox-container">
    <div class="col-xl-8 col-11">
        <div class="card bg-authentication mb-0">
            <div class="row m-0">
                <!-- left section-login -->
                <div class="col-md-6 col-12 px-0">
                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                        <div class="card-header pb-1">
                            <div class="card-title">
                                <h4 class="text-center mb-2">{{ __('Welcome Back') }}</h4>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="d-flex flex-md-row flex-column justify-content-around">
                                    <a href="#"
                                        class="btn btn-social btn-google btn-block font-small-3 mr-md-1 mb-md-0 mb-1">
                                        <i class="bx bxl-google font-medium-3"></i><span
                                            class="pl-50 d-block text-center">Google</span></a>
                                    <a href="#" class="btn btn-social btn-block mt-0 btn-facebook font-small-3">
                                        <i class="bx bxl-facebook-square font-medium-3"></i><span
                                            class="pl-50 d-block text-center">Facebook</span></a>
                                </div>
                                <div class="divider">
                                    <div class="divider-text text-uppercase text-muted"><small>or login with
                                            Username</small>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('login') }}">

                                @csrf
                                    <div class="form-group mb-50">
                                        <label class="text-bold-600" for="exampleInputEmail1">Username</label>

                                        <input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                            placeholder="User Name" value="{{ old('username') }}" required autocomplete="username" autofocus/>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="text-bold-600" for="exampleInputPassword1">{{ __('Password') }}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" placeholder="Password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                        <div class="text-left">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="checkboxsmall" for="exampleCheck1">
                                                <small>{{ __('Keep me logged in') }}</small>
                                                </label>
                                            </div>
                                        </div>

                                    @if (Route::has('password.request'))
                                        <div class="text-right"><a href="{{ route('password.request') }}"
                                            class="card-link"><small> {{ __('Forgot Your Password?') }}</small></a>
                                        </div>
                                    @endif

                                    </div>
                                    <button type="submit" class="btn btn-primary glow w-100 position-relative">{{ __('Login') }}
                                    <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center"><small class="mr-25">Don't have an account?</small><a
                                        href="{{ route('register') }}"><small>Sign up</small></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right section image -->
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                    <div class="card-content">
                        <img class="img-fluid" src="{{ asset('images/pages/login.png') }}" alt="branding logo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</div><!-- login page ends -->

@endsection
