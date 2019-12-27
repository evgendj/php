<?php

class BookProduct extends Product
{
  public $numPages;

  function __construct($name, $price, $numPages) {
    parent::__construct($name, $price);
    $this->numPages = $numPages;
  }

  function getProduct() {
    $out = parent::getProduct();
    $out .= "Цена без скидки: {$this->price}<br>";
    $out .= "Кол-во страниц: {$this->numPages}";
    return $out;
  }

}
