<?php


require_once 'classes/file.php';

$file = new File(__DIR__ . '/file.txt'); // дир говорит текущая директория

$file->write('Строка 1');
$file->write('Строка 2');

 ?>
