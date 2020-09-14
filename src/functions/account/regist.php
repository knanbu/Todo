<?php
require('./../lib/model.php');
require('./../lib/session.php');
require('lib/account.class.php');

$pdo = new Database(); //データベース接続
$session = new Session();
$acc = new Account($pdo);

unset($_POST['regist']); //必要のない情報を破棄
$data = $_POST; //ログイン画面で入力されたデータを格納
$acc->regist_account($data);
