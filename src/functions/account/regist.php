<?php
require('./../lib/model.php');
require('./../lib/session.php');
require('lib/account.class.php');
require('lib/validate.class.php');

$pdo = new Database(); //データベース接続
$session = new Session();
$acc = new Account($pdo);
$err = new Validate($pdo);

unset($_POST['regist']); //必要のない情報を破棄
$data = $_POST; //ログイン画面で入力されたデータを格納
$err_array = $err->err_check($data);
if (empty($err_array)) { //エラーがなければアカウント登録開始
    $result = $err->isset_email($data['email']);
    if ($result === null) {
        unset($_SESSION);
        $acc->regist_account($data);
        header('Location:' . './../view/task_show.view.php'); //タスク一覧画面へ進む
    } else {
        $_SESSION['err'] = $err_array;
        header('Location:' . './../view/regist_acc.view.php'); //再登録
    }
} else {
    $_SESSION['err'] = $err_array;
    header('Location:' . './../view/regist_acc.view.php'); //再登録
}
