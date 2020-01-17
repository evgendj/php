<!-- Скляр - 215  ***  В подлиннике - 698 (Работа в sql - 686) -->

<?php

require_once('connect_db_forum.php');

// Изменяем только тип, при этом имя должно посторяться

$q = $pdo->query("SELECT * FROM catalogs WHERE id > 2 AND id < 10");
while ($row = $q->fetch()) {
  echo "$row[0] - $row[1]<br>";
}


/*
try {
  $query = $pdo->exec("UPDATE tbl SET lastdate = '2020-04-18' WHERE lastdate = '2020-04-17'");
  echo "Изменена " . $query . " строка";
} catch (PDOEXception $e) {
  echo "Не удалось вставить строку " . $e->getMessage();
}
*/
