<?php

// ++++ Изучаю +++ страница 139


class Entree {	// определение класса
	public $name;	// свойство
	public $ingredients = array();	// другое свойство
	public function hasIngredient($ingredient) {	// метод
		return in_array($ingredient, $this->ingredients);	// $this - спец. переменная, ссылающаяся на тот экземпляр класса, из которого вызывается метод.
	}

	public static function getSizes() {	// Объявление статического метода
		return array('small', 'medium', 'large');
	}
}
// создание экземпляра класса и присвоение его переменной
$soup = new Entree; // new возвращает новы объект типа Entree
$soup->name = 'Chicken Soup';	// установка значений свойств экзепляра в переменной $soup
$soup->ingredients = ['chicken', 'water'];
// еще один экземпляр
$sandwich = new Entree;
$sandwich->name = 'Chicken Sandwich';
$sandwich->ingredients = ['chicken', 'bread'];

foreach (['chicken', 'lemon', 'bread', 'water'] as $ing) {
	if ($soup->hasIngredient($ing)) { // $this ссылается в теле метода hasIngredient на экземпляр объекта, хранящийся в переменной $soup
		echo "Soup conteins $ing.\n";
	}
	if ($sandwich->hasIngredient($ing)) {
		echo "Sandwich conteins $ing.\n";
	}
}
// Вызов статического метода
$sizes = Entree::getSizes();
echo "<hr>";
//------------ КОНСТРУКТОРЫ -----------------
// Спец метод со служебными операциями для подготовки объекта. Делаем тоже что и выше, но с использованием конструктора
class Entree2 {
	public $name;
	public $ingredients = array();

	public function __construct($name, $ingredients) { // метод-конструктор
		$this->name = $name;
		$this->ingredients = $ingredients;
	}

	public function hasIngredient($ingredient) {
		return in_array($ingredient, $this->ingredients);
	}
}

$soup = new Entree2('Chicken Soup', array('chicken', 'water'));



















?>
