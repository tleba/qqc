<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';
require_once ('include/function_thumbs.php');
$request    = ( isset($_SERVER['REQUEST_URI']) ) ? $_SERVER['REQUEST_URI'] : NULL;
$query      = explode('/', $request);
$module = get_request_arg('index_ajax','varchar');
$modules_allowed = array('videos','videos_tab','bbs_tab','index_bbs_commendable','commendable_mian');
if ( !in_array($module, $modules_allowed) ) {
    exit('此模块未开启');
}
if($module==='videos'){

	$sql            = "SELECT VID, title, duration, addtime, thumb, thumbs, viewnumber, rate, likes, dislikes, type, hd
	                   FROM video WHERE  active = '1' ORDER BY viewtime DESC LIMIT 18,8";
	$rs             = $conn->CacheExecute(3000,$sql);
	$featured_videos         = $rs->getrows();
	foreach ($featured_videos as $value=>$v) { 
	echo "<li class=\"videos_item\"> <a href=\"/video/".$v['VID']."\"><img src=\"".get_thumb_url($v['VID'])."/2.jpg\"/></a> <a href=\"/video/".$v['VID']."\" class='title_item'>".$v['title']."</a> </li>";
	} 

}elseif($module==='videos_tab'){

$sql            = "SELECT VID, title, duration, addtime, thumb, thumbs, viewnumber, rate, likes, dislikes, type, hd
                   FROM video  WHERE `featured` = 'yes' AND  active = '1' ORDER BY viewtime DESC LIMIT 0,8";
$rs             = $conn->CacheExecute(1,$sql);
$featured_videos         = $rs->getrows();
foreach ($featured_videos as $value=>$v) { 
echo "<li style=' line-height: 19px; '><img src='/templates/frontend/frontend-default/img/2.png' style='  float: left; margin-right: 8px; '><a href=\"/video/".$v['VID']."\">".$v['title']."</a><em><img src='/templates/frontend/frontend-default/img/3.png'></em></li>";
}

}

$conn->Close();

?>
