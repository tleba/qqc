<?php
define('_VALID', true);
require '../../include/config.php';
require '../../include/function_smarty.php';
$starttime = strtotime('2016-12-24');
$endtime = strtotime('2017-1-3');
$currtime = time();
$isstart = 0;
require '../../classes/Hbrecommend.class.php';
require '../../classes/Hongbao.class.php';
require '../../classes/Member.class.php';
require '../../classes/Deposit.class.php';
if ($starttime < $currtime && $endtime > $currtime) {
    if (isset($_SESSION['uid'])) {
        if (isset($_GET['a']) && $_GET['a'] == 'increase') {
            //被推荐者
            $uid = round($_GET['uid']);
            if (!Member::getUsers($uid)) {
                VRedirect::gomsg('/qhd/hongbao/bian.php?u='.$uid, '对不起，推荐者在系统中没有找到！');
            }
            //帮援藏者加大红包者
            $ruid = $_SESSION['uid'];
            if ($ruid == $uid) {
                VRedirect::gomsg('/qhd/hongbao/bian.php?u='.$uid, '对不起，您不能既是鬼又是钟馗，他的红包不需要您来加大的！');
            }
            $rip = ip2long(GetRealIP());
            $result = Member::payReHongbao($uid, $ruid, $rip);
            if($result === true){
                VRedirect::gomsg('/qhd/hongbao/bian.php?u='.$uid, '感谢您无私的奉献！好人一生平安！');
            }else{
                if ($result === -3) {
                    VRedirect::gomsg('/qhd/hongbao/bian.php?u='.$uid, '对不起，帮援藏者加大红包失败，可能原因是没有领取到红包！');
                }else{
                    VRedirect::gomsg('/qhd/hongbao/bian.php?u='.$uid, '对不起，您是好人，已经帮推荐者加大红包了，重复操作无效！');
                }
            }
        }
        $isstart = 2;
    }else{
       $_SESSION['redirect'] = '/qhd/hongbao/bian.php?u='.$uid;
       $isstart = 1; 
    }
}else {
    $isstart = 0;
}
$uid = round($_GET['u']);
$hongbao = Hongbao::getUid($uid);
if ($hongbao) {
    $smarty->assign('amount', number_format($hongbao['amount'],2));
    $smarty->assign('totalamount', number_format($hongbao['total'],2));
}
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
$smarty->assign('uid', $uid);
$smarty->assign('isstart', $isstart);
$smarty->assign('nhbarr',$nhbarr);
$basedir = dirname(__FILE__);
if (is_mobile()) {
    $tpl = $basedir.'/tpl/mbian.tpl';
}else{
    $tpl = $basedir.'/tpl/bian.tpl';
}
$smarty->display($tpl);
$smarty->gzip_encode();