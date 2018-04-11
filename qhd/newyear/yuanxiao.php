<?php
define('_VALID', true);
require '../../include/config.php';
$start = strtotime('2017-2-3');
$end = strtotime('2017-2-11');
$ctime = time();
$result = array('code'=>0,'msg'=>'');
//判断游戏是否开始
if (!($ctime > $start && $ctime < $end)) {
    $result['code'] = -1;
    $result['msg'] = '本活动时间还没到或已结束，不可进行操作';
    echo json_encode($result);exit;
}
//是否已经登陆
if ($type_of_user === 'guest') {
    $_SESSION['redirect'] = '/qhd/newyear';
    $result['code'] = -2;
    $result['msg'] = '游客不能参加游戏，请去登陆';
    echo json_encode($result);exit;
}
$gid = 4;
$uid = isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;
$uname = isset($_SESSION['username'])?$_SESSION['username']:'';
//判断用户是否是在活动期间存款并且>=100
require $config['BASE_DIR'].'/classes/Deposit.class.php';
$deposit = Deposit::getTimeDepositMoney($uid, $start, $end);
if (!$deposit) {
    $result['code'] = -6;
    $result['msg'] = '请先前往充值';
    echo json_encode($result);exit;
}
$total_money = array_sum($deposit);
if ($total_money < 100) {
    $result['code'] = -7;
    $result['msg'] = '活动期间内有存款且满足存款≥100会员方可参与';
    echo json_encode($result);exit;
}
$today = strtotime(date('Y-m-d'));
$expire = $end - $start;
$options = array(
    'host'=>$config['mem_host'],
    'port'=>$config['mem_port'],
    'prefix'=>'yx',
    'expire'=>$expire,
    'length'=>0
);
$dcache = Cache::getInstance('MemcacheAction',$options);
$yxkey = 'yx'.$uid.$today;
$isuse = $dcache->get($yxkey);
if ($isuse) {
    $result['code'] = -3;
    $result['msg'] = '您今天的一次免费猜灯机会已经用完';
    echo json_encode($result);exit;
}
require $config['BASE_DIR'].'/include/config.rank.php';
//获取用户选择的灯笼
$yx_index = intval($_POST['yx_index']);
//打乱后灯笼排序
$jiangpings_index = $_SESSION['yuanxiao_jp_index'];
//记录用户猜的次数
$dcache->set($yxkey,1);
unset($_SESSION['yuanxiao_jp_index']);
//检查选择的灯笼是否在范围之内
if (isset($jiangpings_index[$yx_index])) {
    //奖品对应的ID
    $index = $jiangpings_index[$yx_index];
    if (empty($yuanxiao_jp[$index])) {
        $result['code'] = -4;
        $result['msg'] = '<p style="margin-top:5px;">没猜到哦</p><p style="margin-top:5px;">明天继续</p><p style="margin-top:5px;">再接再厉</p>';
        echo json_encode($result);exit;
    }
    $uip = ip2long(GetRealIP()); 
    $data = array();
    require $config['BASE_DIR'].'/classes/HDGames.class.php';
    $hdgames = HDGames::get($gid, $uid);
    if ($hdgames) {
        $data = json_decode($hdgames['data'],true);
        $data[$ctime] = $index;
        HDGames::updateData($gid, $uid,$data);
    }else{
        $data[$ctime] = $index;
        HDGames::add($gid, $uid,$uname, $uip,$data);
    }
    $result['msg'] = '<p style="margin-top:5px;">恭喜中奖</p><strong>'.$yuanxiao_jp[$index].'</strong><p style="margin-top:5px;">联系客服兑换</p>';
    echo json_encode($result);exit;
}else{
    $result['code'] = -5;
    $result['msg'] = '没有设置该奖品';
    echo json_encode($result);exit;
}