<?php
defined('_VALID') or die('Restricted Access!');
Auth::checkAdmin();
require $config['BASE_DIR']. '/classes/pagination.class.php';
require $config['BASE_DIR'].'/classes/TuiGuang.class.php';
$filter = new VFilter();
$where = array();
$a = $filter->get('a','STRING','GET');

$configPath   = $config['BASE_DIR'].'/ps';
$configBase   = '/tuiguang.txt';
if($a == 'cache'){
    $data['day_total_award'] = $filter->get('day_total_award','STRING','POST');
    $data['day_user_total_award'] = $filter->get('day_user_total_award','STRING','POST');
    $data['min_invit_custom'] = $filter->get('min_invit_custom','STRING','POST');
    TuiGuang::write_tuiguang_cache($configPath,$configBase,$data);
}
$configJson = file_get_contents($configPath.$configBase);
$config = json_decode($configJson,true);
$page   = $filter->get('page','INTEGER','GET');
$page = $page <= 0 ? 1 : $page;
$pagesize = 20;
$pageindex = ($page -1 ) * $pagesize;
$total = TuiGuang::selectUserRanksTotal($where);
$pagination     = new Pagination($pagesize);
$limit          = $pagination->getLimit($total);
$paging         = $pagination->getAdminPagination('');
$ranks = TuiGuang::selectUserRanks($where,$pageindex,$pagesize);

$smarty->assign($config);
$smarty->assign('rows', $ranks);
$smarty->assign('total', $total);
$smarty->assign('paging', $paging);
$smarty->assign('page', $page);