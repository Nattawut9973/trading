@extends('layouts.main_frontend')
@section('title', 'Product')
@section('header', 'Market Summary')
@section('contents')
    <head>
        <style>
            .custom-table {
                border-collapse: collapse;
                width: 100%;
                border: solid 1px #c0c0c0;
                font-family: 'Droid Sans', 'Helvetica', Arial, sans-serif;
                font-size: 14px;
            }

            .custom-table th, .custom-table td {
                text-align: left;
                padding: 8px;
                border: solid 1.5px #c0c0c0
            }

            .custom-table th {
                color: #0d152a;
            }

            .custom-table tr:nth-child(odd) {
                background-color: #f7f7ff
            }

            .custom-table > thead > tr {
                background-color: #dde8f7 !important
            }

            .tbtn {
                border: 0;
                outline: 0;
                background-color: transparent;
                font-size: 13px;
                cursor: pointer
            }

            .toggler {
                display: none;
            }

            .toggler1 {
                display: table-row;
            }

            .custom-table a {
                color: #0033cc;
            }

            .custom-table a:hover {
                color: #f00;
            }

            body {
                /*font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;*/
            }
        </style>
    </head>
    @include('frontend.patials.breadcumb')
    <section class="currency-calculator-area section-padding-100" style="background-color : #0d104d">
        <div class="container">
            <table class="custom-table">
                <thead>
                <tr>
                    <th class="text-center">Symbol</a></th>
                    <th class="text-center">Open</th>
                    <th class="text-center">High</th>
                    <th class="text-center">Low</th>
                    <th class="text-center">Last</th>
                    <th class="text-center">Change</th>
                    <th class="text-center">% Change</th>
                    <th class="text-center">Bid</th>
                    <th class="text-center">Offer</th>
                    <th class="text-center">Volume</th>
                    <th class="text-center">Value('000 <i class="fa fa-bitcoin"></i> )</th>

                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="toggler toggler1">
                        <td style="background-color: whitesmoke">
                            <a href="{{ route('product-follow',['product_id' => $product->id]) }}">{{ $product->symbol }}</a>
                        </td>
                        <td style="background-color: white" class="text-center">{{ $product->open }}</td>
                        <td style="background-color: white" class="text-center">{{ $product->high }}</td>
                        <td style="background-color: white" class="text-center">{{ $product->low }}</td>
                        <td style="background-color: white" class="text-center">{{ $product->last }}</td>
                        <td style="background-color: white" class="text-center">{{ number_format((float)($product->last)-(float)($product->open),2) }}</td>
                        <td style="background-color: white" class="text-center">{{ number_format(($product->last * ($product->last - $product->open)/100),2) }}
                        </td>
                        <td style="background-color: white" class="text-center">{{ $product->bid }}</td>
                        <td style="background-color: white" class="text-center">{{ $product->offer }}</td>
                        <td style="background-color: white" class="text-center">{{ $product->volumn }}</td>
                        <td style="background-color: white" class="text-center">{{ $product->value }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <div class="currency-calculator mb-15 clearfix">
                <form action="{{ route('getProduct') }}" method="GET"
                      class="d-flex align-items-center justify-content-center">
                    <!-- Calculator Part -->
                    <div class="calculator-first-part d-flex align-items-center">
                        <input type="text" name="amount" placeholder="0" id="amount"
                               autocomplete="off" required>
                        <select name="product" class="select2-results__option">
                            @foreach($products as $product)
                                <option>{{ $product->symbol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Equal Sign -->
                    <div class="equal-sign"></div>
                    <button type="submit" class="btn btn-bottom ">Submit</button>
                </form>
            </div>
        </div>

    </section>
    @include('frontend.patials.letter')
@endsection
