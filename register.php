<?php
require 'twig_setup.php'; require 'db_connect.php';
$error='';
if(post()) {
 check_token(); $username=field($_POST,'username'); $password=$_POST['password']??'';
 if(!preg_match('/^[A-Za-z0-9_]{3,100}$/D',$username)||!is_string($password)||strlen($password)<8||strlen($password)>72||strpos($password,"\0")!==false) $error='Use a username of 3–100 letters, numbers or underscores and a password of 8–72 bytes.';
 else { $hash=password_hash($password,PASSWORD_DEFAULT); try { $stmt=$mysqli->prepare('INSERT INTO users (username,password) VALUES (?,?)'); $stmt->bind_param('ss',$username,$hash); $stmt->execute(); go('login.php'); } catch(mysqli_sql_exception $e) { $error=$e->getCode()===1062?'Username already exists.':'Registration failed.'; } }
}
render('register.twig',['error'=>$error]);
