<!-- В папке классов оставь car file, в корне оставь file-->
<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

// Абстрактные классы, интерфейсы
error_reporting(-1);
require_once 'classes/Product.php';
require_once 'classes/I3D.php';
require_once 'classes/BookProduct.php';

$book = new BookProduct('Три мушкетера', 20, 1000);

debug($book);

echo $book->getProduct();
//echo $book->test();

// $product = new Product('Test', 1); // Product - абстрактный класс, сделали его асбтрактным, чтобы нельзя было вывести объект этого класса, так как он является шаблоном и его бессмысленно выводить.

class A{};
class B extends A{};
class C{};

$a = new A;
$b = new B;
$c = new C;

var_dump($a instanceof A);
var_dump($b instanceof B);
var_dump($c instanceof A);




// Наследование, модификаторы - пример с ценой для модификатора
/*
error_reporting(-1); // Вывод ошибок
require_once 'classes/Product.php';
require_once 'classes/NotebookProduct.php';
require_once 'classes/BookProduct.php';

$book = new BookProduct('Три мушкетера', 20, 1000);
$notebook = new NotebookProduct('Dell', 1000, 'Intel');

debug($book);
// debug($notebook); // Чтобы посмотреть бук, раскомментируй

// $book->discount = 50; // Так же переменую можно переопределить из вне, если она публичная.

echo $book->getProduct();
echo $book->getDiscount(); // Посмотреть закрытую переменную вне класса можно при помощи гетера, если он делает это возможным

// echo $book->price; // Закрываем доступ к цене в не класса, чтобы случайно не ту цену не вывели
// echo $notebook->getProduct(); // Чтобы посмотреть бук, раскомментируй

// var_dump($book->public); // Публичную переменную можно вывести вне класса
// var_dump($book->protected); // Выводит ошибку при попытке обратится к защищенной переменной вне класса
// var_dump($book->private); // К обращении вне класса к закрытой переменной выдаст ошибку, что нет такой переменной
*/

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
