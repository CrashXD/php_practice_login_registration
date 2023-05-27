<?php
    session_start();

    // unset($_SESSION['user_id']);

    // setcookie('PHPSESSID', "", time() - 10);

    session_destroy();

    session_start();
    $_SESSION['success'] = 'Вы успешно вышли из аккаунта';

    header("Location: index.php");
