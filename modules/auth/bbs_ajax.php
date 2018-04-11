<?php
defined('_VALID') or die('Restricted Access!');
$options    = get_user_auth_info();
$access = array();
$access['username'] = $options['username'];
$access['email'] = $options['email'];
$access['gender'] = $options['gender'];
$access['vip'] = $type_of_user;
$access['ip'] = isset($_SERVER["HTTP_CLIENT_IP"])?$_SERVER['HTTP_CLIENT_IP']:'none';
$access['useragent'] = md5($_SERVER['HTTP_USER_AGENT']);
$access['time'] = time()+10;
$access['random_token'] = Auth_Random_token('',38);
$access_token = Auth_Access_token($access);

	if(isset($access['username'])){

$sql        = "SELECT * FROM `auth` WHERE `username` = '" .$access['username']. "' LIMIT 1";
$rs         = $authDB->Execute($sql);
if ( $authDB->Affected_Rows() === 1 ) {
$sql = "UPDATE `auth` SET `access_token`='".$access_token."' ,`random_token`='".$access['random_token']."',`gender`='".$access['gender']."',`vip`='".$access['vip']."',`email`='".$access['email']."',`ip`='".$access['ip']."',`useragent`='".$access['useragent']."',`time`='".$access['time']."' WHERE `username` = '".$access['username']."' LIMIT 1";
$authDB->execute("$sql");
}else{
$sql = "INSERT INTO `auth` (`auth_id`, `access_token`, `random_token`, `username`, `gender`, `vip`, `email`, `ip`, `useragent`, `time`) VALUES (NULL, '".$access_token."', '".$access['random_token']."', '".$access['username']."', '".$access['gender']."', '".$access['vip']."', '".$access['email']."', '".$access['ip']."', '".$access['useragent']."', '".$access['time']."');";
$authDB->execute("$sql");
}

}
$bbsdomain1 = bbsDomain();
$bbsurl = "/auth.php?ajax=yes&access=$access_token&random=".$access['random_token'];
$accesslink = $bbsdomain1.$bbsurl;
?>
