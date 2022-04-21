<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="/css/my_reset.css" rel="stylesheet"/>
	<!-- Bootstrap -->
	<link href="/bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">
	<!--	<link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">-->
	<script src="/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
	<link href="/css/style.css" rel="stylesheet"/>
	<!--
		<link href="fontawesome/css/fontawesome_all.min.css" rel="stylesheet">
	-->
	<script src="/js/jquery-3.6.0.min.js" type="text/javascript"></script>
	@isset($debug_mode_on) <script src="/js/live_only_JS_and_css.js" type="text/javascript"></script> @endisset
	<script src="/js/dashboard.js" type="text/javascript"></script>
	<script src="/js/search.js" type="text/javascript"></script>
	<script src="/js/_my_functions_lib.js" type="text/javascript"></script>
	<!-- jquery-fancy file uploader -->
	{{--
		<script type="text/javascript" src="js/fancy-file-uploader/jquery.ui.widget.js"></script>
		<link rel="stylesheet" href="js/fancy-file-uploader/fancy_fileupload.css" type="text/css" media="all"/>
		<script type="text/javascript" src="js/fancy-file-uploader/jquery.fileupload.js"></script>
		<script type="text/javascript" src="js/fancy-file-uploader/jquery.iframe-transport.js"></script>
		<script type="text/javascript" src="js/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
	--}}
	{{--	Dropzone  --}}
	{{--
		<script src="js/dropzone/dropzone-min.js"></script>
		<link href="js/dropzone/dropzone.css" rel="stylesheet" type="text/css"/>
	--}}
{{--
	<title>@if(isset($page_title)) {{$page_title}}
		@else CREATE NEW AD @endif </title>
--}}
	<title>{{$page_title ?? "CREATE NEW AD" }}</title>
</head>