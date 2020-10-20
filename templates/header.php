<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/skillbox/homework/block_3/include/main_menu.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/skillbox/homework/block_3/helpers/helperMenu.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?= '/skillbox/homework/block_3/styles.css' ?>" rel="stylesheet">
    <title>Project - ведение списков</title>
</head>

<body>

    <div class="header">
        <div class="logo"><img src="<?= '/skillbox/homework/block_3/i/logo.png' ?>" width="68" height="23" alt="Project"></div>
        <div class="clearfix"></div>
    </div>

    <div class="clear">
        <ul class="main-menu top">
            <?= helperMenu\showMenu($menuItemsArr, 'sort', SORT_ASC); ?>
        </ul>
    </div>