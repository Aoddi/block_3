<?php

include 'include/loginArr.php';
include 'include/passwordArr.php';

if (!empty($_POST)) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    if (!in_array($_POST['login'], $loginArr) || !in_array($_POST['password'], $passwordArr)) {
        include 'include/error.php';
    } else {
        foreach ($loginArr as $loginValue) {
            foreach ($passwordArr as $passwordValue) {
                if ($login === $loginValue && $password === $passwordValue) {
                    include 'include/succeess.php';
                }
            }
        }
    }
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/skillbox/homework/block_3/templates/header.php');
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">

            <h1>Возможности проекта —</h1>
            <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>


        </td>
        <td class="right-collum-index">

            <div class="project-folders-menu">
                <ul class="project-folders-v">
                    <li class="project-folders-v-active"><a href="#">Авторизация</a></li>
                    <li><a href="#">Регистрация</a></li>
                    <li><a href="#">Забыли пароль?</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="index-auth">
                <?php if (isset($_GET) && $_GET['login'] === 'yes') {
                    include 'include/form.php';
                } ?>
            </div>

        </td>
    </tr>
</table>

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/skillbox/homework/block_3/templates/footer.php');