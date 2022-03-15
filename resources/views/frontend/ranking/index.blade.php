<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }

</style>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>


@extends('layouts.main_frontend')
@section('title','Ranking')
@section('header','Total Ranking')
@section('contents')
    <section class="cryptos-blog-area section-padding-100">
        @include('frontend.patials.breadcumb')
        <br><br>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-7">
                    <div class="blog-area">
                        <form action="{{ route('month') }}" method="get">
                            <div class="single-blog-area d-flex align-items-start">
                                <!-- Thumbnail -->
                                <div class="blog-thumbnail">
                                    <h4><label for="month">รอบการแข่งขัน</label></h4>
                                    <select class="cryptos-tabs-content" name="event_id">
                                        <option selected>All</option>
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->title }}
                                                ( {{ $event->start_date }} - {{ $event->end_date }} )
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-link col-md-2">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if($tops == null)
                    <div class="col-12 col-lg-6">
                        <div class="cryptos-prices-table">
                            <div class="single-price-table d-flex align-items-center justify-content-between">
                                <div class="p-content d-flex align-items-center">
                                    <span>ยังไม่มีรายชื่อผู้เล่นที่ถูกจัดอันดับในรอบนี้</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 col-lg-6">
                        {{--<div class="cryptos-prices-table">--}}
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">Table Ranking</div>
                                @foreach($tops as $key => $top)
                                    <div class="single-price-table d-flex align-items-center justify-content-between">
                                        <div class="p-content d-flex align-items-center">
                                            <span>{{ $key+1 }}.</span>
                                            <p>{{ $top->name }}</p>

                                        </div>
                                        <div class="price">
                                            <p>{{ $top->sum }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Top Ranking</h4>
                                <div class="flot-container">
                                    <div id="chartdiv"></div>
                                </div>
                            </div>
                        </div><!-- /# card -->
                    </div><!-- /# column -->
                @endif
            </div>
        </div>
        <!-- Newsletter Area -->
        @include('frontend.patials.letter')
    </section>
@endsection
<script>
    am4core.ready(function () {
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
        chart.data = [{
            "name": "Jared",
            "points": 999875.29,
            "color": chart.colors.next(),
            "bullet": "https://www.amcharts.com/lib/images/faces/A04.png"
        }, {
            "name": "Garrison",
            "points": 967733.77,
            "color": chart.colors.next(),
            "bullet": "https://www.amcharts.com/lib/images/faces/C02.png"
        }, {
            "name": "Irwin",
            "points": 927661.62,
            "color": chart.colors.next(),
            "bullet": "https://www.amcharts.com/lib/images/faces/D02.png"
        }, {
            "name": "Scotty",
            "points": 897245.07,
            "color": chart.colors.next(),
            "bullet": "https://www.amcharts.com/lib/images/faces/E01.png"
        },
            {
                "name": "Dillon",
                "points": 897150.26,
                "color": chart.colors.next(),
                "bullet": "https://www.amcharts.com/lib/images/faces/F01.png"
            }];

// Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "name";
        categoryAxis.renderer.grid.template.disabled = true;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.inside = true;
        categoryAxis.renderer.labels.template.fill = am4core.color("#fff");
        categoryAxis.renderer.labels.template.fontSize = 20;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.grid.template.strokeDasharray = "4,4";
        valueAxis.renderer.labels.template.disabled = true;
        valueAxis.min = 0;

// Do not crop bullets
        chart.maskBullets = false;

// Remove padding
        chart.paddingBottom = 0;

// Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "points";
        series.dataFields.categoryX = "name";
        series.columns.template.propertyFields.fill = "color";
        series.columns.template.propertyFields.stroke = "color";
        series.columns.template.column.cornerRadiusTopLeft = 15;
        series.columns.template.column.cornerRadiusTopRight = 15;
        series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/b]";

// Add bullets
        var bullet = series.bullets.push(new am4charts.Bullet());
        var image = bullet.createChild(am4core.Image);
        image.horizontalCenter = "middle";
        image.verticalCenter = "bottom";
        image.dy = 20;
        image.y = am4core.percent(100);
        image.propertyFields.href = "bullet";
        image.tooltipText = series.columns.template.tooltipText;
        image.propertyFields.fill = "color";
        image.filters.push(new am4core.DropShadowFilter());

    }); // end am4core.ready()
</script>
