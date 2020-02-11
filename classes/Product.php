<?php

class Product {

	public $name;
	public $price;

	public function __construct($name, $price) {
		$this->name = $name;
		$this->price = $price;
	}

	public function getProduct() {
		return "<hr><b>О товаре:</b><br>
						Наименование: {$this->name}<br>
						Цена: {$this->price}<br>";
	}

  public function getName() {
    return $this->name;
  }

  public function getPrice() {
    return $this->price;
  }





}





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
