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


if ($data['add']) {//タスクが追加されたとき
    unset($data['add']);
    $errArray = $err->err_check($data);
    if (!empty($errArray)) { //エラーがある場合
        $_SESSION['err_task'] = $errArray;
        header('Location:' . './../view/add_task.view.php');
    } else { //成功の場合
        $task->addTask($data, $member_id); //タスクの新規登録
        unset($_SESSION['err_task']);
        header('Location:' . './../view/task_show.view.php');
    }
}
