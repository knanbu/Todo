<?php
require('../lib/model.php');
require('lib/task.class.php');
require('../lib/session.php');
$ses = new Session();
$pdo = new Database(); //データベース接続
$task = new Task($pdo);

$category_id=$_GET['category_id'];
$task->delete_category($category_id);//カテゴリーとカテゴリー内のタスクの削除
header('Location:'.'../view/task_show.view.php');