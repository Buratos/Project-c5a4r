<div class="content container pt-3 pb-1">
	<div class="row car_list">
		<div class="col-12 col-sm-6 mt-1 mb-2 load_more_btn_container">
			<span class="me-4">Found <span>{{$cars->total()}}</span> cars</span>
		</div>
		<div class="col-12 col-sm-6 paginator_container">{{$cars->onEachSide(0)->links()}}</div>
		<div class="d-flex flex-wrap ps-2 pe-0 car_list_container"> <!-- ОБЁРТКА ЧТОБЫ ВЫРОВНЯТЬ ОТСТУПЫ МЕЖДУ CARDs-->
			@foreach($cars as $car)
				@php
					$url_for_card = route("car.view", [$car]);
					$car_photo_url = "/storage/car_photos/{$car->photos[0]}";
					$car_name = $car->title;
					$car_price = number_format($car->price, 0, "", " ") . " $";
					$car_year = $car->production_year . ", " . number_format($car->mileage, 0, "", " ") . " m";
				@endphp
				<x-car_card_for_search_results :url-for-card="$url_for_card" :car-photo-url="$car_photo_url" :car-title="$car->title" :car-price="$car_price" :car-parameters="$car_year"/>
			@endforeach
		</div>
		<div class="col-12 col-sm-6 mt-1 mb-2 load_more_btn_container">
			<span class="me-4">Found <span>{{$cars->total()}}</span> cars</span>
		</div>
		<div class="col-12 col-sm-6 paginator_container">{{$cars->onEachSide(0)->links()}}</div>

	</div>
</div>