<?php

class Info_change
{
    public $pdo;
    public function __construct($db)
    { //db接続とdb機能関連
        $this->pdo = $db;
    }
    public function isset_account($data) //入力情報からアカウントが存在するか確認
    {
        $table = ' (select m.member_id,m.email,a.question_id,a.a_content from Member as m join Answer as a on m.member_id=a.member_id)as G ';
        $column = ' G.member_id ';
        $value = [
            ':email' => $data['email'],
            ':question_id' => $data['question_id'],
            ':a_content' => $data['answer']
        ];
        $option = ' where G.email=:email and G.question_id=:question_id and G.a_content=:a_content ';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result['member_id'];
    }
    public function password_update($data, $member_id) //パスワード変更
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $table = ' Member ';
        $column = ' pass ';
        $value = ' :password ';
        $pre_value = [
            ':password' => "{$password}",
            ':member_id' => "{$member_id}"
        ];
        $option = 'where member_id=:member_id';
        $result = $this->pdo->update($table, $column, $value, $pre_value, $option);
        return $result;
    }
}
