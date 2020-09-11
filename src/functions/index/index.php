<?php
require('./../lib/session.php');
$title = 'ToDo';
$ses = new Session();
require_once('./../common/meta.php');
?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <div class="wrapper login-box">
        <div class="login-form">
            <form action="./../login/login_check.php" method="post" name="login_form">
                <div>
                    <p class="red">
                        <?php
                        if ($_SESSION['err']) {
                            echo $_SESSION['err'];
                        } ?>
                    </p>
                    <p id="err_email" class="red"></p>
                    <input type="email" name="email" placeholder="Email"><br>
                </div>
                <div>
                    <p id="err_password" class="red"></p>
                    <input type="password" id="password_js" name="password" placeholder="Password"><br>
                </div>
        </div>
        <!--login-form  -->
        <div class="center">
            <input type="submit" class="button" name="login" value="ログイン" onclick="return err_login(login_form.email.value,login_form.password.value)">
            </form>
            <p><a href="">パスワードを忘れた場合</a></p>
            <p><a href="./../account/regist_acc.php">新規アカウント登録</a></p>
        </div>
    </div>
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>