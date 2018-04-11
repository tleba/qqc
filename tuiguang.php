<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';

$ip = GetRealIP();
$uid = intval($_GET['fromuid']);
if($uid)
{    $fourDayAgo = strtotime('-4 days',strtotime(date('Y-m-d')));
	$conn->execute("delete from user_tuiguang where dateline < {$fourDayAgo}");//先删除四天前记录
	
	$stime = strtotime(date('Y-m-d'));
	$etime = $stime + 86400;
	$exist_sql = "select count(id) as count from user_tuiguang where uid={$uid} and ip='{$ip}' and (dateline > {$stime} and dateline < {$etime})";
	$rsc = $conn->execute($exist_sql);
	$today_total = $rsc->fields['count'];
	if($today_total==0)//本日该ip没有访问过
	{
		$time = time();
		$sql = "insert into user_tuiguang (`uid`,`ip`,`dateline`) values ('$uid','$ip','$time')";//增加一条记录
		$conn->execute($sql);
	}
	$day = date("Y-m_d");
	$award_sql = "select sum(award) as awards from user_award where uid=$uid and day='$day'";//统计今日奖励数
	$award_rs = $conn->execute($award_sql);
	$award_total = $award_rs->fields['awards'];
	if($award_total<50)//没达到每日上限
	{
		$now_sql = "select count(id) as count from user_tuiguang where uid=$uid";//统计当前uid的ip流量
		$now_rs = $conn->execute($now_sql);
		$today_total = $now_rs->fields['count'];
		if($today_total>=80 && $today_total<100)
		{
			$sql_ty = "UPDATE user_sebi SET sebi_tiyan = sebi_tiyan + 4 WHERE uid = {$uid} LIMIT 1";//奖励体验色币
			$conn->execute($sql_ty);
			$sql = "insert into user_award (`uid`,`award`,`day`) values ('$uid','4','$day')";//增加一条记录
			$conn->execute($sql);
			$delete_sql = "delete from user_tuiguang where uid=$uid order by dateline limit 80";//ip清零
			$conn->execute($delete_sql);
		}
		elseif($count>=60 && $count<80)
		{
			$sql_ty = "UPDATE user_sebi SET sebi_tiyan = sebi_tiyan + 3 WHERE uid = {$uid} LIMIT 1";//奖励体验色币
			$conn->execute($sql_ty);
			$sql = "insert into user_award (`uid`,`award`,`day`) values ('$uid','3','$day')";//增加一条记录
			$conn->execute($sql);
			$delete_sql = "delete from user_tuiguang where uid=$uid order by dateline limit 60";//ip清零
			$conn->execute($delete_sql);
		}
		elseif($count>=40 && $count<60)
		{
			$sql_ty = "UPDATE user_sebi SET sebi_tiyan = sebi_tiyan + 2 WHERE uid = {$uid} LIMIT 1";//奖励体验色币
			$conn->execute($sql_ty);
			$sql = "insert into user_award (`uid`,`award`,`day`) values ('$uid','2','$day')";//增加一条记录
			$conn->execute($sql);
			$delete_sql = "delete from user_tuiguang where uid=$uid order by dateline limit 40";//ip清零
			$conn->execute($delete_sql);
		}
		elseif($count>=20 && $count<40)
		{
			$sql_ty = "UPDATE user_sebi SET sebi_tiyan = sebi_tiyan + 1 WHERE uid = {$uid} LIMIT 1";//奖励体验色币
			$conn->execute($sql_ty);
			$sql = "insert into user_award (`uid`,`award`,`day`) values ('$uid','1','$day')";//增加一条记录
			$conn->execute($sql);
			$delete_sql = "delete from user_tuiguang where uid=$uid order by dateline limit 20";//ip清零
			$conn->execute($delete_sql);
		}
	}
}
$smarty->display('tuiguang.tpl');
$smarty->gzip_encode();
?>