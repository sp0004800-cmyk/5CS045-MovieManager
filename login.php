<?php
require 'twig_setup.php'; require 'db_connect.php';
$error='';
if(post()) {
 check_token(); $answer=field($_POST,'captcha'); $expected=$_SESSION['captcha']??null; unset($_SESSION['captcha']);
 $username=field($_POST,'username'); $password=$_POST['password']??'';
 if($expected===null || $answer!==(string)$expected) $error='Incorrect CAPTCHA.';
 elseif(!is_string($password)||strlen($password)>72||strpos($password,"\0")!==false||strlen($username)>100) $error='Invalid credentials.';
 else { $stmt=$mysqli->prepare('SELECT user_id,password FROM users WHERE username=?'); $stmt->bind_param('s',$username); $stmt->execute(); $user=$stmt->get_result()->fetch_assoc(); if($user && password_verify($password,$user['password'])) { session_regenerate_id(true); $_SESSION=['user_id'=>$user['user_id']]; go('list-movies.php'); } $error='Invalid credentials.'; }
}
$a=random_int(1,9); $b=random_int(1,9); $_SESSION['captcha']=$a+$b;
render('login.twig',['error'=>$error,'question'=>"$a + $b"]);
