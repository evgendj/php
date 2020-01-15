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

ALTER TABLE // Работа со столбцами
"ALTER TABLE forums ADD test int(10) AFTER name" // Добавление нового столбца test
"ALTER TABLE forums CHANGE test new_test TEXT" // Переименовывание столбца test в new_test и изменение типа поля
"ALTER TABLE forums CHANGE new_test new_test INT(10) NOT NULL" // Изменяем только тип, при этом имя должно посторяться
"ALTER TABLE forums DROP new_test" // Удаление столбца new_test

INSERT // Вставка строк в таблицу
"INSERT INTO tbl VALUES (10, 20)" // Добавятся значения по порядку столбцов, при этом количество значений в скобках должно соответсвовать кол-ву столбцов в таблице.
"INSERT INTO tbl (id_cat, id) VALUES (10, 20)" // Добавили в скобки названия столбцов, причем с измененным порядком, так и запишутся
"INSERT INTO tbl (id) VALUES (30)" // Заполнять можно часть столбцов, остальные проставятся по умолчанию
"INSERT INTO tbl () VALUES ()" // С пустыми скобками просто по дефолту проставятся значения. Этого же можно добиться оператором DEFAULT
"INSERT INTO tbl (id, id_cat) VALUES (DEFAULT, DEFAULT)" // Обозначает все тоже что и в строке выше
// Выше примеры поддерживаются всеми СУБД. Ниже только для MySQL
"INSERT INTO tbl SET id = 40, id_cat = 50"
"INSERT INTO tbl SET id = 50" // Можно заполнять так один столбец, остальное будет по дефолту
"INSERT INTO catalogs VALUES (1, 'Процессоры')" // Строковые значачения вставляются в одинарные или двойные кавычки
// если в тексте есть какие либо кавычки, то просто при вставке используй противополжные. Чет у меня не сработало. Так же можно экранировать \
"INSERT INTO catalogs VALUES (3, 'Память \'DDR\'')" // Так получилось норм
DATETIME DATE // это второй и третий столбец. В третий подается и дата и время, время отбросится
"INSERT INTO tbl VALUES (1, '2016-01-03 0:00:00', '2016-01-03 0:00:00')"
NOW() // Встроенная функция MySQL - вставка текущего времени.
"INSERT INTO tbl VALUES (2, NOW(), NOW())"
// В рамках одного SQL запроса время вычисляется один раз и дальше остается постоянным. Но можно использовать временные интервалы
"INSERT INTO tbl VALUES (3, '2016-01-01 0:00:00' - INTERVAL 3 WEEk, NOW() + INTERVAL 3 MONTH)" // От первой даты отнимется 3 недели, ко второй дате прибавится 3 месяца




















//
