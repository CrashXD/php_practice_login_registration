<?php
    session_start();

    // unset($_SESSION['user_id']);

    // setcookie('PHPSESSID', "", time() - 10);

    session_destroy();

    header("Location: index.php");
