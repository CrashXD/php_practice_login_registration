<?php
    session_start();
    require "connection.php";

    $is_admin = false;

    if (isset($_SESSION['user_id'])) {
        $sql = "SELECT id, role FROM users WHERE id = ?";
        $query = $database->prepare($sql);
        $query->execute([$_SESSION['user_id']]);

        $user = $query->fetch(); 

        if ($user['role'] == 'admin') {
            $is_admin = true;
        }
    } else {
        header('Location: login.php');
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
    <?php if($is_admin) : ?>
        <h1>Секретная информация</h1>
    <?php else: ?>
        <h1>Нет доступа</h1>
    <?php endif; ?>
</body>
</html>
