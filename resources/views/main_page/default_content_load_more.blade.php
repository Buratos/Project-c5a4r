<?php foreach ($cars as $car) {
$car_photo_url = "img/users/{$car->user->id}/car_{$car->id}/photo_1.webp";

$car_name = $car->brand->title . " " . $car->carModel->title;
$car_price = number_format($car->price, 0, "", " ") . " $";
$car_parameters = $car->production_year . ", " . number_format($car->mileage, 0, "", " ") . " m"
?>
<div class="col-6 col-md-4 col-lg-4 col-xl-3   ps-0 ps-sm-0 pe-2 pe-sm-2 mb-2">
	<div class="card car_card">
		<a href="#">
			<img src="{{$car_photo_url}}" class="card-img-top" alt="car photo">
			<div class="card-body">
				<h6 class="car_name">{{$car_name}}</h6>
				<h6 class="car_price">{{$car_price}}</h6>
				<span class="card-text car_parameters">{{$car_parameters}}</span>
			</div>
		</a>
	</div>
</div><?php } ?>