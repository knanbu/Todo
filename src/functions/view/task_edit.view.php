<?php
require('./../lib/session.php');
$ses = new Session();
$title = 'タスクの編集';
require_once('./../common/meta.php');
require_once('./../task/show_cate_task.php');

?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <div class="add-box">
        <div class="add-task-box">
            <h2>タスク編集</h2>
            <p><span class="red">*</span> 必須項目</p>
            <form action="./../task/task_edit.php" method="post">
            <input type="hidden" name="task_id" value="<?php echo $task_id;?>">
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
                        <input type="text" name="task_name" value="<?php echo $task_info[0]['task_name']; ?>"><br>
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
                            <?php foreach ($priority as  $value) { ?>
                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <span>カテゴリー:</span>
                        <br>
                        <?foreach ($category_list as $key => $value) {?>
                            <input type="checkbox" id="<?php echo  $value['category_id']; ?>" name="category_id[]" value="<?php echo $value['category_id']; ?>" <?php if (in_array($value['category_id'],$category_id,true)) {
                                echo 'checked';
                            }?>>
                            <label for="<?php echo $value['category_id'];?>">
                                <?php echo $value['c_name']; ?>
                            </label>
                            <br>
                        <?php } ?>
                    </div>
                    <div>
                        <span>メモ</span>
                        <input type="text" name="comment" value="<?php echo $task_info[0]['comment']; ?>"><br>
                    </div>
                    <div>
                        <label>開始
                            <input type="date" name="start_date" value='<?php echo $task_info[0]['start_date']; ?>' placeholder="始める日"><br>
                        </label>
                    </div>
                    <div>
                        <label>終了
                            <input type="date" name="limit_date" value='<?php echo $task_info[0]['limit_date']; ?>' placeholder="終わる日"><br>
                        </label>
                    </div>
                </div>
                <div class="center">
                    <input type="submit" class="button" name="add" value="更新">
                </div>
            </form>
        </div>
                <!--カテゴリー追加-->
        <div class="edit-box">
            <form action="./../task/add_category.php" method="post">
                <div class="new-task">
                    <h2>カテゴリーの追加</h2>
                    <div class="edit-form task-form">
                        <input type="hidden" name="task_id" value="<?php echo $task_id?>">
                        <p class="red">
                            <?php
                            if ($_SESSION['add_category']) { //追加に成功した場合
                                echo $_SESSION['add_category'];
                            } elseif ($_SESSION['err_category']) { //空白の場合
                                echo $_SESSION['err_category'];
                            }
                            ?>
                        </p>
                        <input type="text" name="c_name" placeholder="カテゴリーの追加">
                        <input type="submit" name="add_category_edit" value="追加">
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