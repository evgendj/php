<?php

// Cтраница 141

require_once 'classes/Entree.php';

function debug($data) {
  echo "<pre>" . print_r($data, 1) . "</pre>";
}

$soup = new Entree('Chicken Soup', ['chicken', 'water']);
$sandwich = new Entree('Chicken Sandwich', ['chicken', 'bread']);

$drink = new Entree('Glass of milk', 'milk');
if ($drink->hasIngredient('milk')) {
  echo "123";
}


debug($soup);
debug($sandwich);

foreach (['chicken', 'lemon', 'bread', 'water'] as $ing) {
  if ($soup->hasIngredient($ing)) {
    echo "Soup contains $ing.<br>";
  }
  if ($sandwich->hasIngredient($ing)) {
    echo "Sandwich contains $ing.<br>";
  }
}
