<?php
namespace Test3;

class newView extends newBase // Класс наследует методы и свойства класса newBase
{
    private $type = null;
    private $size = 0;
    private $property = null;
    /**
     * @param mixed $value // Входяшее значение в метод микс
     */
     public function setValue($value) // Передается объект1 в свойство, задаются тип и размер
     {
        parent::setValue($value);
        $this->setType();
        $this->setSize();
         return $this; // Добваил тут строку
     }
     public function setProperty($value) // Метод только для второго класса
     {
         $this->property = $value;
         return $this;
     }
     private function setType() // Приватный метод - устанавливает тип test согласно переделанной функции
     {
         $this->type = gettype($this->value);
     }
     private function setSize()
     {
        // if (is_subclass_of($this->value, "Test3\newView")) {
        if (is_subclass_of($this->value, 'Test3\newView')) { // При обращении в данном случае условие не выполняется
            $this->size = parent::getSize() + 1 + strlen($this->property);
       } elseif ($this->type == 'test') { // Это выполняется
            $this->size = parent::getSize();
       } else {
            $this->size = strlen($this->value);
       }
     }
     /**
      * @return array
      */

      public function getName(): string
      {
          if (empty($this->name)) {
              // throw new Exception('The object doesn\'t have name');
              throw new \Exception('The object doesn\'t have name');
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
           // } catch (Exception $exc) {
           } catch (\Exception $exc) {
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
        return parent::getSave() . serialize($this->property);
    }

    /**
     * @param string $value
     * @return newView
     */
    static public function load(string $value): newBase
    {
        $arValue = explode(':', $value); // 9876:28:s:20:"12345:11:s:4:"text";";s:5:"field"; - Разбиваем на массив
        return (new newView($arValue[0]))
            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
                // + strlen($arValue[1]) + 1), $arValue[1]))
                + strlen($arValue[1]) + 1, $arValue[1])))
            ->setProperty(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1 + $arValue[1])))
            ;
    }
}
