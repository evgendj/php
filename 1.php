<?php

/* Результат выполнения тестового задания №1 от Гузун ЕА */

//------ Функции и классы
// 1.2.2 - массив простых чисел findSimple()
function findSimple($a, $b) {
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
	return $array;
}
// 1.2.3 - двумерный массив a, b, c createTrapeze()
$mass = [9,2,3,6,15,2,17,9,12];
function createTrapeze($a) {
	for ($i = 0, $j = 0, $array1 = []; $i < count($a)/3; $i++) {
		for($let = 'a'; $let <= 'c'; $let++, $j++) {
			$array1[$i][$let] = $a[$j];
		}
	}
	return $array1;
}
// 1.2.4 - расчет площади трапеции squareTrapeze()
function squareTrapeze($a) {
	for($i = 0; $i < count($a); $i++) {
		$a[$i]['s'] = 0.5 * $a[$i]['c']*($a[$i]['a'] + $a[$i]['b']);
	}
	return $a;	
}
// 1.2.5 - максимальная площадь getSizeForLimit()
function getSizeForLimit($a, $b) {
	for($i = 0, $m = 0, $array2 = []; $i < count($a); $i++) {
		if ($a[$i]['s'] > $m && $a[$i]['s'] < $b) {
			$array2 = $a[$i];
		}
	}
	return $array2;
}

// 1.2.6 - минимальное число в массиве getMin()
$array3 = array('один' => 2000, 'два' => 3000, 'три' => 500);
function getMin($a) {
	$min === null;
	foreach($a as $v) {
		if($min > $v or $min === null) {
			$min = $v;
		}
	}
	return $min;
}
// 1.2.7 - вывод таблицы с размерами трапеций printTrapeze()
function printTrapeze($a) {
	echo "
		<table border='2'>
		    <tr>
		        <th></th>
		        <th>Сторона - a</th>
		        <th>Сторона - b</th>
		        <th>Высота - h(c)</th>
		        <th>Площадь - s</th>
		    </tr>";
	for($i = 0; $i < count($a); $i++) {
		if(($a[$i]['s'] - floor($a[$i]['s'])) != 0 || $a[$i]['s'] % 2 === 0) {
			echo "
				<tr>";
		} else {
			echo "
			<tr bgcolor='#d0d0d0'>";
		}
		echo "
			<td>Трапеция № ".($i+1	)."</td>
		        <td>".$a[$i]['a']."</td>
		        <td>".$a[$i]['b']."</td>
		        <td>".$a[$i]['c']."</td>
		        <td>".$a[$i]['s']."</td>
		    </tr>";
	}
	echo "</table>";
}
// 1.2.8 - класс BaseMath
class BaseMath {
	public $a;
	public $b;
	public $c;
	public function __construct($a,$b,$c) {
		$this->a = $a;
		$this->b = $b;
		$this->c = $c;
	}
	function exp1() {
		$exp1 = $this->a * ($this->b ^ $this->c);
		return $exp1;
	}
	function exp2() {
		$exp2 = ($this->a / $this->b) ^ $this->c;
		return $exp2;
	}
	function getValue() {
		$classF1 = new F1($this->a, $this->b, $this->c);
	}
}
// 1.2.9 - класс F1
class F1 extends BaseMath {
	public $f;
    public function __construct($a, $b, $c) {
        parent::__construct($a, $b, $c);
        $f = ($this->a*($this->b^$this->c)+((($this->a/$this->c)^$this->b)%3)^min($this->a,$this->b,$this->c));
    }
}

// -----Вывод заданий в браузер
// 1.2.7
printTrapeze(squareTrapeze(createTrapeze($mass)));



?>