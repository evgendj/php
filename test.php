<?php
namespace Test3;

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

class newBase
{
		static private $count = 0; // Статическое свойство, для расчета внутри класса. Тут используется как счетчик.
    static private $arSetName = []; // Тоже статическое свойство - пустой массив в начале.

		function __construct(int $name = 0) // Конструктор принимает целочисленное значение при создании объекта.
    {
        if (empty($name)) { // Если $name не задано или = 0, то выполняется условие
            while (array_search(self::$count, self::$arSetName) != false) {
                ++self::$count; // В статике в массиве ищется заданное в объекте значение.
            }
            $name = self::$count;
        }
        $this->name = $name; // Создается новое свойство из значения при создании объекта
        self::$arSetName[] = $this->name; // Значение передается в массив в статику

				//
				debug($name);
				debug(self::$arSetName);
				debug(self::$count);
				//
    }
    private $name; // Устанавливается закрытый модификатор
}

class newView extends newBase
{

}

$obj = new newBase('12345');


$obj2 = new \Test3\newView('9876'); // Объект необходимо создавать с целочисленным значением, было с буквой О в начале

$obj3 = new \Test3\newView();

debug($obj);

debug($obj2);

debug($obj3);
















// Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)
