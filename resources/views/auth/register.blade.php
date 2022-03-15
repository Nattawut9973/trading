@extends('layouts.main_login')
@section('title','register')
@section('contents')
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="">
                        <h2>Register</h2>
                    </a>
                </div>
                <div class="login-form">
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Firstname') }}</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Name"
                                   value="{{ old('name') }}" required autofocus autocomplete="none">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">{{ __('Lastname') }}</label>
                            <input id="name" name="lastname" type="text" class="form-control" placeholder="Lastname"
                                   value="{{ old('lastname') }}" required autofocus autocomplete="none">
                            @if ($errors->has('lastname'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label>{{ __('E-Mail Address') }}</label>
                            <input id="email" name="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="Email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" id="password" name="password"
                                   class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input type="password" id="password-confirm"
                                   class="form-control"
                                   placeholder="Re-password" name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Age') }}</label>
                            <input id="age" name="age" type="text"
                                   class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}"
                                   placeholder="Your age" value="{{ old('age') }}" required>
                            @if ($errors->has('age'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ __('Telephone') }}</label>
                            <input id="tel" name="tel" type="text"
                                   class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}"
                                   placeholder="Telephone number" value="{{ old('tel') }}" required>
                            @if ($errors->has('tel'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{__('Mode')}}</label>
                            <select class="form-control" name="event">
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->title }}
                                        ( {{ date('d-M-Y',strtotime($event->start_date)) }}
                                        - {{ date('d-M-Y',strtotime($event->end_date)) }} ) (win {{ $event->price }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" id="register">
                            Register
                        </button>

                        <div class="register-link m-t-15 text-center">
                            <p>Already have account ? <a href="{{ route('login') }}"> Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
