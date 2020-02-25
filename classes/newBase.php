<?php
namespace Test3;

class newBase
{
    static private $count = 0;
    static private $arSetName = [];

    private $name;
    protected $value;

    function __construct($name = 0) // Тут исправил ошибку, int было
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

    public function getName(): string
    {
        return '*' . $this->name  . '*';
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getSize()
    {
        $size = strlen(serialize($this->value));
        return strlen($size) + $size;
    }

    public function __sleep()
    {
        return ['value'];
    }




}
