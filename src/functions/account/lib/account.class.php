<?php

class Account
{
    public $pdo;
    public function __construct($db)
    { //db接続とdb機能関連
        $this->pdo = $db;
    }

    public function regist_account($data)//アカウントの登録
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
        $this->pdo->insert($table, $column, $value, $pre_value);
        $member_id = $this->get_member_id($data['email']); //valueが違うので明日はこの部分の手直し
        $this->answer_regist($data, $member_id); //秘密の質問登録
        $this->defaultCategoryInsert($member_id); //各アカウントごとのデフォルトのカテゴリー追加
        return;
    }
    private function defaultCategoryInsert($member_id) //各アカウントごとのデフォルトのカテゴリー追加
    {
        $table = ' Category ';
        $column = 'member_id,c_name ';
        $value = ' :member_id , :c_name ';
        $pre_value = [
            ':member_id' => $member_id,
            ':c_name' => "すべて"
        ];
        $this->pdo->insert($table, $column, $value, $pre_value);
        return;
    }

    public function get_member_id($email) //アカウントID取得
    {
        $table = ' Member ';
        $column = ' member_id ';
        $value = [':email' => $email];
        $option = ' where email=:email';
        $result = $this->pdo->select($table, $column, $value, $option);
        return $result[0]['member_id'];
    }

    private function pass_hash($data) //パスワードのハッシュ化
    {
        return password_hash($data['password'], PASSWORD_DEFAULT);
    }

    private function answer_regist($data, $member_id) //秘密の質問の答えの登録
    {
        $table = ' Answer ';
        $column = ' question_id, member_id, a_content ';
        $value = ':question_id , :member_id, :a_content';
        $pre_value = [
            ':question_id' => $data['question_id'],
            ':member_id' => $member_id,
            ':a_content' => $data['answer']
        ];
        $result = $this->pdo->insert($table, $column, $value, $pre_value);
        return;
    }

    public function show_name($member_id)
    {
        $table=' Member ';
        $column=' member_name ';
        $value=[':member_id'=>$member_id];
        $option=' where member_id=:member_id';
        $result=$this->pdo->select($table,$column,$value,$option);
        return $result;
    }
}
