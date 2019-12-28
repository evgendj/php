<?php

abstract class BaseMath
{
  function exp1($a, $b, $c) {
    return $this->a * ($this->b ^ $this->c);
  }

  function exp2($a, $b, $c) {
    return ($this->a / $this->b) ^ $this->c;
  }

  function getValue() {
    return $this->f;
  }
}
