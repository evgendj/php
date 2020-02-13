<?php

// Автозагрузка, пространство имен

namespace classes;

use classes\interfaces\I3D;

class BookProduct extends Product implements I3D
{
  public $numPages;

  public function __construct($name, $price, $numPages) {
    parent::__construct($name, $price);
    $this->numPages = $numPages;
    $this->setDiscount(5);
    var_dump(self::class);
  }

  public function test() {
    var_dump(self::TEST2);
  }

  public function getProduct() {
    $out = parent::getProduct();
    $out .= "Цена без скидки: {$this->price}<br>";
    $out .= "Кол-во страниц: {$this->numPages}<br>";
    $out .= "Скидка: {$this->getDiscount()}%<br>";
    return $out;
  }

  public function getNumPages() {
    return $this->numPages;
  }

  public function addProduct($name, $price) {}
}


// Абстрактные классы, интерфейсы
/*
class BookProduct extends Product implements I3D
{
  public $numPages;

  public function __construct($name, $price, $numPages) {
    parent::__construct($name, $price);
    $this->numPages = $numPages;
    $this->setDiscount(5);
    var_dump(self::class);
  }

  public function test() {
    var_dump(self::TEST2);
  }

  public function getProduct() {
    $out = parent::getProduct();
    $out .= "Цена без скидки: {$this->price}<br>";
    $out .= "Кол-во страниц: {$this->numPages}<br>";
    $out .= "Скидка: {$this->getDiscount()}%<br>";
    return $out;
  }

  public function getNumPages() {
    return $this->numPages;
  }

  public function addProduct($name, $price) {}
}
*/


// Наследование, модификаторы - пример с ценой для модификатора
/*
class BookProduct extends Product
{
  public $numPages;

  public function __construct($name, $price, $numPages) {
    parent::__construct($name, $price);
    $this->numPages = $numPages;

    $this->setDiscount(5); // В сетере для книг мы ставим скидку, несмотря на то что в родительском классе скидка закрыта, но она там же вродителе используется в сететере, которому дозволено работать с этой закрытой скидкой, а в дочернеме методе можно работать с этим методом родителя. Таким образом появляется доступ к переопределению скидки.

    // var_dump($this->public); // При обращении в дочернем классе выводится
		// var_dump($this->protected); // При обращении в дочернем классе выводится
		// var_dump($this->private); // При обращении в дочернем классе будет ошибка, не выводится!
  }

  public function getProduct() {
    $out = parent::getProduct();
    $out .= "Цена без скидки: {$this->price}<br>"; // Выводим цену защищенную тут
    $out .= "Кол-во страниц: {$this->numPages}<br>";
    $out .= "Скидка: {$this->getDiscount()}%<br>"; // Так же мы можем вывести закрытое значение скидки через метод родителя геттер, у которого есть доступ к закрытому свойству.
    return $out;
  }

  public function getNumPages() {
    return $this->numPages;
  }
}
*/
