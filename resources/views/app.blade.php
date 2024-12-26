<html>
@php
    $siteSetting = DB::table('site_settings')->first();
@endphp
<head>
    <title>Garments Niyog</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/js/app.js')
    @if(!empty($siteSetting))
        <link rel="shortcut icon" href="{{asset($siteSetting->favicon)}}">
    @endif

    {{-- Frontend Template Styles Start--}}
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}" />
    {{-- Frontend Template Styles End--}}
    @inertiaHead
</head>
<body>
@inertia
{{-- Frontend Template Scripts --}}
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.counterup.js')}}"></script>
<script src="{{asset('frontend/js/jquery.waypoints.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
{{-- End Frontend Template Scripts --}}
</body>
</html>
