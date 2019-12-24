<?php

// Видео 2 10 минут


require_once 'classes/Car.php';

function debug($data) {
  echo "<pre>" . print_r($data, 1) . "</pre>";
}

$car1 = new Car();
debug($car1);






 ?>
