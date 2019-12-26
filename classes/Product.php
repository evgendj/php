<?php

class Product
{
  public $name;
  public $price;

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
    return $this->price;
  }

  function getProduct()
  {
    return "<hr><b>О товаре:</b><br>
    Наименование: {$this->name}<br>
    Цена: {$this->price}<br>";
  }



}
