<?php
define('_VALID', true);
include 'include/config.ajax.php';
disableRegisterGlobals();
$time = strtotime(date('Y-m-d'));
$tomorrow = $time + 86400;
$expire = $tomorrow - time();
$options = array(
    'host'=>$config['mem_host'],
    'port'=>$config['mem_port'],
    'prefix'=>'sebi',
    'expire'=>$expire,
    'length'=>99999999
);
$cache = Cache::getInstance('MemcacheAction',$options);
$options['prefix'] = 'sebiv';
$tcache = Cache::getInstance('MemcacheAction',$options);
//根据不同的用户类型设置奖励色币
$type_of_user_str = '';
$is_show = false;
$tpl_msg = '欢迎您访问本站点，特此奖励%s个体验币，有了它，您就有机会免费观看视频哦！';
$msg = '';
$ip = GetRealIP();
$uid =  isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;
if ($type_of_user == 'guest' && isset($config['visitors_sebi_select']) && $config['visitors_sebi_select'] == 1) {
    $ip = ip2long($ip);
    //游客的验证逻辑
    $result = $cache->get($ip.$time);//记录在缓存里
    if(!$result){
        //获取当前访问游客的信息
        $sql = "SELECT guest_id, sebi_total,sebi_consume FROM guests WHERE guest_ip = {$ip} and last_login = {$time} LIMIT 0,1;";
        $rs    = $conn->execute($sql);
        //如果游客今天没有被奖励过
        if ( $conn->Affected_Rows() === 0 ) {
        	$num = intval($config['visitors_sebi']);//获得到奖励的色币数
        	//记录用户得到的奖励信息
        	$sql = "INSERT INTO guests (guest_ip,last_login,sebi_total , sebi_consume) VALUES ({$ip},{$time},{$num},0);";
        	$rs = $conn->execute($sql);
        	if ($rs && $conn->Affected_Rows()>0) {
        		$type_of_user_str = '游客';
        		$is_show = true;
        		$msg = sprintf($tpl_msg,$num);
        		$cache->set($ip.$time,$type_of_user_str.'|'.$ip.'|'.$time.'|'.$msg);
        	}
        }
    }
}elseif ($type_of_user == 'free' && isset($config['free_sebi_select']) && $config['free_sebi_select'] == 1){
    //以下奖励色币逻辑
    $result = $cache->get($uid.$time);
    if (!$result){
        $num = intval($config['free_sebi']);//普通用户每天登陆访问后奖励的色币数
        //查找当前用户的体验币情况
    	$sql = "SELECT sebi,sebi_tiyan,jiangli_time FROM user_sebi WHERE uid = {$uid}  LIMIT 0,1;";
    	$rs    = $conn->execute($sql);
        //如果当前用户在之前是已经获得过奖励
    	if ($conn->Affected_Rows() == 1) {
    	    //判断当前用户今天有没有获得奖励
    	    $sql = "SELECT sebi,sebi_tiyan,jiangli_time FROM user_sebi WHERE uid = {$uid} and jiangli_time = '{$time}' LIMIT 0,1;";
    	    $rs    = $conn->execute($sql);
    	    //如果没有得到奖励，就给予一定的奖励
    	    if ( $conn->Affected_Rows() === 0 ) {
    	        $sql = "UPDATE user_sebi set sebi = sebi + '{$num}',sebi_tiyan = sebi_tiyan+'{$num}',jiangli_time = {$time},isfree =1 where uid = {$uid} LIMIT 1;";
    	        $iurs = $conn->execute($sql);
    	        $tcache->_unset($uid.$time.'free');
    	    }
    	}else{//之前从未得到过奖励的,通过IP判断是否存在同一个IP上多个用户名得到奖励
    	    $sql = "SELECT uid FROM user_sebi WHERE ip = '{$ip}'  LIMIT 0,1;";
    	    $rs    = $conn->execute($sql);
    	    //如果没有在同一个IP的用户名，就给予相应的色币奖励
    	    if ( $conn->Affected_Rows() === 0 ) {
    	        $sql = "INSERT INTO user_sebi (uid,sebi,sebi_tiyan,jiangli_time,ip,isfree) VALUES ('{$uid}','{$num}','{$num}','{$time}','{$ip}',1);";
    	        $iurs = $conn->execute($sql);
    	        $tcache->_unset($uid.$time.'free');
    	    }
    	}
    	//输出色币奖励相关信息
    	if ($iurs) {
    	    $is_show = true;
    	    $type_of_user_str = $_SESSION['username'];
    	    $msg = sprintf($tpl_msg,$num);
    	    $cache->set($uid.$time,$type_of_user_str.'|'.$uid.'|'.$time.'|'.$msg);
    	}
    }
}
if ($is_show) {
    $smarty->assign('msg', $msg);
    $smarty->assign('type_of_user_str', $type_of_user_str);
    $smarty->assign('prompt','每天登陆，会有丰富的奖励哦！');
    $smarty->assign('but_msg','<a href="/hdong/vip/" style="margin-right:10px;"><img src="/templates/frontend/frontend-default/img/s2.png"></a>');
}
//检测当前用户是否绑定游戏账号，并且是否得到色币或体验币奖励
if ($uid > 0 && !$is_show) {
    $premium = intval($_SESSION['uid_premium']);
    $tpl_msg = '恭喜您，绑定游戏账号给予%s%s奖励!';
    require 'classes/QQCToGame.class.php';
    require 'include/config.rank.php';
    if (QQCToGame::findObjIsGetsebi($uid, 0)) {
        require 'classes/NSebi.class.php';
        if (!NSebi::findSebiRecord($uid)) {
            NSebi::addSebiRecord($uid);
        }
        if ($type_of_user == 'free') {
            $msg = sprintf($tpl_msg,'10个','体验币');
            $sbresult = NSebi::updateTiYanbi($uid, 10);
        }elseif($type_of_user == 'premium'){
            require 'classes/Member.class.php';
            if ($premium === 1) {
                $msg = sprintf($tpl_msg,'10个','色币');
                $sbresult = NSebi::updateSebi($uid, 10);
                if ($sbresult) {
                    $record = NSebi::findSebiRecord($uid);
                    $r = Member::updateMemberRank($uid, $record['sebi_surplus']);
                    if ($r !== false) {
                        set_session_vals(array('uid_premium'=>$r));
                    }
                }
            }elseif($premium === 2){
                $msg = sprintf($tpl_msg,'10天','累加');
                $sbresult = Member::updateUserYearTime($uid, 10);
            }
        }
        if($sbresult){
            $is_show = true;
            QQCToGame::setIsgetsebi($uid, 1);
            $type_of_user_str = $_SESSION['username'];
            $smarty->assign('msg', $msg);
            $smarty->assign('prompt','您已加到游戏筹码，进入游戏投注领取免费色币');
            $smarty->assign('but_msg','<a href="http://www.dd00d.net/" target="_blank" style="background-color:#17937b;padding:5px;color:#fff;margin-top:5px;">立即游戏</a>');
            $smarty->assign('type_of_user_str', $type_of_user_str);
        }
    }
}
//拼图
$ispuzzleshow = true;
$totay = strtotime(date('Y-m-d'));
$ukey = $ip;
if ($uid > 0) {
    $ukey = $uid;
}
$puzzleKey = '_firstpuzzleshow'.$totay.$ukey;
$isfirstpuzzleshow = $cache->get($puzzleKey);
$endTime = strtotime('2017-08-29');
if (time() > $endTime || $isfirstpuzzleshow) {
    $ispuzzleshow = false;
}else{
    $cache->set($puzzleKey,1,0);
}
$cache->close();
$smarty->assign('ispuzzleshow',$ispuzzleshow);
$smarty->assign('type_of_user',$type_of_user);
$smarty->assign('is_show',$is_show);
$smarty->display('sebi.tpl');
$smarty->gzip_encode();