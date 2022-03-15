<style>
    body {
        background-color: #1a1a1a;
        color: #fff;
    }

    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

@extends('layouts.main_frontend')
@section('title', 'Product')
@section('header','Product Content')
@section('contents')
    @include('frontend.patials.breadcumb')

    <section class="cryptos-video-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="about-content mb-100">
                        <div class="section-heading">
                            <h3><span>{{ $product->symbol }}</span></h3>
                            <h5>ราคาเปิด : {{ $product->open }} บาท.</h5>
                            <h5>ราคาสูงสุด : {{ $product->high }} บาท.</h5>
                            <h5>ราคาต่ำสุด : {{ $product->low }} บาท.</h5>
                            <h5>ราคาล่าสุด : {{ $product->last }} บาท.</h5>
                            <h5>ราคาเสนอซื้อล่าสุด : {{ $product->bid }} บาท.</h5>
                            <h5>ราคาเสนอขายล่าสุด : {{ $product->offer }} บาท.</h5>
                            <h5>* หมายเหตุ. การตั้งค่าแจ้งเตือนจะเทียบกับราคาเสนอขายล่าสุด</h5>
                            <form action="{{ route('getProduct') }}" method="get">
                                <h6>
                                    จำนวนที่ต้องการ
                                </h6>
                                <h5>
                                    <input type="text" name="amount" class="col-md-4" style="border-color: #1a1a1a;"
                                           placeholder="0">
                                </h5>
                                <input type="hidden" value="{{ $product->symbol }}" name="product">
                                <input type="submit" class="btn btn-outline-primary">
                            </form>
                            <hr>
                            @if(auth()->check())
                                <form method="post" action="{{ route('follow',['product_id' => $product_id]) }}">
                                    @csrf
                                    <h4><span>ตั้งค่าการแจ้งเตือน</span></h4>
                                    <h5>
                                        <select name="value" onchange="selectOption(this)">
                                            <option selected disabled>กรุณาเลือก</option>
                                            <option value="sale">Higher</option>
                                            <option value="buy"> Lower</option>
                                            <option value="both" id="both">Range</option>
                                        </select> <font color="red">*</font>

                                    </h5>
                                    <h5>
                                        <div id="1" style="display: block;" class="col">
                                            Price
                                            <input type="text" placeholder=" 0.00" name="price" id="price"
                                                   class="col-md-4"
                                                   style="border-color: #1a1a1a">
                                        </div>
                                        <div id="adCheck" style="display: none;" class="col">
                                            Lower
                                            <input type="text" placeholder="0.00" name="lower_price" id="lower_price"
                                                   class="col-md-4" style="border-color: #1a1a1a">
                                            or Higher
                                            <input type="text" placeholder=" 0.00" name="higher_price" id="higher_price"
                                                   class="col-md-4"
                                                   style="border-color: #1a1a1a">
                                        </div>
                                    </h5>
                                    <h5>
                                        <button type="submit" class="btn cryptos-btn mt-30"><i class="fa fa-bell">
                                                Remind me</i></button>
                                    </h5>
                                    <input type="hidden" value="{{ $user_id }}" name="user_id">
                                </form>

                            @else
                                <h4><span>ตั้งค่าการแจ้งเตือน</span></h4>
                                <h5>ไม่พบที่อยู่ที่จะรับการแจ้งเตือน! กรุณาล็อกอิน<a class="btn btn-link"
                                                                                     href="{{ route('login') }}">ตลิ๊กที่นี่</a>
                                </h5>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-10 col-md-6">
                    <div class="video-area mb-100">
                        {{--<div id="container" style="height: 400px; min-width: 400px"></div>--}}
                        <div id="chartdiv"></div>
                    </div>
                </div>
            </div>
        </div>
        <center><a class="btn btn-link" href="{{ route('products') }}">ย้อนกลับไปหน้าหลัก</a></center>
        <br>
    </section>


    <script type="text/javascript">
        function selectOption(select) {
            if (select) {
                show = document.getElementById("both").value;
                if (show == select.value) {
                    document.getElementById("adCheck").style.display = "block";
                    document.getElementById("1").style.display = "none";
                } else {
                    document.getElementById("1").style.display = "block";
                    document.getElementById("adCheck").style.display = "none";
                }
            }
        }
    </script>


    <script>
        am4core.ready(function () {
            am4core.useTheme(am4themes_dark);
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            var data = [];
            var value = 50;
            for (let i = 0; i < 300; i++) {
                let date = new Date();
                date.setHours(0, 0, 0, 0);
                date.setDate(i);
                value -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
                data.push({date: date, value: value});
            }

            chart.data = data;

            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.minGridDistance = 60;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "{value}";
            series.tooltip.pointerOrientation = "vertical";

            chart.cursor = new am4charts.XYCursor();
            chart.cursor.snapToSeries = series;
            chart.cursor.xAxis = dateAxis;

            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarX = new am4core.Scrollbar();

        }); // end am4core.ready()
    </script>


    <script>
        am4core.ready(function () {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);
            var text = {!! json_encode($text) !!};
            var j = JSON.parse(text);

            for (var i = 0; i < j.length; i++) {
                chart.data.push({
                    "date": j[i].created_at,
                    "value": parseInt(j[i].price)
                });
            }
            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.grid.template.location = 0;
            dateAxis.renderer.minGridDistance = 50;
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.strokeWidth = 3;
            series.fillOpacity = 0.5;


            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.marginLeft = 0;

            chart.scrollbarX = new am4core.Scrollbar();
            chart.scrollbarX.marginLeft = 0;


            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "zoomY";
            chart.cursor.lineX.disabled = true;
        });
    </script>

@endsection