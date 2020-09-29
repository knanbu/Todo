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
if (!empty($result)) { //ログイン成功時
    unset($_SESSION['err']); //エラーメッセージ削除
    $_SESSION['member_id'] = $result[0]['member_id'];
    header('Location:' . './../view/task_show.view.php');//タスク一覧画面に移動
    exit;
} else { //ログインエラーがあったとき
    $err_log = 'メールアドレス、またはパスワードが違います';
    $_SESSION['err'] = $err_log;
    header('Location:' . './../view/login.view.php');//ログイン画面に戻る
}
