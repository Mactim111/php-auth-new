<?php
    session_start();
    // require_once '/connect.php';
        if (!$_SESSION['user']) {
    header('Location: index.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Профиль пользователя</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body

    <form>
      <!-- <img src="<?= $_SESSION['user']['avatar'] ?>" heigt="2000" width="100" alt="мое фото"><br> -->
      <p style="margin:30px;"><?= $_SESSION['user']['login'] ?></p><br>
      <!-- <p style="margin:30px;"><?= $_SESSION['user']['full_name'] ?></p><br> -->
      <p style="margin:30px;"><?= $_SESSION['user']['login'] ?></p><br>
      <a href="#"><?= $_SESSION['user']['email'] ?></a><br>
      <a href="logout.php" class="logout">Выход</a>
    </form>
    <!-- <p> -->
        <!-- <a href="/freedback.php">Обратная связь</a> -->
        <!-- </p> -->


            <?php
        // if ($_SESSION['message']) {
                // echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            // }
            // unset($_SESSION['message']);
           print_r($_SESSION['user']['email']);
        //?>
    </body>
   

</html>