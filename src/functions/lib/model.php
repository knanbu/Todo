<?php

class Database
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->connectDB();
    }

    public function connectDB() //DB接続
    {
        try {
            $dbh = new PDO("mysql:host=todo-mysql;dbname=todo_db", "user1", "pass");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print($e->getMessage());
            echo "<br>例外処理あり";
            die();
        }
        return $dbh;
    }

    public function select($table = '', $column = '', $value = [], $option = '') //select文の実行
    {
        $type = 'select';
        $sql = $this->createSQL($type, $table, $column, $value) . $option;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($value);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function insert($table = '', $column = '', $value = '', $pre_value = '', $option = '') //insert文の実行
    {
        $type = 'insert';
        $sql = $this->createSQL($type, $table, $column, $value) . $option;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($pre_value);
        return;
    }

    public function update($table = '', $column = [], $value = '', $pre_value = '', $option = '') //update文の実行
    {
        $type = 'update';
        $sql = $this->createSQL($type, $table, $column, $value) . $option;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($pre_value);
        return;
    }
    public function delete($table = '', $column = [], $pre_value = '', $option = '') //delete文の実行
    {
        $type = 'delete';
        $sql = $this->createSQL($type, $table, $column) . $option;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($pre_value);
        return;
    }

    private function createSQL($type, $table = '', $column = '', $value = '') //sql文の作成、updateとdeleteの値が少し変わっているので注意
    {
        $sql = '';

        switch ($type) {
            case 'select':
                $sql = "select {$column} from {$table}";
                break;

            case 'insert':
                $sql = "insert into {$table} ( {$column} ) values ( {$value} )";
                break;

            case 'update':
                $sql = "update {$table} set ";
                foreach ($column as $key => $item) {
                    if ($key === 0) {
                        $sql .= $item;
                    } else {
                        $sql .= ',' . $item;
                    }
                }
                break;

            case 'delete':
                $sql = "delete from {$table} where {$column}";
                break;
        }
        return $sql;
    }
}
