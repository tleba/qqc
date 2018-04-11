<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_smarty.php';
$currtime = time();
if (isset($_SESSION['uid'])) {
    $sebi_surplus = 0;
    $uid = intval($_SESSION['uid']);
    $sql = "SELECT sebi_total,sebi_consume,sebi_surplus,sebi_tiyan FROM user_sebi WHERE uid = {$uid} LIMIT 0,1;";
    $rs    = $conn->execute($sql);
    if ($conn->Affected_Rows() === 1) {
        if($premium >0){
            $sebi_surplus = $rs->fields['sebi_surplus'];
        }else{
            $sebi_surplus = $rs->fields['sebi_tiyan'];
        }
    }
    require 'classes/QQCToGame.class.php';
    $gameUser = QQCToGame::findObj($uid);
    $isgameUserNull = 1;
    if ($gameUser) {
        $isgameUserNull = 0;
        $firstLetterGames = array('c'=>'凯时','m'=>'尊龙');
        $firstLetter = substr($gameUser['gusername'], 0,1);
        $smarty->assign('game',$firstLetterGames[$firstLetter]);
        $smarty->assign('istask',($firstLetter === 'm'?1:0));
        $smarty->assign('gusername',$gameUser['gusername']);
    }
    $smarty->assign('isgameUserNull', $isgameUserNull);
    $smarty->assign('sebi_surplus', intval($sebi_surplus));
    //装备显示
    $gid = 2;
    require 'classes/HDGames.class.php';
    $hdgames = HDGames::get($gid, $uid);
    $zb_isshow = false;
    if ($hdgames) {
        $result = json_decode($hdgames['result'],true);
        if ($result['expire'] > $currtime) {
            $zb_isshow = true;
            $smarty->assign('zb_index', $result['zb_index']);
    
        }
    }
    $smarty->assign('zb_isshow', $zb_isshow);
    //装备显示
}
//红包显示
$starttime = strtotime('2016-12-24');
$endtime = strtotime('2017-1-3');
$currdate = strtotime(date('Y-m-d'));
$expire = strtotime('+1 day',$currdate) - $currtime;
$options = array(
    'host'=>$config['mem_host'],
    'port'=>$config['mem_port'],
    'prefix'=>'video',
    'expire'=>$expire,
    'length'=>99999999
);
$cache = Cache::getInstance('MemcacheAction',$options);
$hgkey = session_id().'_'.$currdate;
$isshow = $cache->get($hgkey);
if(!$isshow){
    $cache->set($hgkey,1);
}
$isstart = 0;
if($starttime < $currtime && $endtime > $currtime){
    $isstart = 1;
}
$smarty->assign('isshow',$isshow);
$smarty->assign('isstart',$isstart);
$smarty->assign('remotehost','http://'.$_SERVER['HTTP_HOST']);
$smarty->display('site_login.tpl');
$smarty->gzip_encode();