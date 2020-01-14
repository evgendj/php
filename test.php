<!-- Скляр - 204  ***  В подлиннике - 698 (Работа в sql - 668) -->

<?php

require_once('connect_db.php');

// Формируем и выполняем SQL-запрос

try {
  $query = $pdo->exec("SHOW TABLES");
} catch (PDOEXception $e) {
  echo "Не удалось удалить таблицу " . $e->getMessage();
}
