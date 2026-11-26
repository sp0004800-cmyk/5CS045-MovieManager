<?php
require 'twig_setup.php'; require_login(); require 'db_connect.php'; require 'search_helpers.php';
$error=''; try{$movies=search_movies($mysqli);}catch(InvalidArgumentException $e){$movies=[];$error=$e->getMessage();} render('search.twig',['movies'=>$movies,'error'=>$error,'filters'=>$_GET]);
