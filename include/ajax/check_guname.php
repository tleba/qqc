<?php
defined('_VALID') or die('Restricted Access!');
require $config['BASE_DIR']. '/classes/filter.class.php';
require $config['BASE_DIR']. '/include/adodb/adodb.inc.php';
require $config['BASE_DIR']. '/include/dbconn.php';
require $config['BASE_DIR'].'/classes/QQCToGame.class.php';
disableRegisterGlobals();
$response = array('flag'=>1,'msg'=>'');
if (isset($_POST['guname'])) {
    $filter     = new VFilter();
    $guname   = $filter->get('guname');
    if(empty($guname)){
        $response['flag'] = false;
        $response['msg'] = '游戏账户名不能为空';
        echo json_encode($response);
        exit;
    }
    //判断是否是指定游戏平台用户
    $firstLetter = substr($guname, 0,1);
    $firstLetterGames = array('c','m');
    if (!in_array($firstLetter, $firstLetterGames)) {
        $response['flag'] = false;
        $response['msg'] = '该游戏账户不支持绑定，请先存款或联系客服查询';
        echo json_encode($response);
        exit;
    }
    if(QQCToGame::find($guname)){
        $response['flag'] = false;
        $response['msg'] = '该账户已被绑定使用';
        echo json_encode($response);
        exit;
    }
    $result = getRemoteData($guname);
    if (!$result) {
        $response['flag'] = false;
        $response['msg'] = '该账户在游戏平台没有找到';
        echo json_encode($response);
        exit;
    }
    $nr = json_decode($result,true);
    if ($nr['status'] == 0) {
        $response['flag'] = false;
        $response['msg'] = '该账户在游戏平台没有找到';
        echo json_encode($response);
        exit;
    }
}
echo json_encode($response);
exit;