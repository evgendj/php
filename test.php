<!-- Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)-->
<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

$a = 1;
$count = 10;
$arSetName = [10, 20];

debug($arSetName);

if (empty($a)) { // Если $name не задано или = 0, то выполняется условие
		while (array_search($count, $arSetName) != false) {
				++$count; // В статике в массиве ищется заданное в объекте значение.
		}
		$name = $count;
}
$arSetName[] = $name; // Значение передается в массив в статику

debug($arSetName);
