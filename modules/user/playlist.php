<?php
defined('_VALID') or die('Restricted Access!');

require $config['BASE_DIR']. '/classes/pagination.class.php';

if ( isset($_GET['clear']) && $_GET['clear'] == 'yes' ) {
    if ( isset($_SESSION['uid']) && $_SESSION['uid'] == $user['UID'] ) {
        $sql        = "DELETE FROM playlist WHERE UID = " .$uid;
        $conn->execute($sql);
        $messages[] = $lang['user.playlist_all'];
    }
}
$page = intval($_GET['page']);
$key = 'u_playlist_'.$uid.'_'.$page;
$playlist_arr = array();
$playlist_arr = $public_cache->get($key);
if (empty($playlist_arr)) {
    $sql            = "SELECT count(VID) AS total_videos FROM playlist WHERE UID = " .$uid;
    $rsc            = $conn->execute($sql);
    $total          = $rsc->fields['total_videos'];
    $playlist_arr['total'] = $total;
    $pagination     = new Pagination(18);
    $limit          = $pagination->getLimit($total);
    $sql            = "SELECT v.VID, v.title, v.addtime, v.rate, v.likes, v.dislikes, v.viewnumber, v.duration, v.type, v.thumb, v.thumbs, v.hd
                       FROM video AS v, playlist AS p
                       WHERE p.UID = " .$uid. " AND p.VID = v.VID AND v.active = '1'
    				   ORDER BY v.VID DESC LIMIT " .$limit;
    $rs             = $conn->execute($sql);
    $playlist       = $rs->getrows();
    $playlist_arr['playlist'] = $playlist;
    $page_link      = $pagination->getPagination('user/' .$username. '/playlist');
    $playlist_arr['page_link'] = $page_link;
    $start_num      = $pagination->getStartItem();
    $playlist_arr['start_num'] = $start_num;
    $end_num        = $pagination->getEndItem();
    $playlist_arr['end_num'] = $end_num;
    $public_cache->set($key,$playlist_arr);
}
if (!empty($playlist_arr)) {
    $playlist =$playlist_arr['playlist'];
    $total=$playlist_arr['total'];
    $page_link=$playlist_arr['page_link'];
    $start_num= $playlist_arr['start_num'];
    $end_num =$playlist_arr['end_num'];
}
$self_title     = $username. '\'s Playlist';

$smarty->assign('playlist', $playlist);
$smarty->assign('playlist_total', $total);
$smarty->assign('page_link', $page_link);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
unset($playlist_arr);
?>
