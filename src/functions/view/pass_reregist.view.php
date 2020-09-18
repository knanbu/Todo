<?php
require('./../lib/session.php');
$title = 'パスワード再設定';
$ses = new Session();
require_once('./../common/meta.php');
?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <div class="wrapper login-box">
        <h2 class="center">パスワード再設定</h2>
        <div class="login-form">
            <form action="./../account/pass_reregist.php" method="post" name="login_form">
                <div>

                    <input type="password" name="password" placeholder="新しいパスワード">
                </div>
                <div>
                    <input type="password" name="password_again" placeholder="パスワード再入力">
                    <p class="red">
                        <?php
                        if ($_SESSION['passout']) {
                            echo $_SESSION['passout'];
                        }
                        ?>
                    </p>
                </div>
                <!--login-form  -->
                <div class="center">
                    <input type="submit" class="button" name="complete" value="変更">
            </form>
        </div>
    </div>
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>