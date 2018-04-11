<?php
defined('_VALID') or die('Restricted Access!');
Auth::checkAdmin();
require $config['BASE_DIR']. '/classes/pagination.class.php';
require $config['BASE_DIR'].'/classes/Puzzle.class.php';
$filter = new VFilter();

$uid = $filter->get('uid','INTEGER','GET');

$sql = 'SELECT username FROM signup WHERE UID = '.$uid.' LIMIT 1;';
$rs = $conn->execute($sql);
$username = '';
if ($rs && $conn->Affected_Rows() > 0) {
    $username = $rs->fields['username'];
}

$sebis = array(3,8,18,28,38,48,58,60,78,88);
$rows = Puzzle::getLevels(array('uid'=>$uid));
if (is_array($rows)) {
    foreach ($rows as $key => &$v) {
        $v['sebis'] = isset($sebis[$v['completes']-1]) ? $sebis[$v['completes']-1] : 0;
    }
}
$smarty->assign('username', $username);
$smarty->assign('rows', $rows);