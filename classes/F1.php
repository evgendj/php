<?php

class F1 extends BaseMath
{
  protected $a, $b, $c, $f;

  function __construct($a, $b, $c) {
    $this->a = $a;
    $this->b = $b;
    $this->c = $c;
    $this->f = ($this->exp1($this->a, $this->b, $this->c) + ($this->exp2($this->a, $this->b, $this->c)%3)^min($this->a,$this->b,$this->c));
  }
}
