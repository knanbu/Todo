<?php
require('./../lib/session.php');
$title = 'タスク一覧';
$ses = new Session();
require_once('./../common/meta.php');
?>
<html>

<body>
    <?php require_once('./../common/header.php'); ?>
    <div class="task-box">
        <!-- サイドバー -->
        <div class="sidebar">
            <div class="center">
                <button class="add-button button">＋</button>
            </div>
            <div class="center category">
                <p>カテゴリーリスト</p>
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
            <?php for ($i = 0; $i <= 5; $i++) { ?>
                <div class="task-list">
                    <div>
                        <label>
                            <input class="task-item" type="checkbox">
                            <span class="task-item">タスク</span>
                        </label>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php require_once('./../common/footer.php'); ?>
</body>

</html>