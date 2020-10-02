<?php
require('./../lib/model.php');
require('lib/task.class.php');
require('lib/validate.class.php');
require('./../lib/session.php');

$ses = new Session();
$pdo = new Database(); //データベース接続
$task = new Task($pdo);
$err = new TaskError();

$member_id = $_SESSION['member_id']; //会員情報
$data = $_POST;
//新規追加画面
if (!empty($data['add_category']) && !empty($data['c_name'])) { //カテゴリーの追加が行われたとき
    unset($data['add_category']);//不必要なもの削除
    unset($_SESSION['err_category']);//不必要なもの削除
    $task->addCategory($data['c_name'], $member_id); //カテゴリーの追加
    $_SESSION['add_category'] = '新しいカテゴリーが追加されました';
    header('Location:' . './../view/add_task.view.php');
}else { //エラーの場合
    unset($_SESSION['add_category']);
    $_SESSION['err_category'] = '空白です';
    header('Location:' . './../view/add_task.view.php');
}
