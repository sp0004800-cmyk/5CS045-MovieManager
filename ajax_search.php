<?php
require 'twig_setup.php'; require_login(); require 'db_connect.php'; require 'search_helpers.php';
try { echo $twig->render('table.twig',['movies'=>search_movies($mysqli)]); } catch(InvalidArgumentException $e){http_response_code(400);echo 'Invalid search filters.';}
