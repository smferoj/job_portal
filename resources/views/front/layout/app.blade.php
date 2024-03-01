<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>jobportal | Find Best Jobs</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
	<link rel="shortcut icon" type="image/x-icon" href="#" />
	
</head>
<body data-instant-intensity="mousedown">
@include('front.layout.partials._header')

@yield('content')

@include('front.layout.partials._footer')
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.5.1.3.min.js')}}"></script>
<script src="{{asset('assets/js/instantpages.5.1.0.min.js')}}"></script>
<script src="{{asset('assets/js/lazyload.17.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/lightbox.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>