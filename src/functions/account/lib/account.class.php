<?php

class Account
{
    public $pdo;
    public function __construct($db)
    { //db接続とdb機能関連
        $this->pdo = $db;
    }

    public function regist_account($data)
    {
        $data['password'] = $this->pass_hash($data); //パスワードのハッシュ化
        $email = $this->check_email($data['email']); //メールアドレスがDBに1つ以上あるかないかチェック
        if ($email !== 1) { //初めてのメールアドレスである場合
            $table = ' Member ';
            $column = ' member_name,email, pass ';
            $value = [
                ':member_name' => "{$data['name']}",
                ':email' => "{$data['email']}",
                ':pass' => "{$data['password']}"
            ];
            $result = $this->pdo->insert($table, $column, $value);
            $member_id = $this->get_member_id($data['email']);
            $q_answer = $this->answer_regist($data, $member_id); //秘密の質問登録
            var_dump($result);
        }
        return;
    }

    public function get_member_id($data)
    {
        $table = ' Member ';
        $column = ' member_id ';
        $value = [':email' => "{$data}"];
        $option = ' where email=:email';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }

    private function pass_hash($data)
    {
        return password_hash($data['password'], PASSWORD_DEFAULT);
    }

    private function check_email($data)
    {
        $type = 'select';
        $table = ' Member ';
        $column = ' email ';
        $value = [
            ':email' => "{$data}"
        ];
        $option = ' where email=:email '; //入力した値がDB上のものと一致するか
        $result = $this->pdo->select($table, $column, $value, $option);
        if (!empty($result)) { //入力された値が一致した場合
            $err = 1; //エラー値
            return $err;
        }
        return;
    }
    private function answer_regist($data, $member_id)
    {
        $table = ' Answer ';
        $column = ' question_id, member_id,a_content ';
        $value = [
            ':question_id' => "{$data['question_id']}",
            ':member_id' => "{$member_id}",
            ':a_content' => "{$data['answer']}"
        ];
        $result = $this->pdo->insert($table, $column, $value);
        return $result;
    }
}
