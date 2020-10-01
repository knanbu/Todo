<?php
require('./../lib/session.php');
$title = 'ToDo';
$ses = new Session();
$ses->deleteSession();
require_once('./../common/meta.php');
echo '<meta http-equiv="refresh" content=" 2; url=login.view.php">';//2秒後にログイン画面に移動
?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <div class=" login-box">
        <div class="center">
            <h2>ログアウトしました</h2>
            <p>2秒後にログイン画面に移動します</p>
        </div>
    </div>
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>