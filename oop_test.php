<!-- В папке классов оставь car file, в корне оставь file-->
<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

error_reporting(-1);
require_once 'classes/Product.php';
require_once 'classes/NotebookProduct.php';
require_once 'classes/BookProduct.php';

$book = new BookProduct('Три мушкетера', 20, 1000);
$notebook = new NotebookProduct('Dell', 1000, 'Intel');

debug($book);
debug($notebook);

echo $book->getProduct();
echo $notebook->getProduct();







// Код без наследования
/*
error_reporting(-1);
require_once 'classes/Product.php';

$book = new Product('Три мушкетера', 20, null, 1000);
$notebook = new Product('Dell', 1000, 'Intel');

debug($book);
debug($notebook);

echo $book->getProduct('book');
echo $notebook->getProduct();
*/



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
