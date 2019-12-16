<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Усовершенствованный скрипт блокировки сервера</title>
  <meta charset='utf-8'>
</head>
<body>

<?php if (!isset($_REQUEST['doGO'])) {?>
  <form action="<?$_SERVER['SCRIPT_NAME']?>">
    Логин: <input type="text" name="login" value=""><br>
    Пароль: <input type="password" name="password" value=""><br>
    <input type="submit" name="doGO" value="Нажмите кнопку!">
  </form>
<?php } else {
  if ($_REQUEST['login'] == "root" && $_REQUEST['password'] == "Z10N0101") {
    echo "Доступ открыт для пользователя {$_REQUEST['login']}";
    system("rundll32.exe user32.dll,LockWorkStation");
  } else {
    echo "Доступ закрыт!";
  }
}
?>
</html>
</body>
