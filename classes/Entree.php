<?php

class Entree
{
  public $name;
  public $ingredients = [];

  function __construct($name, $ingredients) {
    if (! is_array($ingredients)) {
      throw new Exception('$ingredients должен быть массивом');
    }
    $this->name = $name;
    $this->ingredients = $ingredients;
  }

  function hasIngredient($ingredient) {
    return in_array($ingredient, $this->ingredients);
  }

  static function getSize() {
    return array('small', 'medium', 'large');
  }
}
