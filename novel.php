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
$vid = get_request_arg('novel');
$isMakeHtml = get_request_arg('isMakeHtml');
if ( !$vid ) {
    VRedirect::go($config['BASE_URL']. '/error/novel_missing');
}
//访问次数加1
$sql        = "UPDATE novel SET viewnumber = viewnumber+1 WHERE VID = " .$vid. " LIMIT 1";
$conn->execute($sql);

$sql            = "SELECT p.VID, p.title, p.content, p.category_id, p.addtime, p.viewnumber FROM novel p WHERE p.VID = " .$vid. " LIMIT 1 ";

$rs         = $conn->execute($sql);
if ( $conn->Affected_Rows() != 1 ) {
    VRedirect::go($config['BASE_URL']. '/error/novel_missing');
}
//取用户信息
$cuid = $rs->fields['UID'];
$sql = "SELECT UID,username,photo,popularity,points,gender,addtime,logintime,aboutme,turnon FROM signup WHERE UID = '{$cuid}' LIMIT 0,1";
$urs         = $conn->execute($sql);
$user   = $urs->getrows();
$user   = $user['0'];

$novel  = $rs->getrows();

$novel  = $novel['0'];
$novel['content'] = htmlspecialchars_decode($novel['content']);
//取分类
$category     = get_lists_categories( $novel['category_id'], 1);

//取图片数据

$self_title         = $novel['title'] . $seo['video_title'];
$self_description   = $novel['title'] . $seo['video_desc'];
$self_keywords      = $novel['title'] . $seo['video_keywords'];

//$conn->Close();
/*$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);*/
//参数
$smarty->assign('user', $user);
$smarty->assign('novel', $novel);
$smarty->assign('showcss', true);
$smarty->assign('category', $category['0']['name']);

//头部
$smarty->assign('tmb_speed_url', $config['tmb_speed_url']);
$smarty->assign('self_title', $self_title);
$smarty->assign('self_description', $self_description);
$smarty->assign('self_keywords', $self_keywords);
//模板
if ($isMakeHtml == 1) {
	$dir = 'novel/' . $vid.'/';
	if(!file_exists( $dir ) ) {
		mkdir($dir,0777,true);
	}
	$content = $smarty->fetch('header.tpl', null, null, false);
	$content .= $smarty->fetch('novel.tpl', null, null, false);
	$content .= $smarty->fetch('footer.tpl', null, null, false);
	
	$static_file =  $config['BASE_DIR'] .'/'.$dir.'/index.html';
	$makeTime = date('Y-m-d H:i:s',time());
	file_put_contents($static_file, $content . "\r\n<!-- static file: {$vid}/index.html make time:{$makeTime}-->");
	echo 200;exit;
}else{
	$smarty->display('header.tpl');
	$smarty->display('novel.tpl');
	$smarty->display('footer.tpl');
	$smarty->gzip_encode();
}
?>
