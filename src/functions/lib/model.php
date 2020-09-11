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
            $dbh = new PDO("mysql:host=todo-mysql;dbname=todo_db", "root", "root");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print($e->getMessage());
            echo "<br>例外処理あり";
            die();
        }
        return $dbh;
    }

    public function select($table = '', $column = '', $value = '', $option = '') //select文の実行
    {
        $type = 'select';
        $sql = $this->createSQL($type, $table, $column, $value) . $option;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($value);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    private function createSQL($type, $table = '', $column = '', $value = '') //sql文の作成、updateとdeleteの値が少し変わっているので注意
    {
        $sql = '';

        switch ($type) {
            case 'select':
                $sql = "select {$column} from {$table}";
                break;

            case 'insert':
                $sql = "insert into {$table} ({$column}) values ( {$value} )";
                break;

            case 'update':
                $sql = "update {$table} set {$value}";
                break;

            case 'delete':
                $sql = "delete from {$table} where {$column} ";
                break;
        }
        return $sql;
    }
}
