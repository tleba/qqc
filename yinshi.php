<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';

$type		= ( $config['show_private_videos'] == '0' ) ? 'public' : NULL;
$type           = ( isset($_GET['type']) && ($_GET['type'] == 'private' or $_GET['type'] == 'public') ) ? $_GET['type'] : $type;
$category       = ( isset($_GET['c']) ) ? intval($_GET['c']) : 0;
$hide_categories = array(61,63,65);
$categories     = get_categories($hide_categories,0);
$orders         = array('bw', 'mr', 'mv', 'tr', 'md', 'tf', 'lg');
$order          = ( isset($_GET['o']) && in_array($_GET['o'], $orders) ) ? $_GET['o'] : 'mr';
$timeframes     = array('t', 'w', 'm', 'a');
$timeframe      = ( isset($_GET['t']) && in_array($_GET['t'], $timeframes) ) ? $_GET['t'] : 'a';

$sql_add        = NULL;
$sql_add_count  = NULL;
$sql_delim      = ' WHERE ';
$title_t        = NULL;
$title_c        = NULL;
$title_o        = NULL;
$title_p        = NULL;
$sql_add = $sql_delim.' channel  IN ('.implode(',', $hide_categories).')';
$sql_add_count = $sql_delim.' channel  IN ('.implode(',', $hide_categories).')';
$sql_delim = ' AND';
if ( $type != '' ) {
    $title_p        = ' '.ucfirst(($type == 'private') ? $lang['global.private'] : $lang['global.public']);
    $sql_add        .= $sql_delim. " type = '" .$type. "'";
    $sql_add_count  .= $sql_delim. " type = '" .$type. "'";
    $sql_delim      = ' AND';
}

switch ( $timeframe ) {
    case 't':
        $title_t         = $lang['global.todays'];
        $sql_add        .= $sql_delim. " DATE_FORMAT(adddate, '%y-%m-%d') = DATE_FORMAT(NOW(), '%y-%m-%d')";
        $sql_add_count  .= $sql_delim. " DATE_FORMAT(adddate, '%y-%m-%d') = DATE_FORMAT(NOW(), '%y-%m-%d')";
        $sql_delim       = ' AND';
        break;
    case 'w':
        $title_t         = $lang['global.this_weeks'];
        $sql_add        .= $sql_delim. " DATE_FORMAT(adddate, '%y-%u') = DATE_FORMAT(NOW(), '%y-%u')";
        $sql_add_count  .= $sql_delim. " DATE_FORMAT(adddate, '%y-%u') = DATE_FORMAT(NOW(), '%y-%u')";
        $sql_delim       = ' AND';
        break;
    case 'm':
        $title_t         = $lang['global.this_months'];
        $sql_add        .= $sql_delim. " DATE_FORMAT(adddate, '%m') = DATE_FORMAT(NOW(), '%m')";
        $sql_add_count  .= $sql_delim. " DATE_FORMAT(adddate, '%m') = DATE_FORMAT(NOW(), '%m')";
        $sql_delim       = ' AND';
        break;
}

if ( $category ) {
    $sql_add        .= $sql_delim. " channel = " .$category;
    $sql_add_count  .= $sql_delim. " channel = " .$category;
    $sql_delim       = ' AND';
    foreach ( $categories as $categ ) {
        if ( $categ['CHID'] == $category ) {
            $title_c = ' ' .$categ['name'];
            break;
        }
    }
}

$sql_add       .= $sql_delim . " active = '1'";
$sql_add_count .= $sql_delim . " active = '1'";

switch ( $order ) {
    case 'bw':
        $title_o  = ' '.$lang['global.being_watched'];
        $sql_add .= ' ORDER BY viewtime DESC';
        break;
    case 'mr':
        $title_o  = ' '.$lang['global.most_recent'];
        $sql_add .= ' ORDER BY addtime DESC';
        break;
    case 'mv':
        $title_o  = ' '.$lang['global.most_viewed'];
        $sql_add .= ' ORDER BY viewnumber DESC';
        break;
    case 'tr':
        $title_o  = ' '.$lang['global.top_rated'];
        $sql_add .= ' ORDER BY rate DESC';
        break;
    case 'md':
        $title_o  = ' '.$lang['global.most_commented'];
        $sql_add .= ' ORDER BY com_num DESC';
        break;
    case 'tf':
        $title_o  = ' '.$lang['global.top_favorites'];
        $sql_add .= ' ORDER BY fav_num DESC';
        break;
    case 'lg':
		$title_o  = ' '.$lang['global.longest'];
        $sql_add .= ' ORDER BY duration DESC';
        break;		
}

$sql            = "SELECT count(VID) AS total_videos FROM video" .$sql_add_count;

$rsc            = $conn->CacheExecute(3000,$sql);
$total          = $rsc->fields['total_videos'];
$pagination     = new Pagination($config['videos_per_page']);
$limit          = $pagination->getLimit($total);
$sql            = "SELECT * FROM video" .$sql_add. " LIMIT " .$limit;

$rs             = $conn->CacheExecute(3000,$sql);
$videos         = $rs->getrows();
$page_link      = $pagination->getPagination('yinshi');
$start_num      = $pagination->getStartItem();
$end_num        = $pagination->getEndItem();

//echo $start_num . '@@@' . $end_num;
$title              = $title_t . $title_o . $title_c . $title_p;
$self_title         = $title . $seo['videos_title'];
$self_description   = $title . $seo['videos_desc'];
$self_keywords      = $title . $seo['videos_keywords'];

$conn->Close();
$menu = '';
if(isset($_GET['c']) && intval($_GET['c'])==0){
    $menu='yinshi';
}
$smarty->assign('c',@intval($_GET['c']));
$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);
$smarty->assign('menu', $menu);
$smarty->assign('categories', $categories);
$smarty->assign('type', $type);
$smarty->assign('videos', $videos);
$smarty->assign('videos_total', $total);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
$smarty->assign('page_link', $page_link);
$smarty->assign('category', $category);
$smarty->assign('timeframe', $timeframe);
$smarty->assign('order', $order);
$smarty->assign('title', $title);
$smarty->assign('self_title', $self_title);
$smarty->assign('self_description', $self_description);
$smarty->assign('self_keywords', $self_keywords);

if ($isMakeHtml == 1) {
	$c_str = $category == 0 ? '' : $category.'/';
	$dir = 'yinshi/' . $c_str;
	if(!file_exists( $dir ) ) {
		mkdir($dir,0777,true);
	}
	$content = $smarty->fetch('header.tpl', null, null, false);
	$content .= $smarty->fetch('videos.tpl', null, null, false);
	$content .= $smarty->fetch('footer.tpl', null, null, false);
	if ($pagination->page == 1) {
		$filename = $dir.'index.html';
	}else{
		$filename = $dir.'index_page_'.$pagination->page.'.html';
	}
	$static_file =  $config['BASE_DIR'] . '/' .$filename;
	$makeTime = date('Y-m-d H:i:s',time());
	file_put_contents($static_file, $content . "\r\n<!-- static file: {$filename} make time:{$makeTime}-->");
	echo $filename;exit;
}else{
	$smarty->display('header.tpl');
	$smarty->display('videos.tpl');
	$smarty->display('footer.tpl');
	//$smarty->gzip_encode();
}
/*
$smarty->display('header.tpl');
$smarty->display('errors.tpl');
$smarty->display('messages.tpl');
$smarty->display('videos.tpl');
$smarty->display('footer.tpl');
$smarty->gzip_encode();*/
?>
