<!-- Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)-->

<?php
function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

// перед добавлением значений надо проверять наличие этих свойств и соответствие типов, например может элемент не иметь свойство код и такой элемент не надо добавлять
//также надо сделать проверку на наличие элемента в БД, чтобы не добавлять дубликаты

// Функция importXml($a)
function importXml($a) {
	require_once('connect_db.php');
	$xml = file_get_contents($a);
	$product = new SimpleXMLElement($xml);
	try {
		for ($i = 0, $parent_id = 0, $c = 1; $i < $product->Товар->count(); $i++) {

			// Загружаем код (ПРИ НАЛИЧИИ) и имя продукта, извлекаем id
			$insert_product = $pdo->prepare("INSERT INTO a_product VALUES (NULL, ?, ?)");
			if ($product->Товар[$i]->attributes()->{'Код'}) {
				$insert_product->execute([$product->Товар[$i]->attributes()->{'Код'}, $product->Товар[$i]->attributes()->{'Название'}]);
			} else {
				$insert_product->execute([NULL, $product->Товар[$i]->attributes()->{'Название'}]);
			}
			$product_id = $pdo->lastInsertId();

			// Загружаем цену с типом
			$insert_price = $pdo->prepare("INSERT INTO a_price VALUES ($product_id, ?, ?)");
			foreach ($product->Товар[$i]->Цена as $price) {
				$insert_price->execute([$price['Тип'], $price]);
			}

			// Загружаем свойства (ПРИ НАЛИЧИИ)
			$insert_properties = $pdo->prepare("INSERT INTO a_property VALUES ($product_id, ?, ?)");
			foreach ($product->Товар[$i]->Свойства as $properties) {
				foreach ($properties as $property => $value) {
					if ($product->Товар[$i]->Свойства) {
						$insert_properties->execute([$property, $value]);
					}
				}
			}

			// Загружаем разделы, вложенность разделов и связь разделов с товаром
			$insert_category = $pdo->prepare("INSERT INTO a_category VALUES (NULL, ?, ?, ?)");
			$product_in_category = $pdo->prepare("INSERT INTO a_product_category VALUES (?, ?)");
			foreach ($product->Товар[$i]->Разделы->Раздел as $category_name) {
				$query_category = $pdo->query("SELECT * FROM a_category WHERE name LIKE '$category_name'");
				$category = $query_category->fetch(PDO::FETCH_ASSOC);
				if ($category['name'] == $category_name) {
					$parent_id = $category['category_id'];
					$product_in_category->execute([$product_id, $category['category_id']]);
				} else {
					$insert_category->execute([$c, $category_name, $parent_id]);
					$parent_id = $pdo->lastInsertId();
					$product_in_category->execute([$product_id, $pdo->lastInsertId()]);
					$c++;
				}
			}
			$parent_id = 0;
		}
	} catch (PDOException $e) {
		echo "Ошибка загрузки в базу данных" . $e->getMessage();
	}
}
$a = 'product.xml';
importXml($a);
