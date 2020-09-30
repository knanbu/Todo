<?php
require('./../lib/session.php');
$ses = new Session();
$title = 'タスクの登録';
require_once('./../common/meta.php');
require_once('./../task/show_category.php');

?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <div class="add-box">
        <div class="add-task-box">
            <h2>タスク新規登録</h2>
            <p><span class="red">*</span> 必須項目</p>
            <form action="./../task/add_task.php" method="post" name="task_form">
                <div class="grid-form task-form">
                    <div>
                        <p class="red">
                            <?php
                            if ($_SESSION['err_task']) {
                                echo $_SESSION['err_task']['err_task_name'];
                            } ?>
                        </p>
                        <span class="red">*</span>
                        <label>タスク名</label>
                        <input type="text" name="task_name"><br>
                    </div>

                    <div>
                        <p class="red">
                            <?php
                            if ($_SESSION['err_task']) {
                                echo $_SESSION['err_task']['err_priority'];
                            } ?>
                        </p>
                        <span class="red">*</span>
                        <label>優先順位</label>
                        <select name="priority">
                            <option value="">未選択</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div>
                        <span>カテゴリー:</span>
                        <br>
                        <?php
                        for ($i = 1; $i < count($category_list); $i++) {
                        ?>
                            <input type="checkbox" id="<?php echo $category_list[$i]['category_id'] ?>" name="category_id" value="<?php echo $category_list[$i]['category_id'] ?>">
                            <label for="<?php echo $category_list[$i]['category_id'] ?>">
                                <?php echo $category_list[$i]['c_name']; ?>
                            </label>
                            <br>
                        <?php } ?>
                    </div>
                    <div>
                        <span>メモ</span>
                        <input type="text" name="comment"><br>
                    </div>
                    <div>
                        <label>開始
                            <input type="date" name="start_date" value='null' placeholder="始める日"><br>
                        </label>
                    </div>
                    <div>
                        <label>終了
                            <input type="date" name="limit_date" value='null' placeholder="終わる日"><br>
                        </label>
                    </div>
                </div>
                <div class="center">
                    <input type="submit" class="button" name="add" value="登録">
                </div>
            </form>
        </div>

        <!--カテゴリー追加-->
        <div class="edit-box">
            <form action="./../task/add_task.php" method="post">
                <div class="new-task">
                    <h2>カテゴリーの追加</h2>
                    <div class="edit-form task-form">
                        <p class="red">
                            <?php
                            if ($_SESSION['add_category']) {
                                echo $_SESSION['add_category'];
                            } ?>
                        </p>
                        <input type="text" name="c_name" placeholder="カテゴリーの追加">
                        <input type="submit" name="add_category" value="追加">
                    </div>
                </div>
            </form>
            <!-- edit-box -->
        </div>
    </div>
    <!--  -->
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>