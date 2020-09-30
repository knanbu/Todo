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

if ($_POST['add_category'] && !empty($data['c_name'])) { //カテゴリーの追加が行われたとき
    unset($data['add_category']);
    unset($_SESSION['err_category']);
    $task->addCategory($data, $member_id); //カテゴリーの追加
    $_SESSION['add_category'] = '新しいカテゴリーが追加されました';
    header('Location:' . './../view/add_task.view.php');
} { //エラーの場合
    unset($_SESSION['add_category']);
    $_SESSION['err_category'] = '空白です';
    header('Location:' . './../view/add_task.view.php');
}
