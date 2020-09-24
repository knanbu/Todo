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
    public function getCategoryList($member_id)
    {
        $table = ' Task as t ';
        $column = ' c.c_name';
        $value = [
            ':member_id' => $member_id,
        ];
        $option = ' join Category as c on t.category_id=c.category_id where member_id=1 group by t.category_id';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }
    public function addCategory($data, $member_id)
    {
        $table=' Category ';
        $column=' * ';
        $value='';
        $pre_value=[
            ':member_id'=>$member_id,
            'c_name'=>$data['category_name'];
        ];
        $option='';
        $this->pdo->insert($table, $column, $value, $option);
    }

    public function addTask($data, $member_id) //タスクの新規登録
    {
        $this->check_space($data);
        $table = ' Task ';
        $column = '  member_id,task_name,category_id,priority,start_date,limit_date,comment ';
        $value = ' :member_id,:task_name,:category_id,:priority,:start_date,:limit_date,:comment ';
        $pre_value = [
            ':member_id' => $member_id,
            ':task_name' => $data['task_name'],
            ':category_id' => $data['category_id'],
            ':priority' => $data['priority'],
            ':start_date' => $data['start_date'],
            ':limit_date' => $data['limit_date'],
            ':comment' => $data['comment']
        ];
        $this->pdo->insert($table, $column, $value, $pre_value);
        return;
    }
    public function delete_task($task_id) //タスクの削除
    {
        $table = ' Task ';
        $column = ' task_id in (:task_id)  ';
        $pre_value = [
            ':task_id' => $task_id
        ];
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
