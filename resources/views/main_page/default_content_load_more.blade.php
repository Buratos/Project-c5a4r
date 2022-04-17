<?php foreach ($cars as $car) {
$car_photo_url = "/storage/car_photos/{$car->photos[0]}";


$car_name = $car->brand->title . " " . $car->carModel->title;
$car_price = number_format($car->price, 0, "", " ") . " $";
$car_parameters = $car->production_year . ", " . number_format($car->mileage, 0, "", " ") . " m";
$url = "/view_car/" . $car->id;
?>

@include('main_carcass.car_card')      {{--▪▪▪ CAR CARD  карточка машины ▪▪▪--}}

<?php } ?>