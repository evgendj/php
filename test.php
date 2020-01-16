<!-- Скляр - 208  ***  В подлиннике - 698 (Работа в sql - 683) -->

<?php

require_once('connect_db_forum.php');

// Изменяем только тип, при этом имя должно посторяться

try {
  $query = $pdo->exec("UPDATE tbl SET lastdate = '2020-04-18' WHERE lastdate = '2020-04-17'");
  echo "Изменена " . $query . " строка";
} catch (PDOEXception $e) {
  echo "Не удалось вставить строку " . $e->getMessage();
}
