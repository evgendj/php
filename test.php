<!-- Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)-->

<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

require_once('connect_db.php');

$content = file_get_contents('product.xml');
$product = new SimpleXMLElement($content);

try {
	for ($i = 0, $cat_code = 1; $i < $product->Товар->count(); $i++, $cat_code++) {
		foreach ($product->Товар[$i]->Разделы->Раздел as $category_name) {
			$query = $pdo->query("SELECT * FROM a_category WHERE category_name LIKE '$category_name'");
			$category = $query->fetch(PDO::FETCH_ASSOC);
			if ($category['category_name'] == $category_name) {
				if ($category_id) {
					$category_id += , + $category['category_id'];
				} else {
					$category_id = $category['category_id'];
				}
			} else {
				$insert_category = $pdo->prepare("INSERT INTO a_category VALUES (NULL, $cat_code, ?, DEFAULT)");
				$insert_category->execute([$category_name]);
				$category_id = $pdo->lastInsertId();
			//	echo $category_id . "<br>";
			}
		}
			$insert_product = $pdo->prepare("INSERT INTO a_product VALUES (NULL, ?, ?, $category_id)");
			$insert_product->execute([$product->Товар[$i]->attributes()->{'Код'}, $product->Товар[$i]->attributes()->{'Название'}]);
			//	echo $product->Товар[$i]->attributes()->{'Код'};
			//	echo $product->Товар[$i]->attributes()->{'Название'};
			unset($category_id);
	}
} catch (PDOException $e) {
  echo "Ошибка загузки в базу данных" . $e->getMessage();
}



// Ввод категорий без защиты
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
$query = $pdo->query("SELECT * FROM a_category WHERE category_name LIKE 'Бумага'");
$category = $query->fetch(PDO::FETCH_ASSOC);

debug($category);
if ($category['category_name'] == 'Бумага') {
	echo "Есть";
} else {
	echo "Нету";
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
