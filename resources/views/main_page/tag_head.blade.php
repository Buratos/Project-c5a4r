<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{asset('/css/my_reset.css')}}" rel="stylesheet"/>
	<!-- Bootstrap -->
	<link href="{{asset('/bootstrap-5.1.3-dist/css/bootstrap.css')}}" rel="stylesheet">
	<!--	<link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">-->
	<script src="{{asset('/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js')}}"></script>
	<link href="{{asset('/css/style.css')}}" rel="stylesheet"/>
	<!--
		<link href="fontawesome/css/fontawesome_all.min.css" rel="stylesheet">
	-->
	<script src="{{asset('/js/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
	@isset($debug_mode_on) <script src="/js/live_only_JS_and_css.js" type="text/javascript"></script> @endisset
	<script src="{{asset('/js/script.js')}}" type="text/javascript"></script>
	<script src="{{asset('/js/search.js')}}" type="text/javascript"></script>
	<script src="{{asset('/js/_my_functions_lib.js')}}" type="text/javascript"></script>
{{--
	<title>@if(isset($page_title)) {{$page_title}}
		@else LARA CAR SALE @endif </title>
--}}
<title>{{$page_title ?? "LARA CAR SALE" }}</title>
</head>