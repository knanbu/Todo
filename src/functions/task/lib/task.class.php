<?php

class Task
{
    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db; //データベース接続
    }

    public function getTaskList($member_id) //各アカウントのすべてのタスクを取得
    {
        $table = ' Task ';
        $column = ' * ';
        $value = [
            ':member_id' => $member_id,
        ];
        $option = ' where member_id=:member_id ';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }
    public function getCategoryTaskList($member_id, $category_id) //カテゴリー別のタスク取得
    {
        $table = ' TCList as tc join Task as t on tc.task_id=t.task_id join Category as c on tc.category_id=c.category_id ';
        $column = ' tc.task_id,tc.category_id,t.member_id, t.task_name,t.priority,t.start_date,t.limit_date,t.comment,c.c_name  ';
        $value = [
            ':member_id' => $member_id,
            ':category_id' => $category_id
        ];
        $option = ' where t.member_id=:member_id and tc.category_id=:category_id ';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }
    public function getCategoryList($member_id) //カテゴリーを取得
    {
        $table = ' Category ';
        $column = ' category_id,c_name ';
        $value = [
            ':member_id' => $member_id
        ];
        $option = ' where member_id = :member_id group by category_id order by category_id ';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }

    public function getTask($task_id) //タスクの詳細取得
    {
        $table = ' Task ';
        $column = ' * ';
        $value = [
            ':task_id' => $task_id
        ];
        $option = ' where task_id=:task_id ';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }
    public function getTaskCategory($task_id) //登録されたいるタスクに対するタスク情報とカテゴリー名を取得
    {
        $table = ' TCList as tc join Task as t on tc.task_id=t.task_id join Category as c on tc.category_id=c.category_id ';
        $column = ' tc.task_id,tc.category_id, t.task_name,t.priority,t.start_date,t.limit_date,t.comment,c.c_name  ';
        $value = [
            ':task_id' => $task_id
        ];
        $option = ' where tc.task_id=:task_id ';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }

    public function getCategoryName($category_id) //カテゴリーの名前の取得
    {
        $table = ' Category ';
        $column = ' c_name ';
        $value = [
            ':category_id' => $category_id,
        ];
        $option = ' where category_id=:category_id ';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }

    public function addCategory($c_name, $member_id) //カテゴリの追加
    {
        $table = ' Category ';
        $column = ' c_name,member_id ';
        $value = ' :c_name, :member_id ';
        $pre_value = [
            ':member_id' => $member_id,
            ':c_name' => $c_name
        ];
        $this->pdo->insert($table, $column, $value, $pre_value);
        return;
    }

    public function addTask($data, $member_id) //タスクの新規登録
    {
        $this->check_space($data);
        $table = ' Task ';
        $column = '  member_id,task_name,priority,start_date,limit_date,comment ';
        $value = ' :member_id,:task_name,:priority,:start_date,:limit_date,:comment ';
        $pre_value = [
            ':member_id' => $member_id,
            ':task_name' => $data['task_name'],
            ':priority' => $data['priority'],
            ':start_date' => $data['start_date'],
            ':limit_date' => $data['limit_date'],
            ':comment' => $data['comment']
        ];
        $this->pdo->insert($table, $column, $value, $pre_value);
        $task_id = $this->get_task_id($member_id); //会員のタスクIDの中で一番最新のものを取得
        $this->addTC_table($member_id, $task_id[0]["max(task_id)"], $data); //タスクとカテゴリーの中間テーブルへの追加
        return;
    }

    private function get_task_id($member_id) //会員のタスクIDの中で一番最新のものを取得
    {
        $table = ' Task ';
        $column = ' max(task_id) ';
        $value = [
            ':member_id' => $member_id,
        ];
        $option = ' where member_id=:member_id ';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }

    private function addTC_table($member_id, $task_id, $data) //タスクとカテゴリーの中間テーブルへの追加
    {
        $this->addTC_table_default($task_id, $member_id);
        if (!empty($data['category_id'])) {
            foreach ($data['category_id'] as  $category_id) {
                $table = ' TCList ';
                $column = '  task_id,category_id ';
                $value = ' :task_id,:category_id ';
                $pre_value = [
                    ':task_id' => $task_id,
                    ':category_id' => (int)$category_id
                ];
                $this->pdo->insert($table, $column, $value, $pre_value);
            }
        }
        return;
    }

    private function addTC_table_default($task_id, $member_id) //
    {
        $category_list = $this->getCategoryList($member_id);
        $index = '';
        foreach ($category_list as $key => $value) {
            if ($value['c_name'] === 'すべて') { //カテゴリーのすべての項目はデフォルト値を探す
                $index = $key;
            }
        }
        $category_id = $category_list[$index]['category_id']; //カテゴリーの「すべて」
        $table = ' TCList ';
        $column = '  task_id,category_id ';
        $value = ' :task_id,:category_id ';
        $pre_value = [
            ':task_id' => $task_id,
            ':category_id' => $category_id
        ];
        $this->pdo->insert($table, $column, $value, $pre_value);
        return;
    }
    public function delete_task($task_id) //タスクの削除
    {
        $table = ' Task ';
        $column = ' ';
        $pre_value = [];
        if (is_array($task_id)) { //要素が複数あった場合
            foreach ($task_id as $key => $value) {
                $pre_value[":task_id{$key}"] = $value;
                if ($key !== count($task_id) - 1) {
                    $column .= " task_id=:task_id{$key} or ";
                } else {
                    $column .= " task_id=:task_id{$key} ";
                }
            }
        } else { //要素が一つしか無かった場合
            $column = ' task_id=:task_id ';
            $pre_value = [':task_id' => $task_id];
        }

        $this->pdo->delete($table, $column, $pre_value);
        $this->deleteTC_task($task_id); //中間テーブルのタスクも削除
        return;
    }
    private function deleteTC_task($task_id)
    {
        $table = ' TCList ';
        $column = ' ';
        $pre_value = [];
        if (is_array($task_id)) { //要素が複数あった場合
            foreach ($task_id as $key => $value) {
                $pre_value[":task_id{$key}"] = $value;
                if ($key !== count($task_id) - 1) {
                    $column .= " task_id=:task_id{$key} or ";
                } else {
                    $column .= " task_id=:task_id{$key} ";
                }
            }
        } else { //要素が一つしか無かった場合
            $column = ' task_id=:task_id ';
            $pre_value = [':task_id' => $task_id];
        }
        $this->pdo->delete($table, $column, $pre_value);
        return;
    }
    public function edit_task($member_id, $data) //タスクの編集
    {
        $this->check_space($data);
        $this->delete_task($data['task_id']); //タスクの削除
        $table = ' Task ';
        $column = ' task_name,member_id, priority, comment, start_date, limit_date ';
        $value = ' :task_name,:member_id,:priority,:comment,:start_date,:limit_date ';
        $pre_value = [
            ":member_id" => $member_id,
            ":task_name" => $data['task_name'],
            ":priority" => (int)$data['priority'],
            ":comment" => $data['comment'],
            ":start_date" => $data['start_date'],
            ":limit_date" => $data['limit_date']
        ];
        $this->pdo->insert($table, $column, $value, $pre_value);
        $task_id = $this->get_task_id($member_id); //会員のタスクIDの中で一番最新のものを取得
        $this->editTC_table((int)$task_id[0]["max(task_id)"], $data['category_id'], $member_id);
        return;
    }
    private function editTC_table($task_id, $category_id, $member_id) //タスクとカテゴリーの中間テーブルへの追加
    {
        $this->addTC_table_default($task_id, $member_id); //デフォルトで「すべて」のカテゴリーを紐づけ
        if (!empty($category_id)) { //カテゴリーが選択されている場合
            foreach ($category_id as  $id) {
                $table = ' TCList ';
                $column = ' task_id,category_id ';
                $value = ' :task_id,:category_id ';
                $pre_value = [
                    ':task_id' => $task_id,
                    ':category_id' => $id
                ];
                $this->pdo->insert($table, $column, $value, $pre_value);
            }
            return;
        }
    }

    public function edit_category($data) //カテゴリーの編集
    {
        $table = ' Category ';
        $column = ['c_name=:c_name'];
        $value = '';
        $pre_value = [
            ":category_id" => (int)$data['category_id'],
            ":c_name" => $data['c_name']
        ];
        $option = ' where category_id=:category_id';
        $this->pdo->update($table, $column, $value, $pre_value, $option);
        return;
    }

    public function delete_category($category_id) //カテゴリーの削除
    {
        $this->delete_category_task($category_id); //カテゴリー内のタスクの削除
        $table = ' Category ';
        $column = '  category_id=:category_id ';
        $pre_value = [':category_id' => $category_id];
        $this->pdo->delete($table, $column, $pre_value);
        return;
    }
    private function delete_category_task($category_id)//カテゴリー内のタスクの削除
    {
        $table = ' TCList ';
        $column = '  category_id=:category_id ';
        $pre_value = [':category_id'=>$category_id];
        $this->pdo->delete($table, $column, $pre_value);
        return;
    }
    private function check_space(&$data) //空白をnullに変える
    {
        for ($i = 0; $i < count($data); $i++) {
            foreach ($data as $key => $value) {
                if ($data[$key] === '') {
                    $data[$key] = null;
                }
            }
        }
        return;
    }
}
