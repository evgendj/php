<?php

class Car
{
  public $color;
  public $wheels = 4;
  public $speed = 180;
  public $brand;
  public static $countCar = 0;

  const TEST_CAR = 'Прототип';
  const TEST_CAR_SPEED = 300;


  function __construct($color, $wheels, $speed, $brand) {
    $this->color = $color;
    $this->wheels = $wheels;
    $this->speed = $speed;
    $this->brand = $brand;
    self::$countCar++; // Оператор разрешения области видимости (Paamayim Nekudotayim - на иврите означает двойное двоеточие)
  }

  function getCount() {
    return self::$countCar;
  }

  public function getCarInfo() {
    return "<h3>О момем авто:</h3>
    Марка: {$this->brand}<br>
    Цвет: {$this->color}<br>
    Кол-во колес: {$this->wheels}<br>
    Скорость: {$this->speed}<br>";
  }

  public function getPrototypeInfo() {
    return "<h3>О момем PROTOTYPE</h3>
    Марка: " . self::TEST_CAR . "<br>
    Скорость: " . self::TEST_CAR_SPEED . "<br>";
  }
}
?>
