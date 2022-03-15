@extends('layouts.main_login')
@section('title','login')
@section('contents')
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="card">
                    <div class="login-logo">
                        <a href="#">
                            <h1>Login</h1>
                        </a>
                    </div>

                    <div class="login-form">
                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" name="email" type="email"
                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="Email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password"
                                       class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="checkbox">
                                <label for="remember">
                                    <input type="checkbox" id="remember"
                                           name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </label>

                            </div>

                            <button type="submit"
                                    class="btn btn-success social">{{ __('Login') }}
                            </button>

                            <div class="social-login-content">
                                <div class="social-button">
                                    <button type="button" class="btn social facebook btn-flat btn-addon mb-2"><i
                                                class="ti-facebook"></i>Sign in with facebook
                                    </button>
                                    <button type="button" class="btn social google-plus btn-flat btn-addon mb-2"><i
                                                class="ti-google"></i>Sign in with google
                                    </button>
                                </div>
                            </div>
                            <div class="register-link m-t-15 text-center">
                                <p>Don't have account ? <a href="{{ route('register') }}"> Sign Up Here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
