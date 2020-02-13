<?php


namespace app;

use wfm\interfaces\IGadget;
use wfm\Product;
use wfm\traits\TColor;

class NotebookProduct extends Product implements IGadget // Это класс для ноутбуков, он наследует все из продукт
{
  use TColor; // Весь код из этого трейта просто подключился в этом есто

  public $cpu;

  public function __construct($name, $price, $cpu) {
    parent::__construct($name, $price);
    $this->cpu = $cpu;
  }

  public function getCase() {

  }

  public function getProduct() {
    $out = parent::getProduct();
    $out .= "Процессор: {$this->cpu}<br>";
    return $out;
  }

  public function getCpu() {
    return $this->cpu;
  }

  public function addProduct($name, $price) {}
}
