<span>ТЕСТ КОМПОНЕНТА x-car_card</span>
<hr>@php
	$car_parameters = "car_parameters";
$car =new stdClass();
$car->model = "Fiat Punto";
$car->price = 10400;
@endphp
<span class="p-4 text-gray-500 bg-red"></span>
<x-car_card url-for-card="http://lara3-car-sale/view_car/296" car-photo-url="/storage/car_photos/4c6b97c5-1a99-432d-a184-73fc457505e3.webp" :car-name="$car->model" :car-price="$car->price" :car-parameters="$car_parameters"/>

