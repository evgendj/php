<?php

// Видео 9 смотрю 18 минут - Про то чтобы прописать скидку в сеттере, напиши про геттеры и сеттеры. И закрой скидку

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

$book->discount = 50;

echo $book->getProduct();
echo $notebook->getProduct();

// var_export($book->public);
// var_export($book->protected);
// var_export($book->private);
