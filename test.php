<!-- Скляр - 206  ***  В подлиннике - 698 (Работа в sql - 683) -->

<?php

require_once('connect_db_forum.php');

// Изменяем только тип, при этом имя должно посторяться

try {
  $query = $pdo->exec("UPDATE catalogs SET name = 'Память 2' WHERE name = 'Паять'");
} catch (PDOEXception $e) {
  echo "Не удалось вставить строку " . $e->getMessage();
}
