<?php

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
    try {
        $db_name = 'lobo03_kadai10';  
        $db_id   = 'lobo03';      
        $db_pw   = 'lobo0303';      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = 'mysql635.db.sakura.ne.jp'; 
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}


// ログインチェク処理 loginCheck()
function loginCheck()
{
    if (!isset($_SESSION['chk_ssid'])  ||  $_SESSION['chk_ssid']  !==  session_id()) {
        redirect('login.php');
    } else {
        // ログイン済み処理
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}
