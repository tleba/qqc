<?php
define('_VALID', true);
require '../include/config.php';
require '../include/function_smarty.php';
require '../classes/pagination.class.php';

if($_SESSION['uid']){
    $uid = $_SESSION['uid'];
    $serverName = $_SERVER["SERVER_NAME"];
    $url = "http://".$serverName."/tuiguang/tuiguang.php?fomid=".$uid;
    //统计今日是否达到最大赠送体验币
    $award_sql = "SELECT sum(award) as awards FROM user_award WHERE `uid`='{$uid}' AND `type`=1";//
    $award_rs = $conn->execute($award_sql);
    $award_rs->fields['awards'] ? $allReceiveSeb = $award_rs->fields['awards']: $allReceiveSeb = 0;
    $smarty->assign( array('sebi'=>$allReceiveSeb,'url'=>$url));
    $smarty->display('tuiguang/index-logged.tpl');
    $smarty->gzip_encode();
}else{
    $smarty->display('tuiguang/index-login.tpl');
    $smarty->gzip_encode();
}
?>
