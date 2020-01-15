<!-- Скляр - 204  ***  В подлиннике - 698 (Работа в sql - 674) -->

<?php

require_once('connect_db_forum.php');

// Изменяем только тип, при этом имя должно посторяться

try {
  $query = $pdo->exec("ALTER TABLE forums DROP new_test");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();
}
