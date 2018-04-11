<?php
define('_VALID', true);
require 'include/config.php';
require 'include/config.rank.php';
require 'include/config.products.php';

$r = get_request_arg('return','string');
if (empty($r)) {
    exit;
}
require 'classes/Member.class.php';
$unameArr = explode(',', $r);
$sql = 'SELECT uid FROM qqc_game WHERE gusername = \'%s\'';
$existArr = array();
foreach ($unameArr as $v) {
    $uname = mysql_real_escape_string($v);
    $msql = sprintf($sql,$uname);
    $rs = $conn->execute($msql);
    if ($rs && $conn->Affected_Rows() > 0) {
        $uid = $rs->fields['uid'];
        $existArr[$v] = $uid;
        Member::updateUserProducts($uid, $uname);
    }
}

if (count($existArr) > 0) {
    $remoteArr = array();
    foreach ($existArr as $k => $vuid) {
        $return = getRemoteData($k);
        //如果后面有多个平台就要注意了
        $remoteArr[$vuid] = $return;
    }
    unset($unameArr);
    unset($existArr);
    require 'classes/Deposit.class.php';
    require 'classes/NSebi.class.php';
    foreach ($remoteArr as $kvuid => $v) {
        //查找存款记录，添加记录，追加色币
        $result = json_decode($v,true);
        if ($result['status'] == 0) {
            break;
        }
        foreach ($result['msg'] as $sk =>$sv) {
            if (strpos($sk, 'deposit_') !== false) {
                list($key,$time) = explode('_', $sk);
                $re = Deposit::isRepeatRecord($kvuid, $time);
                if (!$re) {
                    $r = Member::deposit($kvuid, $sv, $time);
                }
            }
            unset($result['msg'][$sk]);
        }
    }
    unset($remoteArr);
}