<?php


function findSimple(int $a, int $b) {
  if ($a <= 1 || $a >= $b) {
    echo "Первый аргумент должен быть больше единицы и меньше второго аргумента.";
  } else {
    for ($i = 0, $array = []; $a <= $b; $i++, $a++) {
      for ($j = 2, $s = 0; $j < $a; $j++) {
        if ($a % $j == 0) {
          $s++;
          break;
        }
      }
    if ($s == 0) {
      $array[] = $a;
    }
    }
  }
  return $array;
}

foreach (findSimple(2, 100) as $v) {
  echo "$v ";
}




?>
