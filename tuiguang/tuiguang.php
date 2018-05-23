<?php
define('_VALID', true);
require '../include/config.php';
require '../include/function_smarty.php';
require '../classes/pagination.class.php';
$uid = intval($_GET['fomid']);
if($uid){
    $expire = 60;
    $options = array(
        'host'=>$config['mem_host'],
        'port'=>$config['mem_port'],
        'prefix'=>'tuiguang',
        'expire'=>$expire,
        'length'=>99999999
    );
    $cache = Cache::getInstance('MemcacheAction',$options);
    $ip = GetRealIP();
    $host = $_SERVER['HTTP_HOST'];
    $random = rand(100, 999999999999);
    $tuiguang_randkey_name = 'tuiguang_randkey'.$host.$uid;
    $tuiguang_randkey_value = $random;
    $cache->_unset($tuiguang_randkey_name);
    $cache->set($tuiguang_randkey_name,$random);
    $referer = md5(urldecode($_SERVER['HTTP_COOKIE']));
    $AVS = $_COOKIE['AVS'];
    $Pratekey = '盗刷可耻!=!???';
    $token = md5($Pratekey.$uid.$host);
    $tuiguang_name = 'tuiguang'.$host.$uid;
    $tuiguang_value = md5($referer.$random.$ip.$AVS.$uid.$Pratekey);
    $cache->set($tuiguang_name,$tuiguang_value);
    $cache->set('token',$token);
    $smarty->assign('token', $token);
    $smarty->assign('fomid', $uid);
    $smarty->display('tuiguang/tuiguang.tpl');
    $smarty->gzip_encode();
}else{
    exit(header('Location:/'));
}
?>