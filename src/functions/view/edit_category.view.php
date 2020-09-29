<?php
require('./../lib/session.php');
$session = new Session();
$title = 'カテゴリー編集';
require_once('./../common/meta.php');
require('./../task/task_show.php');
?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <h2>カテゴリーの編集</h2>
    <div class="edit-box">
        <form action="./../task/edit_category.php" method="post">
            <input type="hidden" name="category_id" value="<?php echo $_GET['category_id'] ?>">
            <div class="new-task">
                <div class=" edit-form task-form">
                    <div>
                        <span>カテゴリー名</span><input type="text" name="c_name" value="<?php echo $category_name[0]['c_name']; ?>"><br>
                    </div>
                </div>
                <!--<task-form> -->
                <div class="center">
                    <input type="submit" class="button" name="change" value="変更">
                </div>
        </form>
    </div><!-- new-task -->
    </div><!-- edit-box -->
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>