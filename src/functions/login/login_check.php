<?php
require('./../lib/model.php');
require('lib/login.class.php');
require('./../lib/session.php');

$pdo = new Database(); //データベース接続
$login = new Login($pdo); //ログインに関連する機能
$session = new Session();

unset($_POST['login']); //必要のない情報を破棄
$data = $_POST; //ログイン画面で入力されたデータを格納
$result = $login->login($data); //ログイン
$_SESSION['member_id'] = $result['member_id'];
if (!empty($result)) {
    unset($_SESSION['err']); //エラーメッセージ削除
    header('Location:' . './../account/test.php');
    exit;
} else {
    $err_log = 'メールアドレス、またはパスワードが違います';
    $_SESSION['err'] = $err_log;
    header('Location:' . './../index.php');
}
