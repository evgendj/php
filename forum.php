<?php

// Создание таблиц Самсон
try {
  $a_product = $pdo->exec(
    "CREATE TABLE a_product (
      product_id INT(11) NOT NULL AUTO_INCREMENT,
      code VARCHAR(255),
      name VARCHAR(255),
      PRIMARY KEY (product_id)
    )"
  );

  $a_property = $pdo->exec(
    "CREATE TABLE a_property (
      product_id INT(11) NOT NULL,
      name VARCHAR(255),
      property VARCHAR(255)
    )"
  );

  $a_price = $pdo->exec(
    "CREATE TABLE a_price (
      product_id INT(11) NOT NULL,
      type VARCHAR(255),
      price DECIMAL(15,2)
    )"
  );

  $a_category =$pdo->exec(
    "CREATE TABLE a_category (
      category_id INT(11) NOT NULL AUTO_INCREMENT,
      code VARCHAR(255),
      name VARCHAR(255),
      parent_id INT(11) NOT NULL DEFAULT 0,
      PRIMARY KEY (category_id)
    )"
  );
} catch (PDOEXception $e) {
  echo "Не удалось создать таблицу " . $e->getMessage();
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
