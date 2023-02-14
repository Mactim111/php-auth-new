<?
session_start();
// Подключаем коннект к БД
require_once 'connect.php';
 
// Проверяем нажата ли кнопка отправки формы
if (isset($_POST['doGo'])) {
    
    // Все последующие проверки, проверяют форму и выводят ошибку
    // Проверка на совпадение паролей
    if ($_POST['pass'] !== $_POST['pass_rep']) {
        $error = 'Пароли не совпадают';
    }
    
    // Проверка есть ли вообще повторный пароль
    if (!$_POST['pass_rep']) {
        $error = 'Подтвердите пароль';
    }
    
    // Проверка есть ли пароль
    if (!$_POST['pass']) {
        $error = 'Введите пароль';
    }
 
    // Проверка есть ли email
    if (!$_POST['email']) {
        $error = 'Введите email';
    }
 
    // Проверка есть ли логин
    if (!$_POST['login']) {
        $error = 'Введите login';
    }
 
    // Если ошибок нет, то происходит регистрация 
    if (!$error) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        // Пароль хешируется
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        // Если день рождения не был указан, то будет самый последний год из доступных
        $DOB = $_POST['year_of_birth'];
        
        // Добавление пользователя
        mysqli_query($connect, "INSERT INTO `users_1` (`login`, `email`, `password`, `DOB`) VALUES ('" . $login . "','" . $email . "','" . $pass . "', '" . $DOB . "')");
        
        // Подтверждение что всё хорошо
        $_SESSION['message'] = 'Регистрация прошла успешно';
        // echo 'Регистрация прошла успешно';
    } else {
        // Если ошибка есть, то выводить её 
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
<form action="/checkin.php" method="post" enctype="multipart/form-data">
        <!-- <p>Логин: <input type="text" name="login" id=""> <samp style="color:red">*</samp></p> -->
        <!-- <p>EMail: <input type="email" name="email" id=""><samp style="color:red">*</samp></p> -->
        <p><label>Логин</label></p>
        <input type="text" name="login" placeholder="Введите свой логин"><samp style="color:red">*</samp>
    <p><label>Почта</label></p>
    <input type="email" name="email" placeholder="Введите адрес своей почты"><samp style="color:red">*</samp>
        <p>Пароль: <input type="password" name="pass" id=""><samp style="color:red">*</samp></p>
        <p>Повторите пароль: <input type="password" name="pass_rep" id=""><samp style="color:red">*</samp></p>
        <?php $year = date('Y'); ?>
        Год рождения:
        <select name="year_of_birth" id="">
        <option value="">----</option>
            <?php for ($i = $year - 14; $i > $year - 14 - 100; $i--) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php } ?>
        </select>
        <p><input type="submit" value="Зарегистрироваться" name="doGo"></p>
        <p>
      У вас уже есть аккаунт? - <a href="/">авторизируйтесь</a>!
    </p>
    <?php
    if ($_SESSION['message']) {
      echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>
    </form>
</body>
</html>