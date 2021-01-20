<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/header.php'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">
            <h1><?= showTitle($menuItemsArr); ?></h1>
            <div class="user__wrapper">
                <ul class="user-info__list">
                    <h2 class="user-info__titile">Профиль</h2>
                    <li class="user-info__item">
                        <h3 class="user-info__item-name">флаг активности пользователя</h3>
                        <p class="user-info__value">
                            <?= getActivityFlag($_SESSION['idActiveUser']) ? 'online' : 'offline' ?>
                        </p>
                    </li>
                    <li class="user-info__item">
                        <h3 class="user-info__item-name">фио</h3>
                        <p class="user-info__value">
                            <?= getFullName($_SESSION['idActiveUser']) ?>
                        </p>
                    </li>
                    <li class="user-info__item">
                        <h3 class="user-info__item-name">email</h3>
                        <p class="user-info__value">
                            <?= getEmail($_SESSION['idActiveUser']) ?>
                        </p>
                    </li>
                    <li class="user-info__item">
                        <h3 class="user-info__item-name">телефон</h3>
                        <p class="user-info__value">
                            <?= '+7' . getPhone($_SESSION['idActiveUser']) ?>
                        </p>
                    </li>
                    <li class="user-info__item">
                        <h3 class="user-info__item-name">пароль</h3>
                        <p class="user-info__value">пароль хранится в хешированном виде</p>
                    </li>
                    <li class="user-info__item">
                        <h3 class="user-info__item-name">Хотите получать уведомления на почту?</h3>
                        <p class="user-info__value">
                            <?= getFlagNotifications($_SESSION['idActiveUser']) ? 'да' : 'нет' ?>
                        </p>
                    </li>
                </ul>
                <ul class="group__list">
                    <h2 class="group__titile">Группы</h2>
                    <?php foreach (getGroups($_SESSION['idActiveUser']) as $group) : ?>
                        <li class="group__item">
                            <h3 class="group__item-name"><?= $group['name'] ?></h3>
                            <p class="group__item-description"><?= $group['description'] ?></p>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </td>
        <td class="right-collum-index">
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/folders-menu.php') ?>
        </td>
    </tr>
</table>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/homework/block_3/templates/footer.php');