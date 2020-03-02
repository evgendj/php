<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

// echo serialize('property');

/*
class newBase
{
    static private $count = 0;
    static private $arSetName = [];

    function __construct(int $name = 0)
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
}
$obj = new newBase(1,2);
*/

class Product {

	private $name;
	protected $price;

	private $discount = 0;

	public function __construct($name, $price) {
		$this->name = $name;
		$this->price = $price;
	}

  public function __sleep ()
  {
    return ['price'];
  }
}
$obj = new Product(1,2);

$o = serialize($obj);
echo $o;
debug($obj);
debug(unserialize($o));

echo "Второй тест<hr>";
$value = '9876:28:s:20:"12345:11:s:4:"text";";s:5:"field"';
$arValue = explode(':', $value); // 9876:28:s:20:"12345:11:s:4:"text";";s:5:"field"; - Разбиваем на массив
$newobd = unserialize(substr($value, strlen($arValue[0]) + 1 + strlen($arValue[1]) + 1, $arValue[1]));
debug($arValue);
debug($newobd);
/*class Product
{
    public $product_name = "";
    private $available = false;

    public function setAvailable() {
        $this->available = true;
    }

    public function unsetAvailable() {
        $this->available = false;
    }

    public function getInfo() {
        return $this->available;
    }

}

$item = new Product();
$item->product_name = "Пылесос";
$item->setAvailable();
$itemString = serialize($item);

//.. тут могут осуществляться любые действия на  $item..//

print "<hr/>1) Объект <b>\$item:</b>  <pre>";print_r($item); print "</pre><hr/>";
print "2) Сериализованный в строку объект  <b> \$item</b>   <pre>";print_r($itemString); print "</pre><hr/>";
print "3) Десериализация полученной строки в новый объект <b>\$backup_item</b>:<hr/>";

$backup_item = unserialize($itemString);

print "4) Восстановленный из строки объект  <b> \$backup_item</b>   <pre>";print_r($backup_item); print "</pre><hr/>";
print "5) Получаем поле \"название\" восстановленного объекта <b> \$backup_item->product_name</b>   <pre>".$backup_item->product_name."</pre><hr/>";
*/








// Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)
