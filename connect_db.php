<?php
try {
  $db = new PDO('mysql:host=localhost;dbname=test_samson', 'root', '');
} catch (PDOException $e) {
  echo "Невозможно установить соединение с базой данных";
}
?>
