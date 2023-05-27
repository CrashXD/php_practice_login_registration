<?php
    require_once "connection.php";

function getUser($login) {
    global $database;
    $sql = "SELECT id, login, password, role FROM users WHERE login = :login";
    $query = $database->prepare($sql);
    $query->execute(['login' => $login]);
    $user = $query->fetch();
    return $user;
}

function authorization($user_id) {
    $_SESSION['user_id'] = $user_id;
}

function registration($login, $password) {
    global $database;
    $passHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (login, password) VALUES (:login, :password)";
    $query = $database->prepare($sql);
    $query->execute([
        'login' => $login,
        'password' => $passHash
    ]);
}