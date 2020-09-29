<?php
require('./../lib/model.php');
require('lib/task.class.php');
require('lib/validate.class.php');

$pdo = new Database(); //データベース接続
$task = new Task($pdo);

$member_id = $_SESSION['member_id']; //会員情報
$category_list = $task->getCategoryList($member_id); //カテゴリーの表示
