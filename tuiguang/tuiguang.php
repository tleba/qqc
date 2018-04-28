<?php
define('_VALID', true);
require '../include/config.php';
//require 'include/function_global.php';
require '../include/function_smarty.php';
require '../classes/pagination.class.php';
$ip = GetRealIP();
$uid = intval($_GET['fomid']);
//$invitConfig = array(
//    'day_total_award'=>100000,
//    'day_user_total_award'=>100,f
//    'min_invit_custom'=>2,
//    'min_sebi'=>1
//);
//体验币配置
$configPath   = $config['BASE_DIR'].'/ps';
$configBase   = '/tuiguang.txt';
$configJson = file_get_contents($configPath.$configBase);
$invitConfig = json_decode($configJson,true);
$errMsg=array('1'=>'赠送体验币必须是整数','2'=>'赠送体验币必须小于total_award','3'=>'体验币总数必须小于day_total','4'=>'缺少 fronuid','5'=>'赠送体验币小于最小单位','6'=>'配置文件错误！！','8'=>'添加成功!!');
$errDebug = 0;
//配置必选参数判断
if(!is_array($invitConfig)||$invitConfig['day_total_award']<10 || $invitConfig['day_user_total_award']<1 || $invitConfig['min_invit_custom']<1 || $invitConfig['min_sebi']<1){
    redirect(5,$errDebug);
}
if($uid)
{
	$exist_sql = "select count(id) as count from user_tuiguang where uid={$uid} and ip='{$ip}'";
	$rsc = $conn->execute($exist_sql);
	$today_total = $rsc->fields['count'];
    $today = date("Y-m-d");
	if($today_total==0)//本日该ip没有访问过
	{
		$time = time();
		$sql = "insert into user_tuiguang (`uid`,`ip`,`dateline`,`day`) values ('$uid','$ip','$time','$today')";//增加一条记录
		$conn->execute($sql);
	}
    //统计用户应赠送体验币
    $now_sql = "select count(id) as count from user_tuiguang where `uid`=$uid AND `condition`=1";//统计当前uid的ip流量
    $now_rs = $conn->execute($now_sql);
    $now_rs->fields['count'] ? $totalIp = $now_rs->fields['count']:$totalIp = 0; //推广ip条数
    if($totalIp<$invitConfig['min_invit_custom']) redirect(5,$errDebug);//赠送体验币小于最小单位
    $awardSeb =$totalIp*($invitConfig['min_sebi']/$invitConfig['min_invit_custom']);
    if( floor($awardSeb)!=$awardSeb )  redirect(1,$errDebug);//赠送体验币必须是整数
    if($receiveSeb+$awardSeb>$invitConfig['day_user_total_award']) redirect(2,$errDebug);//赠送体验币必须小于day_user_total_award
	//统计用户今日已领体验币
    $award_sql = "select sum(award) as awards from user_award where uid=$uid and day='$today'";//统计今日奖励数
    $award_rs = $conn->execute($award_sql);
    $award_rs->fields['awards'] ? $receiveSeb = $award_rs->fields['awards']:$receiveSeb = 0; //已领体验币
    //统计今日是否达到最大赠送体验币
	$award_sql = "select sum(award) as awards from user_award where day='$today'";//统计今天已送出体验币的总数
    $award_rs = $conn->execute($award_sql);
    $award_rs->fields['awards'] ? $allReceiveSeb = $award_rs->fields['awards']: $allReceiveSeb = 0;
    if($allReceiveSeb+$awardSeb>$invitConfig['day_total_award']) redirect(3,$errDebug);//不得超出已送出体验币总数day_total_award
	//赠送体验币入库
    $sql_tui = "UPDATE user_tuiguang SET `condition`=2 WHERE uid={$uid}"; //修改状态为已经奖励
    $conn->execute($sql_tui);
    $sql = "insert into user_award (`uid`,`award`,`day`,`type`) values ('$uid','{$awardSeb}','$today','1')";//增加一条记录
    $conn->execute($sql);
    $sql_ty = "UPDATE user_sebi SET sebi_tiyan = sebi_tiyan + '{$awardSeb}' WHERE uid = {$uid} LIMIT 1";//奖励体验体验币
    $conn->execute($sql_ty);
    redirect(8,$errDebug);
}
redirect(4,$errDebug);
function redirect($code,$errDebug=0){
    global $errMsg;
    if($errDebug){
        var_dump($errMsg[$code]);
        exit( header("Refresh:5;url=/") );
    }
    exit(header("Location: /"));
}
?>