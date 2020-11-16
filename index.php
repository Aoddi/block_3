<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/header.php');
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">

            <h1>Возможности проекта —</h1>
            <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>


        </td>
        <td class="right-collum-index">
            <?php
            require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/folders-menu.php');
            ?>
            <div class="index-auth">
                <?php if (isset($_GET) && $_GET['login'] === 'yes') {
                    include 'include/form.php';
                } ?>
            </div>

        </td>
    </tr>
</table>

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/footer.php');
