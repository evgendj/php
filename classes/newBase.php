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
             // while (array_search(self::$count, self::$arSetName) != false) {
             while (array_search(self::$count, self::$arSetName)) {
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
    public function getName(): string // Метод для работы со свойством name, но он нигде не вызывается
    {
        return '*' . $this->name  . '*';
    }
    protected $value;
    /**
     * @param mixed $value // Входящий парамтр будет микс
     */
     public function setValue($value) // Просто установка значения
     {
         $this->value = $value;
     }
     /**
      * @return string // Должен строку вернуть
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

}

/*
{
    public function getSave(): string
    {
        $value = serialize($value);
        return $this->name . ':' . sizeof($value) . ':' . $value;
    }

    static public function load(string $value): newBase
    {
        $arValue = explode(':', $value);
        return (new newBase($arValue[0]))
            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1), $arValue[1]));
    }
}
*/
