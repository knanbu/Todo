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
unset($data['delete']);
$task_id = implode(',', $data['task_id']);
$task->delete_task($task_id);
header('Location:' . './../view/task_show.view.php');
