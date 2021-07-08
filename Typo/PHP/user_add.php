<?php
session_start();
include('function.php');

//1.POSTデータ取得
$user_name = $_SESSION['user_name'];
$user_loginid = $_SESSION['user_loginid'];
$user_loginpw = $_SESSION['user_loginpw'];

//2.DB接続
$pdo = connectDB();

//3.データ登録SQL作成
$sql='INSERT INTO user_table (user_id,user_name,user_loginid,user_loginpw,life_flag,indate)
VALUES(NULL,:user_name,:user_loginid,:user_loginpw,0,sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name',$user_name,PDO::PARAM_STR);
$stmt->bindValue(':user_loginid',$user_loginid,PDO::PARAM_STR);
$stmt->bindValue(':user_loginpw',$user_loginpw,PDO::PARAM_STR);

$flag=$stmt->execute();

//4.データ登録処理後
if($flag==false){
    $error = $stmt->errorInfo();
    exit('QueryError:'.$error[2]);
}else{
    header('Location: create_table.php');
    exit();
}