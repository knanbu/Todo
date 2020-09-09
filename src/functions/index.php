<?php
$title = 'ToDo';
require_once('./common/meta.php');
?>
<html>

<body>
    <?php require_once('./common/header.php'); ?>
    <div class="wrapper login-box">
        <div class="login-form">
            <form action="#" method="post">
                <div>
                    <input type="email" name="email" placeholder="Email"><br>
                </div>
                <div>
                    <input type="password" name="password" placeholder="Password"><br>
                </div>
        </div>
        <!--login-form  -->
        <div class="center">
            <input type="submit" class="button" name="login" value="ログイン">
            </form>
            <p><a href="./account/regist_acc.php">パスワードを忘れた場合</a></p>
            <p><a href="">新規アカウント登録</a></p>
        </div>
    </div>
    <?php require_once('./common/footer.php'); ?>
</body>

</html>