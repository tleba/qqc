<?php
defined('_VALID') or die('Restricted Access!');

if ( $config['video_module'] == '0' ) {
    VRedirect::go($config['BASE_URL']. '/error/page_invalid');
}

$category       = ( isset($_GET['c']) ) ? intval($_GET['c']) : 0;
$orders         = array('bw', 'mr', 'mv', 'tr', 'md', 'tf', 'lg');
$order          = ( isset($_GET['o']) && in_array($_GET['o'], $orders) ) ? $_GET['o'] : 'mr';
$timeframes     = array('t', 'w', 'm', 'a');
$timeframe      = ( isset($_GET['t']) && in_array($_GET['t'], $timeframes) ) ? $_GET['t'] : 'a';
$rating         = ( isset($_GET['r']) ) ? floatval($_GET['r']) : NULL;
$min_length     = ( isset($_GET['min_length']) && is_numeric($_GET['min_length']) ) ? intval($_GET['min_length']) : NULL;
$max_length     = ( isset($_GET['max_length']) && is_numeric($_GET['max_length']) ) ? intval($_GET['max_length']) : NULL;
$type           = ( isset($_GET['type']) && ( $_GET['type'] == 'public' or $_GET['type'] == 'private' ) ) ? $_GET['type'] : NULL;
$sql_add        = NULL;
$sql_add_count  = NULL;

if ( $type ) {
    $sql_add        .= " AND type = '" .$type. "'";
    $sql_add_count  .= " AND type = '" .$type. "'";
}

if ( $category ) {
    $sql_add        .= " AND channel = " .$category;
    $sql_add_count  .= " AND channel = " .$category;
}

if ( $rating ) {
    $sql_add        .= " AND rate >= " .$rating;
    $sql_add_count  .= " AND rate >= " .$rating;
}

if ( $min_length ) {
    $min_length_s       = ( $min_length == '1' ) ? 3600 : $min_length*60;
    $sql_add           .= " AND duration > " .$min_length_s;
    $sql_add_count     .= " AND duration > " .$min_length_s;
}

if ( $max_length ) {
    $max_length_s       = ( $max_length == '1' ) ? 3600 : $max_length*60;
    $sql_add           .= " AND duration < " .$max_length_s;
    $sql_add_count     .= " AND duration < " .$max_length_s;
}

switch ( $timeframe ) {
    case 't':
        $now = strtotime(date('Y-m-d'));
        $next = strtotime("+1 day",$now);
        $sql_add        .= " AND (addtime > {$now} AND addtime < {$next})";
        $sql_add_count  .= " AND (addtime > {$now} AND addtime < {$next})";
        break;
    case 'w':
        $today_week = date('w',time());
        $now = strtotime("-{$today_week} week",time());
        $next_week = 6 - $today_week;
        $next = strtotime("+{$next_week} week",time());
        $sql_add        .= " AND (addtime > {$now} AND addtime < {$next})";
        $sql_add_count  .= " AND (addtime > {$now} AND addtime < {$next})";
        break;
    case 'm':
        $m = date('Y-m',time());
        $now = strtotime($m.'-1');
        $next = strtotime("+1 month",$now);
        $sql_add        .= " AND (addtime > {$now} AND addtime < {$next})";
        $sql_add_count  .= " AND (addtime > {$now} AND addtime < {$next})";
        break;
}

if ( $search_query ) {
    $sql_add        .= " AND ( title LIKE '%" .mysql_real_escape_string($search_query). "%' OR keyword LIKE '%" .mysql_real_escape_string($search_query). "%' )";
    $sql_add_count  .= " AND ( title LIKE '%" .mysql_real_escape_string($search_query). "%' OR keyword LIKE '%" .mysql_real_escape_string($search_query). "%' )";
}

switch ( $order ) {
    case 'br':
        $sql_add .= " ORDER BY viewtime DESC";
        break;
    case 'mr':
        $sql_add .= " ORDER BY addtime DESC";
        break;
    case 'mv':
        $sql_add .= " ORDER BY viewnumber DESC";
        break;
    case 'tr':
        $sql_add .= " ORDER BY (ratedby*rate) DESC";
        break;
    case 'md':
        $sql_add .= " ORDER BY com_num DESC";
        break;
    case 'tf':
        $sql_add .= " ORDER BY fav_num DESC";
        break;		
    case 'lg':
        $sql_add .= " ORDER BY duration DESC";
        break;
}

$sql            = "SELECT count(VID) AS total_videos FROM video FORCE INDEX(title,keyword) WHERE active = 1 ". $sql_add_count;
$rsc            = $conn->CacheExecute(30000,$sql);
$total          = $rsc->fields['total_videos'];
$pagination     = new Pagination($config['videos_per_page']);
$limit          = $pagination->getLimit($total);
$sql            = "SELECT * FROM video FORCE INDEX(title,keyword) WHERE active = 1 ". $sql_add. " LIMIT " .$limit;
$rs             = $conn->CacheExecute(30000,$sql);
$videos         = $rs->getrows();
$page_link      = $pagination->getPagination('search');
$start_num      = $pagination->getStartItem();
$end_num        = $pagination->getEndItem();

$conn->Close();

$smarty->assign('category', $category);
$smarty->assign('categories', get_categories());
$smarty->assign('timeframe', $timeframe);
$smarty->assign('type', $type);
$smarty->assign('order', $order);
$smarty->assign('min_length', $min_length);
$smarty->assign('max_length', $max_length);
$smarty->assign('rating', $rating);
$smarty->assign('videos', $videos);
$smarty->assign('videos_total', $total);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
$smarty->assign('page_link', $page_link);