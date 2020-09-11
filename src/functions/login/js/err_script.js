'use strict';

function err_login(email = '', password = '') {
    const correct_email = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
    const correct_pass = /^(?=.*?[a-z])(?=.*?\d)[a-z\d]{4,10}$/i;

    if (email === '') { //空白チェック
        event.preventDefault();
        document.getElementById('err_email').textContent = 'メールアドレスが空白です'
    }
    // 以下のコメントアウトは新規登録が実装完了次第
    //else if (!(correct_email.test(email))) { //正規表現チェック
    //     event.preventDefault();
    //     document.getElementById('err_email').textContent = 'メールアドレスを正しく入力してください'
    // }

    if (password === '') { //空白チェック
        event.preventDefault();
        document.getElementById('err_password').textContent = 'パスワードが空白です'
    }
    // 以下のコメントアウトは新規登録が実装完了次第
    //else if (!(correct_pass.test(password))) { //正規表現チェック
    //     event.preventDefault();
    //     document.getElementById('err_password').textContent = 'パスワードは半角英数字で、4文字以上10文字以下です'
    // }
}