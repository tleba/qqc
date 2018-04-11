<?php
define('_VALID', true);
require '../../include/config.php';
require '../../include/function_smarty.php';
require '../../classes/Games_task.class.php';
//用户余额
$balance = 0;
//用户存款总额
$deposit = 0;
//用户存款次数
$deposit_count = 0;
//用户流水总额
$bet = 0;
$taskids = array();
if ($type_of_user !== 'guest') {
    $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;
    $start = strtotime(date('Y-m-d'));
    $end = strtotime("+1 day",$start);
    $expire = $end - $start;
    $options = array(
        'host'=>$config['mem_host'],
        'port'=>$config['mem_port'],
        'prefix'=>'task',
        'expire'=>$expire,
        'length'=>0
    );
    $dcache = Cache::getInstance('MemcacheAction',$options);
    $bkey = 'balance'.$uid.$start;
    $bekey = 'bet'.$uid.$start;
    $balance = $dcache->get($bkey);
    $bet = $dcache->get($bekey);
    
    if ($balance === false || $bet === false) {
        require '../../classes/QQCToGame.class.php';
        $qqcToGame = QQCToGame::findObj($uid);
        $gusername = $qqcToGame['gusername'];
        $data_json = getRemoteData($gusername);
        if ($data_json && !empty($data_json)) {
            $data = json_decode($data_json,true);
            $record = isset($data['msg'])?$data['msg']:array();
            foreach ($record as $key => $value) {
                if ($key === 'balance_record') {
                    $balance = $value;
                    $dcache->set($bkey,$balance);
                }
                if ($key === 'bet_record') {
                    $bet = $value;
                    $dcache->set($bekey,$value);
                }
            }
        }
    }
    if ($balance === false) {
        $balance = 0;
    }
    if ($bet === false) {
        $bet = 0;
    }
    require '../../classes/GamesTaskReceive.class.php';
    $taskids = GamesTaskReceive::getUserTask($uid);
    
    require '../../classes/Deposit.class.php';
    $deposit_result = Deposit::getDepositMoneyTotal($uid);
    if ($deposit_result) {
        $deposit = $deposit_result['moneyTotal'];
        $deposit_count = $deposit_result['count'];
    }
}
function compareGamesCondition($num1,$compare,$num2){
    $num1 = floatval($num1);
    $num2 = floatval($num2);
    $result = 0;
    switch ($compare) {
        case '>':
            if($num1 > $num2)
                $result = 1;
            break;
        case '>=':
            if($num1 >= $num2)
                $result = 1;
            break;
        case '<':
            if($num1 < $num2)
                $result = 1;
            break;
        case '<=':
            if ($num1 <= $num2)
                $result = 1;
            break;
        case '==':
            if($num1 == $num2)
                $result = 1;
            break;
    }
    return $result;
}

$rows = Games_task::getAll(0,8,'isshow = 1','`orders` ASC,id DESC');
if($rows){
    foreach ($rows as &$v) {
        if (!empty($taskids) && in_array($v['id'], $taskids['taskids']) && isset($taskids['isposts'][$v['id']]) && $taskids['isposts'][$v['id']] == 0) {
            $v['isreceive'] = 1;
        }elseif(!empty($taskids) && $taskids['isposts'][$v['id']] == 1){
            $v['isreceive'] = 3;
        }else{
            if($type_of_user === 'guest'){
                $v['isreceive'] = -1;
                $_SESSION['redirect'] = '/qhd/task/';
            }else{
                if (!empty($v['condition_arr']) && count($v['condition_arr']) > 0) {
                    $v['isreceive'] = 0;
                    $iscondition = false;
                    $results = array();
                    foreach ($v['condition_arr'] as $svalue) {
                        if(isset($svalue['task_join']) && !empty($svalue['task_join']))
                            array_push($results, $svalue['task_join']);
                        if ($svalue['task_type'] == 1) {
                            $result = compareGamesCondition($balance,$svalue['task_sign'],$svalue['credit']);
                            array_push($results, $result);
                        }
                        if ($svalue['task_type'] == 2) {
                            //比较存款是否符合条件
                            $result = compareGamesCondition($deposit,$svalue['task_sign'],$svalue['credit']);
                            //检查是否要求首次存款，并且存款次数小于0次的，结果就为0
                            if ($svalue['task_isfirst'] == 1 && $deposit_count <= 0) {
                                $result = 0;
                            }
                            array_push($results, $result);
                        }
                        if ($svalue['task_type'] == 3) {
                            $result = compareGamesCondition($bet,$svalue['task_sign'],$svalue['credit']);
                            array_push($results, $result);
                        }
                    }
                    $count = count($results);
                    for ($i = 0; $i < $count; $i++) {
                        if ($results[$i] === '&&') {
                            ++$i;
                            $iscondition = $iscondition && $results[$i];                 
                        }elseif($results[$i] === '||'){
                            ++$i;
                            $iscondition = $iscondition || $results[$i];
                        }else{
                            $iscondition = $results[$i];
                        }
                    }
                    if($iscondition)
                        $v['isreceive'] = 2;
                }else{
                    $v['isreceive'] = 2;
                }
            }
        }
    }
}
if (isset($_POST['a']) && $_POST['a'] === 'exchange') {
    $msg = array('code'=>0,'msg'=>'');
    if($type_of_user === 'guest'){
        $msg['msg'] = '您还未登陆，请登陆';
        $_SESSION['redirect'] = '/qhd/task/';
        echo json_encode($msg);exit;
    }else{
        $id = intval($_POST['id']);
        if($rows){
            $row = null;
            foreach ($rows as $key => $value) {
                if($value['id'] == $id){
                    $row = $value;
                    break;
                }
            }
            if ($row && isset($row['isreceive']) && $row['isreceive'] === 2) {
                if (!class_exists('GamesTaskReceive')) {
                    require '../../classes/GamesTaskReceive.class.php';
                }
                $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;
                if(GamesTaskReceive::add($uid, $row['id'])){
                    $msg['code'] = 1;
                    $msg['task_isfirst'] = $row['condition_str']['task_isfirst'];
                    $msg['msg'] = '任务已成功兑换，请用QQ联系管理员';
                    echo json_encode($msg);exit;
                }else{
                    $msg['msg'] = '任务兑换失败，请确认是否有领取资格';
                    echo json_encode($msg);exit;
                }
            }else{
                $msg['msg'] = '当前任务目前不可领取!';
                echo json_encode($msg);exit;
            }
        }else{
            $msg['msg'] = '未找到可领取的任务项';
            echo json_encode($msg);exit;
        }
    }
}
$smarty->assign('balance',$balance);
$smarty->assign('rows',$rows);
$basedir = dirname(__FILE__);
$tpl = $basedir.'/index.tpl';
if (is_mobile()) {
    $tpl = $basedir.'/pindex.tpl';
}
$smarty->display($tpl);
$smarty->gzip_encode();