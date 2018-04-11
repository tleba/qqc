<?php
define('_VALID', true);
require '../../include/config.php';
$start = strtotime('2017-1-27');
$end = strtotime('2017-2-11');
$ctime = time();
$result = array('code'=>0,'msg'=>'');
$expire = $end - $start;
$options = array(
    'host'=>$config['mem_host'],
    'port'=>$config['mem_port'],
    'prefix'=>'dpg',
    'expire'=>$expire,
    'length'=>0
);
$dcache = Cache::getInstance('MemcacheAction',$options);
//材料
$materials = array(1=>'饺子皮',2=>'白菜',3=>'肉',4=>'调味料',);
//材料数量
$materials_num = array(1=>300,2=>300,3=>300,4=>300,);
//页面显示材料及材料数
$today = strtotime(date('Y-m-d'));
$mnkey =  'matnum'.$today;
if (isset($_POST['a']) && $_POST['a'] === 'info') {
    //材料名称
   $result['name'] = $materials;
   //查找当日是否已经有初始化材料数量的数据
   $cresult = $dcache->get($mnkey);
   //如果没有，就设置
   if ($cresult) {
       $result['num'] = $cresult;
   }else{
       //当日设置材料数量
       $dcache->set($mnkey,$materials_num);
       $result['num'] = $materials_num;
   }
   echo json_encode($result);
   exit;
}
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
require $config['BASE_DIR'].'/classes/HDGames.class.php';
//获取当前用户抢到材料的名单
$uid = isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;
$gid = 1;
$uip = ip2long(GetRealIP());
$uname = isset($_SESSION['username'])?$_SESSION['username']:'';
if (isset($_POST['a']) && $_POST['a'] === 'get_user_materials') {
    $hdgames = HDGames::get($gid, $uid);
    if($hdgames){
        $data = json_decode($hdgames['data']);
        $result['user_materials'] = $data;
    }
    echo json_encode($result);
    exit;
}
//获取随机数
function get_rand($arr){
    $result = 0;
    $arr_total = array_sum($arr);
    foreach ($arr as $k => $v) {
        $rand = mt_rand(1, $arr_total);
        if ($rand <= $v) {
            $result = $k;
            break;
        }else{
            $arr_total -= $v;
        }
    }
    unset($arr);
    return $result;
}
//抢材料
if (isset($_POST['a']) && $_POST['a'] === 'make_materials') {
    $ipgames = HDGames::getIpRecord($gid, $uip);
    if ($ipgames && $ipgames['uid'] != $uid) {
        $result['code'] = -6;
        $result['msg'] = '同一个IP地址下只有一个用户有机会抢材料';
        echo json_encode($result);
        exit;
    }
    //获取用户抢料次数
    $mmkey = 'make_materials_'.$uid.$today;
    $make_num = $dcache->get($mmkey);
    if ($make_num >= 3) {
        $result['code'] = -3;
        $result['msg'] = '今天的抢料次数已经用完';
        echo json_encode($result);
        exit;
    }
    $cresult = $dcache->get($mnkey);
    if($cresult){
        $total = 0;
        foreach ($cresult as $k=>$v){
            $total += $v;
        }
        if ($total <= 0) {
            $result['code'] = -4;
            $result['msg'] = '今天的材料已被抢完';
            echo json_encode($result);
            exit;
        }
    }
    if(!is_numeric($make_num)){
        $make_num = 0;
    }
    //获取当前用户的材料数据
    $hdgames = HDGames::get($gid, $uid);
    $data = array(1=>0,2=>0,3=>0,4=>0,);
    if ($hdgames) {
        $data = json_decode($hdgames['data'],true);
    }
    //产生随机数
    $index = get_rand($cresult);
    if ($index == 0) {
        $result['code'] = -7;
        $result['msg'] = '产生结果有误,请继续!';
        echo json_encode($result);
        exit;
    }
    //将对应的材料数量上+1
    $data[$index] += 1;
    //将当前抢料的数据存储
    $flag = !$hdgames ? HDGames::add($gid, $uid,$uname,$uip,$data) : HDGames::updateData($gid, $uid,$data);
    if($flag){
        //记录用户今天抢料的次数
        $make_num += 1;
        $dcache->set($mmkey,$make_num);
        //以下更新各个材料的数量值
        if ($cresult) {
            $cresult[$index] -= 1;
            $dcache->set($mnkey,$cresult);
        }
    }
    $result['name'] = $materials[$index];
    $result['user_materials'] = $data;
    echo json_encode($result);
    exit;
}
//用材料包饺子
if (isset($_POST['a']) && $_POST['a'] === 'make_dumplings') {
    //获取到当前用户的材料
    $hdgames = HDGames::get($gid, $uid);
    if ($hdgames) {
        $data = json_decode($hdgames['data'],true);
        if (empty($data)) {
           $result['dumplings_num'] = 0;
        }else{
            sort($data);
            $result['dumplings_num'] = $data[0];
        }
    }else {
        $result['dumplings_num'] = 0;
    }
    echo json_encode($result);
    exit;
}
//饺子数量兑换色币
$materials2sebi = array(1=>8,2=>18,3=>58,4=>88,5=>888,);
//对换规则
function getMaterials2sebi($materialsNum,$keys,$index=0){
    static $result = array();
    if ($materialsNum > 0) {
        if($materialsNum >=  $keys[$index]){
            $materialsNum = $materialsNum - $keys[$index];
            $result[]= $keys[$index];
        }
        if ($materialsNum < $keys[$index]){
            $index++;
        }
        getMaterials2sebi($materialsNum,$keys,$index);
    }
    return $result;
}
//用户兑换结果
function getUserSebi($materialsNum){
    global $materials2sebi;
    arsort($materials2sebi);
    $keys = array_keys($materials2sebi);
    $results = getMaterials2sebi($materialsNum,$keys);
    $total = 0 ;
    foreach ($results as $k => $v) {
        $total += $materials2sebi[$v];
    }
    return $total;
}
if (isset($_POST['a']) && $_POST['a'] === 'change') {
    require $config['BASE_DIR'].'/classes/NSebi.class.php';
    //获取要兑换的数据
    $hdgames = HDGames::get($gid, $uid);
    //如果存在
    if ($hdgames) {
        $data = json_decode($hdgames['data'],true);
        if (!empty($data)) {
            $odata = $data;
            sort($data);
            //如果饺子数量为0
            if($data[0] == 0){
                $result['code'] = -5;
                $result['msg'] = '饺子数量为0';
                $result['sebi_count'] = 0;
                echo json_encode($result);
                exit;
            }
            //将饺子数兑换成色币
            $sebi_count = getUserSebi($data[0]);
            //向用户添加色币
            $sebi = NSebi::findSebiRecord($uid);
            //如果没有色币记录，就添加一条
            if (!$sebi) {
                NSebi::addSebiRecord($uid);
            }
            //如果色币添加成功,就将用户对应升级，并且扣除能够包饺子的材料数量
            if(NSebi::updateSebi($uid, $sebi_count)){
                $sebi = NSebi::findSebiRecord($uid);
                if ($sebi) {
                    require $config['BASE_DIR'].'/include/config.rank.php';
                    require $config['BASE_DIR'].'/classes/Member.class.php';
                    Member::updateMemberRank($uid, $sebi['sebi_surplus']);
                }
                foreach ($odata as &$v) {
                    $v = $v - $data[0];
                }
                HDGames::updateData($gid, $uid,$odata);
                $hdgame = HDGames::get($gid, $uid);
                $re = round($hdgame['result']) + $data[0];
                HDGames::updateResult($gid, $uid, $re);
            }
            $result['sebi_count'] = $sebi_count;
            echo json_encode($result);
            exit;
        }
    }
    $result['sebi_count'] = 0;
    echo json_encode($result);
    exit;
}