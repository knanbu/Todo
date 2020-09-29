<?php

class Task
{
    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db; //データベース接続
    }

    public function getTaskList($member_id) //各アカウントのタスクを取得
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
    public function getCategoryList($member_id)//カテゴリーを取得
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

    public function getTask($task_id)//タスクの取得
    {
        $table = ' Task ';
        $column = ' * ';
        $value = [
            ':task_id' => $task_id,
        ];
        $option = ' where task_id=:task_id ';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }
    public function getCategoryName($category_id)//カテゴリーの名前の取得
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

    public function addCategory($data, $member_id)//カテゴリの追加
    {
        $table = ' Category ';
        $column = ' c_name,member_id ';
        $value = ' :c_name, :member_id ';
        $pre_value = [
            ':member_id' => $member_id,
            ':c_name' => $data['c_name']
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
        $task_id=$this->get_task_id($member_id);//会員のタスクIDの中で一番最新のものを取得
        $this->addTC_table($task_id[0]["max(task_id)"],$data);//タスクとカテゴリーの中間テーブルへの追加
        return;
    }

    private function get_task_id($member_id)//会員のタスクIDの中で一番最新のものを取得
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

    private function addTC_table($task_id,$data)//タスクとカテゴリーの中間テーブルへの追加
    {
        $table = ' TCList ';
        $column = '  task_id,category_id ';
        $value = ' :task_id,:category_id ';
        $pre_value = [
            ':task_id' => $task_id,
            ':category_id' => $data['category_id']
        ];
        $this->pdo->insert($table, $column, $value, $pre_value);
        return;
    }
    public function delete_task($task_id) //タスクの削除
    {

        $table = ' Task ';
        $column = ' ';
        $pre_value = [];
        foreach ($task_id as $key => $value) {
            $pre_value[":task_id{$key}"] = $value;
            if ($key !== count($task_id) - 1) {
                $column .= " task_id=:task_id{$key} or ";
            } else {
                $column .= " task_id=:task_id{$key} ";
            }
        }
        $this->pdo->delete($table, $column, $pre_value);
        return;
    }
    public function edit_task($data) //タスクの編集
    {
        $this->check_space($data);
        $table = ' Task ';
        $column = ['task_name=:task_name', 'priority=:priority', 'category_id=:category_id', 'comment=:comment', 'start_date=:start_date', 'limit_date=:limit_date'];
        $value = '';
        $pre_value = [
            ":task_id" => (int)$data['task_id'],
            ":task_name" => $data['task_name'],
            ":priority" => $data['priority'],
            ":category_id" => $data['category_id'],
            ":comment" => $data['comment'],
            ":start_date" => $data['start_date'],
            ":limit_date" => $data['limit_date']
        ];
        $option = ' where task_id=:task_id';
        $this->pdo->update($table, $column, $value, $pre_value, $option);
        return;
    }

    public function edit_category($data)//カテゴリーの編集
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

    public function delete_category()//カテゴリーの削除
    {
        # code...
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
