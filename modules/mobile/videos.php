<?php
/*|******************************************************
|*|	iPhone / iPod - Mobile Webapp Module Version 2.0
|*| -----------------------------
|*| AVS Version 2.0+
|*| 12-03-2009
|*|******************************************************
|*/

$errors = '';
$messages = '';
$mobile_menu				= 'videos';
$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - '.$lang['global.most_recent'].' '.$lang['videos.videos'];
$seo['mobile_desc'] 		= $mconfig['mobile_seo_description'].' '.$lang['global.most_recent'];
$module						= $mobile_menu;
// ------------------------------------------------------------------------------

$max = $config['mobile_view_limit'];
if(intval($max)<1) $max=5;
$pg = ((isset($_GET['page'])) && $_GET['page'] >= 1) ? $_GET['page'] : '1';
$type = (isset($_GET['type'])) ? mysql_real_escape_string($_GET['type']) : $config['mobile_default_type'];
$search = (isset($_GET['search'])) ? mysql_real_escape_string($_GET['search']) : '';

if($pg>1) {
	$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - Page '.$pg.'.'.$lang['global.most_recent'].' '.$lang['videos.videos'];
	$seo['mobile_desc'] 		= $mconfig['mobile_seo_description'].' '.$lang['global.most_recent'].'. Page '.$pg;
}


// Get Page	Value
if($pg == '1'){
$start = "0"; $pg = '1';}
else{$start = (($pg-1) * $max);}
if($start < 1){$start = 0;}
$limit = "LIMIT ".$start.", ".$max;

$public = "type = 'public'";
// Work Out Video Type
switch($type){
	case 'recent': 		$condition = " ORDER BY addtime DESC"; break;
	case 'rated': 		$condition = " ORDER BY rate DESC"; break;
	case 'popular': 	$condition = " ORDER BY viewnumber DESC"; break;
}

// Work Out Search
$where = ''; 



if($search != ''){
	$where .= " AND title like '%".$search ."%' ";	
	$where .= "OR description like '%".$search ."%' ";
	$where .= "OR keyword like '%".$search ."%' AND ".$public." ORDER BY VID DESC";	
}else{
	$where .= $condition;
}



// Hard Coded Where Results
$static = "(iphone = '1' OR embed_code LIKE '%youtube%') AND type = 'public' AND active = '1'";

// Count All Videos
$sql = "SELECT COUNT(VID) AS ct FROM video WHERE ".$static.$where;
$res = $conn->execute($sql);
$count = $res->fields['ct'];


// Total Pages
$pages = ceil($count/$max);

// Get Videos Data
$sql        = "SELECT * FROM video WHERE ".$static.$where. " " .$limit;
$rs         = $conn->execute($sql);
$videos     = $rs->getrows();
$search 	= ($search != '') ? $search : 'Search';
// ------------------------------------------------------------------------------

$tpager='';
if($pages>1) {
	include('pagination.php');
	$url = 'mobile/videos/';
	if(isset($request['1'])) $url.=$request['1'].'/';
	$tpager = get_pagination($pg, $pages, $url);
}

// Assign Page Content Data
$smarty->assign('videos', $videos);
$smarty->assign('tpager', $tpager);
$smarty->assign('current_page', $pg);
$smarty->assign('total_pages', $pages);
$smarty->assign('curr_count', $count);
$smarty->assign('mobile_type', $type);


// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);
$smarty->assign('self_description', $seo['mobile_desc']);

// Assign Nav Tab
$smarty->assign('mobile_menu',$mobile_menu);

$smarty->assign('mconfig',$mconfig);

// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
