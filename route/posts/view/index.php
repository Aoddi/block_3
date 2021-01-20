<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/header.php');

if (isset($_GET) && isset($_GET['id'])) {
    $message = getMessage($_GET['id']);

    if (isset($message['read_message_flag'])) {
        mysqli_query(
            connect(),
            "UPDATE messages SET read_message_flag = 1 
            WHERE id = {$message['id']}"
        );
    }
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">
            <h1>Просмотр сообщения</h1>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <h2><?= $message['header'] ?></h2>
                        <h3><?= $message['datetime'] ?></h3>
                        <p><?= $message['full_name'] ?></p>
                        <p><?= $message['email'] ?></p>
                        <p><?= $message['text'] ?></p>
                    </td>
                </tr>
            </table>
        </td>
        <td class="right-collum-index">
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/folders-menu.php') ?>
        </td>
    </tr>
</table>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/footer.php'); ?>