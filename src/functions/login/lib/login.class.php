<?php

class  Login
{
    public $pdo; //db接続

    public function __construct($db) //
    { //db接続とdb機能関連
        $this->pdo = $db;
    }

    public function login($data) //ログイン
    {
        $table = ' Member '; //テーブル名
        $column = " * "; //カラム名
        $value = [ //プリペアードステートメント
            ':email' => "{$data['email']}",
        ];
        $option = ' where email=:email '; //入力ログイン情報とDBのログイン情報が合っているか
        $result = $this->pdo->select($table, $column, $value, $option);

        if (password_verify($data['password'], $result['password'])) { //ハッシュ化されたDB上でのパスワードを解読できたら
            return $result;
        }
        return $result;
    }
}
