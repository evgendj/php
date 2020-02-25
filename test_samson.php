<?php
namespace Test3;

require_once('classes\newBase.php');
require_once('classes\newView.php');

// Debug
function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}
//

function gettype($value): string // Переопределенная функция
{
    if (is_object($value)) {
        $type = get_class($value);
        do {
            if (strpos($type, 'Test3\newBase') !== false) { // Поставил одинарные кавычки
                return 'test';
            }
        } while ($type = get_parent_class($type));
    }
    return \gettype($value); // Поставил обратный слэш
}

//- в конструкторе тип был указан правильно, но есть ошибка в проверке на существование элемента (в случае пустого параметра);

//- в функции getSave вызов функции sizeof является ошибкой, надо правильную использовать, так же в этой функции есть еще ошибка;
//- в функциях getSize и load осталась еще по ошибке;
//Для класса newView:
//- остались ошибки в функциях __sleep, getInfo, load;
//- в getSave есть принципиальная ошибка, которая мешает повторному использованию.


$obj = new newBase('12345');
$obj->setValue('text');

$obj2 = new \Test3\newView('O9876');
$obj2->setValue($obj);
$obj2->setProperty('field');
$obj2->getInfo();
//
//$save = $obj2->getSave();
//
//$obj3 = newView::load($save);
//
//var_dump($obj2->getSave() == $obj3->getSave());


debug($obj);
debug($obj2);
