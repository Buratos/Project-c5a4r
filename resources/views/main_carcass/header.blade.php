<header class="container-fluid m-0 p-0 bg-light">
	<!--	HEADER с меню ДЛЯ МОБИЛКИ -->
	<div class="d-sm-none container-fluid bg-light px-0">
		<nav class="navbar navbar-expand-md navbar-light bg-light mb-2 pb-0 mobile_navbar">
			<div class="container-fluid px-0">
				<a href="{{route("car.index")}}" class="d-flex align-items-center mb-2 ms-2 bg-light me-lg-4 car_sale_logo">
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
							<button class="btn btn-outline-secondary do_search" type="button" id="button-addon1">
								<svg class="bi" width="16" height="16">
									<use xlink:href="#i_search"></use>
								</svg>
							</button>
							<div class="dynamic_search_results_mobile mt-2 mb-2 d-none"></div>
						</div>
					</form>
				</div>
				<div class="navbar-collapse collapse" id="navbar_mobile_red_menu">
					<div class="row mx-0 justify-content-center">
						@guest
							<div class="col-12 text-center mt-0 mb-3 for_unknown_user">
								<a href="{{ route('login') }}" type="button" class="btn btn btn-outline-secondary me-2">{{ __('Login') }}</a>
								<a href="{{ route('register') }}" type="button" class="btn btn-outline-secondary">{{ __('Register') }}</a>
							</div>
						@else
							<div class="col-12 mt-0 mb-3 px-0 d-flex flex-nowrap justify-content-center align-items-center for_logged_user">
								{{--								<a type="button" class="btn d-inline-flex align-items-center text-secondary ps-0 py-0" data-func="">
																	<!-- * -->
																	<svg class="bi" width="16" height="16">
																		<use xlink:href="#i_logget_user"></use>
																	</svg>
																	<span>{{ Auth::user()->name }}</span>
																</a>
																<button type="button" class="btn btn-outline-secondary">Log out</button>--}}
								<li class="nav-item dropdown">
									<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
										{{ Auth::user()->name }}
									</a>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
									</div>
								</li>
							</div>
						@endguest
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
									<a class="nav-link" href="#">COMPARE</a>
								</li>
								<li class="nav-item d-sm-none">
									<a class="nav-link" href="{{ route('admin.car.index') }}">ADMIN</a>
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
			<form id="search_form" class="me-3" style="flex: 1 0 8rem" action="/search">
				<div class="input-group search_wrapper">
					<input id="search" name="search_str" type="search" class="form-control" placeholder="Search in ads..." aria-label="Search" autocomplete="off">
					<button class="btn btn-outline-secondary" id="btn_search_submit" type="submit">
						<svg class="bi" width="16" height="16">
							<use xlink:href="#i_search"></use>
						</svg>
					</button>
					{{--					<input id="btn_search_submit" class="btn btn-outline-secondary" type="submit" value="SEARCH">--}}
					<div class="dynamic_search_results mt-2 mb-2 d-none "></div>
				</div>
			</form>
			<!-- Authentication Links -->
			@guest
				<div class="for_unknown_user">
					<a href="{{ route('login') }}" type="button" class="btn btn btn-outline-secondary me-2">{{ __('Login') }}</a>
					<a href="{{ route('register') }}" type="button" class="btn btn-outline-secondary">{{ __('Register') }}</a>
				</div>
			@else
				<div class="text-center for_logged_user">
					<a type="button" class="btn d-flex align-items-center text-secondary" data-func="">
						<!-- * -->
						<svg class="bi" width="16" height="16">
							<use xlink:href="#i_logget_user"></use>
						</svg>
						<span>{{ Auth::user()->name }}</span>
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST">
						@csrf
						<input href="{{ route('logout') }}" type="submit" class="btn btn-outline-secondary btn-sm lh-sm mb-sm-2 mb-md-1" value="{{ __('Logout') }}">
					</form>
					{{--<a href="{{ route('logout') }}" type="button" class="btn btn-outline-secondary btn-sm lh-sm mb-sm-2 mb-md-1">{{ __('Logout') }}</a>--}}
				</div>

				{{--<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

					</a>
					<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
				</li>--}}
			@endguest
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
					<a href="#" class="nav-link link-light px-2">CONTACTS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link link-light px-2" href="#">COMPARE</a>
				</li>
				<li class="nav-item">
					<a class="nav-link link-light px-2" href="{{ route('admin.car.index') }}">ADMIN</a>
				</li>
			</ul>
		</div>
	</nav>
</header>