<div class="project-folders-menu">
    <ul class="project-folders-v">
        <li class="project-folders-v-active">
            <?php if (isSessionExists()) : ?>
                <a href="?login=no" class="btnExit">Выход</a>
            <?php else : ?>
                <a href="?login=yes" class="btnLogin">Авторизация</a>
            <?php endif ?>
        </li>
        <!-- <li><a href="#">Регистрация</a></li>
        <li><a href="#">Забыли пароль?</a></li> -->
    </ul>
    <div class="clearfix"></div>
</div>