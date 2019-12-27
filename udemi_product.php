<?php

// Видео 10 смотрю

error_reporting(-1);

require_once 'classes/Product.php';
require_once 'classes/BookProduct.php';
require_once 'classes/NotebookProduct.php';

function debug($data) {
  echo "<pre>" . print_r($data, 1) . "</pre>";
}

$book = new BookProduct('Три Мушкитера', 20, 557);
$notebook = new NotebookProduct('Dell', 1000, 'Intel');

debug($book);
debug($notebook);


echo $book->getProduct();
echo $notebook->getProduct();

// var_export($book->public);
// var_export($book->protected);
// var_export($book->private);
