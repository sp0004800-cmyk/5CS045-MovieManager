<?php
require 'twig_setup.php'; require_login(); require 'db_connect.php'; require 'movie_helpers.php';
$m=get_movie($mysqli); $id=$m['movie_id']; $error=''; if(post()){check_token(); $m=movie_input(); if(valid_movie($m)){ $s=$mysqli->prepare('UPDATE movie SET movie_name=?,genre=?,price=?,date_released=? WHERE movie_id=?'); $s->bind_param('ssdsi',$m['movie_name'],$m['genre'],$m['price'],$m['date_released'],$id); $s->execute(); go('list-movies.php'); } $error='Enter valid movie details.'; } render('movie_form.twig',['movie'=>$m,'heading'=>'Edit movie','error'=>$error]);
