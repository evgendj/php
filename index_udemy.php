<?php

// Видео 4 просмотрел 7 минут

require_once 'classes/Car.php';

function debug($data) {
  echo "<pre>" . print_r($data, 1) . "</pre>";
}


$car1 = new Car('черный', 4, 180, 'volvo');

echo $car1->getCarInfo();




//debug($car1);

 ?>
