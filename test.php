<!-- Скляр - 215  ***  В подлиннике - 704 -->

<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

https://snipp.ru/php/manual-pdo

require_once('connect_db.php');

$content = file_get_contents('product.xml');
$product = new SimpleXMLElement($content);

$query = $pdo->query("SELECT * FROM a_category WHERE category_name LIKE 'Бумага'");

debug($query);

/*
for ($i = 0, $cat_code = 1; $i < $product->Товар->count(); $i++, $cat_code++) {
  foreach ($product->Товар[$i]->Разделы->Раздел as $value) {
    try {
      $exec = $pdo->exec("INSERT INTO a_category VALUES (NULL, $cat_code, '$value', DEFAULT)");
    } catch (PDOException $e) {
      echo "Ошибка загузки в базу данных" . $e->getMessage();
    }
  }
}
*/




/*
$q = $pdo->query("SELECT * FROM catalogs WHERE id NOT IN (8,9)");
while ($row = $q->fetch()) {
  echo "$row[0] - $row[1]<br>";
}
*/

/*
try {
  $query = $pdo->exec("UPDATE tbl SET lastdate = '2020-04-18' WHERE lastdate = '2020-04-17'");
  echo "Изменена " . $query . " строка";
} catch (PDOEXception $e) {
  echo "Не удалось вставить строку " . $e->getMessage();
}
*/
