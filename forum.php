<?php

// Разница между TEXT и TUNYTEXT всего 1 байт, не следует экономить, поскольку размер плавающий и не будет занимать много памяти.
try {
  $query = $pdo->exec(
    "CREATE TABLE authors ( // Создание таблицы с пользователями форума
      id INT(11) NOT NULL AUTO_INCREMENT,
      name TINYTEXT, // позволяет ввести не более 256 символов
      passw TINYTEXT,
      email TINYTEXT,
      url TEXT, // 65 536 символов
      icq TINYTEXT,
      about TEXT,
      photo TINYTEXT,
      putdate DATETIME DEFAULT NULL,
      last_time DATETIME DEFAULT NULL,
      statususer ENUM ('user', 'moderator', 'admin') NOT NULL default 'user',
      PRIMARY KEY (id)
    )");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();
}

try {
  $query = $pdo->exec(
    "CREATE TABLE forums ( // Создание таблицы с разделами форума
      id INT(11) NOT NULL AUTO_INCREMENT,
      name TINYTEXT,
      rule TEXT,
      logo TINYTEXT,
      pos INT(11) DEFAULT NULL,
      hide ENUM ('show', 'hide') NOT NULL DEFAULT 'show',
      PRIMARY KEY (id)
    )");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();
}

try {
  $query = $pdo->exec(
    "CREATE TABLE themes ( // Создание таблицы с темаи разделов форума
      id INT(11) NOT NULL AUTO_INCREMENT,
      name TINYTEXT,
      author TINYTEXT,
      author_id INT(11) DEFAULT NULL,
      hide ENUM('show','hide') NOT NULL DEFAULT 'show',
      putdate DATETIME DEFAULT NULL,
      forum_id INT(11) default NULL,
      PRIMARY KEY (id)
    )");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();
}

try {
  $query = $pdo->exec(
    "CREATE TABLE posts ( // Создание таблицы с сообщениями в темах форума
      id INT(11) NOT NULL AUTO_INCREMENT,
      name TINYTEXT,
      url TEXT,
      file TINYTEXT,
      author TINYTEXT,
      author_id INT(11) DEFAULT NULL,
      hide ENUM('show','hide') NOT NULL DEFAULT 'show',
      putdate DATETIME DEFAULT NULL,
      parent_post INT(11) DEFAULT NULL,
      theme_id INT(11) default NULL,
      PRIMARY KEY (id)
    )");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();
}
// Добавление нового столбца test
try {
  $query = $pdo->exec("ALTER TABLE forums ADD test int(10) AFTER name");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();}
// Переименовывание столбца test в new_test и изменение типа поля
try {
  $query = $pdo->exec("ALTER TABLE forums CHANGE test new_test TEXT");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();}
// Изменяем только тип, при этом имя должно посторяться
try {
  $query = $pdo->exec("ALTER TABLE forums CHANGE new_test new_test INT(10) NOT NULL");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();}
// Удаление столбца new_test
try {
  $query = $pdo->exec("ALTER TABLE forums DROP new_test");
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();}
