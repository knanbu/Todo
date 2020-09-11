<?php

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function changeSession() //セッションハイジャック防止
    {
        session_regenerate_id(true);
    }

    public function deleteSession() //ログアウト用
    {
        unset($_SESSION);
        session_destroy();
    }
}
