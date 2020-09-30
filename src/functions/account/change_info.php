<?php
require('./../lib/model.php');
require('./../lib/session.php');
require('lib/account.class.php');
require('lib/validate.class.php');
require('lib/info_change.class.php');

$pdo = new Database(); //データベース接続
$session = new Session();
$acc = new Account($pdo);
$err = new Validate($pdo);
$change = new Info_change($pdo);

$data = $_POST;
$member_id = $_SESSION['member_id'];
if ($data['change_name']) { //
    $change->change_name($data['new_name'], $member_id); //名前の更新
    header('Location:' . './../view/change_name.view.php');
}
