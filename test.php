<?php
class Product
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









// Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)
