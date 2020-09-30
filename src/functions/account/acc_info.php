<?php
require('lib/validate.class.php');
require('lib/info_change.class.php');
require('./../task/task_show.php');

$err = new Validate($pdo);
$change= new Info_change($pdo);
$data=$_POST;
$member_id=$_SESSION['member_id'];
$now_name=$account->show_name($member_id);//現在の名前
