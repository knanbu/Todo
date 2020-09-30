<?php
require('./../lib/model.php');
require('./../lib/session.php');
require('lib/info_change.class.php');
require('lib/validate.class.php');

$pdo = new Database(); //データベース接続
$session = new Session();
$change = new Info_change($pdo);
$err = new Validate($pdo);

unset($_POST['confirm']); //必要のない情報を破棄
$data = $_POST; //ログイン画面で入力されたデータを格納
$member_id = $_SESSION['member_id'];

if ($data['password'] === $data['password_again']) {
    $result = $change->password_update($data, $member_id);//パスワードの更新
    unset($_SESSION['passout']);
    header('Location:' . './../view/login.view.php');//ログイン画面に戻る
} else {
    $_SESSION['passout'] = 'パスワードを間違えています';
    header('Location:' . './../view/pass_reregist.view.php');
}
