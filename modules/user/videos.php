<?php
defined('_VALID') or die('Restricted Access!');

require $config['BASE_DIR']. '/classes/pagination.class.php';
$page = intval($_GET['page']);
$key = 'u_videos_'.$uid.'_'.$page;
$videoslist_arr = array();
$videoslist_arr = $public_cache->get($key);
if (empty($videoslist_arr)) {
    $sql            = "SELECT COUNT(VID) AS total_videos FROM video WHERE UID = " .$uid. " AND active = '1'";
    $rsc            = $conn->execute($sql);
    $total          = $rsc->fields['total_videos'];
    $videoslist_arr['total'] = $total;
    
    $pagination     = new Pagination(18);
    $limit          = $pagination->getLimit($total);
    $sql            = "SELECT VID, title, addtime, rate, likes, dislikes, viewnumber, duration, type, thumb, thumbs, hd FROM video
                       WHERE UID = " .$uid. " AND active = '1' ORDER BY VID DESC LIMIT " .$limit;
    $rs             = $conn->execute($sql);
    $videos         = $rs->getrows();
    $videoslist_arr['videos'] = $videos;
    $page_link      = $pagination->getPagination('user/' .$username. '/videos');
    $videoslist_arr['page_link'] = $page_link;
    $start_num      = $pagination->getStartItem();
    $videoslist_arr['start_num'] = $start_num;
    $end_num        = $pagination->getEndItem();
    $videoslist_arr['end_num'] = $end_num;
}
if (!empty($videoslist_arr)) {
    $videos = $videoslist_arr['videos'];
    $total = $videoslist_arr['total'];
    $page_link = $videoslist_arr['page_link'];
    $start_num = $videoslist_arr['start_num'];
    $end_num = $videoslist_arr['end_num'];
}
$smarty->assign('type', $type);
$smarty->assign('videos', $videos);
$smarty->assign('videos_total', $total);
$smarty->assign('page_link', $page_link);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
unset($videoslist_arr);
?>
