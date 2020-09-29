<?php
require('./../lib/session.php');
$session = new Session();
$title = 'タスク編集';
require_once('./../common/meta.php');
require('./../task/task_show.php');

?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <h2>タスクの編集</h2>
    <div class="edit-box">
        <!-- 古いタスク -->
        <div class="old-task">
            <ul>
                <li>タスク名：<?php echo $task_info[0]['task_name']; ?></li>
                <li>優先度：<?php echo $task_info[0]['priority']; ?></li>
                <li>カテゴリー名<?php echo $category_name[0]['c_name']; ?></li>
                <li>メモ：<?php echo $task_info[0]['comment']; ?></li>
                <li>開始時期：<?php echo $task_info[0]['start_date']; ?></li>
                <li>終了時期：<?php echo $task_info[0]['limit_date']; ?></li>
            </ul>
        </div>
        <!--<old-task> -->
        <!-- 新しいタスク -->
        <form action="./../task/task_edit.php" method="post">
            <input type="hidden" name="task_id" value="<?php echo $_GET['task_id'] ?>">
            <div class="new-task">
                <p><span class="red">*</span> 必須項目</p>
                <div class=" edit-form task-form">
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
                            <?php
                            for ($i = 0; $i < count($category_list); $i++) {
                            ?>
                                <option value="<?php echo $category_list[$i]['category_id'] ?>"><?php echo $category_list[$i]['c_name']; ?></option>
                            <?php } ?>
                        </select>
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
                <!--<task-form> -->
                <div class="center">
                    <input type="submit" class="button" name="add" value="登録">
                </div>
        </form>
    </div><!-- new-task -->
    </div><!-- edit-box -->
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>