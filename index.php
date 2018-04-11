<?php
define('_VALID', true);

require 'include/config.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';


$sql_add	= NULL;
$sql_delim	= ' WHERE';
if ( $config['show_private_videos'] == '0' ) {
    $sql_add   .= $sql_delim. " type = 'public'";
    $sql_delim	= ' AND';
}

$sql_add       .= $sql_delim. " active = '1'";

$sql            = "SELECT VID, title, duration, addtime, thumb, thumbs, viewnumber, rate, likes, dislikes, type, hd
                   FROM video" .$sql_add. " AND tuijian = 3 ORDER BY viewtime DESC LIMIT " .$config['watched_per_page'];
$rs             = $conn->execute($sql);
$viewed_videos  = $rs->getrows();
//$viewed_videos  = ($rs=="") ? trim($rs) : trim($rs->getrows());
$viewed_total   = count($viewed_videos);
$sql            = "SELECT VID, title, duration, addtime, thumb, thumbs, viewnumber, rate, likes, dislikes, type, hd
                   FROM video" .$sql_add. "  AND tuijian = 2 ORDER BY addtime DESC LIMIT " .$config['recent_per_page'];
$rs             = $conn->execute($sql);

$recent_videos  = $rs->getrows();

/*最新视频和分页
Email:frontend.offer@gmail.com
*/
$sql            = "SELECT count(VID) AS total_videos FROM video WHERE active = 1 AND channel NOT IN (61,63,65) ORDER BY addtime DESC";
$rsc            = $conn->CacheExecute(3000,$sql);//$conn->execute($sql);
$total          = $rsc->fields['total_videos'];
$pagination     = new Pagination($config['videos_per_page']);
$limit          = $pagination->getLimit($total);
//$sql            = "SELECT * FROM video WHERE active = '1' LIMIT " .$limit;
//$rs             = $conn->execute($sql);
//$videos         = $rs->getrows();
$page_link      = $pagination->getPagination('videos');
$start_num      = $pagination->getStartItem();
$end_num        = $pagination->getEndItem();


/*featured Video
frontend.offer@gmail.com
*/
$sql            = "SELECT VID, title, duration, addtime, thumb, thumbs, viewnumber, rate, likes, dislikes, type, hd
                   FROM video" .$sql_add. " AND tuijian = 1 ORDER BY viewtime DESC LIMIT 8";
$rs             = $conn->execute($sql);
$featured_videos         = $rs->getrows();


$conn->Close();

$smarty->assign('featured_videos', $featured_videos);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
$smarty->assign('page_link', $page_link);

//featured

//$viewed_videos  = ($rs=="") ? trim($rs) : trim($rs->getrows());
$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);
$smarty->assign('menu', 'v');
$smarty->assign('index', true);
$smarty->assign('viewed_total', $viewed_total);
$smarty->assign('viewed_videos', $viewed_videos);
//$smarty->assign('videos', $videos);
$smarty->assign('recent_videos', $recent_videos);
$smarty->assign('self_title', $seo['index_title']);
$smarty->assign('self_description', $seo['index_desc']);
$smarty->assign('self_keywords', $seo['index_keywords']);

$template_file = 'v.tpl';
if ($isMakeHtml == 1) {
	$content = $smarty->fetch($template_file, null, null, false);
	$static_file = $config['BASE_DIR'] . '/' . 'index.html';
	$makeTime = date('Y-m-d H:i:s',time());
	file_put_contents($static_file, $content . "\r\n<!-- static file: index.html make time:{$makeTime}-->");

}else{
    $smarty->display($template_file);
    //$smarty->gzip_encode();
}
?>
