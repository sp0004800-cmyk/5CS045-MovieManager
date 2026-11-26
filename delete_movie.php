<?php
require 'twig_setup.php'; require_login(); require 'db_connect.php'; require 'movie_helpers.php';
$m=get_movie($mysqli); if(post()){check_token(); $s=$mysqli->prepare('DELETE FROM movie WHERE movie_id=?'); $s->bind_param('i',$m['movie_id']); $s->execute(); go('list-movies.php');} render('delete.twig',['movie'=>$m]);
