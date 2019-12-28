<?php

abstract class Product
{
  public $name;
  protected $price;

  const TEST = 10;

  private $discount = 0;

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

  function getDiscount() {
    return $this->discount;
  }

  function setDiscount($discount)
  {
    $this->discount = $discount;
  }

  abstract public function addProduct($name, $price);


}
