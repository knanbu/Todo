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
            <h2>名前の変更</h2>
            <ul>
            <li></li>
            <form action="" method="post">
            <li>inputte</li>
            <input type="submit">
            </form>
            </ul>
        </div> <!-- task-show -->
    </div><!-- task-box -->
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>