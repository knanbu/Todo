<?php
require('./../lib/model.php');
require('./../lib/session.php');
require('lib/info_change.class.php');

$pdo = new Database(); //データベース接続
$session = new Session();
$change = new Info_change($pdo);

unset($_POST['confirm']); //必要のない情報を破棄
$data = $_POST; //ログイン画面で入力されたデータを格納
$result = $change->isset_account($data); //入力値でDB上にアカウントがあるか確認
if ($result) { //成功
    $_SESSION['member_id'] = $result;
    header('Location:' . './../view/pass_reregist.view.php');
} else { //失敗
    $_SESSION['no_account'] = 'アカウントがありません';
    header('Location:' . './../view/acc_check.view.php');
}
