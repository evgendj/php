<?php

// Автозагрузка, пространство имен

namespace classes;

use classes\interfaces\IGadget;

class NotebookProduct extends Product implements IGadget // Это класс для ноутбуков, он наследует все из продукт
{
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

// Абстрактные классы, интерфейсы
/*
class NotebookProduct extends Product implements IGadget // Это класс для ноутбуков, он наследует все из продукт
{
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
*/
