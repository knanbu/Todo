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
        <h2 class="center">アカウント確認</h2>
        <div class="login-form">
            <form action="./../account/acc_check.php" method="post" name="login_form">
                <div>
                    <p class="red">
                        <?php
                        if ($_SESSION['no_account']) {
                            echo $_SESSION['no_account'];
                        }
                        ?>
                        <br>
                    </p>
                    <input type="email" name="email" placeholder="Email">
                </div>
                <div>
                    <select name="question_id">
                        <option value="">未選択</option>
                        <option value="1">小学校の名前は？</option>
                    </select> </div>
                <div>
                    <input type="text" name="answer" placeholder="答え"><br>
                </div>
        </div>
        <!--login-form  -->
        <div class="center">
            <input type="submit" class="button" name="confirm" value="次へ">
            </form>
            <p><a href="acc_check.php">新規アカウント登録</a></p>
            <p><a href="login.view.php">戻る</a></p>
        </div>
    </div>
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>