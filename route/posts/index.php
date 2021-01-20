<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/header.php');
define('READ', 1);
define('UNREAD', 0);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">
            <h1><?= showTitle($menuItemsArr); ?></h1>
            <?php foreach (getGroups($_SESSION['idActiveUser']) as $group) : ?>
                <?php if ($group['id'] == 1) : ?>
                    <p>Вы сможете отправлять сообщения после прохождения модерации</p>
                <?php endif ?>

                <?php if ($group['id'] == 2) : ?>
                    <div class="messages__wrapper">
                        <ul class="unread-messages__list">
                            <h2 class="unread-messages__title">Непрочитанные сообщения</h2>
                            <!-- записываем в переменную в массив с данными непрочитанных сообщений -->
                            <?php $unreadMessages = getMessagesList($_SESSION['idActiveUser'], UNREAD); ?>
                            <?php if (isset($unreadMessages)) : ?>
                                <!-- проходимся по массиву с данными прочитанных сообщений -->
                                <?php foreach ($unreadMessages as $message) : ?>
                                    <li class="unread-messages__item">
                                        <a href="./view/index.php?id=<?= $message['id'] ?>" class="message__link">
                                            <!-- вставляем заголовк -->
                                            <h3 class="message__header"><?= $message['header'] ?></h3>
                                            <!-- вставляем цвет и название раздела -->
                                            <p class="message__section" style="color: <?= $message['hex'] ?>">
                                                <?= $message['name'] ?>
                                            </p>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            <?php else : ?>
                                <p>У вас нет непрочитанных сообщений</p>
                            <?php endif ?>
                        </ul>
                        <ul class="read-messages__list">
                            <h2 class="read-messages__title">Прочитанные сообщения</h2>
                            <!-- записываем в переменную в массив с данными прочитанных сообщений -->
                            <?php $readMessages = getMessagesList($_SESSION['idActiveUser'], READ); ?>
                            <?php if (isset($readMessages)) : ?>
                                <!-- проходимся по массиву с данными прочитанных сообщений -->
                                <?php foreach ($readMessages as $message) : ?>
                                    <li class="read-messages__item">
                                        <a href="./view/index.php?id=<?= $message['id'] ?>" class="message__link">
                                            <!-- вставляем заголовк -->
                                            <h3 class="message__header"><?= $message['header'] ?></h3>
                                            <!-- вставляем цвет и название раздела -->
                                            <p class="message__section" style="color: <?= $message['hex'] ?>">
                                                <?= $message['name'] ?>
                                            </p>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            <?php else : ?>
                                <p>У вас вообще нет сообщений</p>
                            <?php endif ?>
                        </ul>
                    </div>
                    <a href="./add/index.php" class="new-message">Написать сообщение</a>
                <?php endif ?>
            <?php endforeach ?>
        </td>
        <td class="right-collum-index">
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/folders-menu.php') ?>
        </td>
    </tr>
</table>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/footer.php');
