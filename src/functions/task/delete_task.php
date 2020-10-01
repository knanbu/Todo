<?php
require('./../lib/model.php');
require('lib/task.class.php');
require('lib/validate.class.php');
require('./../lib/session.php');
$ses = new Session();
$pdo = new Database(); //データベース接続
$task = new Task($pdo);
$err = new TaskError();

$data = $_POST;
unset($data['delete']);//不必要なもの削除
if (!empty($data)) {//項目がチェックされている場合
    unset($_SESSION['err_delete']);//エラー文削除
    $task->delete_task($data['task_id']);
    header('Location:' . './../view/task_show.view.php');
}else {
    $_SESSION['err_delete']='項目を指定してください';
    header('Location:' . './../view/task_show.view.php');
}
