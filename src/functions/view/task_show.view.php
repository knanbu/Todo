<?php
require('./../lib/session.php');
$session = new Session();
$title = 'タスク一覧';
require_once('./../common/meta.php');
require('./../task/task_show.php');

?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <div class="task-box">
        <!-- サイドバー -->
        <div class="sidebar">
            <div class="center">
                <a href="add_task.view.php">
                    <button class="add-button button">＋</button>
                </a>
            </div>
            <div class="category">
                <div class="category-item">
                    <ul>
                        <?php
                        for ($i = 0; $i <= count($category_list) - 1; $i++) {
                        ?>
                            <li>
                                <a href="">
                                    <?php echo $category_list[$i]['c_name']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="center ">
                <p><a href="">アカウント設定</a></p>
            </div>
            <div class="center">
                <p><a href="">ログアウト</a></p>
            </div>
        </div>

        <!-- タスク一覧画面 -->
        <div class="task-show">
            <form action="./../task/delete_task.php" method="post">
                <div class="delete-button">
                    <input type="submit" name="delete" value="削除">
                </div>
                <ul>
                    <?php
                    if (!empty($task_list)) { //タスクがある場合リストを表示
                        for ($j = 0; $j <= count($task_list) - 1; $j++) {
                    ?>
                            <li class="task-list">
                                <label>
                                    <input class="task-item" type="checkbox" name="task_id[]" value="<?php echo $task_list[$j]['task_id'] ?>">
                                    <span class=" task-item"><?php echo $task_list[$j]['task_name']; ?></span>
                                </label>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </form>
        </div> <!-- task-show -->
    </div><!-- task-box -->
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>