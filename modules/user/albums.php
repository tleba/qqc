<?php
defined('_VALID') or die('Restricted Access!');
require $config['BASE_DIR']. '/classes/pagination.class.php';

$page = intval($_GET['page']);
$key = 'u_alb_'.$uid.'_'.$page;
$albums_arr = array();
$albums_arr = $public_cache->get($key);
if (empty($albums_arr)) {
    $sql            = "SELECT COUNT(AID) AS total_albums FROM albums WHERE UID = " .$uid. " AND status = '1'";
    $rsc            = $conn->execute($sql);
    $total          = $rsc->fields['total_albums'];
    $albums_arr['total'] = $total;
    
    $pagination     = new Pagination(18);
    $limit          = $pagination->getLimit($total);
    $sql            = "SELECT * FROM albums WHERE UID = " .$uid. " AND status = '1' LIMIT " .$limit;
    $rs             = $conn->execute($sql);
    $albums         = $rs->getrows();
    $albums_arr['albums'] = $albums;
    
    $page_link      = $pagination->getPagination('user/' .$username. '/albums');
    $albums_arr['page_link'] = $page_link;
    $start_num      = $pagination->getStartItem();
    $albums_arr['start_num'] = $start_num;
    $end_num        = $pagination->getEndItem();
    $albums_arr['end_num'] = $end_num;
    
    $public_cache->set($key,$albums_arr);
}

if (!empty($albums_arr)) {
    $total = $albums_arr['total'];
    $albums = $albums_arr['albums'];
    $page_link = $albums_arr['page_link'];
    $start_num = $albums_arr['start_num'];
    $end_num = $albums_arr['end_num'];
}

$self_title     = $username. '\'s Photo Albums';

$smarty->assign('albums_total', $total);
$smarty->assign('albums', $albums);
$smarty->assign('page_link', $page_link);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
unset($albums_arr);
?>
