<?php foreach ($cars as $car) {
$car_photo_url = "/storage/car_photos/{$car->photos[0]}";
$car_price = number_format($car->price, 0, "", " ") . " $";
$car_parameters = $car->production_year . ", " . number_format($car->mileage, 0, "", " ") . " m";
$url_for_card = route("car.view",[$car->id])
?>

<x-car_card :url-for-card="$url_for_card" :car-photo-url="$car_photo_url" :car-title="$car->title" :car-price="$car_price" :car-parameters="$car_parameters"/>
{{--@include('main_carcass.car_card')--}}      {{--▪▪▪ CAR CARD  карточка машины ▪▪▪--}}

<?php } ?>