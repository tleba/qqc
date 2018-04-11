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
$where = array();
$where['uid'] = $uid;
$total = Puzzle::getPuzzleTotal($where);

$page   = $filter->get('page','INTEGER','GET');
$page = $page <= 0 ? 1 : $page;
$pagesize = 20;
$pageindex = ($page -1 ) * $pagesize;

$pagination     = new Pagination($pagesize);
$limit          = $pagination->getLimit($total);
$paging         = $pagination->getAdminPagination('');

$rows = Puzzle::getAll($where,$pageindex,$pagesize,'id desc');
if (is_array($rows)) {
    foreach ($rows as $k => &$v) {
        $v['stime'] = date('Y-m-d H:i:s',$v['stime']);
        $v['etime'] = ($v['etime'] == 0) ? 0 :date('Y-m-d H:i:s',$v['etime']);
    }
}
$smarty->assign('username', $username);
$smarty->assign('rows', $rows);
$smarty->assign('total', $total);
$smarty->assign('paging', $paging);
$smarty->assign('page', $page);