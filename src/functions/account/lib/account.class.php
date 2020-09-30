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
        $table = ' Member ';
        $column = 'member_name,email,pass ';
        $value = ' :member_name , :email , :pass ';
        $pre_value = [
            ':member_name' => "{$data['name']}",
            ':email' => "{$data['email']}",
            ':pass' => "{$data['password']}"
        ];
        $result = $this->pdo->insert($table, $column, $value, $pre_value);
        $member_id = $this->get_member_id($data['email']); //
        $this->answer_regist($data, $member_id[0]['member_id']); //秘密の質問登録
        return;
    }

    public function get_member_id($email)
    {
        $table = ' Member ';
        $column = ' member_id ';
        $value = [':email' => $email];
        $option = ' where email=:email';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result;
    }

    private function pass_hash($data)
    {
        return password_hash($data['password'], PASSWORD_DEFAULT);
    }


    private function answer_regist($data, $member_id)
    {
        $table = ' Answer ';
        $column = ' question_id, member_id, a_content ';
        $value = ':question_id , :member_id, :a_content';
        $pre_value = [
            ':question_id' => $data['question_id'],
            ':member_id' => $member_id,
            ':a_content' => "{$data['answer']}"
        ];
        $result = $this->pdo->insert($table, $column, $value, $pre_value);
        return;
    }
}
