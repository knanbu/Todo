<?php
require('./../lib/model.php');
require('lib/task.class.php');
require('lib/validate.class.php');
require('./../lib/session.php');

$session = new Session();
$pdo = new Database(); //データベース接続
$task = new Task($pdo);
$err = new TaskError();

$data = $_POST;
unset($data['add']);
$err_data = $err->err_check($data); //エラーチェック
if (empty($err_data)) { //エラーなしの場合
    unset($_SESSION['errtask']);//エラー削除
    $task->edit_task($data); //タスクの編集
    header('Location:' . './../view/task_show.view.php');
} else { //エラーありの場合
    $_SESSION['err_task'] = $err_data;
    header('Location:' . "./../view/task_edit.view.php?task_id={$data['task_id']}");
}
