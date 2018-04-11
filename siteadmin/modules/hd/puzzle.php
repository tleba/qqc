<?php
defined('_VALID') or die('Restricted Access!');
Auth::checkAdmin();
require $config['BASE_DIR']. '/classes/pagination.class.php';
require $config['BASE_DIR'].'/classes/Puzzle.class.php';
$filter = new VFilter();
$where = array();
if (isset($_POST['search_hd'])) {
    $keyword = $filter->get('keyword');
    $where['username'] = array('like',$keyword);
    $_SESSION['puzzle_where'] = json_encode($where);
}
$a = $filter->get('a','STRING','GET');
if (isset($_SESSION['puzzle_where'])) {
    if($a == 'all'){
        del_session_vals(array('puzzle_where'));
    }else{
        $where = json_decode($_SESSION['puzzle_where'],true);
    }
}

$page   = $filter->get('page','INTEGER','GET');
$page = $page <= 0 ? 1 : $page;
$pagesize = 20;
$pageindex = ($page -1 ) * $pagesize;

$total = Puzzle::selectUserRanksTotal($where);
$pagination     = new Pagination($pagesize);
$limit          = $pagination->getLimit($total);
$paging         = $pagination->getAdminPagination('');

$ranks = Puzzle::selectUserRanks($where,$pageindex,$pagesize);
$smarty->assign('rows', $ranks);
$smarty->assign('total', $total);
$smarty->assign('paging', $paging);
$smarty->assign('page', $page);