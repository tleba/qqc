<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_smarty.php';
require 'classes/auth.class.php';

$auth   = new Auth();
$auth->check();

define('SITE_ADMIN', '管理员');
$expire = 600;
$options = array(
    'host'=>$config['mem_host'],
    'port'=>$config['mem_port'],
    'prefix'=>'puc',
    'expire'=>$expire,
    'length'=>0
);
$cache = Cache::getInstance('MemcacheAction',$options);

$uid        = intval($_SESSION['uid']);
$username   = $_SESSION['username'];

$user = $cache->get($uid);
if (empty($user)) {
    $sql        = "SELECT * FROM signup WHERE UID = " .$uid. " LIMIT 1";
    $rs         = $conn->execute($sql);
    $user       = $rs->getrows();
    $user       = $user['0'];
    $cache->set($uid,$user);
}
if ( empty($user) ) {
    VRedirect::go($config['BASE_URL']. '/error/user_missing');
}

$key = 'online_'.$uid;
$users_online = $cache->get($key);
if (!$users_online) {
    $sql        = "SELECT * FROM users_online WHERE UID = " .$uid. " AND online > " .(time()-300). " LIMIT 1";
    $rs     = $conn->execute($sql);
    $users_onlines   = $rs->getrows();
    $users_online   = $users_onlines['0'];
    $cache->set($key,$users_online,300);
}
if ( $users_online )
	$online = true;
else
	$online = false;

$request    = ( isset($_SERVER['REQUEST_URI']) ) ? $_SERVER['REQUEST_URI'] : NULL;
$request    = str_replace('?' .$_SERVER['QUERY_STRING'], '', $request);
$query      = explode('/', $request);
foreach ( $query as $key => $value ) {
    if ( $value == 'mail' ) {
        $query = array_slice($query, $key+1);
    }
}

if ( isset($query['0']) && $query['0'] != '' ) {
    $module             = $query['0'];
    $modules_allowed    = array('inbox', 'outbox', 'compose', 'read');
    if ( !in_array($module, $modules_allowed) ) {
        $module         = 'inbox';
    }
}
$module     = ( isset($module) ) ? $module : 'inbox';
if ( $module == 'read' ) {
    $template = 'mail_read';
} elseif ( $module == 'compose' ) {
    $template = 'mail_compose';
} else {
    $template = 'mail';
}

require 'modules/mail/' .$module. '.php';

$smarty->assign('site_admin',SITE_ADMIN);
$smarty->assign('errors',$errors);
$smarty->assign('err',$err);
$smarty->assign('messages',$messages);
$smarty->assign('menu', 'home');
$smarty->assign('submenu', '');
$smarty->assign('username', $username);
$smarty->assign('user', $user);
$smarty->assign('online', $online);
$smarty->assign('profile', true);
$smarty->display('header.tpl');
$smarty->display('errors.tpl');
$smarty->display('messages.tpl');
$smarty->display($template. '.tpl');
$smarty->display('footer.tpl');
$smarty->gzip_encode();
?>
