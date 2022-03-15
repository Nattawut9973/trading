@extends('layouts.main_frontend')
@section('title', 'Sell Orders')
@section('header','Sell Order')
@section('contents')
    @include('frontend.patials.breadcumb')
    <br><br><br>
    <section id="cart_items">
        <div class="container">
            <div class="heading">
                <h3 class="text-center">Orders List</h3>
            </div>
            <div class="table-responsive cart_info">
                <form method="post" name="form" action="{{ route('sell-order') }}">
                    @csrf
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Symbol</td>
                            <td class="price">Price</td>
                            <td class="quantity">Volume</td>
                            <td class="quantity">Time</td>
                            <td class="total">Commission(0.15%)</td>
                            <td class="total">Vat(7% of Com)</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $item)
                            <tr>
                                <td class="cart_price">
                                    <p>{{ $item->title }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ $item->product->bid }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ $item->amount }}</p>
                                </td>
                                <td class="cart_price">
                                    <p class="cart_total_price">{{ $now }}</p>
                                </td>
                                <td class="cart_total">
                                    <p>{{ number_format($com,3) }}</p>
                                </td>
                                <td class="cart_total">
                                    <p>{{ $vat }}</p>
                                </td>
                                <td class="cart_total">
                                    <p>{{ number_format($total_price,2) }}</p>
                                </td>
                                <input type="hidden" value="{{ $item->id }}" name="order_id">
                                <input type="hidden" value="{{ $item->product->bid }}" name="price_per_unit">
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <center>
                        <input type="button" class="btn cryptos-btn btn-3 m-2 text-center" onclick="myFunction()"
                               id="conf" value="Submit">
                        <input type="hidden" value="{{ $total_price }}" name="total_price">
                    </center>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function myFunction() {
                var checkConfirm = confirm("Confirm ?");
                if (checkConfirm == true) {
                    form.submit();
                }
            }
        </script>
    </section> <!--/#cart_items-->
    @include('frontend.patials.letter')
@endsection