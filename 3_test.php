<?php
namespace Test3;

// Дебаг
function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

// - в конструкторе тип был указан правильно, но есть ошибка в проверке на существование элемента (в случае пустого параметра);
// - в функции getSave вызов функции sizeof является ошибкой, надо правильную использовать, так же в этой функции есть еще ошибка;
// - в функциях getSize и load осталась еще по ошибке;
// Для класса newView:
// - остались ошибки в функциях __sleep, getInfo, load;
// - в getSave есть принципиальная ошибка, которая мешает повторному использованию.

class newBase
{
    static private $count = 0; // Статическое свойство, для расчета внутри класса. Тут используется как счетчик.
    static private $arSetName = []; // Тоже статическое свойство - пустой массив в начале.
    /**
     * @param string $name
     */
    function __construct($name = 0) // Конструктор принимает !!целочисленное -(int $name = 0) - убрал int
    {
        if (empty($name)) { // Если $name не задано или = 0, то выполняется условие
            while (array_search(self::$count, self::$arSetName) != false) {
                ++self::$count; // В статике в массиве ищется заданное в объекте значение.
            }
            $name = self::$count;
        }
        $this->name = $name; // Создается новое свойство из значения при создании объекта
        self::$arSetName[] = $this->name; // Значение передается в массив в статику
    }
    protected $name;
    /**
     * @return string
     */
    public function getName(): string // Метот добавляет звездочки для $name с двух сторон
    {
        return '*' . $this->name  . '*';
    }
    protected $value; // Создается защищенное свойство
    /**
     * @param mixed $value
     */
    public function setValue($value) // Передача значения свойству при обрещении к методу
    {
        $this->value = $value;
    }
    /**
     * @return string
     */
    public function getSize()
    {
        $size = strlen(serialize($this->value)); // Сериализация объекта value (в данном случае объекта) и определение длины строки
        return strlen($size) + $size; // Возвращает результат мат. действий
    }
    public function __sleep() // Но перед сериализацией выполняется метод
    {
        return ['value'];
    }
    /**
     * @return string
     */
    public function getSave(): string
    {
        $value = serialize($value); // value пустое здесь????

        return $this->name . ':' . sizeof($value) . ':' . $value;
    }
    /**
     * @return newBase
     */
    static public function load(string $value): newBase
    {
        $arValue = explode(':', $value);
        return (new newBase($arValue[0]))
            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1), $arValue[1]));
    }
}
class newView extends newBase // Класс наследует методы и свойства класса newBase
{
    private $type = null;
    private $size = 0;
    private $property = null;
    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        parent::setValue($value); // Наследуется установка значения для $value
        $this->setType();					// И выполняются еще 2 метода
        $this->setSize();
    }
    public function setProperty($value) // Передача значения в свойство $property при обращении к методу
    {
        $this->property = $value;
        return $this;
    }
    private function setType() // Определение типа по переопределенной функции и запись в $type
    {
        $this->type = gettype($this->value);
    }
    private function setSize()
    {
        if (is_subclass_of($this->value, 'Test3\newView')) { // Если объект указанного класса, !!кавычки тоже поменял на одинарные
            $this->size = parent::getSize() + 1 + strlen($this->property);
        } elseif ($this->type == 'test') { // Если тип test, то обращается к родительскому методу
            $this->size = parent::getSize(); // Соответственно метод работает со свойством класса newBase
        } else {
            $this->size = strlen($this->value);
        }
    }
    /**
     * @return string
     */
    public function __sleep()
    {
        return ['property'];
    }
    /**
     * @return string
     */

    public function getName(): string
    {
        if (empty($this->name)) {
            throw new \Exception('The object doesn\'t have name'); // !!! не правильное создание объекта для исключений
																																	// !!! поставил обратный слэш перед классом Exception
        }

        return '"' . $this->name  . '": ';
    }
    /**
     * @return string
     */
    public function getType(): string
    {
        return ' type ' . $this->type  . ';';
    }
    /**
     * @return string
     */
    public function getSize(): string
    {
        return ' size ' . $this->size . ';';
    }
    public function getInfo() // Вывод на экран
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
    /**
     * @return string
     */
    public function getSave(): string
    {
        if ($this->type == 'test') { // Если тип test
            $this->value = $this->value->getSave(); //
        }
        return parent::getSave() . serialize($this->property);
    }
    /**
     * @return newView
     */
    static public function load(string $value): newBase
    {
        $arValue = explode(':', $value);
        return (new newBase($arValue[0]))
            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1), $arValue[1]))
            ->setProperty(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1 + $arValue[1])))
            ;
    }
}
function gettype($value): string // Переопределение функции gettype()
{
    if (is_object($value)) { // Если объект
        $type = get_class($value);
        do {																									// В условии проверяется соответствие классу newBase
            if (strpos($type, 'Test3\newBase') !== false) { // !!! было в двойных кавычках
                return 'test';	// Если условие проходит возвращает строку test
            }
        } while ($type = get_parent_class($type));
    }
    return \gettype($value); // Было зацикливание
														// !!! Добавил обратный слэш перед gettype($value)
}


$obj = new newBase('12345');
$obj->setValue('text');

$obj2 = new newView('O9876'); // !!! либо убираем int в конструкторе, либо передаем целочисленное в конструктор
$obj2->setValue($obj);
$obj2->setProperty('field');
$obj2->getInfo();
//
debug($obj);
debug($obj2);
exit;
//




$save = $obj2->getSave();

$obj3 = newView::load($save);

var_dump($obj2->getSave() == $obj3->getSave());
