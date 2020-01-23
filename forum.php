<?php

// Разница между TEXT и TUNYTEXT всего 1 байт, не следует экономить, поскольку размер плавающий и не будет занимать много памяти.
try {
  $a_product = $pdo->exec(
    "CREATE TABLE a_product (
      product_id INT(11) NOT NULL AUTO_INCREMENT,
      code VARCHAR(255),
      name VARCHAR(255),
      PRIMARY KEY (product_id)
    )"
  );

  
}


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
// Трай кэтч везде будет один и тотже, только выводить сообщение нужно под соответсвующую ошибку
    "CREATE TABLE forums ( // Создание таблицы с разделами форума
      id INT(11) NOT NULL AUTO_INCREMENT,
      name TINYTEXT,
      rule TEXT,
      logo TINYTEXT,
      pos INT(11) DEFAULT NULL,
      hide ENUM ('show', 'hide') NOT NULL DEFAULT 'show',
      PRIMARY KEY (id))"

    "CREATE TABLE themes ( // Создание таблицы с темаи разделов форума
      id INT(11) NOT NULL AUTO_INCREMENT,
      name TINYTEXT,
      author TINYTEXT,
      author_id INT(11) DEFAULT NULL,
      hide ENUM('show','hide') NOT NULL DEFAULT 'show',
      putdate DATETIME DEFAULT NULL,
      forum_id INT(11) default NULL,
      PRIMARY KEY (id))"

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
      PRIMARY KEY (id))"




















//
