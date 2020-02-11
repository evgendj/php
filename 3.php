<?php
namespace Test3; // Пространство имен

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

class newBase // Класс со статикой
{
    static private $count = 0; // Статическое свойство используется только в конструкторе тут
    static private $arSetName = []; // Статический массив используется только в конструкторе
    /**
     * @param string $name
     */
    function __construct(int $name = 0) // В конструктор передается значение (int)
    {
        if (empty($name)) {
            while (array_search(self::$count, self::$arSetName) != false) {
                ++self::$count;
            }
            $name = self::$count;
        }
        $this->name = $name;
        self::$arSetName[] = $this->name;
    }
    private $name;
    /**
     * @return string
     */
    public function getName(): string
    {
        return '*' . $this->name  . '*';
    }
    protected $value;
    /**
     * @param mixed $value
     */
    public function setValue($value) // Метод создает переменную и принимает значение при обращении к методу
    {
        $this->value = $value;
    }
    /**
     * @return string
     */
    public function getSize()
    {
        $size = strlen(serialize($this->value));
        return strlen($size) + $size;
    }
    public function __sleep()
    {
        return ['value'];
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
class newView extends newBase // Новый метод наследует парамтры newBase
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
      // $this->type = gettype($this->value);
      echo $this->value;
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
        if ($this->type == 'test') {
            $this->value = $this->value->getSave();
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


$obj = new newBase('12345'); // Создается новый объект класса newBase и передаются данные в конструктор (должно быть целочисл.)
$obj->setValue('text'); // Обращение к методу с передачей данных в него

debug($obj);

$obj2 = new \Test3\newView('9876'); // Создается новый объект класса newView и передаются данные (должно быть целочисл.)
// Была ошибка $obj2 = new \Test3\newView('O9876'); - вместо нуля стоит буква О

// ini_set('memory_limit', '10000M');
$obj2->setValue($obj);
// Эта строка выдала ошибку Allowed memory size of 1610612736 bytes exhausted (tried to allocate 262144 bytes) - над ней увеличил память и уменшил входяшую цифру, но не помогло

//$obj2->setProperty('field');
//$obj2->getInfo();

debug($obj2);

//$save = $obj2->getSave();

//$obj3 = newView::load($save);

//var_dump($obj2->getSave() == $obj3->getSave());
