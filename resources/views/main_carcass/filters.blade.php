<nav class="btn_filters_container">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-6 col-sm-5 col-md-4 mb-sm-3">
				<button class="w-100 btn btn-outline-secondary lh-sm" data-func="show_filters">Show filters</button>
			</div>
			<div class="col-6 col-sm-5 col-md-4 mb-sm-3">
				<a  href="/add" class="w-100 btn btn-outline-secondary lh-sm" type="button" >Create new ad</a>
			</div>
		</div>
	</div>
</nav>
<section class="container-fluid bg-light collapse" id="filters_global_container">
	<div class="modal-content container-md bg-light filters_fullscreen_block " id="filters_container">
		<div class="filters_header">
			<div class="d-flex d-sm-none justify-content-between pt-3 px-4 pb-3">
				<span class="text-secondary">Найдено <span class="total_cars_found">{{$total_cars_found}}</span> товара</span>
				<button type="button" class="btn-close opacity-100" data-func="close_fullscreen_filters" aria-label="Закрыть"></button>
			</div>
			<div class="d-flex justify-content-between px-3 pb-3 p-sm-3 ">
				<span class="text-secondary d-none d-sm-block">Найдено <span class="total_cars_found">{{$total_cars_found}}</span> товара</span>
				<div class="d-flex justify-content-between w-100 w_sm_auto">
					<button type="button" class="btn btn-success btn-sm px-2 px-sm-3 ms-1 me-sm-3" data-func="apply_filters">APPLY FILTERS</button>
					<button type="button" class="btn btn-danger btn-sm px-2 px-sm-3 me-1 ms-sm-3 d-none" data-func="clear_all_filters">CLEAR ALL FILTERS</button>
				</div>
			</div>
		</div>
		<div class="row modal-body g-0 filters_content">
			<div class="col px-0 mt-0">
				<form class="needs-validation" novalidate="">
					<div class="accordion" id="filters_accordion"><!-- accordion-item -->
						<div class="accordion-item" data-group-name="price">
							<h2 class="accordion-header" id="filters_accordion__header1">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse1" aria-expanded="true" aria-controls="filters_accordion__collapse1">Price, $</button>
								<a type="button" class="btn d-flex align-items-center d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse1" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header1">
								<div class="accordion-body">
									<div class="row">
										<div class="col-6">
											<!--							<label for="price_from" class="form-label">From</label>-->
											<input type="number" class="form-control" id="filters__price_from" placeholder="from, $" value="" name="filters__price_from">
										</div>
										<div class="col-6">
											<!--							<label for="price_from" class="form-label">From</label>-->
											<input type="number" class="form-control" id="filters__price_to" placeholder="to, $" value="" name="filters__price_to">
										</div>
										<div class="col text-center mt-3">
											<button class="w-50 btn btn-secondary btn-sm" data-func="apply_filters__price">Apply prices</button>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="brand">
							<h2 class="accordion-header" id="filters_accordion__header2">
								<button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse2" aria-expanded="false" aria-controls="filters_accordion__collapse2">Car brand</button>
								<a type="button" class="btn d-flex align-items-center d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse2" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header2">
								<div class="accordion-body d-flex flex-wrap g-1">
                  <?php foreach ($filters["brand"] as $title => $value) {
                  ?>
									<label class="btn_checkbox btn_checkbox_filters">
										<input type="checkbox" name="filters_checkbox__brands_{{$value["id"]}}" data-value="{{$value["value"]}}">
										<div class="btn_checkbox_text">
											<span>{{$title}}</span><span id="brand_{{$value["id"]}}">{{$value["count"]}}</span>
										</div>
									</label>
                  <?php } ?>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="car_model">
							<h2 class="accordion-header" id="filters_accordion__header3">
								<button class="accordion-button  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse3" aria-expanded="false" aria-controls="filters_accordion__collapse3">Car model</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse3" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header3">
								<div class="accordion-body d-flex flex-wrap g-1">
                  <?php
                  if ($filters["brand_checked_count"] != 1) {
                  ?>
									<div class="text-center w-100">Please select one manufacturer (above)</div>
                  <?php } else foreach ($filters["car_model"] as $title => $value) {
                  ?>
									<label class="btn_checkbox btn_checkbox_filters">
										<input type="checkbox" name="filters_checkbox__car_models_{{$value["id"]}}" data-value="{{$value["value"]}}">
										<div class="btn_checkbox_text">
											<span>{{$title}}</span><span id="car_model_{{$value["id"]}}">{{$value["count"]}}</span>
										</div>
									</label>
                  <?php } ?>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="production_year">
							<h2 class="accordion-header" id="filters_accordion__header4">
								<button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse4" aria-expanded="false" aria-controls="filters_accordion__collapse4">Production year</button>
								<a type="button" class="btn d-flex align-items-center d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse4" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header4">
								<div class="accordion-body">
									{{--<div class="row justify-content-center">
										<div class="col-6">
											<input type="number" class="form-control" id="filters__price_from" placeholder="starting, year" value="" name="filters__price_from">
										</div>
										<div class="col-6">
											<input type="number" class="form-control" id="filters__price_to" placeholder="ending, year" value="" name="filters__price_to">
										</div>
										<div class="col col-sm-6 text-center mt-3 mb-2">
											<button class="w-100 btn btn-secondary btn-sm" data-func="apply_filters__production_years">Apply or select below</button>
										</div>
									</div>
									<hr class="my-2">--}}
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["production_year"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__production_years_{{$title}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="production_year_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="body_type">
							<h2 class="accordion-header" id="filters_accordion__header6">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse6" aria-expanded="false" aria-controls="filters_accordion__collapse6">Car body type</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse6" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header6">
								<div class="accordion-body">
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["body_type"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__car_body_types_{{$value["id"]}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="body_type_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="color">
							<h2 class="accordion-header" id="filters_accordion__header9">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse9" aria-expanded="false" aria-controls="filters_accordion__collapse9">Color of car</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse9" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header9">
								<div class="accordion-body">
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["color"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__colors_{{$value["id"]}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="color_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="number_doors">
							<h2 class="accordion-header" id="filters_accordion__header12">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse12" aria-expanded="false" aria-controls="filters_accordion__collapse12">Number of doors</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse12" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header12">
								<div class="accordion-body">
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["number_doors"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__number_doors_{{$title}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="number_doors_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="number_places">
							<h2 class="accordion-header" id="filters_accordion__header13">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse13" aria-expanded="false" aria-controls="filters_accordion__collapse13">Number of places</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse13" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header13">
								<div class="accordion-body">
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["number_places"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__number_places_{{$title}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="number_places_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="vehicle_drive_type">
							<h2 class="accordion-header" id="filters_accordion__header10">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse10" aria-expanded="false" aria-controls="filters_accordion__collapse10">Vehicle drive type</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse10" class="accordion-collapse collapse" aria-labelledby="filters_accordion__header10">
								<div class="accordion-body">
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["vehicle_drive_type"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__vehicle_drive_types_{{$value["id"]}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="vehicle_drive_type_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="transmission_type">
							<h2 class="accordion-header" id="filters_accordion__header5">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse5" aria-expanded="false" aria-controls="filters_accordion__collapse5">Transmission type</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse5" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header5">
								<div class="accordion-body">
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["transmission_type"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__transmission_types_{{$value["id"]}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="transmission_type_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="engine_type">
							<h2 class="accordion-header" id="filters_accordion__header7">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse7" aria-expanded="false" aria-controls="filters_accordion__collapse7">Engine type</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse7" class="accordion-collapse collapse" aria-labelledby="filters_accordion__header7">
								<div class="accordion-body">
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["engine_type"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__engine_types_{{$value["id"]}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="engine_type_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="engine_capacity">
							<h2 class="accordion-header" id="filters_accordion__header8 ">
								<button class="accordion-button collapsed text-center" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse8" aria-expanded="false" aria-controls="filters_accordion__collapse8">Engine capacity
								</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse8" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header8">
								<div class="accordion-body">
									{{--
																		<div class="row justify-content-center">
																			<div class="col-6">
																				<input type="number" class="form-control" id="filters__price_from" placeholder="from 1600, cm" value="" name="filters__price_from">
																			</div>
																			<div class="col-6">
																				<input type="number" class="form-control" id="filters__price_to" placeholder="to 3200, cm" value="" name="filters__price_to">
																			</div>
																			<div class="col col-sm-6 text-center mt-3 mb-2">
																				<button class="w-100 btn btn-secondary btn-sm" data-func="apply_filters__engine_capacity">Apply or select below</button>
																			</div>
																		</div>
																		<hr class="my-2">
									--}}
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["engine_capacity"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__engine_capacities_{{$value["id"]}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="engine_capacity_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="engine_power">
							<h2 class="accordion-header" id="filters_accordion__header11">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse11" aria-expanded="true" aria-controls="filters_accordion__collapse11">Engine power</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse11" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header11">
								<div class="accordion-body">
									<div class="row justify-content-center">
										<div class="col-6">
											<input type="number" class="form-control" id="filters__engine_power_from" placeholder="from, hp" value="" name="filters__engine_power_from">
										</div>
										<div class="col-6">
											<input type="number" class="form-control" id="filters__engine_power_to" placeholder="to, hp" value="" name="filters__engine_power_to">
										</div>
										<div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2 col-xxl-1 text-center mt-3">
											<button class="w-100 btn btn-secondary btn-sm" data-func="apply_filters__engine_power">Apply</button>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="car_mileage">
							<h2 class="accordion-header" id="filters_accordion__header15">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse15" aria-expanded="true" aria-controls="filters_accordion__collapse15">Сar mileage</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse15" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header15">
								<div class="accordion-body">
									<div class="row justify-content-center">
										<div class="col-6">
											<input type="number" class="form-control" id="filters__mileage_from" placeholder="from, miles" value="" name="filters__mileage_from">
										</div>
										<div class="col-6">
											<input type="number" class="form-control" id="filters__mileage_to" placeholder="to, miles" value="" name="filters__mileage_to">
										</div>
										<div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2 col-xxl-1 text-center mt-3">
											<button class="w-100 btn btn-secondary btn-sm" data-func="apply_filters__mileage">Apply</button>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="dimensions">
							<h2 class="accordion-header" id="filters_accordion__header14">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse14" aria-expanded="true" aria-controls="filters_accordion__collapse14">Dimensions of a car</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse14" class="accordion-collapse collapse" aria-labelledby="filters_accordion__header14">
								<div class="accordion-body">
									<div class="row">
										<h6 class="text-center">Length, cm</h6>
										<div class="col-6">
											<input type="number" class="form-control" id="filters__length_from" placeholder="from, cm" value="" name="filters__length_from">
										</div>
										<div class="col-6">
											<input type="number" class="form-control" id="filters__length_to" placeholder="to, cm" value="" name="filters__length_to">
										</div>
									</div>
									<div class="row mt-3">
										<h6 class="text-center">Width, cm</h6>
										<div class="col-6">
											<input type="number" class="form-control" id="filters__price_from" placeholder="from, cm" value="" name="filters__price_from">
										</div>
										<div class="col-6">
											<input type="number" class="form-control" id="filters__price_to" placeholder="to, cm" value="" name="filters__price_to">
										</div>
									</div>
									<div class="row mt-3">
										<h6 class="text-center">Height, cm</h6>
										<div class="col-6">
											<input type="number" class="form-control" id="filters__price_from" placeholder="from, cm" value="" name="filters__price_from">
										</div>
										<div class="col-6">
											<input type="number" class="form-control" id="filters__price_to" placeholder="to, cm" value="" name="filters__price_to">
										</div>
									</div>
									<div class="row">
										<div class="col text-center mt-3">
											<button class="w-50 btn btn-secondary btn-sm" type="" data-func="apply_filters__dimensions">Apply</button>
										</div>
									</div>
								</div>
							</div>
						</div><!-- accordion-item -->
						<div class="accordion-item" data-group-name="was_in_accident">
							<h2 class="accordion-header" id="filters_accordion__header16">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filters_accordion__collapse16" aria-expanded="false" aria-controls="filters_accordion__collapse16">Car was in an accident</button>
								<a type="button" class="btn d-flex align-items-center  d-none" data-func="clear_filters">
									<!-- * -->
									<span>0</span>
									<svg class="bi" width="16" height="16">
										<use xlink:href="#i_close_filters_clear"></use>
									</svg>
								</a>
							</h2>
							<div id="filters_accordion__collapse16" class="accordion-collapse collapse " aria-labelledby="filters_accordion__header16">
								<div class="accordion-body">
									<div class="row">
										<div class="col d-flex flex-wrap g-1">
                      <?php foreach ($filters["was_in_accident"] as $title => $value) {
                      ?>
											<label class="btn_checkbox btn_checkbox_filters">
												<input type="checkbox" name="filters_checkbox__was_in_accident_{{$title}}" data-value="{{$value["value"]}}">
												<div class="btn_checkbox_text">
													<span>{{$title}}</span><span id="was_in_accident_{{$value["id"]}}">{{$value["count"]}}</span>
												</div>
											</label>
                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr class="d-none my-4">
					<div class="d-none row justify-content-center">
						<div class="col col-sm-6 col-md-5 col-lg-4 col-xl-3 col-xxl-2">
							<button class="w-100 btn btn-primary btn-lg" type="">Show results</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="filters_header">
			<div class="d-flex d-sm-none justify-content-between pt-3 px-4 pb-3">
				<span class="text-secondary">Найдено <span class="total_cars_found">{{$total_cars_found}}</span> товара</span>
				<button type="button" class="btn-close opacity-100" data-func="close_fullscreen_filters" aria-label="Закрыть"></button>
			</div>
			<div class="d-flex justify-content-between px-3 pb-3 p-sm-3 ">
				<span class="text-secondary d-none d-sm-block">Найдено <span class="total_cars_found">{{$total_cars_found}}</span> товара</span>
				<div class="d-flex justify-content-between w-100 w_sm_auto">
					<button type="button" class="btn btn-success btn-sm px-2 px-sm-3 ms-1 me-sm-3" data-func="apply_filters">APPLY FILTERS</button>
					<button type="button" class="btn btn-danger btn-sm px-2 px-sm-3 me-1 ms-sm-3 d-none" data-func="clear_all_filters">CLEAR ALL FILTERS</button>
				</div>
			</div>
		</div>
	</div>
</section>
