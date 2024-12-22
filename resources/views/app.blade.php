<html>
@php
    $siteSetting = DB::table('site_settings')->first();
@endphp
<head>
    <meta charset="utf-8" />
    <title>Garments Niyog</title>
    @vite('resources/js/app.js')
    {{-- Frontend Template Styles Start--}}
    @if(!empty($siteSetting))
    <link rel="shortcut icon" href="{{asset($siteSetting->favicon)}}">
    @endif
    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}" />
    {{-- Frontend Template Styles End--}}
    @inertiaHead
</head>
<body>
@inertia

{{-- Frontend Template Scripts --}}
<!-- JS here -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.counterup.js')}}"></script>
<script src="{{asset('frontend/js/jquery.waypoints.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
{{-- End Frontend Template Scripts --}}
</body>
</html>
