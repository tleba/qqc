<?php
define('_VALID', true);
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//require 'include/debug.php';
require 'include/config.local.php';
require 'include/security.php';
require 'include/function_global.php';
ob_start();
require 'include/sessions.php';
ob_end_clean();
if (isset($_SESSION['uid'])&&$_SESSION['uid']>0&&$_SESSION['uid_premium']>1) {
    $msg = $_SESSION['uid_premium'];
    exit(json_encode(array('code'=>1,'msg'=>$msg) ) );
}else{
	exit(json_encode(array('code'=>0,'msg'=>0)));
}