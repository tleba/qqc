<?php
define('_VALID', true);

require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';
/*
# 小说展示列表页面
# 开发时间：20150906
# 作者：shchzh85@gmail.com
*/
$type           = ( $config['show_private_videos'] == '0' ) ? 'public' : NULL;
$type           = ( isset($_GET['type']) && ($_GET['type'] == 'private' or $_GET['type'] == 'public') ) ? $_GET['type'] : $type;
$orders         = array('bw', 'mr', 'mv', 'tr', 'md', 'tf', 'lg');
$order          = ( isset($_GET['o']) && in_array($_GET['o'], $orders) ) ? $_GET['o'] : 'mr';
$timeframes     = array('t', 'w', 'm', 'a');
$timeframe      = ( isset($_GET['t']) && in_array($_GET['t'], $timeframes) ) ? $_GET['t'] : 'a';

//分类
$category       = ( isset($_GET['c']) ) ? intval($_GET['c']) : 0;

$categories     = get_lists_categories(1);

$sql_add        = NULL;
$sql_add_count  = NULL;
$sql_delim      = ' WHERE ';
$title_t        = NULL;
$title_c        = NULL;
$title_o        = NULL;
$title_p        = NULL;

if ( $type != '' ) {
    $title_p        = ' '.ucfirst(($type == 'private') ? $lang['global.private'] : $lang['global.public']);
    $sql_add        = $sql_delim. " privacy = '" . $type . "'";
    $sql_add_count  = $sql_delim. " privacy = '" . $type . "'";
    $sql_delim      = ' AND';
}

switch ( $timeframe ) {
    case 't':
        $title_t         = $lang['global.todays'];
        $sql_add        .= $sql_delim. " FROM_UNIXTIME(addtime, '%Y-%m-%d') = CURDATE()";
        $sql_add_count  .= $sql_delim. " FROM_UNIXTIME(addtime, '%Y-%m-%d') = CURDATE()";
        $sql_delim       = ' AND';
        break;
    case 'w':
        $title_t         = $lang['global.this_weeks'];
        $sql_add        .= $sql_delim. " FROM_UNIXTIME(addtime, '%Y-%u') = DATE_FORMAT(NOW(), '%Y-%u')";
        $sql_add_count  .= $sql_delim. " FROM_UNIXTIME(addtime, '%Y-%u') = DATE_FORMAT(NOW(), '%Y-%u')";
        $sql_delim       = ' AND';
        break;
    case 'm':
        $title_t         = $lang['global.this_months'];
        $sql_add        .= $sql_delim. " FROM_UNIXTIME(addtime, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m')";
        $sql_add_count  .= $sql_delim. " FROM_UNIXTIME(addtime, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m')";
        $sql_delim       = ' AND';
        break;
}
//分类显示
$arr_cate = array();
if ( $category > 0) {
    $sql_add        .= $sql_delim. " category_id = " . $category;
    $sql_add_count  .= $sql_delim. " category_id = " . $category;
    $sql_delim       = ' AND';
    foreach ( $categories as $categ ) {
        if ( $categ['CHID'] == $category ) {
            $title_c = ' ' . $categ['name'];
            break;
        }
        if( in_array($categ['CHID'], $arr_cate) ) {
            $arr_cate[$categ['CHID']] = $categ['name'];
        }
    }
}
if( count( $arr_cate ) == 0) {
    foreach ($categories as $key => $categ) {
        if(!in_array($categ['CHID'], $arr_cate) ) {
            $arr_cate[$categ['CHID']] = $categ['name'];
        }
    }
}
//排序 目前只有图片数量，添加时间，访问人员
switch ( $order ) {
    case 'mr':
        $title_o  = ' '.$lang['global.most_recent'];
        $sql_add .= ' ORDER BY addtime DESC';
        break;
    case 'mv':
        $title_o  = ' '.$lang['global.most_viewed'];
        $sql_add .= ' ORDER BY viewnumber DESC';
        break;
}
//取数据
$sql            = "SELECT count(VID) AS total_videos FROM novel " .$sql_add_count;

$rsc            = $conn->CacheExecute(3000,$sql);
$total          = $rsc->fields['total_videos'];
$pagination     = new Pagination($config['videos_per_page']);
$limit          = $pagination->getLimit($total);
$sql            = "SELECT * FROM novel " . $sql_add . " LIMIT " . $limit;

$rs             = $conn->CacheExecute(3000,$sql);
$novels       = $rs->getrows();
foreach ($novels as &$v) {
	$v['content'] = strip_tags(htmlspecialchars_decode($v['content']));
}
$page_link      = $pagination->getPagination('novels');
$start_num      = $pagination->getStartItem();
$end_num        = $pagination->getEndItem();

$title              = $title_t . $title_o . $title_c . $title_p;
$self_title         = $title . $seo['videos_title'];
$self_description   = $title . $seo['videos_desc'];
$self_keywords      = $title . $seo['videos_keywords'];

//$conn->Close();

$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);
//参数
$smarty->assign('type', $type);
$smarty->assign('novels', $novels);
$smarty->assign('novels_total', $total);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
$smarty->assign('page_link', $page_link);
$smarty->assign('order', $order);
$smarty->assign('category', $category);
$smarty->assign('category_in_name', $arr_cate);
$smarty->assign('timeframe', $timeframe);
$smarty->assign('categories', $categories);
//头部
$smarty->assign('csspic', true);    //小说图片css
$smarty->assign('title', $title);
$smarty->assign('self_title', $self_title);
$smarty->assign('self_description', $self_description);
$smarty->assign('self_keywords', $self_keywords);
//模板
if ($isMakeHtml == 1) {
	$c_str = $category == 0 ? '' : $category.'/';
	$dir = 'novels/' . $c_str;
	if(!file_exists( $dir ) ) {
		mkdir($dir,0777,true);
	}
	$content = $smarty->fetch('header.tpl', null, null, false);
	$content .= $smarty->fetch('novels.tpl', null, null, false);
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
	$smarty->display('errors.tpl');
	$smarty->display('messages.tpl');
	$smarty->display('novels.tpl');
	$smarty->display('footer.tpl');
	$smarty->gzip_encode();
}
?>
