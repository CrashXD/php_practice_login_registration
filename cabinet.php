<?php
    session_start();
    require "connection.php";
    require "functions.php";

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['login'])) {
            $user = getUser($_POST['login']);

            if ($user) {
                $error = 'Логин занят!';
            } else {
                $sql = 'UPDATE users SET login = ? WHERE id = ?';
                $query = $database->prepare($sql);
                $query->execute([$_POST['login'], $_SESSION['user_id']]);
                $success = 'Логин обновлен!';
            }
        }
    }

    if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
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
        <input type="text" name="login" value="" placeholder="Логин" required>
        <button>Сохранить</button>
    </form>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p style="color: green;"><?= $success ?></p>
    <?php endif; ?>
</body>
</html>
