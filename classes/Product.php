<?php

// Автозагрузка, пространство имен

namespace classes;

abstract class Product {

	private $name;
	protected $price;

	private $discount = 0;

	public function __construct($name, $price) {
		$this->name = $name;
		$this->price = $price;
	}

	public function getProduct() {
		return "<hr><b>О товаре:</b><br>
						Наименование: {$this->name}<br>
						Цена со скидкой: {$this->getPrice()}<br>";
	}

  public function getName() {
    return $this->name;
  }

  public function getPrice() {
    return $this->price - ($this->discount / 100 * $this->price);
  }

	public function getDiscount(): int {
		return $this->discount;
	}

	public function setDiscount(int $discount) {
		$this->discount = $discount;
	}

	abstract protected function addProduct($name, $price); // Если создали астрактный метод, то обязательно его нужно создавать в дочернем классе, даже без действий в теле метода.
}

// Абстрактные классы, интерфейсы
/*
abstract class Product {

	private $name;
	protected $price;

	private $discount = 0;

	public function __construct($name, $price) {
		$this->name = $name;
		$this->price = $price;
	}

	public function getProduct() {
		return "<hr><b>О товаре:</b><br>
						Наименование: {$this->name}<br>
						Цена со скидкой: {$this->getPrice()}<br>";
	}

  public function getName() {
    return $this->name;
  }

  public function getPrice() {
    return $this->price - ($this->discount / 100 * $this->price);
  }

	public function getDiscount(): int {
		return $this->discount;
	}

	public function setDiscount(int $discount) {
		$this->discount = $discount;
	}

	abstract protected function addProduct($name, $price); // Если создали астрактный метод, то обязательно его нужно создавать в дочернем классе, даже без действий в теле метода.
}
*/

// Наследование, модификаторы - пример с ценой для модификатора
/*
class Product { // Это класс шаблон, который будет наследоваться в ноутбуках и книгах

	private $name; // Тоже можно сделать защищенным имя товара, чтобы не переопределили вне класса
	protected $price;

	private $discount = 0; // Ставить здесь скидук не правильно, нужно в методе

	// public $public = 'PUBLIC'; // Доступно в классе, в наследниках, вне класса
	// protected $protected = 'PROTECTED'; // Доступен только в классе и наследниках
	// private $private = 'PRIVATE'; // Доступен только внутри класса, ни в насле. ни вне класса не доступен

	public function __construct($name, $price) {
		$this->name = $name;
		$this->price = $price;

		// var_dump($this->public); // При обращении внутри класса выводится
		// var_dump($this->protected); // При обращении внутри класса выводится
		// var_dump($this->private); // При обращении внутри класса выводится
	}

	public function getProduct() {
		return "<hr><b>О товаре:</b><br>
						Наименование: {$this->name}<br>
						Цена со скидкой: {$this->getPrice()}<br>";
	}

  public function getName() {
    return $this->name;
  }

  public function getPrice() {
    return $this->price - ($this->discount / 100 * $this->price);
  }

	public function getDiscount(): int { // Задается тип данных который должен вернуться
		return $this->discount;
	}

	public function setDiscount(int $discount) { // Задается тип данных который должен установиться
		$this->discount = $discount;
	}
}
*/




// Код без наследования
/*
class Product {

	public $name;
	public $price;

	public $cpu;
	public $numPages;

	public function __construct($name, $price, $cpu = null, $numPages = null) {
		$this->name = $name;
		$this->price = $price;
		$this->cpu = $cpu;
		$this->numPages = $numPages;
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
*/
