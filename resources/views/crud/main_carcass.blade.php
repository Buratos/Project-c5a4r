<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="css/my_reset.css" rel="stylesheet"/>
	<!-- Bootstrap -->
	<link href="bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">
{{--	<!--	<link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">-->--}}
	<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
	<link href="css/style.css" rel="stylesheet"/>
	<!--
		<link href="fontawesome/css/fontawesome_all.min.css" rel="stylesheet">
	-->
	<script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
	<script src="js/live.js" type="text/javascript"></script>
	<script src="js/dashboard.js" type="text/javascript"></script>
	<script src="js/_my_functions_lib.js" type="text/javascript"></script>
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
	<title>Dashboard _ CREATE NEW AD</title>
</head>
<body>
<header class="container-fluid m-0 p-0 bg-light">
	<!--	HEADER с меню ДЛЯ МОБИЛКИ -->
	<div class="d-sm-none container-fluid bg-light px-0">
		<nav class="navbar navbar-expand-md navbar-light bg-light mb-2 pb-0 mobile_navbar">
			<div class="container-fluid px-0">
				<a href="/" class="d-flex align-items-center mb-2 ms-2 bg-light me-lg-4 car_sale_logo">
					<div class="i_header_logo">
						<div><!-- ЭТОТ div тут нужен --></div>
					</div>
					<h2 class="text-danger fw-bold m-0">CAR SALE</h2>
				</a>
				<button class="navbar-toggler me-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_mobile_red_menu" aria-controls="navbar_mobile_red_menu" aria-expanded="false" aria-label="Переключить навигацию">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="col-12 pb-3">
					<form class="d-flex">
						<input class="form-control ms-3 me-2" type="search" placeholder="Search in ads..." aria-label="Поиск">
						<button class="btn btn-outline-success me-3" type="submit">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
								<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
							</svg>
						</button>
					</form>
				</div>
				<div class="navbar-collapse collapse" id="navbar_mobile_red_menu">
					<div class="row mx-0 justify-content-center">
						<div class="col-12 text-center mt-0 mb-3 for_unknown_user">
							<button type="button" class="btn btn btn-outline-secondary me-2">Log in</button>
							<button type="button" class="btn btn-outline-secondary">Register</button>
						</div>
						<div class="col-12 mt-0 mb-3 px-0 d-flex flex-nowrap justify-content-center align-items-center for_logged_user d-none">
							<a type="button" class="btn d-inline-flex align-items-center text-secondary ps-0 py-0" data-func="">
								<!-- * -->
								<svg class="bi" width="16" height="16">
									<use xlink:href="#i_logget_user"></use>
								</svg>
								<span>User nickname</span>
							</a>
							<button type="button" class="btn btn-outline-secondary">Log out</button>
						</div>
						<div class="col-12 bg-danger px-0">
							<ul class="navbar-nav me-auto main_menu_red">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="#">CREATE ADS</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">LATEST ADS</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">SHOPS</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">FORUM</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">CONTACTS</a>
								</li>
								<hr class="my-1 d-sm-none text-white">
								<li class="nav-item d-sm-none">
									<a class="nav-link" href="#">MY FAVORITEs</a>
								</li>
								<li class="nav-item d-sm-none">
									<a class="nav-link" href="#">COMPARE</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div style="width: 100%;height: 1px;background-color: #AAAAAA;"></div>
			</div>
		</nav>
	</div>
	<!--	HEADER линия c логотипом для экранов БОЛЬШЕ мобилки -->
	<div class="d-none d-sm-block container-md bg-light">
		<div class="d-flex flex-wrap justify-content-left align-items-center flex-nowrap">
			<a href="/" class="d-flex align-items-center mb-sm-0 mt-sd-0 bg-light me-4 car_sale_logo">
				<div class="i_header_logo">
					<div><!-- ЭТОТ div тут нужен --></div>
				</div>
				<span class="text-danger fw-bold m-0" style="font-size: 2rem;">CAR SALE</span>
			</a>
			<form class="" style="flex: 1 0 8rem">
				<input type="search" class="form-control form-control-dark" placeholder="Search in ads..." aria-label="Search">
			</form>
			<ul class="d-none d-md-flex nav my-2 flex-nowrap">
				<li>
					<a href="#" class="nav-link text-secondary pe-2">
						<svg class="bi d-block mx-auto mt-2" width="24" height="24">
							<use xlink:href="#i_favorite"></use>
						</svg>
						Favorite
					</a>
				</li>
				<li>
					<a href="#" class="nav-link text-secondary ps-2">
						<svg class="bi d-block mx-auto mt-2" width="24" height="24">
							<use xlink:href="#i_compare"></use>
						</svg>
						Compare
					</a>
				</li>
			</ul>
			<div class="for_unknown_user">
				<button type="button" class="btn btn-outline-secondary ms-4 ms-md-0 me-2">Log in</button>
				<button type="button" class="btn btn-outline-secondary">Register</button>
			</div>
			<div class="text-center for_logged_user d-none">
				<a type="button" class="btn d-flex align-items-center text-secondary" data-func="">
					<!-- * -->
					<svg class="bi" width="16" height="16">
						<use xlink:href="#i_logget_user"></use>
					</svg>
					<span>User nickname lsdh asfda sasf</span>
				</a>
				<button type="button" class="btn btn-outline-secondary btn-sm lh-sm mb-sm-2 mb-md-1">Log out</button>
			</div>
		</div>
	</div>
	</div>
	<!--	КРАСНОЕ МЕНЮ для экранов БОЛЬШЕ мобилки -->
	<nav class="d-none d-sm-block py-2 border-bottom bg-danger text-white main_menu_red">
		<div class="container-fluid container-md d-flex  flex-wrap">
			<ul class="nav mx-auto justify-content-center">
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2 active" aria-current="page">CREATE ADS</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">LATEST ADS</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">SHOPS</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">FORUM</a>
				</li>
				<li class="nav-item">
					<a href="#" class="d-md-none nav-link link-light px-2">FAVORITE</a>
				</li>
				<li class="nav-item">
					<a href="#" class="d-md-none nav-link link-light px-2">COMPARE</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">CONTACTS</a>
				</li>
			</ul>
		</div>
	</nav>
</header>
<!-- ▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪ МЕНЮ  ИКОНОК  БРЭНДОВ  ▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪-->
{{--@include("main_page.brands_menu")--}}
<!--▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪ ФИЛЬТРЫ  FILTERS ▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪-->
{{--@include('main_page.filters')--}}
<!--▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪ КОНТЕНТ ▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪-->
@include('crud.' . $content_template_name)
{{--<h1>{{$content_template_name}}</h1>--}}
<!--▪▪▪▪▪▪▪▪▪▪▪▪▪  FOOTER   ПОДВАЛ  ▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪-->
<footer>
	<nav class="py-0  border-bottom text-white main_menu_footer">
		<div class="container d-flex flex-wrap">
			<ul class="nav mx-auto justify-content-center">
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2 active" aria-current="page">CREATE ADS</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">LATEST ADS</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">SHOPS</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">FORUM</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">CONTACTS</a>
				</li>
				<li class="nav-item d-sm-none">
					<a class="nav-link link-light px-2" href="#">MY FAVORITEs</a>
				</li>
				<li class="nav-item d-sm-none">
					<a class="nav-link link-light px-2" href="#">COMPARE</a>
				</li>
			</ul>
		</div>
	</nav>
</footer>
</body>
<!-- **************  СКЛАД   ИКОНКИ svg  -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
	<symbol id="i_close_filters_clear" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
		<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
	</symbol>
	<symbol id="i_favorite" class="bi bi-heart-pulse-fill" viewBox="0 0 16 16" fill="currentColor">
		<path fill-rule="evenodd" d="M1.475 9C2.702 10.84 4.779 12.871 8 15c3.221-2.129 5.298-4.16 6.525-6H12a.5.5 0 0 1-.464-.314l-1.457-3.642-1.598 5.593a.5.5 0 0 1-.945.049L5.889 6.568l-1.473 2.21A.5.5 0 0 1 4 9H1.475ZM.879 8C-2.426 1.68 4.41-2 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C11.59-2 18.426 1.68 15.12 8h-2.783l-1.874-4.686a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.88Z"/>
	</symbol>
	<symbol id="i_compare" class="bi bi-nintendo-switch" fill="currentColor" viewBox="0 0 16 16">
		<path d="M9.34 8.005c0-4.38.01-7.972.023-7.982C9.373.01 10.036 0 10.831 0c1.153 0 1.51.01 1.743.05 1.73.298 3.045 1.6 3.373 3.326.046.242.053.809.053 4.61 0 4.06.005 4.537-.123 4.976-.022.076-.048.15-.08.242a4.136 4.136 0 0 1-3.426 2.767c-.317.033-2.889.046-2.978.013-.05-.02-.053-.752-.053-7.979Zm4.675.269a1.621 1.621 0 0 0-1.113-1.034 1.609 1.609 0 0 0-1.938 1.073 1.9 1.9 0 0 0-.014.935 1.632 1.632 0 0 0 1.952 1.107c.51-.136.908-.504 1.11-1.028.11-.285.113-.742.003-1.053ZM3.71 3.317c-.208.04-.526.199-.695.348-.348.301-.52.729-.494 1.232.013.262.03.332.136.544.155.321.39.556.712.715.222.11.278.123.567.133.261.01.354 0 .53-.06.719-.242 1.153-.94 1.03-1.656-.142-.852-.95-1.422-1.786-1.256Z"/>
		<path d="M3.425.053a4.136 4.136 0 0 0-3.28 3.015C0 3.628-.01 3.956.005 8.3c.01 3.99.014 4.082.08 4.39.368 1.66 1.548 2.844 3.224 3.235.22.05.497.06 2.29.07 1.856.012 2.048.009 2.097-.04.05-.05.053-.69.053-7.94 0-5.374-.01-7.906-.033-7.952-.033-.06-.09-.063-2.03-.06-1.578.004-2.052.014-2.26.05Zm3 14.665-1.35-.016c-1.242-.013-1.375-.02-1.623-.083a2.81 2.81 0 0 1-2.08-2.167c-.074-.335-.074-8.579-.004-8.907a2.845 2.845 0 0 1 1.716-2.05c.438-.176.64-.196 2.058-.2l1.282-.003v13.426Z"/>
	</symbol>
	<symbol id="i_logget_user" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
		<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
		<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
	</symbol>
</svg>
<div class="sklad d-none"></div>
</html>