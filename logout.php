<?php
require 'security.php'; if(!post()){http_response_code(405);exit;} check_token(); $_SESSION=[]; setcookie(session_name(),'',time()-3600,'/','',true,true); session_destroy(); go('login.php');
