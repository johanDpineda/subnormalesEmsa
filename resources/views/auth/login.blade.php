@extends('layouts.auth.app')
@section('title',__('Sign in'))
@section('content')

<style>
    .btneternalsesion{
        background-color: #3333ff;
  border-color: transparent;
  color: white;
  font-weight: bolder;
}

.btneternalsesion:hover{
    background-color: #1818df  !important;
  border-color: transparent !important;
  color: white !important;
  font-weight: bolder !important;

    
}

.btneternalsesion:focus{
    background-color: #1818df  !important;
  border-color: transparent !important;
  color: white !important;
  font-weight: bolder !important;

    
}
</style>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="/" class="app-brand-link gap-2">
                                <img src="{{asset('assets/img/logo-emsa.png')}}" alt="" class="light-logo img-fluid" >
                                <img src="{{asset('assets/img/logo-emsa.png')}}" alt="" class="dark-logo img-fluid" >
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2 text-center">{{__('Welcome to Emsa')}} </h4>
                        <p class="mb-4 text-center">{{__('Please sign-in to your account and Register your SubNormales data')}}</p>

                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{__('Email')}}</label>
                                <input
                                    type="text"
                                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    id="email"
                                    placeholder="{{__('Enter your email')}}"
                                />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">{{__('Password')}}</label>
{{--                                    <a href="auth-forgot-password-basic.html">--}}
{{--                                        <small>Forgot Password?</small>--}}
{{--                                    </a>--}}
                                </div>
                                <div class="input-group input-group-merge">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
{{--                            <div class="mb-3">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" id="remember-me" />--}}
{{--                                    <label class="form-check-label" for="remember-me"> Remember Me </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100 btneternalsesion" type="submit">{{__('Sign in')}}</button>
                            </div>
                        </form>

{{--                        <p class="text-center">--}}
{{--                            <span>New on our platform?</span>--}}
{{--                            <a href="auth-register-basic.html">--}}
{{--                                <span>Create an account</span>--}}
{{--                            </a>--}}
{{--                        </p>--}}

{{--                        <div class="divider my-4">--}}
{{--                            <div class="divider-text">or</div>--}}
{{--                        </div>--}}

{{--                        <div class="d-flex justify-content-center">--}}
{{--                            <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">--}}
{{--                                <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>--}}
{{--                            </a>--}}

{{--                            <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">--}}
{{--                                <i class="tf-icons fa-brands fa-google fs-5"></i>--}}
{{--                            </a>--}}

{{--                            <a href="javascript:;" class="btn btn-icon btn-label-twitter">--}}
{{--                                <i class="tf-icons fa-brands fa-twitter fs-5"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
