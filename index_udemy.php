<?php

// Видео 2 просмотрел


require_once 'classes/Car.php';

function debug($data) {
  echo "<pre>" . print_r($data, 1) . "</pre>";
}

$car1 = new Car();
$car2 = new Car();

$car1->color = 'черный';
$car1->brand = 'volvo';
$car1->year = 2018;

$car2->color = 'белый';
$car2->brand = 'bmw';
$car2->speed = 200;
$car1->year = 2017;

echo "<h3>О момем авто:</h3>
Марка: {$car1->brand}<br>
Цвет: {$car1->color}<br>
Кол-во колес: {$car1->wheels}<br>
Год выпуска: {$car1->year}<br>
Скорость: {$car1->speed}<br>";



//debug($car1);

 ?>
