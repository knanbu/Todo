<?php 
$url= './../view/login.view.php';//ログイン画面
if ($_SESSION['member_id']) {//ログインしている状態
    $url='./../view/task_show.view.php';//タスク一覧画面
}
?>
<header class="header">
    <h2><a href="<?php echo $url?>"><img src="./../../img/Y_logo.png" alt="">ToDo</a></h2>
</header>