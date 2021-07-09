<?php

session_start();
include('function.php');

$login_id = $_POST['user_loginid'];
$login_pw = $_POST['user_loginpw'];


//1.DB接続
$pdo = connectDB();
 
//2.SQL作成
$sql = 'SELECT * FROM user_table WhERE user_loginid=:user_loginid AND user_loginpw=:user_loginpw';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_loginid',$login_id,PDO::PARAM_STR);
$stmt->bindValue(':user_loginpw',$login_pw,PDO::PARAM_STR);
$status = $stmt->execute();

//3.データ更新処理後
if($status==false){
    $error = $stmt->errorInfo();
    exit('QueryError:'.$error[2]);
}

$val = $stmt->fetch();

if($val['user_id']!=''){
    $_SESSION['user_id'] = $val['user_id'];
    $_SESSION['session_id_check'] = session_id();
    $_SESSION['user_name'] = $val['user_name'];

    header("Location: typing.php");
    exit();
}else{
    header("Location: index.php");
    exit();
}

?>