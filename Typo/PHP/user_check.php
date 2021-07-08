<?php

session_start();
include('function.php');

//0.入力チェック
if(
    !isset($_POST['user_name']) || $_POST['user_name']=='' ||
    !isset($_POST['user_loginid']) || $_POST['user_loginid']=='' ||
    !isset($_POST['user_loginpw']) || $_POST['user_loginpw']==''
){
    exit('ParamError');
}

//1.POSTデータ取得
$_SESSION['user_name'] = $_POST['user_name'];
$_SESSION['user_loginid'] = $_POST['user_loginid'];
$_SESSION['user_loginpw'] = $_POST['user_loginpw'];

//2.DB接続
$pdo = connectDB();

//3.SQL作成
$sql = 'SELECT * FROM user_table WHERE user_name = "'.$_SESSION['user_name'].'"';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//4.ユーザ名Check
$view = '';
if(!isset($row['user_name'])){
    header("Location: user_add.php");
    exit();
}else{
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録エラー</title>
</head>
<body>
    <p>すでに登録されているユーザー名です</p>
</body>
</html>

<?php
}
?>