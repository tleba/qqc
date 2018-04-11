<?php
define('_VALID', true);

require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';
/*
# 图片展示列表页面
# 开发时间：20150906
# 作者：shchzh85@gmail.com
*/
$vid = get_request_arg('picture');
$isMakeHtml = get_request_arg('isMakeHtml');
$_GET['page'] = get_request_arg('page');
if ( !$vid ) {
    VRedirect::go($config['BASE_URL']. '/error/picture_missing');
}
//访问次数加1
$sql        = "UPDATE picture SET viewnumber = viewnumber+1 WHERE VID = " .$vid. " LIMIT 1";
$conn->execute($sql);

$sql            = "SELECT p.VID, p.title, p.description, p.category_id, p.addtime, p.viewnumber,p.UID FROM picture p WHERE p.VID = " .$vid. " LIMIT 0,1 ";

$rs         = $conn->execute($sql);
if ( $conn->Affected_Rows() != 1 ) {
    VRedirect::go($config['BASE_URL']. '/error/picture_missing');
}
//取用户信息
$cuid = $rs->fields['UID'];
$sql = "SELECT UID,username,photo,popularity,points,gender,addtime,logintime,aboutme,turnon FROM signup WHERE UID = '{$cuid}' LIMIT 0,1";
$urs         = $conn->execute($sql);
$user   = $urs->getrows();
$user   = $user['0'];

$picture  = $rs->getrows();

$picture  = $picture['0'];
//取分类
$category     = get_lists_categories( $picture['category_id'], 1);



//取图片数据
//取数据
$sql            = 'SELECT count(VID) AS total_videos FROM picture_img WHERE picture_id = ' . $picture['VID'] . ' AND thumb = 0';

$rsc            = $conn->CacheExecute(3000,$sql);
$total          = $rsc->fields['total_videos'];
$pagination     = new Pagination($config['videos_per_page']);
$limit          = $pagination->getLimit($total);
$sql            = 'SELECT * FROM picture_img WHERE picture_id = ' . $picture['VID'] . ' AND thumb = 0 LIMIT ' . $limit;

$rs             = $conn->CacheExecute(3000,$sql);
$pictures       = $rs->getrows();
$page_link      = $pagination->getPagination('picture/'.$picture['VID']);
$start_num      = $pagination->getStartItem();
$end_num        = $pagination->getEndItem();

$self_title         = $picture['title'] . $seo['video_title'];
$self_description   = $picture['title'] . $seo['video_desc'];
$self_keywords      = $picture['title'] . $seo['video_keywords'];

//$conn->Close();
/*$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);*/
//参数
$smarty->assign('user', $user);
$smarty->assign('picture', $picture);
$smarty->assign('showcss', true);
$smarty->assign('category', $category['0']['name']);
$smarty->assign('pictures', $pictures);
$smarty->assign('pictures_total', $total);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
$smarty->assign('page_link', $page_link);
//头部
$smarty->assign('tmb_speed_url', $config['tmb_speed_url']);
$smarty->assign('self_title', $self_title);
$smarty->assign('self_description', $self_description);
$smarty->assign('self_keywords', $self_keywords);
//模板
if ($isMakeHtml == 1) {
	$dir = 'picture/' . $vid.'/';
	if(!file_exists( $dir ) ) {
		mkdir($dir,0777,true);
	}
	$content = $smarty->fetch('header.tpl', null, null, false);
	$content .= $smarty->fetch('picture.tpl', null, null, false);
	$content .= $smarty->fetch('footer.tpl', null, null, false);
	
	if ($pagination->page == 1) {
		$filename = $dir.'index.html';
	}else{
		$filename = $dir.'index_page_'.$pagination->page.'.html';
	}
	//内容替换
	$a_header   = array('?page=', '&page=');
	$a_replace  = array('/index_page_', '/index_page_');
	$content    = str_replace($a_header, $a_replace, $content);
	$content = preg_replace('/(page_\d+)/', '$1.html', $content);
	$content    = str_replace('/index_page_1.html', '/index.html', $content);
	$static_file =  $config['BASE_DIR'] .'/'.$filename;
	$makeTime = date('Y-m-d H:i:s',time());
	file_put_contents($static_file, $content . "\r\n<!-- static file: {$filename} make time:{$makeTime}-->");
	echo 200;exit;
}else{
	$smarty->display('header.tpl');
	$smarty->display('picture.tpl');
	$smarty->display('footer.tpl');
	$smarty->gzip_encode();
}
?>
