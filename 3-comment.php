<?php
namespace Test3;

class newBase
{
    static private $count = 0; // Статическое свойство, для расчета внутри класса. Тут используется как счетчик.
    static private $arSetName = []; // Тоже статическое свойство - пустой массив в начале.
    /**
     * @param string $name // Говорит, что в конструкторе входящий параметр name будет строковым, вот почему в кавычках newBase('12345')
     */
     // В конструкторе тип int установлен верно, но в нем же есть ошибка, в конструкторе
     // Предположим что ошибка - лишнее написание != false и вторая ошибка передача букв при создании второго объекта
    function __construct(int $name = 0) // Конструктор принимает !!целочисленное
    {
        if (empty($name)) { // Если $name не задано или = 0, то выполняется условие
            while (array_search(self::$count, self::$arSetName) != false) { // можно убрать != false
                ++self::$count; // Если объект создается без переменной внутри, то срабатывает счетчик и записывается в масс. по порядку
            }
            $name = self::$count;
        }
        $this->name = $name;
        self::$arSetName[] = $this->name; // Значение передается в массив в статику, либо счетчик
    }
    public function getArray() // Проверяю, что в массиве в статике
    {
      return self::$arSetName;
    }
    //private $name;
    protected $name;
    /**
     * @return string // Метод вернет строку
     */
    public function getName(): string
    {
        return '*' . $this->name  . '*';
    }
    protected $value;
    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
    /**
     * @return string
     */
    public function getSize()
    {
        $size = strlen(serialize($this->value)); // Сериализуется первый объект, поскольку он в value и измеряется длина этой строки се-и
        return strlen($size) + $size; // Здесь измеряется длина строки измерения сериализации и плюсуется эта же длина строки
                                      // А так же ниже магический метод возвращает только...
    }
    public function __sleep()
    {
        return ['value'];   //... сериализованный объект с одним свойством value
    }
    /**
     * @return string
     */
    public function getSave(): string
    {
        $value = serialize($value);
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
        parent::setValue($value);
        $this->setType();
        $this->setSize();
    }
    public function setProperty($value)
    {
        $this->property = $value;
        return $this;
    }
    private function setType()
    {
        $this->type = gettype($this->value);
    }
    private function setSize()
    {
        if (is_subclass_of($this->value, "Test3\newView")) {
            $this->size = parent::getSize() + 1 + strlen($this->property);
        } elseif ($this->type == 'test') {
            $this->size = parent::getSize();
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
            throw new Exception('The object doesn\'t have name');
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
    /**
     * @return string
     */
    public function getSave(): string
    {
        if ($this->type == 'test') {                // Если указанный тип, то в значение загоняется не массив, а то что возвращает метод
            $this->value = $this->value->getSave();
        }
        return parent::getSave() . serialize($this->property);  // Вызывается родитель с данными
                                                                // Соединяется с сериализованным свойством - s:5:"field";
    }
    /**
     * @return newView
     */
    static public function load(string $value): newBase
    {
        $arValue = explode(':', $value); // 9876:28:s:20:"12345:11:s:4:"text";";s:5:"field"; - Разбиваем на массив
        return (new newBase($arValue[0]))
            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1), $arValue[1]))
            ->setProperty(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1 + $arValue[1])))
            ;
    }
}
function gettype($value): string
{
    if (is_object($value)) {
        $type = get_class($value);
        do {
            if (strpos($type, "Test3\newBase") !== false) {
                return 'test';
            }
        } while ($type = get_parent_class($type));
    }
    return gettype($value);
}


$obj = new newBase('12345');
$obj->setValue('text');

// $obj2 = new \Test3\newView('O9876');
$obj2 = new \Test3\newView('9876');  // Передавалось О, поменял на ноль было -
$obj2->setValue($obj);
$obj2->setProperty('field');
$obj2->getInfo();

$save = $obj2->getSave();

$obj3 = newView::load($save);

var_dump($obj2->getSave() == $obj3->getSave


// array_search() - ищет значение (первый аргумент mixed - если строка, то с учетом регистра) в массиве (второй аргумент array).
// Если установлен третий параметр $strict = TRUE, также будут проверяться типы needle в haystack
// а объекты должны быть одним и тем же экземпляром.
// Будет возвращен первый ключ первого найденого значения. Если нужны все ключи нужно array_keys() использовать
//
// is_subclass_of() - проверяет объект, наследует ли он указанный класс.
//
// strlen() - возвращает длину строки и 0  в случае пустой строки
//
// serialize() Сериализация — процесс конвертирования сложной структуры языка программирования в строку, для компактной передачи данных
// Product Object
// (
//     [product_name] => Пылесос
//     [available:Product:private] => 1
// )
// Сериализованный объект
// O:7:"Product":2:{s:12:"product_name";s:7:"Пылесос";s:18:"Productavailable";b:1;}
// O:7:»Product»:2: — объект класса «Product», в названии 7 символов, содержит 2 поля.
// s:12:»product_name» — строковая переменная, название поля «product_name» из 12 символов.
// s:7:»Пылесос» — строка из 7 символов «Пылесос».
// b:1 – булево значение true;
// Поддерживаемые функцией serialize() типы данных:
// i:4; // - тип integer
// s:6:"qwerty"; // - тип string
// b:1; //- тип boolean
// a:3:{...} //array
// O:9:"TestClass":1:{...} //object
// Методы я так понял не попадают в сериализацию
// Если стоит магический метод __sleep(), в нем обысно указывается какое свойство сериализовать - return ['value'];
// то сериализует это свойство. Метод может быть в любом месте документа, последовательность не имеет значения
//
// explode() - разбивает строку в массив, первый аргумент - разделитель, второй аргумент - строка которую нужно разбить.
// substr() - Возвращает кусок илю всю строку (подстроку) заданную первым аргументом. Второй аргумент = с какого начинать символа, второй = длина символов, которые нужно вернуть
