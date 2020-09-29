<?php
require('./../lib/model.php');
require('lib/task.class.php');
require('lib/validate.class.php');
require('./../lib/session.php');

$session = new Session();
$pdo = new Database(); //データベース接続
$task = new Task($pdo);

$data=$_POST;
unset($data['change']);

if ($data) {
    $task->edit_category($data); //カテゴリー名更新
    header('Location:' . './../view/task_show.view.php');
}

