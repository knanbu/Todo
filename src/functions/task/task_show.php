<?php
require('./../lib/model.php');
require('lib/task.class.php');
require('./../account/lib/account.class.php');

$pdo = new Database(); //データベース接続
$task = new Task($pdo);
$account=new Account($pdo);

$member_id = $_SESSION['member_id']; //アカウント情報
$category_list = $task->getCategoryList($member_id); //各アカウントのカテゴリー覧取得

$task_list = $task->getTaskList($member_id); //各アカウントのタスク取得
$member_name=$account->show_name($member_id);

if ($_GET['task_id']) { //タスクの詳細
    $task_id = $_GET['task_id'];
    $task_info = $task->getTask($task_id);
    $category_name = $task->getCategoryName($task_info[0]['category_id']);
}

if ($_GET['category_id']) { //サイドバーのカテゴリーが押された場合
    $category_id = $_GET['category_id'];
    $category_name = $task->getCategoryName($category_id);//カテゴリーの編集
    $task_list=$task->getCategoryTaskList($member_id,$category_id);//カテゴリー別のタスク取得
}
