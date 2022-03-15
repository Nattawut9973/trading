<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
      rel="stylesheet">
<link href="{{ asset('form/css/main.css') }}" rel="stylesheet" media="all">
@extends('layouts.main_frontend')
@section('title', 'Set price')
@section('header','Auto Selling')
@section('contents')
    @include('frontend.patials.breadcumb')
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading" style="background-color: #0d104d">
                    <center><h3 style="color: yellow">{{ $order->title }}</h3></center>
                    <center><p>รายการราคา ณ วันที่ {{ date_format($now,'d M Y H:i') }}</p></center>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('set-price',[$order]) }}">
                        @csrf
                        <div class="form-row">
                            <div class="name">ชื่อ</div>
                            <div class="name">
                                <p>{{ $order->title }}</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">ราคาตอนซื้อ(บาท/หุ้น)</div>
                            <div class="name">
                                <p>{{ $order->price_per_unit }}</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">ราคาปัจจุบัน(บาท/หุ้น)</div>
                            <div class="name">
                                <p>{{ $product->bid }}</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">จำนวน</div>
                            <div class="name">
                                <p>{{ $order->amount }} หุ้น</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <select name="value" onchange="selectOption(this)">
                                <option selected disabled>กรุณาเลือก</option>
                                <option id="lower">Lower</option>
                                <option id="higher"> Higher</option>
                            </select>

                            <div style="display: none" id="lp" class="col-md-6">
                                <div class="container">
                                    <p>ต่ำกว่า</p>
                                    <div class="object-value form-inline">
                                        <input class="input--style-6 col-md-6" type="text" name="lower_price">
                                    </div>
                                </div>
                            </div>

                            <div style="display: none" id="hp" class="col-md-6">
                                <div class="container">
                                    <p>สูงกว่า</p>
                                    <div class="object-value form-inline">
                                        <input class="input--style-6 col-md-6" type="text" name="higher_price">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a class="btn btn-danger" href="{{ route('port') }}">Back</a>
                            <button class="btn btn--radius-2 btn--blue-2" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function selectOption(select) {
            if (select) {
                low = document.getElementById("lower").value;
                high = document.getElementById("higher").value;
                if (low == select.value) {
                    document.getElementById("lp").style.display = "block";
                    document.getElementById("hp").style.display = "none";
                }
                if (high == select.value) {
                    document.getElementById("hp").style.display = "block";
                    document.getElementById("lp").style.display = "none";
                }
            }
        }
    </script>

@endsection