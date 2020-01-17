<?php
"
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
"INSERT INTO tbl VALUES (3, '2016-01-01 0:00:00' - INTERVAL 3 WEEk, NOW() + INTERVAL 3 MONTH) // От первой даты отнимется 3 недели, ко второй дате прибавится 3 месяца. Есть и другие интервалы, много их.

PRIMARY KEY // первичный ключ - предполагает, что поле не должно повторяться, и если 2 раза попытаться одно и тоже число вставить, выдаст ошибку.
PRIMARY KEY (id) // под всеми полями прописывается, в скобках столбик который нужно сделать первичным
// Но можно принудительно отключить ошибку через IGNORE. Ошибки не будет, но и строчка с дубликатом не запишется.
INSERT IGNORE INTO tbl VALUES (1, 'Видеоадаптеры') // Единичка не запишется дублем
AUTO_INCREMENT // Чтобы не гадать какой id использовать, придумали атрибут для генерации по порядку. Достаточно при внесении записи написать NULL или 0 под id и просчитается максимальное значение +1
"INSERT INTO tbl VALUES (NULL, 'Процессоры')" // Вместо NULL можно поставить 0
// Добавлять можно не по одной записии, а сразу кучу используя INSERT один раз. Тоже можно использовать IGNORE, перестановку, и частями вносить
"INSERT INTO catalogs VALUES (NULL, 'Процессоры'), (NULL, 'Видео')"
"INSERT INTO catalogs (name) VALUES ('Материнские платы'), ('Память')" // Можно частями вводить

DELETE // Удаление всех или части записей из таблицы. В инкрементируемых полях запоминается последнее значение и при удалении уже не используется номера, которые уже были, идет только на увеличение. Но приэтом если ввести тот id который был удален, то запись будет добавлена под этим ID
TRUNCATE TABLE tbl // Удаление всех записей из таблицы. В отличии от DELETE удаление происходит гораздо быстрее! Не перебирается каждая запись
DELETE FROM catalogs // Удаление всех записей из таблицы, если нет условий
DELETE FROM catalogs WHERE id > 2 // Удалить все записи с id больше 2
LIMIT // удалит указанное количество записей сначала
DELETE FROM catalogs LIMIT 3 // удалить 3 записи сначала

UPDATE // Обновляет поля в существующих записях
"UPDATE catalogs SET name = 'Процессоры (Intel)' WHERE name = 'Процессоры'" // Если ошибся в написании значения поля, ничего не произойдет, даже ошибку не выдаст. Причем можно использовать WHERE с одним столбцом, а сэт с другим.
UPDATE dishes SET price = 5.50 // изменит цену во всех строках
UPDATE dishes SET price = price *  2 // Можно использовать арифметические действия

REPLACE // Больше похож на INSERT - но если id с PRIMARY KEY будет такой же, то старая запись будет удалена, а новая внесена. Если нет PRIMARY KEY, то использовать ее бессмысленно, так как будет действовать точно как insert, просто вставит новую запись. Синтаксис как у INSERT
REPLACE INTO catalogs VALUES (8, 'Память'), (9, 'Диск'), (10, 'HDD') // Удобно использовать когда нужно часть строк перезаписать, а остальное просто записать, при использовании PRIMARY KEY


query() // Метод для извлечения информации из бд
fetch() // Вовращает из базы строки. Когда заканчиватся, вовращает ложь.

SELECT // Выбор записей из таблицы. Можно сделать часть выборки, можно столбцы менять местами
$q = $pdo->query("SELECT id, name FROM catalogs");
while ($row = $q->fetch()) { // Возвращает массив и присваивает переменной
  echo "$row[id] - $row[name]<br>";} // Выводит в строчку выбранные столбцы, тут можно менять местами столбцы
// echo "$row[0] - $row[1] - Такой вариант тоже будет работать: фетч возвращает и ассоциативный ключ и цифровой
// Все столбцы не обязательно перечислять, можно заменить звездочкой, это будет значить все столбцы - *
"SELECT * FROM catalogs" // Выберет все столбцы
// Условная выборка
"SELECT * FROM catalogs WHERE id > 2" // Выберет все записи чей первичный ключ больше 2
> Больше, < меньше, >= больше или равно, <= меньше или равно, = равно, <> не равно, != тоже не равно, <=> аналогичен равенству = но допускает если один из аргументов NULL
// При сравнении возвращает истинну или ложь. Истина = любое число, ложь = 0
AND и OR // Помогают сделать составные условия
"SELECT * FROM catalogs WHERE id > 2 AND id < 10"
NOT // Логический оператор отрицания - возвращает истену для ложного и наоборот












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




















//
