<?php
$title = '新規会員登録';
require_once('./../common/meta.php');
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
                        <p id="err_name" class="red"></p>
                        <input type="text" name="name" placeholder="ニックネーム"><br>
                    </div>
                    <div></div>
                    <div>
                        <p id="err_email1" class="red"></p>
                        <input type="email" name="email" placeholder="メールアドレス"><br>
                    </div>
                    <div>
                        <p id="err_email2" class="red"></p>
                        <input type="email" name="email_again" placeholder="メールアドレスの再入力"><br>
                    </div>
                    <div>
                        <p id="err_password1" class="red"></p>
                        <input type="password" name="password" placeholder="パスワード"><br>
                    </div>
                    <div>
                        <p id="err_password2" class="red"></p>
                        <input type="password" name="password" placeholder="パスワードの再入力"><br>
                    </div>
                    <div>
                        <p id="err_question" class="red" name='question'></p>
                        <select name="question_id">
                            <option value="">未選択</option>
                            <option value="1">データベースの秘密の質問が表示される</option>
                        </select>
                    </div>
                    <div>
                        <p id="err_answer" class="red"></p>
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