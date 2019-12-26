<?php

// Видео 8 смотрю 13 минут 

error_reporting(-1);

require_once 'classes/Product.php';
require_once 'classes/BookProduct.php';
require_once 'classes/NotebookProduct.php';

function debug($data) {
  echo "<pre>" . print_r($data, 1) . "</pre>";
}

$book = new Product('Три Мушкитера', 20);
$notebook = new NotebookProduct('Dell', 1000);

debug($book);
debug($notebook);

echo $book->getProduct();
echo $notebook->getProduct();
