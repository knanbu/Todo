<?php

class  Validate
{

    public $pdo; //db接続
    private $err_array = [];
    private $err_empty = '空白です';


    public function __construct($db) //
    { //db接続とdb機能関連
        $this->pdo = $db;
    }

    public function err_check($data)
    {
        $this->check_email($data);
        $this->check_name($data);
        $this->check_password($data);
        $this->check_question($data);
        $this->check_answer($data);
        return $this->err_array;
    }

    public function isset_email($email)//DB上に同じメールアドレスが存在していないか確認
    {
        $table = ' Member ';
        $column = ' email ';
        $value = [
            ':email' => $email
        ];
        $option = ' where email=:email ';
        $result = $this->pdo->select($table, $column, $value, $option);
        if ($result === true) { //入力された値が一致した場合
            return 'すでにメールアドレスが登録されています';
        }
    }

    private function check_name($data)//名前のエラー判定
    {
        if (empty($data['name'])) { //空白チェック
            $this->err_array['err_name'] = $this->err_empty;
            return;
        }
    }
    private function check_question($data)//秘密の質問のエラー判定
    {
        if (empty($data['question_id'])) { //空白チェック
            $this->err_array['err_question'] = '質問が未選択です';
            return;
        }
    }
    private function check_answer($data)//秘密の質問へのエラー判定
    {
        if (empty($data['answer'])) { //空白チェック
            $this->err_array['err_answer'] = $this->err_empty;
            return;
        }
    }

    private function check_password($data)//パスワードのエラー判定
    {
        //空白チェック
        if (empty($data['password'])) { //空白チェック
            $this->err_array['empty_password'] = $this->err_empty;
            return;
        }

        //再入力の部分に間違えがないかチェック
        if ($data['password'] !== $data['password_again']) {
            $this->err_array['again_password'] = 'パスワードを間違えています';
        }

        // //正規表現チェック
        // $correct_pass = '/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{4,10}$/i';
        // $preg = preg_match($correct_pass, $data['pass']);
        // if ($preg === 0) { //形式が合わない場合
        //     $this->err_array['preg_err_password'] = 'パスワードは半角英数字で、4文字以上10文字以下です';
        // }
    }

    private function check_email($data)//メールのエラー判定
    {
        //空白チェック
        if (empty($data['email'])) {
            $this->err_array['empty_email'] = $this->err_empty;
        }
        //再入力の部分に間違えがないかチェック
        if ($data['email'] !== $data['email_again']) {
            $this->err_array['again_email'] = '同じメールアドレスを入力してください';
        }
        //メールアドレスの正規表現チェック
        $correct_email = "/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i";
        $preg = preg_match($correct_email, $data['email']);
        if ($preg === 0) { //形式が合わない場合
            $this->err_array['preg_err_email'] = 'メールアドレスを正しく入力してください';
        }
    }
}
