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
$seo['mobile_title'] 		= '青青草成人视频';
$seo['mobile_desc'] 		= '青青草成人视频';
$seo['mobile_keywords'] 	= '青青草成人视频';
$module						= $mobile_menu;
// ------------------------------------------------------------------------------

$max = $config['mobile_view_limit'];
$pg = ((isset($_GET['page'])) && $_GET['page'] >= 1) ? $_GET['page'] : '1';
$type = (isset($_GET['type'])) ? mysql_real_escape_string($_GET['type']) : $config['mobile_default_type'];
$search = (isset($_GET['search'])) ? mysql_real_escape_string($_GET['search']) : '';

// Get Page	Value
if($pg == '1'){
$start = "0"; $pg = '1';}
else{$start = (($pg-1) * $max);}
if($start < 1){$start = 0;}
$limit = "LIMIT ".$start.", ".$max;

$public = "type = 'public'";
// Work Out Video Type
switch($type){
	case 'recent': 		$condition = $public." "."ORDER BY addtime DESC"; break;
	case 'rated': 		$condition = $public." "."ORDER BY rate DESC"; break;
	case 'popular': 	$condition = $public." "."ORDER BY viewnumber DESC"; break;
}

// Work Out Search
$where = ''; 
if($search != ''){
	$where .= "title like '%".$search ."%' ";	
	$where .= "OR description like '%".$search ."%' ";
	$where .= "OR keyword like '%".$search ."%' AND ".$public." ORDER BY VID DESC";	
}else{
	$where = $condition;
}

// Hard Coded Where Results
$static = "iphone = '1' AND type = 'public' AND active = '1'";

// Count All Videos
$sql = "SELECT COUNT(VID) AS ct FROM video WHERE ".$static." AND ".$where;
$res = $conn->execute($sql);
$count = $res->fields['ct'];

// Total Pages
$pages = ceil($count/$max);

// Get Paging Links
if($pg == 1){
	$tpaging 	.= "<span>".$pg."</span>";
	if($pages > 1){
		$tpaging 	.= "<span id='next' class='right' onclick='javascript:newPage(\"videos\",\"page\",".($pg+1).");'></span>";
	}
}elseif($pg > 1 && $pg < $pages){
	$tpaging 	.= "<span id='prev' class='left' onclick='javascript:newPage(\"videos\",\"page\",".($pg-1).");'></span>";
	$tpaging 	.= "<span>".$pg."</span>";
	$tpaging 	.= "<span id='next' class='right' onclick='javascript:newPage(\"videos\",\"page\",".($pg+1).");'></span>";
}elseif($pg == $pages){
	$tpaging 	.= "<span id='prev' class='left' onclick='javascript:newPage(\"videos\",\"page\",".($pg-1).");'></span>";
	$tpaging 	.= "<span>".$pg."</span>";
}

// Get Videos Data
$sql        = "SELECT * FROM video WHERE ".$static." AND ".$where. " " .$limit;
$rs         = $conn->execute($sql);
$videos     = $rs->getrows();
$search 	= ($search != '') ? $search : 'Search';
// ------------------------------------------------------------------------------

// Assign Page Content Data
$smarty->assign('videos', $videos);
$smarty->assign('tpaging', $tpaging);
$smarty->assign('curr_page', $pg);
$smarty->assign('curr_count', $count);
$smarty->assign('top_page', $pages);
$smarty->assign('mobile_type', $type);
$smarty->assign('mobile_search', $search);
$smarty->assign('vquery', $type);


// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);
$smarty->assign('self_description', $seo['mobile_desc']);
$smarty->assign('self_keywords', $seo['mobile_keywords']);

// Assign Nav Tab
$smarty->assign('mobile_menu',$mobile_menu);

// Display Mobile Pages
if(!$ajax){$smarty->display('mobile_header.tpl');}
$smarty->display('mobile_'.$module.'.tpl');
if(!$ajax){$smarty->display('mobile_footer.tpl');}
if(!$ajax){$smarty->gzip_encode();}

?>
