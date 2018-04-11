<?php
define('_VALID', true);
require '../../include/config.php';
$start = strtotime('2017-1-27');
$end = strtotime('2017-2-11');
$ctime = time();
$result = array('code'=>0,'msg'=>'');
//判断游戏是否开始
if (!($ctime > $start && $ctime < $end)) {
    $result['code'] = -1;
    $result['msg'] = '本活动时间还没到或已结束，不可进行操作';
    echo json_encode($result);exit;
}
require $config['BASE_DIR'].'/classes/HDBless.class.php';
if (isset($_POST['a']) && $_POST['a'] == 'info') {
    $hdbless = HDBless::get(0,4,'isshow = 1','atime DESC');
    if($hdbless){
        foreach ($hdbless as &$v) {
            foreach ($v as $sk=>$sv){
                if($sk == 'atime'){
                    $v['atime'] = date('m-d H:i:s');
                }
            }
        }
    }else{
        $hdbless = array();
    }
    $result['bless'] = $hdbless;
    echo json_encode($result);
    exit;
}
//是否已经登陆
if ($type_of_user === 'guest') {
    $_SESSION['redirect'] = '/qhd/newyear';
    $result['code'] = -2;
    $result['msg'] = '游客不能参加游戏，请去登陆';
    echo json_encode($result);exit;
}
$uid = isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;

if (isset($_POST['a']) && $_POST['a'] == 'bless') { 
    $uip = ip2long(GetRealIP());
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
    $blkey = 'bless'.$uip.$today;
    $isbless = $dcache->get($blkey);
    if ($isbless) {
        $result['code'] = -3;
        $result['msg'] = '每个IP用户日均一次送出祝福机会';
        echo json_encode($result);exit;
    }
    require $config['BASE_DIR']. '/classes/filter.class.php';
    $filter     = new VFilter();
    $qq = $filter->get('qq','STRING');
    if (empty($qq)) {
        $result['code'] = -5;
        $result['msg'] = 'QQ号码未填写';
        echo json_encode($result);exit;
    }
    $context = $filter->get('context','STRING');
    if (empty($context)) {
        $result['code'] = -6;
        $result['msg'] = '未填写新年祝福';
        echo json_encode($result);exit;
    }
    $uname = $_SESSION['username'];
    $dcache->set($blkey,1);
    if(HDBless::add($uid, $uname, $uip, $qq, $context)){
        $result['msg'] = '祝福成功送出，审核后就会显示出来';   
    }else{
        $result['code'] = -4;
        $result['msg'] = '祝福送出失败';
    }
    echo json_encode($result);exit;
}