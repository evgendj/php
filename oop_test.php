<!-- В папке классов оставь car file, в корне оставь file-->
<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

require_once('classes\Car.php');
echo Car::$countCar;
$car1 = new Car('black', 4, 180,'volvo');
echo Car::$countCar;
$car2 = new Car('white', 4, 200, 'BMW');

echo Car::$countCar;

echo $car1->getCarInfo();
echo $car2->getCarInfo();


/*
// Класс для записи в файл
require_once 'classes/file.php';

$file = new File(__DIR__ . '/file.txt');

$file->write("Строка 1");
$file->write("Строка 2");
*/
