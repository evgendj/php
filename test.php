<!-- Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)-->

<?php
function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

/*
$dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
 $dom->formatOutput=true; // Делаем перенос строки

 $root = $dom->createElement("users"); // Создаём корневой элемент
$dom->appendChild($root);

$logins = array("User1", "User2", "User3"); // Логины пользователей
$passwords = array("Pass1", "Pass2", "Pass3"); // Пароли пользователей
for ($i = 0; $i < count($logins); $i++) {
  $id = $i + 1; // id-пользователя
  $user = $dom->createElement("user"); // Создаём узел "user"
  $user->setAttribute("id", $id); // Устанавливаем атрибут "id" у узла "user"
  $login = $dom->createElement("login", $logins[$i]); // Создаём узел "login" с текстом внутри
  $password = $dom->createElement("password", $passwords[$i]); // Создаём узел "password" с текстом внутри
  $user->appendChild($login); // Добавляем в узел "user" узел "login"
  $user->appendChild($password);// Добавляем в узел "user" узел "password"
  $root->appendChild($user); // Добавляем в корневой узел "users" узел "user"
}
$dom->save("users.xml"); // Сохраняем полученный XML-документ в файл


require_once('connect_db.php');
$dom = new domDocument("1.0", "utf-8");
$dom->formatOutput=true;
$root = $dom->createelement('Товары');
$dom->appendChild($root);

try {
	// Выбираем категорию с требуемым кодом.
	$category_q = $pdo->query("SELECT * FROM a_category WHERE code = 2");
	$category = $category_q->fetch(PDO::FETCH_ASSOC);

	// Выбираем id товаров, соответствующих требуемой категории. Формируем код и название товара.
	$product_cat_q = $pdo->query("SELECT * FROM a_product_category WHERE category_id = $category[category_id]");
	while ($product_category = $product_cat_q->fetch(PDO::FETCH_ASSOC)) {
		$product_q = $pdo->query("SELECT * FROM a_product WHERE product_id = $product_category[product_id]");
		$product = $product_q->fetch(PDO::FETCH_ASSOC);
		$product_tag = $dom->createElement('Товар');
		$product_tag->setAttribute('Код', $product['code']);
		$product_tag->setAttribute('Название', $product['name']);
		$root->appendChild($product_tag);
	}



} catch (PDOException $e) {
	echo "Ошибка выполнения запроса " . $e->getMessage();
}



$dom->save('a.xml');
*/
// Функция exportXml($a, $b)
function exportXml($a, $b) {
	require_once('connect_db.php');
	$dom = new domDocument("1.0", "utf-8");
	$dom->formatOutput=true;
	$root = $dom->createElement('Товары');
	$dom->appendChild($root);

	try {
		// Выбираем категорию с требуемым кодом.
		$category_q = $pdo->query("SELECT * FROM a_category WHERE code = $b");
		$category = $category_q->fetch(PDO::FETCH_ASSOC);

		// Выбираем id товаров, соответствующих требуемой категории. Формируем код и название товара.
		$product_cat_q = $pdo->query("SELECT * FROM a_product_category WHERE category_id = $category[category_id]");
		while ($product_category = $product_cat_q->fetch(PDO::FETCH_ASSOC)) {
			$product_q = $pdo->query("SELECT * FROM a_product WHERE product_id = $product_category[product_id]");
			$product = $product_q->fetch(PDO::FETCH_ASSOC);
			$product_tag = $dom->createElement('Товар');
			$product_tag->setAttribute('Код', $product['code']);
			$product_tag->setAttribute('Название', $product['name']);

			// Выбираем цены, формируем тип цены и значение.
			$price_q = $pdo->query("SELECT * FROM a_price WHERE product_id = $product[product_id]");
			while ($price = $price_q->fetch(PDO::FETCH_ASSOC)) {
				$price_tag = $dom->createElement('Цена', $price['price']);
				$price_tag->setAttribute('Тип', $price['type']);
				$product_tag->appendChild($price_tag);
			}

			// Выбираем и формируем свойства
			$properties_tag = $dom->createElement('Свойства');
			$property_q = $pdo->query("SELECT * FROM a_property WHERE product_id = $product[product_id]");
			while ($property = $property_q->fetch(PDO::FETCH_ASSOC)) {
				$property_tag = $dom->createElement($property['name'], $property['property']);
				$properties_tag->appendChild($property_tag);
				$product_tag->appendChild($properties_tag);
			}

			// Формируем категории
			$catalogs_tag = $dom->createElement('Разделы');
			$catalog_tag = $dom->createElement('Раздел', $category['name']);
			$catalogs_tag->appendChild($catalog_tag);
			$product_tag->appendChild($catalogs_tag);

			$root->appendChild($product_tag);
		}
	} catch (PDOException $e) {
		echo "Ошибка выполнения запроса " . $e->getMessage();
	}
	$dom->save($a);
}
$a = 'a.xml';
$b = 1;
exportXml($a, $b);
