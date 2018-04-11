<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
require 'include/function_user.php';
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$options    = getUserQuery();
$username   = $options['username'];

if ( !$username ) {
    require 'classes/auth.class.php';
    $auth   = new Auth();
    $auth->check();
}

$request    = ( isset($_SERVER['REQUEST_URI']) ) ? $_SERVER['REQUEST_URI'] : NULL;
$query      = explode('/', $request);
$module = get_request_arg('auth','varchar');
$modules_allowed = array('bbs','bbs_ajax');
if ( !in_array($module, $modules_allowed) ) {
    $message    = '此模块未开启';
}

if ( in_array($module, $modules_allowed) ) {

require 'modules/auth/' .$module. '.php';

}
Header("HTTP/1.1 301 Moved Permanently");
Header("Location: $accesslink");
?>

