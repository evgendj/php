<!-- Скляр - 198  ***  В подлиннике - 697 (Прочитай типы полей - 664) -->

<?php

require_once('connect_db.php');

// Формируем и выполняем SQL-запрос

try {
  $query = $pdo->exec("CREATE TABLE catalogs (
            id_catalog INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            PRIMARY KEY (id_catalog))");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();
}
