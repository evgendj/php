<?php

class Product
{
  public $name;
  protected $price;

  private $discount = 10;

  //public $public = 'PUBLIC';
  //protected $protected = 'PROTECTED';
  //private $private = 'PRIVATE';

  function __construct($name, $price)
  {
    $this->name = $name;
    $this->price = $price;
  }

  function getName()
  {
    return $this->name;
  }

  function getPrice()
  {
    return $this->price - ($this->discount / 100 * $this->price);
  }

  function getProduct()
  {
    return "<hr><b>О товаре:</b><br>
    Наименование: {$this->name}<br>
    Цена со скидкой: {$this->getPrice()}<br>";
  }

  function setDiscount($discount)
  {
    $this->discount = $discount;
  }



}
