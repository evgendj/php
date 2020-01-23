<!-- Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)-->

<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

require_once('connect_db.php');

$xml = file_get_contents('product.xml');
$product = new SimpleXMLElement($xml);

try {
	for ($i = 0; $i < $product->Товар->count(); $i++) {
		$insert_product = $pdo->prepare("INSERT INTO a_product VALUES (NULL, ?, ?)");
		$insert_product->execute([$product->Товар[$i]->attributes()->{'Код'}, $product->Товар[$i]->attributes()->{'Название'}]);
	}

} catch (PDOException $e) {
	echo "Ошибка загрузки в базу данных" . $e->getMessage();
}

/*
$content = file_get_contents('product.xml');
$product = new SimpleXMLElement($content);

try {
	for ($i = 0, $cat_code = 1; $i < $product->Товар->count(); $i++, $cat_code++) {
		foreach ($product->Товар[$i]->Разделы->Раздел as $category_name) {
			$query = $pdo->query("SELECT * FROM a_category WHERE category_name LIKE '$category_name'");
			$category = $query->fetch(PDO::FETCH_ASSOC);
			if ($category['category_name'] == $category_name) {
					$category_id = $category['category_id'];
			} else {
				$insert_category = $pdo->prepare("INSERT INTO a_category VALUES (NULL, $cat_code, ?, DEFAULT)");
				$insert_category->execute([$category_name]);
				$category_id = $pdo->lastInsertId();
			//	echo $category_id . "<br>";
			}
		}
			$insert_product = $pdo->prepare("INSERT INTO a_product VALUES (NULL, ?, ?)");
			$insert_product->execute([$product->Товар[$i]->attributes()->{'Код'}, $product->Товар[$i]->attributes()->{'Название'}]);
			$product_id = $pdo->lastInsertId();
			$product_category = $pdo->exec("INSERT INTO product_category VALUES ($product_id, $category_id)");
			//	echo $product->Товар[$i]->attributes()->{'Код'};
			//	echo $product->Товар[$i]->attributes()->{'Название'};

	}
} catch (PDOException $e) {
  echo "Ошибка загузки в базу данных" . $e->getMessage();
}
*/

// Создание таблиц
/*
try {
  $a_product = $pdo->exec(
    "CREATE TABLE a_product (
      product_id INT(11) NOT NULL AUTO_INCREMENT,
      code VARCHAR(255),
      name VARCHAR(255),
      PRIMARY KEY (product_id)
    )"
  );

  $a_property = $pdo->exec(
    "CREATE TABLE a_property (
      product_id INT(11) NOT NULL,
      name VARCHAR(255),
      property VARCHAR(255)
    )"
  );

  $a_price = $pdo->exec(
    "CREATE TABLE a_price (
      product_id INT(11) NOT NULL,
      type VARCHAR(255),
      price DECIMAL(15,2)
    )"
  );

  $a_category =$pdo->exec(
    "CREATE TABLE a_category (
      category_id INT(11) NOT NULL AUTO_INCREMENT,
      code VARCHAR(255),
      name VARCHAR(255),
      parent_id INT(11) NOT NULL DEFAULT 0,
      PRIMARY KEY (category_id)
    )"
  );
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();
}
*/


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
