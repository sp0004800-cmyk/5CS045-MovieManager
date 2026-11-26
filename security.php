<?php
ini_set('display_errors', '0');
ini_set('session.use_strict_mode', '1');
session_set_cookie_params(['secure'=>true,'httponly'=>true,'samesite'=>'Lax','path'=>'/']);
session_start();
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header("Content-Security-Policy: default-src 'self'; frame-ancestors 'none'; base-uri 'none'; form-action 'self'");
header('Cache-Control: no-store');
function field($source,$key) { return isset($source[$key]) && is_string($source[$key]) ? trim($source[$key]) : ''; }
function token() { return $_SESSION['csrf'] ?? ($_SESSION['csrf']=bin2hex(random_bytes(32))); }
function check_token() { if (!hash_equals(token(),field($_POST,'csrf'))) { http_response_code(403); exit('Invalid form token.'); } }
function require_login() { if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; } }
function go($page) { header('Location: '.$page); exit; }
function post() { return $_SERVER['REQUEST_METHOD']==='POST'; }
