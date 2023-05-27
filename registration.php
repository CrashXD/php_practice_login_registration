<?php
    session_start();
    require "connection.php";
    require "functions.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $user = getUser($_POST['login']);

            if ($user) {
                $error = "Пользователь с таким логином уже существует";
            } else {
                registration($_POST['login'], $_POST['password']);
                $_SESSION['success'] = 'Вы успешно зарегистрировались!';

                $user = getUser($_POST['login']);

                authorization($user['id']);
            }
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
        <input type="text" name="login" value="<?= $_POST['login'] ?? ""?>" placeholder="Логин" required>
        <input type="password" name="password" value="" placeholder="Пароль" required>
        <button>Зарегистрироваться</button>
    </form>
    <?php if (isset($error)) : ?>
        <p style="color: red"><?= $error ?></p>
    <?php endif; ?>
</body>
</html>
