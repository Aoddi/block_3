<?php
require_once 'logins.php';
require_once 'passwords.php';
session_start();

if (!empty($_POST)) {

    if (in_array($_POST['login'], $logins) && in_array($_POST['password'], $passwords)) {
        $_SESSION['successedLogin'] = true;
        setcookie('login', $_POST['login'], time()+60*60*24*30, '/');
        require_once 'include/succeess.php';
    } else {
        require_once 'include/error.php';
    }
} else if (isSessionExists()) {
    setcookie('login', $_COOKIE['login'], time()+60*60*24*30, '/');
}

// если пользователь нажал на "Выход" удаляет удаляет сессию и перенаправляет на главную стр
if (isset($_GET) && $_GET['login'] === 'no') {
    unset($_SESSION['successedLogin']);
    header("Location: /homework/block_3/index.php");
}

/**
 * Функция проверяет авторизирован пользователь или нет
 * @return bool true/false
 */
function isSessionExists(): bool
{
    return isset($_SESSION['successedLogin']) ?? false;
}