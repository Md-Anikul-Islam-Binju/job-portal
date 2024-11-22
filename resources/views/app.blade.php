<html>
@php
    $siteSetting = DB::table('site_settings')->first();
@endphp
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/js/app.js')

    {{-- Frontend Template Styles Start--}}
    @if(!empty($siteSetting))
    <link rel="shortcut icon" href="{{asset($siteSetting->favicon)}}">
    @endif
    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}">
    {{-- Frontend Template Styles End--}}

    @inertiaHead
</head>
<body>
@inertia

{{-- Frontend Template Scripts --}}
<!-- JS here -->
<script src="{{asset('frontend/js/vendor/modernizr-3.5.0.min.js')}}"></script>
<script src="{{asset('frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/js/ajax-form.js')}}"></script>
<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/js/scrollIt.js')}}"></script>
<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('frontend/js/wow.min.js')}}"></script>
<script src="{{asset('frontend/js/nice-select.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.slicknav.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins.js')}}"></script>
<script src="{{asset('frontend/js/gijgo.min.js')}}"></script>
<!--contact js-->
<script src="{{asset('frontend/js/contact.js')}}"></script>
<script src="{{asset('frontend/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.form.js')}}"></script>
<script src="{{asset('frontend/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('frontend/js/mail-script.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
{{-- End Frontend Template Scripts --}}
</body>
</html>
