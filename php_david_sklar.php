<?php



class Entree {	// определение класса
	public $name;	// свойство
	public $ingredients = array();	// другое свойство
	public function hasIngredient($ingredient) {	// метод
		return in_array($ingredient, $this->ingredients);	// $this - спец. переменная, ссылающаяся на тот экземпляр класса, из которого вызывается метод.
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




?>
