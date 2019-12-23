<?php


// Даем массив и дробим на массивы, кол-во элементов кратно 3

$mass = [9,2,3,6,15,2,17,9,12];
function createTrapeze($a) {
	for ($i = 0, $j = 0, $array1 = []; $i < count($a)/3; $i++) {
		for($let = 'a'; $let <= 'c'; $let++, $j++) {
			$array1[$i][$let] = $a[$j];
		}
	}
	return $array1;
}

function squareTrapeze($a) {
	for($i = 0; $i < count($a); $i++) {
		$a[$i]['s'] = 0.5 * $a[$i]['c']*($a[$i]['a'] + $a[$i]['b']);
	}
	return $a;
}

foreach (squareTrapeze(createTrapeze($mass)) as $key => $value) {
  echo "Массив номер - $key<br>";
  foreach ($value as $k => $v) {
    echo "$k - $v<br>";
  }
}

function getSizeForLimit($a, $b) {
	for($i = 0, $m = 0, $array2 = []; $i < count($a); $i++) {
		if ($a[$i]['s'] > $m && $a[$i]['s'] < $b) {
			$array2 = $a[$i];
		}
	}
	return $array2;
}


echo "<hr>";

$mas_for_limit = squareTrapeze(createTrapeze($mass));

foreach (getSizeForLimit($mas_for_limit, 17) as $key => $value) {
  echo "$value<br>";
}










?>
