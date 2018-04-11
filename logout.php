<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_smarty.php';
require 'include/function_user.php';
if ( $config['user_remember'] == '1' ) {
    Remember::del();
}
if(isset($_SESSION['uid'])){
    $uid = intval($_SESSION['uid']);
    $cache->rm($uid);
    
    $time = strtotime(date('Y-m-d'));
    $cache->rm('sebiv'.$uid.$time);
    
    $sql = "DELETE FROM `users_online` WHERE UID = {$uid}";
    $conn->execute($sql);
}
del_session_vals(array(
    'session_id','uid','uid_premium','username','email','emailverified','photo','fname','gender','signup'
));

//$hash =  md5(date("Y/M/H h:i",time()).md5('!@#$%^&*'));
//if($hash!=@$_GET['token']){
//$bbsdomain = bbsDomain();

/*$smarty->assign('bbsdomain', $bbsdomain);
$smarty->assign('token', $hash);
$smarty->display('logout.tpl');
$smarty->gzip_encode();*/
//}
?>
<meta http-equiv="Refresh" content="1; url=/" /> 
<!--<script type="text/javascript" src="<?php echo $bbsdomain ?>"/auth_logout_api.php?token=<?php $token ?>"></script>-->