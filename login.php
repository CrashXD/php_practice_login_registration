<?php
    session_start();
    require "functions.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['login'])) {
            $user = getUser($_POST['login']);
            if ($user) {
                if (isset($_POST['password'])) {
                    // $correct = $_POST['password'] == $user['password'];
                    $correct = password_verify($_POST['password'], $user['password']);
                    if ($correct) {
                        authorization($user['id']);
                        $_SESSION['success'] = 'Вы успешно авторизовались!';
                    } else {
                        $error = "Пароль введен неверно";
                    }
                } else {
                    $error = "Пароль не введен";
                }
            } else {
                $error = "Пользователь не найден";
            }
        } else {
            $error = "Логин не введен";
        }
    }

    if (isset($_SESSION['user_id'])) {
        header("Location: cabinet.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><a href="index.php">Главная страница</a></p>
    <form action="" method="POST">
        <input type="text" name="login" value="<?= $_POST['login'] ?? '' ?>" placeholder="Логин" required>
        <input type="password" name="password" value="" placeholder="Пароль" required>
        <button>Войти</button>
    </form>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <!-- <p>Логин или пароль неверны</p> -->
</body>
</html>
