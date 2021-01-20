<form action="./index.php" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="iat">
                <label for="message_header">Заголовок:</label>
                <input id="message_header" name="message_header" value="<?= htmlspecialchars($_POST['message_header']) ?>">
                <p class="error"><?= $result['header'] ?></p>
            </td>
        </tr>
        <tr>
            <td class="iat">
                <label for="message_text">Текст сообщения:</label>
                <input id="message_text" name="message_text" value="<?= htmlspecialchars($_POST['message_text']) ?>">
                <p class="error"><?= $result['text'] ?></p>
            </td>
        </tr>
        <tr>
            <td class="iat">
                <?php $usersModerated = getUsersModerated() ?>
                <label>Получатель:
                    <select name="message_users">
                        <?php foreach ($usersModerated as $user) : ?>
                            <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </label>
            </td>
        </tr>
        <tr>
            <td class="iat">
                <!-- записали в перенную массив с данными о разделах -->
                <?php $sections = getSections($_SESSION['idActiveUser']) ?>
                <label>Раздел сообщения:
                    <select size="" name="message_section">
                        <!-- циклом проходим по массиву для сортировки разделов -->
                        <?php foreach ($sections as $section) : ?>
                            <!-- проверка, есть ли у блока родительские разделы -->
                            <?php if (!isset($section['parent_id'])) : ?>
                                <option value="<?= $section['id'] ?>">
                                    &#8212 &#8194<?= $section['name'] ?>
                                </option>
                                <!-- цикл для поиска дочерних разделов -->
                                <?php foreach ($sections as $childSection) : ?>
                                    <!-- проверка, является ли раздел дочерним -->
                                    <?php if ($section['id'] === $childSection['parent_id']) : ?>
                                        <option value="<?= $childSection['id'] ?>">
                                            &#8194 &#8212 &#8194<?= $childSection['name'] ?>
                                        </option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </label>
            </td>
        </tr>
        <tr>
            <td class="iat">
                <?php $colors = getColors() ?>
                <label>Цвет раздела:
                    <select name="section_color">
                        <?php foreach ($colors as $color) : ?>
                            <option value="<?= $color['id'] ?>">
                                <?= $color['color'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </label>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="message" value="Отправить"></td>
        </tr>
    </table>
</form>