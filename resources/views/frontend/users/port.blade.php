@extends('layouts.main_frontend')
@section('title', 'profile')
@section('header','Port')
@section('contents')
    @include('frontend.patials.breadcumb')
    <br><br>
    <div class="container">
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>#</th>
            <th>ชื่อ</th>
            <th>จำนวน</th>
            <th>ราคา/หุ้น</th>
            <th>ราคาาเสนอซื้อ</th>
            <th>ราคาาเสนอขาย</th>
            <th>ราคาขาย/หน่วย</th>
            <th>รวม</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody style="background-color: whitesmoke">
        @foreach($orders as $key => $order)
            <form action="{{ route('pre-sell') }}" method="POST">
                @csrf
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $order->title }}</td>
                    <td>{{ $order->amount }}</td>
                    <td>{{ $order->price_per_unit }}</td>
                    <td>{{ $order->product->bid }}</td>
                    <td>{{ $order->product->offer }}</td>
                    <td>{{ number_format($order->product->bid - $order->price_per_unit,2) }} บาท/หุ้น
                        {{--<i class="fa fa-bitcoin"></i></td>--}}
                    <td>{{ number_format(($order->amount * $order->product->bid) - ($order->amount * $order->price_per_unit),2) }}</td>
                    <td>
                        <input type="hidden" value="{{ $order->id }}" name="order_id">
                        <input type="hidden" value="{{ $order->total_price }}" name="total_price">
                        <input type="hidden" value="{{ $order->product->bid }}" name="price">
                        <input type="hidden" value="{{ $order->amount }}" name="amount">
                        <input type="hidden" value="{{ $order->product->symbol }}" name="symbol">
                        <button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart"></i> sell</button>

                        <a class="btn btn-primary" href="{{ route('auto-sale',[$order]) }}"><i class="fa fa-gear"></i> auto</a>

                    </td>
                </tr>
            </form>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection