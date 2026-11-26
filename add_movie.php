<?php
require 'twig_setup.php'; require_login(); require 'db_connect.php'; require 'movie_helpers.php';
$m=[]; $error=''; if(post()){check_token(); $m=movie_input(); if(valid_movie($m)){ $s=$mysqli->prepare('INSERT INTO movie (movie_name,genre,price,date_released) VALUES (?,?,?,?)'); $s->bind_param('ssds',$m['movie_name'],$m['genre'],$m['price'],$m['date_released']); $s->execute(); go('list-movies.php'); } $error='Enter valid movie details.'; } render('movie_form.twig',['movie'=>$m,'heading'=>'Add movie','error'=>$error]);
