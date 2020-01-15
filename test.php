<!-- Скляр - 204  ***  В подлиннике - 698 (Работа в sql - 678) -->

<?php

require_once('connect_db_forum.php');

// Изменяем только тип, при этом имя должно посторяться

try {
  $query = $pdo->exec("INSERT INTO tbl VALUES (3, '2016-01-01 0:00:00' - INTERVAL 3 WEEk, NOW() + INTERVAL 3 MONTH)");
} catch (PDOEXception $e) {
  echo "Не удалось вставить строку " . $e->getMessage();
}
