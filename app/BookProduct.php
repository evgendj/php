<?php

namespace app;

use wfm\interfaces\I3D;
use wfm\Product;

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
