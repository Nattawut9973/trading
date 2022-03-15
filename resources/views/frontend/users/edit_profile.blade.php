@extends('layouts.main_frontend')
@section('title', 'Edit Profile')
@section('header','Profile')
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
    body {
        /*background: -webkit-linear-gradient(left, #3931af, #00c6ff);*/
    }

    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-img img {
        width: 30%;
        height: 30%;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-head h5 {
        color: #333;
    }

    .profile-head h6 {
        color: #0062cc;
    }

    .profile-edit-btn {
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }

    .proile-rating {
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }

    .proile-rating span {
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }

    .profile-head .nav-tabs {
        margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: #0062cc;
    }
</style>
@section('contents')
    @include('frontend.patials.breadcumb')

    <div class="container">
        <h1>Edit Profile</h1>
        <hr>
        <div class="row">

            <div class="col-md-3">
                <div class="text-center">
                {{--<img src="{{ asset('uploads/profile-image') }}" class="avatar img-circle" alt="avatar">--}}
                    {{--<img width="100px" height="100px" src="{{ asset('uploads/avatars/'.$user->avatar) }}">--}}
                {{--<h6>Upload a different photo...</h6>--}}
                {{--<input type="file" class="form-control">--}}
                </div>
            </div>

            <div class="col-md-9 personal-info">
                <h3>Personal info</h3>

                <form class="form-horizontal" role="form" method="post" action="{{ route('update-profile') }}" name="form">
                    @csrf
                    <input type="hidden" value="{{ auth()->user()->id }}" name="id">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">First name:</label>
                        <div class="col-lg-8">
                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"
                                   value="{{ auth()->user()->name }}" name="name">
                        </div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Last name:</label>
                        <div class="col-lg-8">
                            <input class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}" type="text"
                                   value="{{ auth()->user()->lastname }}" name="lastname">
                        </div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Age:</label>
                        <div class="col-md-8">
                            <input class="form-control {{ $errors->has('age') ? ' is-invalid' : '' }}"
                                   type="text" value="{{ auth()->user()->age }}" name="age">
                        </div>
                        @if ($errors->has('age'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Telephone:</label>
                        <div class="col-md-8">
                            <input class="form-control {{ $errors->has('tel') ? ' is-invalid' : '' }}"
                                   type="text" value="{{ auth()->user()->tel }}" name="tel">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="button" class="btn btn-primary" value="Save Changes" onclick="myFunction()" id="conf">
                            <span></span>
                            <a href="{{ route('profile') }}" class="btn btn-default" type="button">Cancle</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <script type="text/javascript">
        function myFunction() {
            var checkConfirm = confirm("Do you confirm to save changes?");
            if (checkConfirm == true){
                form.submit();
            }
        }
    </script>
@endsection
