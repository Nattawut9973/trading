<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') </title>
    <link rel="icon" href="{{ asset('frontend/img/core-img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">

</head>

<body>
@include('frontend.patials.header')
@yield('contents')
@include('sweetalert::alert')
@include('frontend.patials.footer')

<!-- jQuery-2.2.4 js -->
<script src="{{ asset('frontend/js/jquery/jquery-2.2.4.min.js') }}"></script>
<!-- Popper js -->
<script src="{{ asset('frontend/js/bootstrap/popper.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('frontend/js/bootstrap/bootstrap.min.js') }}"></script>
<!-- All Plugins js -->
<script src="{{ asset('frontend/js/plugins/plugins.js') }}"></script>
<!-- Active js -->
<script src="{{ asset('frontend/js/active.js') }}"></script>
</body>

</html>
