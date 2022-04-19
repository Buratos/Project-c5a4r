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
						<div class="input-group search_wrapper">
							<input id="search_mobile" name="search_mobile" type="search" class="form-control" placeholder="Search in ads..." aria-label="Search" autocomplete="off">
							<button class="btn btn-outline-secondary" type="button" id="button-addon1">
								<svg class="bi" width="16" height="16">
									<use xlink:href="#i_search"></use>
								</svg>
							</button>
							<div class="dynamic_search_results_mobile mt-2 mb-2 d-none">
							</div>
						</div>

						{{--
						<input id="search" name="search" type="search" class="form-control" placeholder="Search in ads..." aria-label="Search" autocomplete="off">
						<button class="btn btn-outline-success me-3" type="submit">
							<svg class="bi" width="16" height="16">
								<use xlink:href="#i_search"></use>
							</svg>
						</button>
					--}}</form>
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
			<a href="/" class="d-flex align-items-center mb-sm-0 mt-sd-0 bg-light me-3 car_sale_logo">
				<div class="i_header_logo">
					<div><!-- ЭТОТ div тут нужен --></div>
				</div>
				<span class="text-danger fw-bold m-0" style="font-size: 2rem;">CAR SALE</span>
			</a>
			<form class="me-3" style="flex: 1 0 8rem">
				<div class="input-group search_wrapper">
					<input id="search" name="search" type="search" class="form-control" placeholder="Search in ads..." aria-label="Search" autocomplete="off">
					<button class="btn btn-outline-secondary" type="button" id="button-addon1">
						<svg class="bi" width="16" height="16">
							<use xlink:href="#i_search"></use>
						</svg>
					</button>
					<div class="dynamic_search_results mt-2 mb-2 d-none ">
					</div>
				</div>
			</form>
			{{--<ul class="d-none d-md-flex nav my-2 flex-nowrap">
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
			</ul>--}}
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
					<a href="#" class="nav-link link-light px-2">FAVORITE</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">COMPARE</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link link-light px-2">CONTACTS</a>
				</li>
			</ul>
		</div>
	</nav>
</header>