<?php
require('./../lib/model.php');
require('./../lib/session.php');
require('lib/account.class.php');
require('lib/validate.class.php');

$pdo = new Database(); //データベース接続
$session = new Session();
$acc = new Account($pdo);

unset($_POST['regist']); //必要のない情報を破棄
$data = $_POST; //ログイン画面で入力されたデータを格納
$err = new Validate($pdo);
$err_array = $err->err_check($data);
if (empty($err_array)) { //エラーがなければアカウント登録開始
    $result = $err->isset_email($data['email']);
    if ($result === null) {
        unset($_SESSION);
        $acc->regist_account($data);
    } else {
        $_SESSION['err'] = $err_array;
        header('Location:' . './../view/regist_acc.view.php');
    }
} else {
    $_SESSION['err'] = $err_array;
    header('Location:' . './../view/regist_acc.view.php');
}
