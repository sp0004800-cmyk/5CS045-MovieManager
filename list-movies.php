<?php
require 'twig_setup.php'; require_login(); require 'db_connect.php';
$movies=$mysqli->query('SELECT * FROM movie ORDER BY date_released,movie_id')->fetch_all(MYSQLI_ASSOC);
render('list.twig',['movies'=>$movies]);
