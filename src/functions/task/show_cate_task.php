<?php
require('./../lib/model.php');
require('lib/task.class.php');
require('lib/validate.class.php');

$pdo = new Database(); //データベース接続
$task = new Task($pdo);

$member_id = $_SESSION['member_id']; //会員情報
$category_list = $task->getCategoryList($member_id); //カテゴリーの表示

foreach ($category_list as $key=> $value) {
    if ($value['c_name']==='すべて') {//カテゴリーのすべての項目はデフォルト値であるから抜く
        unset($category_list[$key]);
        $category_list=array_merge($category_list);//添え字の降り直し
    }
}

if ($_GET['task_id']) { //タスクの詳細
    $task_id = $_GET['task_id'];
    $task_info = $task->getTaskCategory($task_id);//登録されたいるタスクに対するタスク情報とカテゴリー名を取得
    $category_id=[];//登録されているタスクに紐づいているカテゴリーID
    for ($h=0; $h <count($task_info) ; $h++) { 
        $category_id[]=$task_info[$h]['category_id'];
    }

    $priority=[1,2,3,4,5];//優先度の基本情報
    $tmp='';//一時保存
    for ($i=0; $i <count($priority) ; $i++) {//selectboxで一番最初の初期値を登録されたものにする
        if ($priority[$i]===(int)$task_info[0]['priority']) {
            $tmp=$priority[0];
            $priority[0]=$priority[$i];
            $priority[$i]=$tmp;
        }
    }
}

