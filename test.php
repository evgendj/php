<!-- Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)-->

<?php
function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

// $a – путь к xml файлу вида (структура файла приведена ниже)
// $b – код рубрики
// выбрать из БД товары (и их характеристики, необходимые для формирования файла) выходящие в рубрику $b или в любую из всех вложенных в нее рубрик, сохранить результат в файл $a.


// Функция exportXml($a, $b)
function exportXml($a, $b) {
	require_once('connect_db.php');
	$xml = '<?xml version="1.0" encoding="UTF-8"?><Товары></Товары>';
	$products = new SimpleXMLElement($xml);
	$product_tag = $products->addChild('Товар');

	try {
		// Выбираем категорию с требуемым кодом.
		$category_q = $pdo->query("SELECT * FROM a_category WHERE code = $b");
		$category = $category_q->fetch(PDO::FETCH_ASSOC);

		// Выбираем id товаров, соответствующих требуемой категории. Формируем код и название товара.
		$product_cat_q = $pdo->query("SELECT * FROM a_product_category WHERE category_id = $category[category_id]");
		while ($product_category = $product_cat_q->fetch(PDO::FETCH_ASSOC)) {
			$product_q = $pdo->query("SELECT * FROM a_product WHERE product_id = $product_category[product_id]");
			$product = $product_q->fetch(PDO::FETCH_ASSOC);
			$product_tag = $products->addChild('Товар');
			$product_tag->addAttribute('Код', $product['code']);
			$product_tag->addAttribute('Название', $product['name']);

			// Выбираем цены, формируем тип цены и значение.
			$price_q = $pdo->query("SELECT * FROM a_price WHERE product_id = $product[product_id]");
			while ($price = $price_q->fetch(PDO::FETCH_ASSOC)) {
				$price_tag = $product_tag->addChild('Цена', $price['price']);
				$price_tag->addAttribute('Тип', $price['type']);
			}

			// Выбираем и формируем свойства
			$properties_tag = $product_tag->addChild('Свойства');
			$property_q = $pdo->query("SELECT * FROM a_property WHERE product_id = $product[product_id]");
			while ($property = $property_q->fetch(PDO::FETCH_ASSOC)) {
				$properties_tag->addChild($property['name'], $property['property']);
			}

			// Формируем категории
			$catalogs_tag = $product_tag->addChild('Разделы');
			$catalogs_tag->addChild('Раздел', $category['name']);
		}
	} catch (PDOException $e) {
		echo "Ошибка выполнения запроса " . $e->getMessage();
	}
	$products->asXML($a);
}
$a = 'a.xml';
$b = 2;
exportXml($a, $b);


/* - тут функция первая по загрузке xml
function importXml($a) {
	require_once('connect_db.php');
	$xml = file_get_contents('product.xml');
	$product = new SimpleXMLElement($xml);
	try {
		for ($i = 0, $parent_id = 0; $i < $product->Товар->count(); $i++) {

			// Загружаем код и имя продукта, извлекаем id
			$insert_product = $pdo->prepare("INSERT INTO a_product VALUES (NULL, ?, ?)");
			$insert_product->execute([$product->Товар[$i]->attributes()->{'Код'}, $product->Товар[$i]->attributes()->{'Название'}]);
			$product_id = $pdo->lastInsertId();

			// Загружаем цену с типом
			$insert_price = $pdo->prepare("INSERT INTO a_price VALUES ($product_id, ?, ?)");
			foreach ($product->Товар[$i]->Цена as $price) {
				$insert_price->execute([$price['Тип'], $price]);
			}

			// Загружаем свойства
			$insert_properties = $pdo->prepare("INSERT INTO a_property VALUES ($product_id, ?, ?)");
			foreach ($product->Товар[$i]->Свойства as $properties) {
				foreach ($properties as $property => $value) {
					$insert_properties->execute([$property, $value]);
				}
			}

			// Загружаем разделы, вложенность разделов и связь разделов с товаром
			$insert_category = $pdo->prepare("INSERT INTO a_category VALUES (NULL, NULL, ?, ?)");
			$product_in_category = $pdo->prepare("INSERT INTO a_product_category VALUES (?, ?)");
			foreach ($product->Товар[$i]->Разделы->Раздел as $category_name) {
				$query_category = $pdo->query("SELECT * FROM a_category WHERE name LIKE '$category_name'");
				$category = $query_category->fetch(PDO::FETCH_ASSOC);
				if ($category['name'] == $category_name) {
					$parent_id = $category['category_id'];
					$product_in_category->execute([$product_id, $category['category_id']]);
				} else {
					$insert_category->execute([$category_name, $parent_id]);
					$parent_id = $pdo->lastInsertId();
					$product_in_category->execute([$product_id, $pdo->lastInsertId()]);
				}
			}
			$parent_id = 0;
		}
	} catch (PDOException $e) {
		echo "Ошибка загрузки в базу данных" . $e->getMessage();
	}
}

$a = 'connect_db.php';
// importXml($a);
*/

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


/*
// Дэбаги
echo "Цикл разделов<br>";
foreach ($product->Товар[2]->Разделы->Раздел as $v) {
	echo $v . "<br>";
}
echo $product->Товар[2]->Разделы->Раздел->count();

echo "<br><br>Цикл свойств";
debug($product->Товар[0]->Свойства);
foreach ($product->Товар[0]->Свойства as $v) {
	debug($v);
	foreach ($v as $key => $value) {
		echo $key . " " . $value . "<br>";
	}
}

echo "Цикл первого товара";
debug($product->Товар);

echo "Цикл атрибутов товара";
debug($product->Товар->attributes());

echo "Цикл цен";
debug($product->Товар->Цена[0]);

echo "Вывод и атрибута и значения тэга в цикле<br>";
foreach ($product->Товар->Цена as $price) {
	echo $price['Тип'] . "=" . $price . "<br>";
}
// Конец дэбагов
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
