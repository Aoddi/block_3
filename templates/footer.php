<div class="clearfix">
    <ul class="main-menu bottom">
        <?= showMenu($menuItemsArr, 'title', SORT_DESC); ?>
    </ul>
</div>

<div class="footer">&copy;&nbsp;<nobr>2018</nobr> Project.</div>
</body>

</html>

<?php mysqli_close(connect()) ?>