<!-- В папке классов оставь car file, в корне оставь file-->
<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}


class Product {

	public $name;
	public $price;

	public $cpu;
	public $numPages;

	public function __construct($name, $price, $cpu = null, $numPages = nuul) {
		$this->name = $name;
		$this->price = $price;
		$this->cpu = $cpu;
		$this->$numPages = $numPages;
	}

	public function getCpu() {
		return $this->cpu;
	}

	public function getProduct($type = 'notebook') {
		$out = "<hr><b>О товаре:</b><br>
						Наименование: {$this->name}<br>
						Цена: {$this->price}<br>";
		if ($type == 'notebook') {
			$out .= "Процессор: {$this->cpu}<br>";
		} else {
			$out .= "Количество страниц: {$this->numPages}<br>";
		}
		return $out;
	}



}






// Статика, константы, свойства, методы
/*
require_once('classes\Car.php');
echo Car::$countCar; // Обращаемся к свойству
$car1 = new Car('black', 4, 180,'volvo');
echo Car::$countCar; // Обращаемся к свойству
$car2 = new Car('white', 4, 200, 'BMW');

echo Car::getCount(); // Обращаемся к методу

echo $car1->getCarInfo();
echo $car2->getCarInfo();

echo $car1->getPrototypeInfo(); // Выводим данные протатипа, которые в константе
echo CAR::TEST_CAR_SPEED; // Обращение к константе
echo "<br>" . Car::class; // Вывод имени класса
*/



// Класс для записи в файл
/*
require_once 'classes/file.php';

$file = new File(__DIR__ . '/file.txt');

$file->write("Строка 1");
$file->write("Строка 2");
*/
