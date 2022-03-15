@extends('layouts.main_frontend')
@section('title', 'profile')
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
    {{--@include('flash-message')--}}
    <div class="container emp-profile">
        {{--<form method="get" action="{{ route('edit-profile') }}">--}}
        <div class="row">
            <div class="col-md-4">
                <form enctype="multipart/form-data" action="{{ route('update-image') }}" method="post">
                    @csrf
                    <img src="uploads/users/profile/{{$user->image}}"
                         style="width: 200px; height: 250px; float: left;border-radius: 50%;margin-right: 25px;">
                    <input type="file" name="image" required>
                    <input type="submit" class="pull-left btn btn-sm btn-primary" value="update">
                </form>
            </div>

            <div class="col-md-4">
                <div class="profile-head">
                    <h5>
                        {{ auth()->user()->name }}
                    </h5>

                    <p class="proile-rating">RANKINGS : @foreach($ranks as $rank)
                        @if($rank->id == auth()->user()->id)
                            {{ $loop->index+1 }}
                        @endif
                    @endforeach

                    <p class="proile-rating">ยอดคงเหลือ : <span>{{ auth()->user()->result }}</span></p>

                    <p class="proile-rating">การแข่งขัน : {{ $event->title }}</p>
                    <p class="proile-rating">ระยะเวลา : {{ $event->start_date }} - {{ $event->end_date }}</p>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">History</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <form method="get" action="{{ route('edit-profile') }}">
                    <input type="submit" class="profile-edit-btn" value="Edit Profile">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>User Id :</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ auth()->user()->id }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Firstname :</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ auth()->user()->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Lastname :</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ auth()->user()->lastname }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email :</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Telephone number :</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ auth()->user()->tel }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @foreach($orders as $order)
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ $order->title }}</label>
                                </div>
                                <div class="col-md-4">
                                    <p>{{ $order->status }}</p>
                                    <p>ราคา: {{ $order->price_per_unit }}</p>
                                    <p>จำนวน: {{ $order->amount }} หุ้น</p>
                                    <p>รวม: {{ $order->total_price }}</p>
                                    <p>วันที่ซื้อ: {{ $order->created_at}}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <div class="row col-md-4">
                            @if(empty($total))
                                ยังไม่มีรายการสั่งซื้อ
                            @else
                                รวมทั้งสิ้น :  {{ number_format($total->total_price,2) }} บาท.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection