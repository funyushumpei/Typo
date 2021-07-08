<?php

session_start();
include('function.php');

//DB接続
$pdo = connectDB();

//SQL作成
$table_name = 'typo_'.$_SESSION['user_name'].'_table';
$sql = 'CREATE TABLE '.$table_name.'(
    id int(12) PRIMARY KEY AUTO_INCREMENT,
    word_id int(12),
    typo_word varchar(128),
    typo_flag int(1),
    indate datetime
)';

//SQL実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//SQL実行後
if($status==false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{
    header("Location: ../index.php");
    exit();
}














?>