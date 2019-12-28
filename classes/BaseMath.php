<?php

abstract class BaseMath
{
  private $a, $b, $c;

  function __construct($a, $b, $c) {
    $this->a = $a;
    $this->b = $b;
    $this->c = $c;
  }

  function exp1($a, $b, $c) {

  }
}

/*
Реализовать абстрактный класс BaseMath содержащий 3 метода:
exp1($a, $b, $c) и exp2($a, $b, $c),getValue().

Метода exp1 реализует расчет по формуле a*(b^c).
Метода exp2 реализует расчет по формуле (a/b)^c.
Метод getValue() возвращает результат расчета класса наследника.

Реализовать класс F1 наследующий методы BaseMath, содержащий конструктор с параметрами ($a, $b, $c) и метод getValue().
Класс реализует расчет по формуле f=(a*(b^c)+(((a/c)^b)%3)^min(a,b,c)).
*/
