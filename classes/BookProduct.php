<?php

class BookProduct extends Product implements I3D
{
  public $numPages;

  //const TEST = 20;

  function __construct($name, $price, $numPages) {
    parent::__construct($name, $price);
    $this->numPages = $numPages;
    $this->setDiscount(5);
    var_dump(self::TEST);
  }

  function getProduct() {
    $out = parent::getProduct();
    $out .= "Цена без скидки: {$this->price}<br>";
    $out .= "Кол-во страниц: {$this->numPages}<br>";
    $out .= "Скидка: {$this->getDiscount()}<br>";
    return $out;
  }

  function addProduct($name, $price) {

  }


      public function test()
      {
          var_dump(self::TEST2);
      }

}
