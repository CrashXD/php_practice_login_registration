<?php

$password = '123456';

$array = [
    'login' => 'admin',
    'password' => $password
];

// $json = json_encode($array);
// print_r($json);
// print_r(json_decode($json, true));

// $serialize = serialize($array);
// print_r($serialize);
// print_r(unserialize($serialize));

// $base64 = base64_encode($password);
// print_r($base64);
// print_r(base64_decode($base64));

// $reverse = strrev($password);
// print_r(strrev($reverse));

// $base64reverse = strrev(base64_encode($password));
// print_r(base64_decode(strrev($base64reverse)));

// $password = 'admin';
// $salt = 'laskdfjlkef';
// $md5 = md5($password . $salt);
// print_r($md5);

// if ($md5 == md5('qwerty' . $salt)) {
    // echo 'пароли совпадают';
// }

$passHash = password_hash($password, PASSWORD_DEFAULT);
// print_r($passHash);

if (password_verify($password, $passHash)) {
    echo 'пароли совпадают';
} else {
    echo 'доступ закрыт';
}