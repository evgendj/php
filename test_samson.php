<?php
namespace Test3;

require_once('classes\newBase.php');
require_once('classes\newView.php');

// Debug
function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}
//

// Данный классы выполняет функцию сохранения и восстановления объектов с их свойствами.
// Вместо стандартной сериализации данных используется свой метод (сохранение в более короткую строку вида
// Имя:ДлиназначенияЗначение и Имя:ДлиназначенияЗначениеСериализованноесвойство и соответственно чтение производится из этих же форматов)

//- в конструкторе тип был указан правильно, но есть ошибка в проверке на существование элемента (в случае пустого параметра);

//- в функции getSave вызов функции sizeof является ошибкой, надо правильную использовать, так же в этой функции есть еще ошибка;
//- в функциях getSize и load осталась еще по ошибке;
//Для класса newView:
//- остались ошибки в функциях __sleep, getInfo, load;
//- в getSave есть принципиальная ошибка, которая мешает повторному использованию.


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
//
//$obj2 = new \Test3\newView('O9876');
//$obj2->setValue($obj);
//$obj2->setProperty('field');
//$obj2->getInfo();
//
//$save = $obj2->getSave();
//
//$obj3 = newView::load($save);
//
//var_dump($obj2->getSave() == $obj3->getSave());

//
debug($obj);
//debug($obj2);
echo serialize($obj);
