<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    {{--<meta name="description" content="Sufee Admin - HTML5 Admin Template">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <link rel="apple-touch-icon" href="{{ asset('admin/apple-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('admin/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>

    @include('backend.sidebar')
    @include('backend.header')
    @include('flash-message')
    @yield('contents')

<script src="{{ asset('admin/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/main.js') }}"></script>
<script src="{{ asset('admin/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('admin/assets/js/widgets.js') }}"></script>
<script src="{{ asset('admin/vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
<script src="{{ asset('admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script>
    (function ($) {
        "use strict";
        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>

</body>

</html>
