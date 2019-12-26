<?php


class File
{
  public $fp; // Тут будем хранить указатель на открытый файл
  public $file; // Тут будет путь к открытому файлу

  public function __construct($file) // Ожидаем из объекта путь к файлу
  {
    $this->file = $file; // Связываем путь со свойством
    if (!is_writable($this->file)) { // Проверяме файл на пригодность к записи
      echo "Файл {$this->file} не доступен для записи.";
      exit;
    }
    $this->fp = fopen($this->file, 'a'); // Записываем указатель на открытый файл
  }

  public function __destruct() // В деструкторе закрываем файл
  {
    fclose($this->fp);
  }

  public function write($text) { // Функция пытается записать текст в файл
    if (fwrite($this->fp, $text . PHP_EOL) === FALSE) { // Но тут снова идет проверка на возможность записи, при этом запись происходит
      echo "Не могу произвести запись в файл ($this->file)";
      exit;
    }
  }
}
