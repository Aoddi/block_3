<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/header.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/include/validation.php') ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">
            <h1>Новое сообщение</h1>
            <div class="index-auth">
                <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/include/formNewMessage.php') ?>
            </div>
        </td>
        <td class="right-collum-index">
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/folders-menu.php') ?>
        </td>
    </tr>
</table>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/footer.php'); ?>