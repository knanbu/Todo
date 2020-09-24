<?php
require('./../lib/session.php');
$ses = new Session();
$title = 'タスクの登録';
require_once('./../common/meta.php');
unset($_SESSION['err_task']);
?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <div class="wrapper add-task-box">
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
                    <input type="text" name="task_name" placeholder="タスク名"><br>
                </div>
                <div></div>
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
                <div></div>
                <div>
                    <p class="red">
                        <?php
                        if ($_SESSION['err_task']) {
                            echo $_SESSION['err_task']['err_category'];
                        } ?>
                    </p>
                    <span class="red">*</span>
                    <label>カテゴリー</label>
                    <select name="category_id">
                        <option value="">未選択</option>
                        <option value="1">すべて</option>
                    </select>
                </div>
                <div>
                    <form action="./../task/add_task.php" method="post">
                        <input type="text" name="category_name" placeholder="カテゴリーの追加">
                        <input type="submit" name="add_category">
                    </form>
                </div>
                <div>
                    <span>&nbsp</span>
                    <input type="text" name="comment" placeholder="メモ"><br>
                </div>
                <div></div>
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
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>