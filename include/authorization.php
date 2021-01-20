<?php
session_start();
if (isset($_POST['authorization'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    if (passwordVerification($login, $password)) {
        $_SESSION['successedLogin'] = true;
        $_SESSION['idActiveUser'] = getIdActiveUser($login);
        activeUser($_SESSION['idActiveUser']);
        setcookie('login', $login, time() + 60 * 60 * 24 * 30, '/');
        require_once 'include/succeess.php';
    } else {
        require_once 'include/error.php';
    }
} else if (isSessionExists()) {
    setcookie('login', $_COOKIE['login'], time() + 60 * 60 * 24 * 30, '/');
}

// если пользователь нажал на "Выход" удаляет сессию и перенаправляет на главную стр
if (isset($_GET) && $_GET['login'] === 'no') {
    inactiveUser($_SESSION['idActiveUser']);
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