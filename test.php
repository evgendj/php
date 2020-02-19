<?php
namespace Test3;

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

class newBase
{
  function __construct($name = 0)
	{
		$this->name = $name;
	}
	protected $name;
}

class newView extends newBase
{
	public function getName()
	{
		return $this->name;
	}
}

$obj = new newBase(123);
$obj2 = new newView(456);

echo $obj2->getName();

echo sizeof(get_object_vars($obj2));

debug($obj);
debug($obj2);



/*
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
				echo '<hr>';
				echo 'Тут выводятся debug $name, массив $arSetName, счетчик $count';
				echo '<hr>';
				debug($name);
				debug(self::$arSetName);
				debug(self::$count);
				//
    }
    private $name; // Устанавливается закрытый модификатор

		public function getName(): string // Метот добавляет звездочки для $name с двух сторон
    {
        return '*' . $this->name  . '*';
    }

		protected $value; // Создается защищенное свойство

		public function setValue($value) // Передача значения свойству при обрещении к методу
    {
        $this->value = $value;
    }

		public function getSize() //
    {
        $size = strlen(serialize($this->value)); // Определение длины строки
        return strlen($size) + $size;
    }
    public function __sleep()
    {
        return ['value'];
    }

}

/////////////////// Новый класс

class newView extends newBase
{
	private $type = null;
	private $size = 0;
	private $property = null;

	public function setValue($value) // Переопределяется метод setValue
	{
			parent::setValue($value); // Передается в значение $value первый объкт в вызове метода
			$this->setType(); // Вызов метода setType
			$this->setSize();
	}

	public function setProperty($value)
	{
			$this->property = $value;
			return $this;
	}
	private function setType() // Метод передает тип свойства $value свойству $type
	{
			$this->type = gettype($this->value);
	}

	private function setSize()
	{
			if (!is_subclass_of($this->value, "Test3\newView")) { // ДОбавил восклицательный знак
					$this->size = parent::getSize() + 1 + strlen($this->property);
			} elseif ($this->type == 'test') {
					$this->size = parent::getSize();
			} else {
					$this->size = strlen($this->value);
			}
	}

	public function __sleep()
	{
			return ['property'];
	}

	public function getName(): string
	{
			if (empty($this->name)) {
					throw new Exception('The object doesn\'t have name');
			}
			return '"' . $this->name  . '": ';
	}

	public function getType(): string
	{
			return ' type ' . $this->type  . ';';
	}

	public function getSize(): string
	{
			return ' size ' . $this->size . ';';
	}
	public function getInfo()
	{
			try {
					echo $this->getName()
							. $this->getType()
							. $this->getSize()
							. "\r\n";
			} catch (Exception $exc) {
					echo 'Error: ' . $exc->getMessage();
			}
	}



}

$obj = new newBase('12345');
$obj->setValue('text'); // Передача значения $value

$obj2 = new \Test3\newView('9876'); // Объект необходимо создавать с целочисленным значением, было с буквой О в начале
$obj2->setValue($obj); // Передача первого объекта в свойство $value
$obj2->setProperty('field');
// $obj2->getInfo();
//
// $save = $obj2->getSave();
//
// $obj3 = newView::load($save);

// var_dump($obj2->getSave() == $obj3->getSave());


//
echo '<hr>';
echo 'А тут выводятся дебаги объектов $obj, $obj2';
echo '<hr>';
debug($obj);
debug($obj2);
//


*/










// Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)
