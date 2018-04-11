<?php
define('_VALID', true);
require '../../include/config.php';

$basedir = dirname(__FILE__);
//获取缓存中的图片数据
require '../../classes/Puzzle.class.php';
//获取当前登陆用户的UID
$uid =isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;

//获取当前用户已经成功完成的记录
$upuzzles = Puzzle::getAll(array('uid'=>$uid,'status'=>1),0,52,'id DESC');
//获取已经使用过的图片名称
$usedPics = array();
if ($upuzzles) {
    foreach ($upuzzles as $v) {
        if (!in_array($v, $usedPics)) {
            $usedPics[] = $v['title'];
        }
    }
}
//过滤掉已经使用过的图片，让用户每次提到都是没有拼成功或未拼过的图片
$pics = Puzzle::getPic($cache,$usedPics,$basedir);
//当前是哪天开始玩游戏
$playtime = strtotime(date('Y-m-d'));

//验证身份
$ip = GetRealIP();
$verifier = md5(trim($_SERVER['HTTP_USER_AGENT']).trim($_SERVER['SERVER_SOFTWARE']).$uid.$ip);
set_session_vals(array('verifier'=>$verifier,'pic'=>$pics['pic'],'pindex'=>$pics['picindex']));

//连续玩就适当增加难度
$levels = array(
  1=>array(1,2,3),
  2=>array(4,5,6),
  3=>array(7,8,9,10)
);
$difficulty = array(
    1=>array(3,3),
    2=>array(3,4),
    3=>array(4,3),
    4=>array(4,4)
);
$diff = 1;
$level = 1;
$completes = 0;
$puzzle_level = Puzzle::getLevel($playtime, $uid);
if ($puzzle_level) {
    $level = (int)$puzzle_level['level'] + 1;
    $completes = (int)$puzzle_level['completes'] + 1;
    foreach ($levels as $key => $value) {
        if ($level === $key) {
            foreach ($value as $k=>$v) {
                if ($v === $completes) {
                    $diff = $k + 1;
                    break;
                }
            }
        }
    }
}
list($rows,$cols) = $difficulty[$diff];
set_session_vals(array('diff'=>$rows.'X'.$cols));
//随机获取hole值
$max = $rows*$cols;
$num = mt_rand(1, $max);

//打乱次数
$rounds = 3;
if ($completes % 2 === 0) {
    $rounds = $rounds + 1;
}else if($completes % 3 === 0){
    $rounds = $rounds + 2;
}
$smarty->assign('rounds',$rounds);
$smarty->assign('level',$level);
$smarty->assign('rows', $rows);
$smarty->assign('cols', $cols);
$smarty->assign('hole', $num);

//今日完成拼图
$todayUsedPics = array();
if ($upuzzles) {
    foreach ($upuzzles as $v) {
        if ((int)$v['playtime'] === $playtime) {
            $todayUsedPics[] = $v['title'];
        }
    }
}
//奖励色币数
$sebis = array(3,8,18,28,38,48,58,60,78,88);
$smarty->assign('todayUsedPics',count($todayUsedPics));
$sebiNum = isset($sebis[count($todayUsedPics)-1]) ? $sebis[count($todayUsedPics)-1] : 0;
$smarty->assign('sebis',$sebiNum);
//当前用户总排名
$currUserRank = 0;
$userRank = Puzzle::getUserRank($uid);
if ($userRank) {
    $currUserRank = $userRank['rank'];
}
$smarty->assign('urank',$currUserRank);
//成功闯关人员
$userLevels = Puzzle::getLevels();
if (is_array($userLevels)) {
    foreach ($userLevels as &$v) {
        if ($v['level'] == 0) {
            $v['level'] = '完成'.(isset($v['completes']) ? $v['completes'] : 0).'副拼图';
        }else{
            $v['level'] = '第'.$v['level'].'关';
        }
        $v['sebi'] = isset($sebis[$v['completes'] - 1]) ? $sebis[$v['completes'] - 1]:0;
    }
}
$smarty->assign('userLevels',$userLevels);
//成功闯关人数
$chuangguanNums = Puzzle::getChuangGuanCount();
$smarty->assign('chuangguanNums',$chuangguanNums);
//拼图荣誉榜
$userRanks = Puzzle::getUserRanks($cache);
$smarty->assign('userRanks',$userRanks);
//累计完成拼图数
$smarty->assign('usedPicTotal',count($usedPics));
//输出图片文件
$smarty->assign('pic', $pics['pic']);
//输出图片名称
$smarty->assign('picname', $pics['picname']);
if (is_mobile()) {
    $tpl = $basedir.'/tpl/mindex.tpl';
}else{
    $tpl = $basedir.'/tpl/index.tpl';
}
$smarty->display($tpl);
//$smarty->gzip_encode();