<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/header.php'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">
            <h1><?= showTitle($menuItemsArr); ?></h1>
        </td>
        <td class="right-collum-index">
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/folders-menu.php') ?>
        </td>
    </tr>
</table>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/footer.php');