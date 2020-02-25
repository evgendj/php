<?php
namespace Test3;

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
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


//$obj = new newBase('12345');
//$obj->setValue('text');
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