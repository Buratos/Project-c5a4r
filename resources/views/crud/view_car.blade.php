<div class="content container pt-3 pb-1">
	<div class="row car_list">
		<h4 class="text-center fw-bold">{{$car->title . " " . $car->production_year}}</h4>
		<hr>
		<div class="row my-1">
			<div class="col-12 text-center">
				<a href="{{route("edit_car",["id" => $car->id])}}" class="btn btn-primary me-3" id="edit_car" style="min-width: 7rem">Edit car</a>
				<a href="{{route("delete_car",["id" => $car])}}" class="btn btn-primary me-3" id="delete_car" style="min-width: 7rem">Delete car</a>
			</div>
		</div>
		<div class="col-12 ps-0 ps-sm-0 pe-2 pe-sm-2 mb-2">
			<div class="card car_card">
				@foreach($car->photos as $photo)
					<img src="{{"/storage/car_photos/" . $photo}}" class="card-img-top mb-2" alt="car photo">
				@endforeach
				<div class="card-body">
					<h6 class="car_name">{{$car->title . " " . $car->production_year}}</h6>
					<h6 class="car_price">{{number_format($car->price, 0, "", " ") . " $"}} $</h6>
				</div>
			</div>
		</div>
		<div class="row my-1">
			<div class="col-12 text-center">
				<a href="{{route("edit_car",["id" => $car->id])}}" class="btn btn-primary me-3" id="edit_car" style="min-width: 7rem">Edit car</a>
			</div>
		</div>
	</div>
	<div class="row my-1 php_response"></div>
</div>