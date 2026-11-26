<?php
require_once __DIR__.'/security.php';
require_once __DIR__.'/../vendor/autoload.php';
$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader(__DIR__), ['autoescape'=>'html','cache'=>false]);
function render($name,$data=[]) { global $twig; echo $twig->render($name,$data+['csrf'=>token(),'logged_in'=>!empty($_SESSION['user_id'])]); }
