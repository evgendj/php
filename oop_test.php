<!-- В папке классов оставь car file, в корне оставь file-->
<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

// Класс для записи в файл
require_once 'classes/file.php';










/* Создание перечня характеристик автомобиля
require_once('classes\Car.php');
$car1 = new Car('black', 4, 180,'volvo');
$car2 = new Car('white', 4, 200, 'BMW');
//debug($car1);

//debug($car1);
//debug($car2);

echo $car1->getCarInfo();
echo $car2->getCarInfo();
*/
