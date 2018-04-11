<?php
define('_VALID', true);
require '../../include/config.php';
require '../../include/function_smarty.php';
$starttime = strtotime('2016-12-24');
$endtime = strtotime('2017-1-3');
$currtime = time();
$isstart = 0;
require '../../classes/Hongbao.class.php';
require '../../classes/Hbrecommend.class.php';
require '../../classes/Member.class.php';
require '../../classes/Deposit.class.php';
//活动是否开始
if ($starttime < $currtime && $endtime > $currtime) {
    if (isset($_SESSION['uid'])) {
        $ip = ip2long(GetRealIP());
        $uid = $_SESSION['uid'];
        //是否有拆红包的动作
         if (isset($_GET['a']) && $_GET['a'] == 'chai') {
            //随机领取红包
            $result = Member::payHongbao($uid, $ip);
            if ($result === true) {
                VRedirect::gomsg('/qhd/hongbao/','恭喜您领取红包成功');
            }elseif($result == -1){
                VRedirect::gomsg('/qhd/hongbao/','对不起，您已经领取过红包了');
            }else{
                VRedirect::gomsg('/qhd/hongbao/','对不起，您领取红包失败,请与管理员联系!');
            }
         }
        $hongbao = Hongbao::getUid($uid);
        if ($hongbao) {
            $smarty->assign('amount', number_format($hongbao['amount'],2));
            $smarty->assign('totalamount', number_format($hongbao['total'] - $hongbao['detotal'],2));
            $smarty->assign('amount50', 50-($hongbao['total']- $hongbao['detotal']));
            $smarty->assign('amount100', 100-($hongbao['total']- $hongbao['detotal']));
            $smarty->assign('url', 'http://'.$_SERVER['HTTP_HOST'].'/qhd/hongbao/bian.php?u='.$uid);
            $isstart = 3;
        }else{
            $isstart = 2;
        }
        //获取当前登陆用户的热心好友
        $hbusers = Hbrecommend::getHBUsers($uid);
        $hbuserids = array();
        foreach ($hbusers as $v) {
            $hbuserids[] = $v['ruid'];
        }
        //查找到热心好友的名字
        $members = Member::getUsers($hbuserids);
        unset($hbuserids);
        $hbarr = array();
        foreach ($hbusers as $ak => $av){
            foreach ($members as $k => $v) {
                if ($av['ruid'] == $v['UID']) {
                    $hbarr[$ak]['ruid'] = $v['UID'];
                    $hbarr[$ak]['username'] = $v['username'];
                    $hbarr[$ak]['bamount'] = number_format($av['bamount'],2);
                    $hbarr[$ak]['rtime'] = $av['rtime'];
                }
            }
        }
        unset($hbusers);
        unset($members);
        $smarty->assign('hbarr', $hbarr);
    }else{
       $_SESSION['redirect'] = '/qhd/hongbao/';
       $isstart = 1; 
    }
}else{
    $isstart = 0;
}
//红包达人榜
$deposits = Deposit::getDepositHongbag(0,10);
$duids = array();
foreach ($deposits as $v) {
    $duids[] = $v['uid'];
}
$hbs = Hongbao::getHongbaos($duids);
$hdresult = array();
foreach ($deposits as $k => $v) {
    foreach ($hbs as $sk => $sv) {
        if ($v['uid'] == $sv['uid']) {
            $hdresult[$k]['uid'] = $sv['uid'];
            $hdresult[$k]['money'] = $v['money'];
            $hdresult[$k]['total'] = number_format($sv['total'],2);
        }
    }
}
unset($deposits);
unset($hbs);
$nusers = Member::getUsers($duids);
foreach ($hdresult as $k => $v) {
    foreach ($nusers as $sk => $sv) {
        if ($v['uid'] == $sv['UID']) {
            $hdresult[$k]['username'] = $sv['username'];
        }
    }
}
unset($duids);
unset($nusers);
$smarty->assign('hdresult',$hdresult);
//戏包动态
$hbrecommends = Hbrecommend::getAll(0,10,'rtime DESC');
$hbrecommenduserids = array();
foreach ($hbrecommends as $v) {
    $hbrecommenduserids[] = $v['ruid'];
}
$nmembers = Member::getUsers($hbrecommenduserids);
$nhbarr = array();
foreach ($hbrecommends as $sk => $sv) {
    foreach ($nmembers as $k => $v) {
        if ($sv['ruid'] == $v['UID']) {
            $nhbarr[$sk]['ruid'] = $v['UID'];
            $nhbarr[$sk]['username'] = $v['username'];
            $nhbarr[$sk]['bamount'] = number_format($sv['bamount'],2);
            $nhbarr[$sk]['rtime'] = $sv['rtime'];
        }
    }
}
unset($nmembers);
unset($hbrecommends);
$smarty->assign('nhbarr',$nhbarr);
$smarty->assign('isstart', $isstart);
$basedir = dirname(__FILE__);
if (is_mobile()) {
    $tpl = $basedir.'/tpl/mindex.tpl';
}else{
    $tpl = $basedir.'/tpl/index.tpl';
}
$smarty->display($tpl);
$smarty->gzip_encode();