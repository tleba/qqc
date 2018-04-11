<?php
defined('_VALID') or die('Restricted Access!');
require $config['BASE_DIR']. '/classes/pagination.class.php';

if ( $config['video_module'] == '0' ) {
    VRedirect::go($config['BASE_URL']. '/error/page_invalid');
}

if ( isset($_GET['clear']) && $_GET['clear'] == 'yes' ) {
    if ( isset($_SESSION['uid']) && $_SESSION['uid'] == $user['UID'] ) {
        $sql        = "DELETE FROM favourite WHERE UID = " .$uid;
        $conn->execute($sql);
        $messages[] = $lang['user.fav_videos_clear'];
    }
}
$page = intval($_GET['page']);
$key = 'u_fv_'.$uid.'_'.$page;
$favorites_arr = array();
$favorites_arr = $public_cache->get($key);
if (empty($favorites_arr)) {
    $sql            = "SELECT count(VID) AS total_videos FROM favourite WHERE UID = " .$uid;
    $rsc            = $conn->execute($sql);
    $total          = $rsc->fields['total_videos'];
    $favorites_arr['total'] = $total;
    
    $pagination     = new Pagination(18);
    $limit          = $pagination->getLimit($total);
    $sql            = "SELECT v.VID, v.title, v.addtime, v.rate, v.likes, v.dislikes, v.viewnumber, v.duration, v.type, v.thumb, v.thumbs, v.hd
                       FROM video AS v, favourite AS f
                       WHERE f.UID = " .$uid. " AND f.VID = v.VID ORDER BY v.VID DESC LIMIT " .$limit;
    $rs             = $conn->execute($sql);
    $favorites      = $rs->getrows();
    $favorites_arr['favorites'] = $favorites;
    
    $page_link      = $pagination->getPagination('user/' .$username. '/favorite/videos');
    $favorites_arr['page_link'] = $page_link;
    $start_num      = $pagination->getStartItem();
    $favorites_arr['start_num'] = $start_num;
    $end_num        = $pagination->getEndItem();
    $favorites_arr['end_num'] = $end_num;
    $public_cache->set($key,$favorites_arr);
}
if (!empty($favorites_arr)) {
    $favorites = $favorites_arr['favorites'];
    $total = $favorites_arr['total'];
    $page_link = $favorites_arr['page_link'];
    $start_num = $favorites_arr['start_num'];
    $end_num = $favorites_arr['end_num'];
}
$self_title     = $username. ' - '.$lang['user.fav_videos'];

$smarty->assign('favorites', $favorites);
$smarty->assign('favorites_total', $total);
$smarty->assign('page_link', $page_link);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
unset($favorites_arr);
?>
