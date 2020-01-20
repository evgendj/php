<!-- Скляр - 215  ***  В подлиннике - 704 -->

<?php

require_once('connect_db_forum.php');

$content = file_get_contents('product.xml');
$product = new SimpleXMLElement($content);

foreach ($product->Товар[2]->Разделы as $product) {
  echo $product->Раздел[1];
}








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
