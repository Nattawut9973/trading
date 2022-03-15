@extends('layouts.main_frontend')
@section('title', 'Get Orders')
@section('header','Orders')
@section('contents')
    @include('frontend.patials.breadcumb')
    <br><br><br>
    <section id="cart_items">
        <div class="container">
            <div class="heading">
                <h3 class="text-center">Orders List</h3>
            </div>
            <div class="table-responsive cart_info">
                <form method="post" name="form" action="{{ route('getOrder') }}">
                    @csrf
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Symbol</td>
                            <td class="price">Price</td>
                            <td class="quantity">Volumn</td>
                            <td class="quantity">Time</td>
                            <td class="total">Commission(0.15%)</td>
                            <td class="total">Vat(7% of Com)</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="cart_description">
                                <h>{{ $symbol }}</h>
                                <p></p>
                            </td>
                            <td class="cart_price">
                                <p>{{ $product->offer }}</p>
                            </td>
                            <td class="cart_price">
                                <p class="cart_total_price">{{ $amount }}</p>
                            </td>
                            <td class="cart_price">
                                <p class="cart_total_price">{{ date_format($time,'H:i:s') }}</p>
                            </td>
                            <td class="cart_price">
                                <p class="cart_total_price">{{ $com_fee }}</p>
                            </td>
                            <td class="cart_price">
                                <p class="cart_total_price">{{ $vat }}</p>
                            </td>
                            <td class="cart_price">
                                <p class="cart_total_price">{{ $total_price }}</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="hidden" value="{{ $symbol }}" name="symbol">
                    <input type="hidden" value="{{ $amount }}" name="amount">
                    <input type="hidden" value="{{ $total_price }}" name="total_price">
                    <input type="hidden" value="{{ $product->offer }}" name="product">
                    <input type="hidden" value="{{ $product_id->id }}" name="product_id">
                    <input type="hidden" value="{{ $time }}" name="time">
                    <center>
                        <input type="button" class="btn cryptos-btn btn-3 m-2 text-center" onclick="myFunction()"
                               id="conf" value="Submit">
                    </center>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function myFunction() {
                 var checkConfirm = confirm("Confirm ?");
                    if (checkConfirm == true){
                form.submit();
                }
            }
        </script>
    </section> <!--/#cart_items-->
    @include('frontend.patials.letter')
@endsection