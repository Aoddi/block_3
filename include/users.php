<?php
require_once 'logins.php';
require_once 'passwords.php';
$users = [];

foreach($logins as $login) {
    $users[] = [
        'login' => $login,
        'password' => '',
    ];
}