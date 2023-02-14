<?php
session_start();

// Подключение БД
require_once 'connect.php';
// Проверка нажата ли кнопка отправки формы
if (isset($_POST['doGo'])) {
 
    // Последующий код проверяет вообще есть формы
    // Проверяет логин
    if (!$_POST['login']) {
        $error = 'Введите логин';
    }
    // Проверяет пароль
    if (!$_POST['pass']) {
        $error = 'Введите пароль';
    }
 
    // Проверяет ошибки
    if (!$error) {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
 
        // берёт из БД пароль и id пользователя 
        if ($result = mysqli_query($connect, "SELECT `password`, `id` FROM `users_1` WHERE `login`='" . $login . "'")) {
            while( $user = mysqli_fetch_assoc($result) ){ 
                // Проверяет есть ли id
                if ($user['id']) {
                    // если id есть, то он сравнивает пароли функцией password_verify
                    if (password_verify($pass, $user['password'])) {
                        
                        // Если функция возвращает true, то вы входите
                        // echo "Вы вошли";
                        $_SESSION['user'] = [
                            "id" => $user['id'],
                            "login" => $_SESSION['user']['login'],
                            // "full_name" => $user['full_name'],
                            // "avatar" => $user['avatar'],
                            "email" => $_SESSION['user']['email']
                          ];
                        header("Location: profile.php");
                        // скрипт больше не выполняется
                        exit;
                    } else {
                         // Если функция возвращает false, то выводит ошибку
                         echo "Ввели не верный пароль";
                    }
                } else {
                    // Выводит ошибку если не нашли такой логин
                    echo "Ввели не верный логин";
                }
            } 
        }
    } else {
         // Выводит ошибки, если есть пустые поля формы
         echo $error;
    }
}

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <form action="/index.php" method="post">
        <p>Логин: <input type="text" name="login" id=""></p>
        <p>Пароль: <input type="password" name="pass" id="">
        <p><input type="submit" value="Войти" name="doGo"></p>
        <p>
            У вас нет аккаунта? - <a href="/checkin.php">зарегистрируйтесь</a>!
        </p>
        <?php
        // $error = $_SESSION['message'];
    if ($_SESSION['message']) {
      echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    // print_r($users['email']);
    // print_r($_SESSION['user']);
    $values = array_values($_POST);
    echo $values;
    print_r($_SESSION['user']['email']);


    ?>
    
    </form>
</body>
</html>