<div class="content container pt-3 pb-1">
	<div class="row car_list">
		<h3 class="text-center fw-bold">Create a new ad</h3>
		<h4 class="text-center">Describe your car</h4>
		<hr>
		<form class="add_new_car_form" enctype="multipart/form-data" id="add_new_car_form">
			<div class="row justify-content-center">
				<div class="col-12 col-sm-6">
					<div class="col-12 mt-0">
						<label class="" for="brand_list">Car brand</label>
						<input list="brand_datalist" id="brand_list" name="brand" placeholder="Choose car brand" value="">
						<datalist id="brand_datalist">
							@foreach ($brand_titles as $title)
								<option value="{{$title}}">
							@endforeach
						</datalist>
					</div>
					<div class="col-12 col-sm-6 mt-2 first_choose_brand">
						<span class="text-nowrap" for="">Car model - first choose car brand</span>
					</div>
					<div class="col-12 col-sm-6 mt-2 d-none no_models_found">
						<span class="" for="">No models found of the brand you entered</span>
					</div>
					<div class="col-12 car_model_selection mt-2 d-none">
						<label for="car_model_list">Car model</label>
						<input list="car_model_datalist" id="car_model_list" name="car_model" placeholder="Choose or input car model" autocomplete="off" value="">
						<datalist id="car_model_datalist"></datalist>
					</div>
					<div class="col-12 mt-2">
						<label for="price" class="">Price, $</label>
						<input id="price" name="price" type="number" placeholder="Input price, $" value="10600">
					</div>
					<div class="col-12 mt-2">
						<label for="production_year" class="">Car production year</label>
						<input id="production_year" name="production_year" type="number" placeholder="Input car production year" value="2018">
					</div>
					<div class="col-12 mt-2">
						<label for="body_type_list">Car body type</label>
						<input list="body_type_datalist" id="body_type_list" name="body_type" placeholder="Input or choose car body type" value="Sedan">
						<datalist id="body_type_datalist">
							@foreach($body_type_titles as $title)
								<option value="{{$title}}">
							@endforeach
						</datalist>
					</div>
					<div class="col-12 mt-2">
						<label for="color_list">Color of a car</label>
						<input list="color_datalist" id="color_list" name="color" placeholder="Input or choose car color" value="Light gray">
						<datalist id="color_datalist">
							<option value="value 1">
						</datalist>
					</div>
					<div class="col-12 mt-2">
						<label for="number_doors" class="">Number of doors</label>
						<input id="number_doors" name="number_doors" type="number" placeholder="Input number of doors" value="4">
					</div>
					<div class="col-12 mt-2">
						<label for="number_places" class="">Number of places</label>
						<input id="number_places" name="number_places" type="number" placeholder="Input number of places in a car" value="5">
					</div>
					<div class="col-12 mt-2">
						<label for="vehicle_drive_type_list">Vehicle drive type</label>
						<input list="vehicle_drive_type_datalist" id="vehicle_drive_type_list" name="vehicle_drive_type" placeholder="Input or choose vehicle drive type" value="Front-wheel drive">
						<datalist id="vehicle_drive_type_datalist">
							<!--					<option value="value 1">-->
						</datalist>
					</div>
				</div>
				<div class="d-none d-sm-block p-0 m-0" style="width: 0px;outline: 1px solid #ecedee;margin-left: -20px"></div>
				<div class="col-12 col-sm-6">
					<div class="col-12 mt-0">
						<label for="transmission_type_list">Car transmission type</label>
						<input list="transmission_type_datalist" id="transmission_type_list" name="transmission_type" placeholder="input or choose transmission type" value="Automatic">
						<datalist id="transmission_type_datalist">
							<!--					<option value="value 1">-->
						</datalist>
					</div>
					<div class="col-12 mt-2">
						<label for="engine_type_list">Car engine type</label>
						<input list="engine_type_datalist" id="engine_type_list" name="engine_type" placeholder="Input or choose car engine type" value="Petrol">
						<datalist id="engine_type_datalist">
							<!--					<option value="value 1">-->
						</datalist>
					</div>
					<div class="col-12 mt-2">
						<label for="engine_capacity" class="">Engine capacity</label>
						<input id="engine_capacity" name="engine_capacity" type="number" placeholder="Input engine capacity" value="1799">
					</div>
					<div class="col-12 mt-2">
						<label for="engine_power" class="">Engine power</label>
						<input id="engine_power" name="engine_power" type="number" placeholder="Horse powers" value="175">
					</div>
					<div class="col-12 mt-2">
						<label for="mileage" class="">Car mileage</label>
						<input id="mileage" name="mileage" type="number" placeholder="Input mileage" value="45000">
					</div>
					<div class="col-12 mt-2">
						<h6 class="">Dimensions of a car:</h6>
						<label for="dimensions_length" class="mt-2">Length, mm</label>
						<input id="dimensions_length" name="dimensions_length" type="number" placeholder="Input height, mm" value="510" style="width: 5rem" class="me-3"><br>
						<label for="dimensions_width" class="mt-2">Width, mm</label>
						<input id="dimensions_width" name="dimensions_width" type="number" placeholder="Input width, mm" value="181" style="width: 5rem" class="me-3"><br>
						<label for="dimensions_height" class="mt-2">Height, mm</label>
						<input id="dimensions_height" name="dimensions_height" type="number" placeholder="Input height, mm" value="176" style="width: 5rem">
					</div>
					<div class=" col-12 mt-2 ">
						<span class="mt-3 me-2">Was a car in accident ?</span>
						<input checked id="was_in_accident_no" class="btn-check" name="was_in_accident" type="radio" value="0" autocomplete="off">
						<label for="was_in_accident_no" class="btn btn-outline-secondary btn-sm me-2">No</label>
						<input id="was_in_accident_yes" class="btn-check" name="was_in_accident" type="radio" value="1" autocomplete="off">
						<label for="was_in_accident_yes" class="btn btn-outline-secondary btn-sm">Yes</label>
					</div>
				</div>
				<div class="row my-1">
					<div class="files_input_area">
						<!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла
						оно укажет скрипту PHP максимальный размер файла, который можно передавать с клиента. Это чтобы никак не передали огромный файл, на всяк случай. Размер в байтах-->
						<input type="hidden" name="MAX_FILE_SIZE" value="10245760">
						<label for="input__upload_photos" class="files">фотки, можно выбрать несколько файлов</label><br>
						<input accept=".jpg,image/*" id="input__upload_photos" multiple="multiple" type="file">
					</div>
				</div>
				{{--
								<div class="col-12 col-sm-6 mt-2 upload_photos_container">
									<input id="photos_to_upload" type="file" name="files" accept=".jpg, .png, .webp, image/jpeg, image/png" multiple>
								</div>
				--}}
			</div>
			<div class="row my-2">
				<div class="input-group">
					<span class="input-group-text" style="max-width: 30%; overflow: hidden; white-space: normal">Description for your car</span>
					<textarea class="form-control" cols="50" placeholder="Сюда вы можете добавить текст" rows="5" name="description" id="description">{{$description}}</textarea>
				</div>
			</div>
			<div class="row my-1">
				<div class="col-12 text-center">
					<a class="btn btn-primary me-3" id="send_data" style="min-width: 7rem">Send</a>
					<button class="btn btn-success" id="clear_data" type="button" style="min-width: 7rem">Clear data</button>
				</div>
			</div>
		</form>
		{{--		<div class="dropzone" id="dropzone">--}}{{-- DROPZONE --}}
	</div>
	<div class="row my-1 php_response"></div>
</div></div>
</div></div>