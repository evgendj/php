<?php

class NotebookProduct extends Product
{
  public $cpu;

  function __construct($name, $price, $cpu){
    parent::__construct($name, $price);
    $this->cpu = $cpu;
  }


  function getProduct() {
    $out = parent::getProduct();
    $out .= "Процессор: {$this->cpu}<br>";
    return $out;
  }

}
