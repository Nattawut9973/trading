@extends('layouts.main_login')
@section('title','Register')
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
                    <form>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="email" class="form-control" placeholder="User Name">
                        </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" placeholder="Email">
                        </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password">
                        </div>
                                    <div class="checkbox">
                                        <label>
                                <input type="checkbox"> Agree the terms and policy
                            </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                                
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account ? <a href="{{ route('admin.login') }}"> Sign in</a></p>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection