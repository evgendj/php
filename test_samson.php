<?php
namespace Test3;

require_once('classes\newBase.php');
require_once('classes\newView.php');

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

// Данный класс выполняет функцию сохранения и восстановления объектов с их свойствами.
// Вместо стандартной сериализации данных используется свой метод (сохранение в более короткую строку вида
// Имя:ДлиназначенияЗначение и Имя:ДлиназначенияЗначениеСериализованноесвойство и соответственно чтение производится из этих же форматов)
// name      4          9876 & name       4       9876       serProp
//- в конструкторе тип был указан правильно, но есть ошибка в проверке на существование элемента (в случае пустого параметра);
//- в функции getSave вызов функции sizeof является ошибкой, надо правильную использовать, так же в этой функции есть еще ошибка;
//- в функциях getSize и load осталась еще по ошибке;
//Для класса newView:
//- остались ошибки в функциях __sleep, getInfo (исправил - обратный слэш), load;
//- в getSave есть принципиальная ошибка, которая мешает повторному использованию.

function gettype($value): string
{
    if (is_object($value)) {
        $type = get_class($value);
        do {
            // if (strpos($type, "Test3\newBase") !== false) {
						if (strpos($type, 'Test3\newBase') !== false) {
                return 'test';
            }
        } while ($type = get_parent_class($type));
    }
    // return gettype($value);
		return \gettype($value);
}


$obj = new newBase('12345');
$obj->setValue('text');
//
$obj2 = new \Test3\newView('9876'); //Передавалось О, убрал вообще, потому что спереди он игнорируется
$obj2->setValue($obj);
$obj2->setProperty('field');
$obj2->getInfo();
//
$save = $obj2->getSave();
//
$obj3 = newView::load($save);
//
// var_dump($obj2->getSave() == $obj3->getSave

//
$obj40 = new newBase;
$obj50 = new newBase;
$obj60 = new newBase;

echo "<hr>";
echo "Первый объект<hr>";
debug($obj);

echo "<hr>";
echo "Второй объект<hr>";
debug($obj2);

echo "<hr>";
echo "Масив в статике<hr>";
debug($obj->getArray());

echo "<hr>";
echo "Обращаюсь к getName() первого класса<hr>";
echo $obj->getName();

echo "<hr>";
echo "Обращаюсь к getName() Второго класса<hr>";
echo $obj2->getName();

echo "<hr>";
echo "Вывожу готовую строку для передачи<hr>";
echo $save;

echo "<hr>";
echo "Третий объект (после десериализации)<hr>";
debug($obj3);
/*

$obj = new newBase('12345');
$obj->setValue('text');
//
$obj2 = new \Test3\newView('09876');
$obj2->setValue($obj);
$obj2->setProperty('field');
$obj2->getInfo();
//
//$save = $obj2->getSave();
//
//$obj3 = newView::load($save);
//
//var_dump($obj2->getSave() == $obj3->getSave());

//
//
debug($obj);
debug($obj2);
*/
