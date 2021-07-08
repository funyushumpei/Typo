<?php

function connectDB(){
    try{
        $pdo = new PDO('mysql:dbname=typo_db;charset=utf8;host=localhost','root','');
    }catch(PDOException $e){
        exit('DbConnectError:'.$e->getMessage());
    }
    return $pdo;
}











?>