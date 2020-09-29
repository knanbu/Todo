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
                    <?php
                    for ($i = 0; $i <= count($category_list) - 1; $i++) {
                    ?>
                        <div class="category-item-detail">
                            <button><?php echo $category_list[$i]['c_name']; ?></button>

                            <a href="edit_category.view.php?category_id=<?php echo $category_list[$i]['category_id'] ?>">
                                <button class="three-point">&#8942; &nbsp 削除</button>
                            </a>
                            <a href="edit_category.view.php?category_id=<?php echo $category_list[$i]['category_id'] ?>">
                                <button class="three-point">編集</button>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div><!-- category-item-->
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
                            <a href="./../view/task_edit.view.php?task_id=<?php echo $task_list[$j]['task_id']; ?>">
                                <li class="task-list">
                                    <input class="task-item" type="checkbox" name="task_id[]" value="<?php echo $task_list[$j]['task_id'] ?>">
                                    <span class=" task-item"><?php echo $task_list[$j]['task_name']; ?></span>
                                </li>
                            </a>
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