<div class="content container pt-3 pb-1">
	<div class="row car_list">
		{{--
				<div class="col-12 paginator_container">{{$cars->onEachSide(0)->links()}}</div>
		--}}
		<div class="col-12 paginator__test_container"></div>
		<div class="d-flex flex-wrap ps-2 pe-0 car_list_container"> <!-- ОБЁРТКА ЧТОБЫ ВЫРОВНЯТЬ ОТСТУПЫ МЕЖДУ CARDs-->
       <?php foreach ($cars as $car) {
       $url_for_card = route("car.view", [$car->id]);
       $car_photo_url = "/storage/car_photos/{$car->photos[0]}";

       $car_name = $car->brand->title . " " . $car->carModel->title;
       $car_price = number_format($car->price, 0, "", " ") . " $";
       $car_parameters = $car->production_year . ", " . number_format($car->mileage, 0, "", " ") . " m";
       ?>
			<x-car_card :url-for-card="$url_for_card" :car-photo-url="$car_photo_url" :car-title="$car->title" :car-price="$car_price" :car-parameters="$car_parameters"/>

		<?php } ?>
		</div>
		<div class="col-12 text-center mt-1 mb-2 load_more_btn_container">
			<span class="me-4">Показано <span class="total_loaded_cars">{{$cars_per_page}}</span> машин из <span>{{$cars_number}}</span></span>
			<button class="btn btn-outline-secondary lh-sm btn_load_more" type="button" data-func="load_more" data-already-loaded-pages="1">Load more...</button>
		</div>
	</div>
</div>