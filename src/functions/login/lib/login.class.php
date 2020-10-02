<?php

class  Login
{
    public $pdo; //db接続

    public function __construct($db) 
    { //db接続とdb機能関連
        $this->pdo = $db;
    }

    public function login($data) //ログイン
    {
        $table = ' Member ';
        $column = " * ";
        $value = [ 
            ':email' => "{$data['email']}",
        ];
        $option = ' where email=:email '; 
        $result = $this->pdo->select($table, $column, $value, $option);
        if (password_verify($data['password'], $result[0]['pass'])) { //ハッシュ化されたDB上でのパスワードを解読
            return $result;
        }
    }
}
