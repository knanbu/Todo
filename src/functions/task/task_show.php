<?php
require('./../lib/model.php');
require('lib/task.class.php');

$pdo = new Database(); //データベース接続
$task = new Task($pdo);

$member_id = $_SESSION['member_id']; //アカウント情報
$task_list = $task->getTaskList($member_id); //各アカウントのタスク取得
$category_list = $task->getCategoryList($member_id); //各アカウントのカテゴリー覧取得

if ($_GET['task_id']) { //タスクの詳細
    $task_id = $_GET['task_id'];
    $task_info = $task->getTask($task_id);
    $category_name = $task->getCategoryName($task_info[0]['category_id']);
}

if ($_GET['category_id']) { //カテゴリーの編集
    $category_id = $_GET['category_id'];
    $category_name = $task->getCategoryName($category_id);
}
