<?php
require_once('./../lib/session.php');
$ses = new Session();
$title = '新規会員登録';
require_once('./../common/meta.php');
var_dump($_SESSION);
?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <div class="wrapper regist-box">
        <h2>新規アカウント登録</h2>
        <div class="regist-form">
            <form action="./../account/regist.php" method="post" name="regist_form">
                <div class="grid-form">
                    <div>
                        <label class="red">
                            <?php
                            if ($_SESSION['err'][0]['err_name']) {
                                echo $_SESSION['err'][0]['err_name'] . '<br>';
                            } ?>
                        </label>
                        <input type="text" name="name" placeholder="ニックネーム"><br>
                    </div>
                    <div></div>
                    <div>
                        <label class="red">
                            <?php
                            if ($_SESSION['err'][0]['empty_email']) {
                                echo $_SESSION['err'][0]['empty_email'] . '<br>';
                            } elseif ($_SESSION['err'][0]['preg_err_email']) {
                                echo $_SESSION['err'][0]['preg_err_email'] . '<br>';
                            } elseif ($_SESSION['err'][0]['isset_email']) {
                                echo $_SESSION['err'][0]['isset_email'] . '<br>';
                            }
                            ?>
                        </label>
                        <input type="email" name="email" placeholder="メールアドレス"><br>
                    </div>
                    <div>
                        <label class="red">
                            <?php
                            if ($_SESSION['err'][0]['empty_email']) {
                                echo $_SESSION['err'][0]['empty_email'] . '<br>';
                            } elseif ($_SESSION['err'][0]['again_email']) {
                                echo $_SESSION['err'][0]['again_email'] . '<br>';
                            }
                            ?>
                            <input type="email" name="email_again" placeholder="メールアドレスの再入力"><br>
                        </label>
                    </div>
                    <div>
                        <label class="red">
                            <?php
                            if ($_SESSION['err'][0]['empty_password']) {
                                echo $_SESSION['err'][0]['empty_password'] . '<br>';
                            }
                            // elseif ($_SESSION['err'][0]['preg_err_password']) {
                            //     echo $_SESSION['err'][0]['preg_err_password'] . '<br>';
                            // }
                            ?>
                        </label>
                        <input type="password" name="password" placeholder="パスワード"><br>
                    </div>
                    <div>
                        <label class="red">
                            <?php
                            if ($_SESSION['err'][0]['empty_password']) {
                                echo $_SESSION['err'][0]['empty_password'] . '<br>';
                            } elseif ($_SESSION['err'][0]['password_again']) {
                                echo $_SESSION['err'][0]['password_again'] . '<br>';
                            }
                            ?>
                        </label>
                        <input type="password" name="password_again" placeholder="パスワードの再入力"><br>
                    </div>
                    <div>
                        <label class="red" name='question'>
                            <?php
                            if ($_SESSION['err'][0]['err_question']) {
                                echo $_SESSION['err'][0]['err_question'] . '<br>';
                            } ?>
                        </label>
                        <select name="question_id">
                            <option value="">未選択</option>
                            <option value="1">データベースの秘密の質問が表示される</option>
                        </select>
                    </div>
                    <div>
                        <label class="red">
                            <?php
                            if ($_SESSION['err'][0]['err_answer']) {
                                echo $_SESSION['err'][0]['err_answer'] . '<br>';
                            } ?>
                        </label>
                        <input type="text" name="answer" placeholder="秘密の質問の答え"><br>
                    </div>
                </div>
                <!--grid-form  -->
        </div>
        <!--login-form  -->
        <div class="center">
            <input type="submit" class="button" name="regist" value="登録">
            <input type="button" name="back" class="button" value="戻る" 　onClick='history.back()'>
            </form>
        </div>
    </div>
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>