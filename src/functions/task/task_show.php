<?php
require('./../lib/model.php');
require('lib/task.class.php');

$pdo = new Database(); //データベース接続
$task = new Task($pdo);

$member_id = $_SESSION['member_id']; //アカウント情報
$task_list = $task->getTaskList($member_id); //各アカウントのタスク取得
$category_list = $task->getCategoryList($member_id);//各アカウントのカテゴリー覧取得
