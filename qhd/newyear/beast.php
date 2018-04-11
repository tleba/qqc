<?php
define('_VALID', true);
require '../../include/config.php';
$start = strtotime('2017-1-27');
$end = strtotime('2017-2-2');
$ctime = time();
$result = array('code'=>0,'msg'=>'');
//判断游戏是否开始
if (!($ctime > $start && $ctime < $end)) {
    $result['code'] = -1;
    $result['msg'] = '本活动时间还没到或已结束，不可进行操作';
    echo json_encode($result);
    exit;
}
//是否已经登陆
if ($type_of_user === 'guest') {
    $_SESSION['redirect'] = '/qhd/newyear';
    $result['code'] = -2;
    $result['msg'] = '游客不能参加游戏，请去登陆';
    echo json_encode($result);
    exit;
}
$expire = $end - $start;
$options = array(
    'host'=>$config['mem_host'],
    'port'=>$config['mem_port'],
    'prefix'=>'bet',
    'expire'=>$expire,
    'length'=>0
);
$dcache = Cache::getInstance('MemcacheAction',$options);
$gid = 2;
$uid = isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;
$uip = ip2long(GetRealIP());
$uname = isset($_SESSION['username'])?$_SESSION['username']:'';
$today = strtotime(date('Y-m-d'));
require $config['BASE_DIR'].'/include/config.rank.php';
require $config['BASE_DIR'].'/classes/HDGames.class.php';
if (isset($_POST['a']) && $_POST['a'] === 'fried') {
    //年兽序号
    $index = intval($_POST['index']);
    //如果不在范围内的
    if (!($index >= 1 && $index <= 10)) {
        $result['code'] = -3;
        $result['msg'] = '您所炸的年兽不存在';
        echo json_encode($result);exit;
    }
    //获取免费次数
    $fkey = 'fried'.$uid.$today;
    $ffnum = $dcache->get($fkey);
    require $config['BASE_DIR'].'/classes/Member.class.php';
    require $config['BASE_DIR'].'/classes/NSebi.class.php';
    //如果是用色币炸年兽
    if ($ffnum === 'fried_sebi') {
        $nsebi = NSebi::findSebiRecord($uid);
        if (!$nsebi) {
            $result['code'] = -6;
            $result['msg'] = '您是穷光蛋，继续炸年兽的梦想破灭了';
            echo json_encode($result);exit;
        }
        if ($nsebi['sebi_surplus'] <= 0) {
            $result['code'] = -7;
            $result['msg'] = '您的色币已经用完了，请前往充值';
            echo json_encode($result);exit;
        }
    }
    //查找游戏记录
    $hdgames = HDGames::get($gid, $uid);
    $data = array();
    $data[$index] = 1;
    //如果有游戏记录的话
    if ($hdgames) {
        $data = json_decode($hdgames['data'],true);
        if ($data[$index] >= 3) {
            $result['code'] = -5;
            $result['msg'] = '该年兽已成功击毙，不需要再炸了';
            echo json_encode($result);exit;
        }
        $data[$index] += 1;
    }
    //记录炸年兽的数据
    $flag = !$hdgames ? HDGames::add($gid, $uid,$uname, $uip,$data) : HDGames::updateData($gid, $uid,$data);
    if ($flag) {
        //如果用户现在是用sebi来炸年兽,就要扣除用户的色币数
        if ($ffnum === 'fried_sebi') {
            //开始扣除色币
            if(NSebi::updateSebi($uid, -1)){
                $nsebi = NSebi::findSebiRecord($uid);
                if ($nsebi) {
                    Member::updateMemberRank($uid, $nsebi['sebi_surplus']);
                }
                $result['code'] = 1;
                $result['msg'] = '花费色币1个';
            }
        }else{
            $dcache->set($fkey,'fried_sebi');
        }
        //获取结果
        $hdgames = HDGames::get($gid, $uid);
        $data = json_decode($hdgames['data'],true);
        $result['index'] = $index - 1;
        $result['shanghai_count'] =   $data[$index];
        $result['shanghai'] = $data[$index].'次伤害';
        $result['remaining'] = '继续炸'.(3-$data[$index]).'次';
        $result['msg'] = '今天的一次免费鞭炮已用完，继续点击使用色币炸年兽！';
        echo json_encode($result);exit;
    }
}
if(isset($_POST['a']) && $_POST['a'] === 'info'){
    $hdgames = HDGames::get($gid, $uid);
    if ($hdgames) {
       $data = json_decode($hdgames['data'],true);
       $result['data'] = $data;
       echo json_encode($result);
    }
    exit;
}
if (isset($_POST['a']) && $_POST['a'] === 'change') {
    $hdgames = HDGames::get($gid, $uid);
    if (!$hdgames) {
        $result['code'] = -8;
        $result['msg'] = '您还没有炸过年兽';
        echo json_encode($result);exit;
    }
    if (!empty($hdgames['result'])) {
        $result['code'] = -10;
        $result['msg'] = '您已兑换了装备，不能再兑换了';
        echo json_encode($result);exit;
    }
    $data = json_decode($hdgames['data'],true);
    $count = 0;
    foreach ($data as $k => $v) {
        if ($v == 3) {
            $count++;
        }
    }
    if ($count < 10) {
        $result['code'] = -9;
        $result['msg'] = '有年兽还活着，小心它咬你哦';
        echo json_encode($result);exit;
    }
    $zb_index = intval($_POST['zb_index']);
    if (!array_key_exists($zb_index, $beast_zhuangbei)) {
        $result['code'] = -11;
        $result['msg'] = '装备不在可兑换之列';
        echo json_encode($result);exit;
    }
    $expire = strtotime('+1 year');
    $re = array('zb_index'=>$zb_index,'expire'=>$expire);
    if (HDGames::updateResult($gid, $uid, json_encode($re))) {
        $result['msg']='兑换装备成功';
    }else{
        $result['code'] = -13;
        $result['msg'] = '兑换装备失败'; 
    }
    echo json_encode($result);exit;
}