<?php

class BookProduct extends Product
{
  public $numPages;

  function __construct($name, $price, $numPages) {
    parent::__construct($name, $price);
    $this->numPages = $numPages;
    $this->setDiscount(5);
  }

  function getProduct() {
    $out = parent::getProduct();
    $out .= "Цена без скидки: {$this->price}<br>";
    $out .= "Скидка: {$this->getDiscount}<br>";
    $out .= "Кол-во страниц: {$this->numPages}";
    return $out;
  }

}
