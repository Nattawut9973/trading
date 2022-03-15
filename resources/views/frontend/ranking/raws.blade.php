@extends('layouts.main_frontend')
@section('title','Ranking')
@section('header','Rule')
@section('contents')
    @include('frontend.patials.breadcumb')
    <section class="elements-area mt-50 section-padding-100-0">
        <div class="container">
            {{--<div class="col-12 col-lg-6">--}}
                <div class="elements-title mb-100">
                    <h2>เงื่อนไขการใช้งาน</h2>
                </div>
            {{--</div>--}}
            <div class="col-12 col-lg-6">
                <div class="accordions mb-100" id="accordion" role="tablist" aria-multiselectable="true">
                    <!-- Single Accordian Area -->
                    <div class="panel single-accordion">
                        <h6><a role="button" class="" aria-expanded="true" aria-controls="collapseOne"
                               data-toggle="collapse"
                               data-parent="#accordion" href="#collapseOne">
                                เงินลงทุนเริ่มต้น
                                <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                            </a></h6>
                        <div id="collapseOne" class="accordion-content collapse show">
                            <p> - 1,000,000 บาท </p>
                        </div>
                    </div>

                    <!-- Single Accordian Area -->
                    <div class="panel single-accordion">
                        <h6>
                            <a role="button" class="collapsed" aria-expanded="true" aria-controls="collapseTwo"
                               data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
                                ประเภทหลักทรัพย์ที่สามารถซื้อขายได้
                                <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                            </a>
                        </h6>
                        <div id="collapseTwo" class="accordion-content collapse">
                            <p> - SET50</p>
                        </div>
                    </div>

                    <div class="panel single-accordion">
                        <h6>
                            <a role="button" aria-expanded="true" aria-controls="collapseThree" class="collapsed"
                               data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
                                ช่วงเวลาให้บริการ
                                <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                            </a>
                        </h6>
                        <div id="collapseThree" class="accordion-content collapse">
                            <p>ช่วงเช้า<br>
                                Pre-open เวลา 09:55 - 10:00 น.<br>
                                Open เวลา 10:00 - 12:30 น.
                            </p>
                            <p>
                                ช่วงบ่าย<br>
                                Pre-open เวลา 14:25 - 14:30 น.<br>
                                Open เวลา 14:30 - 16:30 น.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="elements-title mb-100">
                <h2>เงื่อนไขการจัดอันดับ</h2>
            </div>
            <div class="cryptos-tabs-content">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="tab--1" data-toggle="tab" href="#tab1" role="tab"
                           aria-controls="tab1" aria-selected="false">จำนวนหลักทรัพย์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="tab--2" data-toggle="tab" href="#tab2" role="tab"
                           aria-controls="tab2" aria-selected="false">รอบการแข่งขัน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab--3" data-toggle="tab" href="#tab3" role="tab"
                           aria-controls="tab3" aria-selected="true">Point system</a>
                    </li>
                </ul>
                <div class="tab-content mb-100" id="myTabContent">
                    <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab--1">
                        <div class="cryptos-tab-content">
                            <!-- Tab Text -->
                            <div class="cryptos-tab-text">
                                <p> - มีการส่งคำสั่งซื้อ-ขายและจับคู่ไม่น้อยกว่า 5 หลักทรัพย์ในรอบนั้นๆ</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="tab2" role="tabpanel" aria-labelledby="tab--2">
                        <div class="cryptos-tab-content">
                            <!-- Tab Text -->
                            <div class="cryptos-tab-text">
                                <p> - จะจัดอันดับแบบรวมผู้เล่นทั้งหมดในแต่ละรอบ (Overall Ranking)</p>
                                <p> - ในแต่ละรอบการแข่งขันจะมีระยะเวลา 3 เดือน
                                    และในทุกๆเดือนจะมีการเปิดรับสมัครเป็นจำนวน 1
                                    รอบของทุกเดือน
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab--3">
                        <div class="cryptos-tab-content">
                            <!-- Tab Text -->
                            <div class="cryptos-tab-text">
                                <p> -
                                    การจัดอันดับจะเรียงตามมูลค่าสินทรัพย์สุทธิและอัตราการเจริญเติบโตของมูลค่าสินทรัพย์สุทธิ
                                    เทียบกับเงินลงทุนเริ่มต้น</p>
                            </div>
                        </div>
                    </div>
                    @if(auth()->check())
                    <center><a href="{{ route('products') }}" class="btn cryptos-btn btn-3 m-2">ไปที่หน้าซื้อ-ขาย</a></center>
                    @else
                    <center><a href="{{ url('register') }}" class="btn cryptos-btn btn-3 m-2">สมัครสมาชิก</a></center>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection