<form action="./index.php?login=yes" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <!-- если есть кука с логином то не показываем поле login -->
        <?php if (!isSessionExists() && isset($_COOKIE['login'])) : ?>
            <input type="hidden" name="login" value="<?= $_COOKIE['login'] ?>">
        <?php else : ?>
            <tr>
                <td class="iat">
                    <label for="login_id">Ваш e-mail:</label>
                    <input id="login_id" size="30" name="login" value="<?= htmlspecialchars($_POST['login']) ?>">
                </td>
            </tr>
        <?php endif ?>
        <tr>
            <td class="iat">
                <label for="password_id">Ваш пароль:</label>
                <input id="password_id" size="30" name="password" type="password" value="<?= htmlspecialchars($_POST['password']) ?>">
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="authorization" value="Войти"></td>
        </tr>
    </table>
</form>