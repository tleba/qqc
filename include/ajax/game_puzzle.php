<?php
defined('_VALID') or die('Restricted Access!');
//输出结果
$result = array('status'=>0,'msg'=>'');
$endTime = strtotime('2017-09-30');
if (time() > $endTime) {
    $result['status'] = -6;
    $result['msg'] = '很抱歉，活动已经结束，关注青青草，内容更精彩！';
    echo json_encode($result);
    exit;
}
require $config['BASE_DIR']. '/classes/filter.class.php';
require $config['BASE_DIR']. '/include/adodb/adodb.inc.php';
require $config['BASE_DIR']. '/include/dbconn.php';
require 'classes/Puzzle.class.php';
//验证用户是否登陆
$uid = isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;
//当前是哪天开始玩游戏
$playtime = strtotime(date('Y-m-d'));

if ($uid <= 0) {
    $result['status'] = -3;
    $result['msg'] = '请先登陆';
    set_session_vals(array('redirect'=>'/qhd/puzzle/'));
    echo json_encode($result);exit;
}
$ip = GetRealIP();
//同一个IP只能有一个账户玩
$puzzle_ip_rank = Puzzle::getIpRank(ip2long($ip));
if ($puzzle_ip_rank) {
    if ($puzzle_ip_rank['uid'] != $uid ) {
        $result['status'] = -7;
        $result['msg'] = '很抱歉，同一个IP只能有一个账户能够参加活动！';
        echo json_encode($result);
        exit;
    }
}
//验证是否来自本站页面
$averifier = md5(trim($_SERVER['HTTP_USER_AGENT']).trim($_SERVER['SERVER_SOFTWARE']).$uid.$ip);
$verifier = isset($_SESSION['verifier']) ? $_SESSION['verifier'] : '';
if ($verifier !== $averifier) {
    $result['status'] = -1;
    $result['msg'] = '不是来自本站的请求';
    echo json_encode($result);exit;
}
//验证页面游戏图片
$filter     = new VFilter();
$rtitle = $filter->get('title');
$title = isset($_SESSION['pic']) ? $_SESSION['pic'] : '';
if ($rtitle !== $title) {
    $result['status'] = -2;
    $result['msg'] = '游戏拼图图片不相符';
    echo json_encode($result);exit;
}
//闯关完成的拼图数
$levels = array(
    1=>3,
    2=>6,
    3=>10
);
//获取用户等级，是否已经通关
$puzzle_level = Puzzle::getLevel($playtime, $uid);
if ($puzzle_level && (int)$puzzle_level['level'] === count($levels)) {
    $result['status'] = -5;
    $result['msg'] = '恭喜您，已经完成今天所有拼图任务，赶快去找客服妹妹获取奖励吧！';
    echo json_encode($result);exit;
}

//检查是否来开始游戏？如果是，就生产游戏ID，如果不是，验证是否来自游戏开始入口的游戏ID
//判断是否来自开始游戏入口
$start = $filter->get('start','INTEGER');
if($start){
    $gid = md5($uid.$rtitle.time());
    set_session_vals(array('gid'=>$gid));
    $result['gid'] = $gid;
    $result['msg'] = '生成游戏ID成功';
    echo json_encode($result);exit;
}else{
    $rgid = $filter->get('gid');
    $gid = isset($_SESSION['gid']) ? $_SESSION['gid'] : '';
    if ($rgid !== $gid) {
        $result['status'] = -4;
        $result['msg'] = '请点击重新开始游戏';
        echo json_encode($result);exit;
    }
}
$moves = $filter->get('moves','INTEGER');
//每走一部验证到此结束
$valid = $filter->get('valid','INTEGER');
if ($valid && $moves > 0) {
    echo json_encode($result);
    exit;
}

//开始记录每步产生的结果和完成后的记录结果
$pindex = isset($_SESSION['pindex']) ? intval($_SESSION['pindex']) : 0;
$puzzle = Puzzle::get($uid,$gid,$pindex,$playtime);
if (!$puzzle) {
    $stime = (int)$_SERVER['REQUEST_TIME'];
    $diff = isset($_SESSION['diff'])?$_SESSION['diff']:'0';
    Puzzle::add('puzzle',
        array(
            'uid'=>$uid,
            'gid'=>$gid,
            'title'=>$title,
            'stime'=>$stime,
            'pindex'=>$pindex,
            'playtime'=>$playtime,
            'diff'=>$diff,
        )
    );
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
//开始记录用户等级
if (!$puzzle_level) {
    Puzzle::add('puzzle_level',array(
        'playtime'=>$playtime,
        'uid'=>$uid,
        'username'=>$username
    ));
}
//总记录
$puzzle_rank = Puzzle::getRank($uid);
if (!$puzzle_rank) {
    Puzzle::add('puzzle_rank',array(
        'uid'=>$uid,
        'username'=>$username,
        'ip'=>ip2long($ip)
    ));
}

$isfinish = $filter->get('isfinish','INTEGER');
if ($isfinish) {
    $seconds = $filter->get('seconds','INTEGER');
    $etime = (int)$_SERVER['REQUEST_TIME'];
    if(Puzzle::update('puzzle',array(
        'moves'=>$moves,
        'seconds'=>$seconds,
        'status'=>1,
        'etime'=>$etime
    ),array(
        'uid'=>$uid,
        'gid'=>$gid,
        'pindex'=>$pindex,
        'playtime'=>$playtime
    ))){
        //更新当前用户完成的拼图数及第几关
        $completes = (int)$puzzle_level['completes'] + 1;
        $level = (int)$puzzle_level['level'];
        foreach ($levels as $key => $value) {
            if ($completes >= $value) {
                $level = $key;
            }
        }
        Puzzle::update('puzzle_level',array(
            'completes'=>$completes,
            'level'=>$level
        ),array(
            'playtime'=>$playtime,
            'uid'=>$uid
        ));
        $puzzle_count = Puzzle::getCount($uid);
        if ($puzzle_count) {
            Puzzle::update('puzzle_rank',array(
                'moves'=>$puzzle_count['movesTotal'],
                'seconds'=>$puzzle_count['secondsTotal'],
                'finishpics'=>$puzzle_count['nums'],
                'utime'=>$etime,
                'ip'=>ip2long($ip)
            ),array(
                'uid'=>$uid
            ));
        }
        $result['msg'] = '恭喜您，完成了本轮拼图，请及时联系客服兑换奖励！';
    }else{
        $result['status'] = -4;
        $result['msg'] = '对不起，拼图游戏出现异常，请联系客服！';
    }
}
echo json_encode($result);
exit;