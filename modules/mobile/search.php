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
$search_query = '';

$where = '';
$mobile_menu				= 'search';
$module						= $mobile_menu;
// ------------------------------------------------------------------------------

$max = $config['mobile_view_limit'];
$pg = ((isset($_GET['page'])) && $_GET['page'] >= 1) ? $_GET['page'] : '1';
$search = (isset($_GET['search'])) ? mysql_real_escape_string($_GET['search']) : '';

if($search != ''){

	$seo['mobile_title'] 		= $search.' - '.$mconfig['mobile_sitename'].' - Search results';
	$seo['mobile_desc'] 		= $lang['search.title']. ' - '.$mconfig['mobile_seo_description'];

	$where .= "title like '%".$search ."%' ";	
	$where .= "OR description like '%".$search ."%' ";
	$where .= "OR keyword like '%".$search ."%' ORDER BY VID DESC";	

	// Get Page	Value
	if($pg == '1'){
	$start = "0"; $pg = '1';}
	else{$start = (($pg-1) * $max);}
	if($start < 1){$start = 0;}
	$limit = " LIMIT ".$start.", ".$max;
	
	// Hard Coded Where Results
	$static = "(iphone = '1' OR embed_code LIKE '%youtube%') AND type = 'public' AND active = '1'";

	// Count All Videos
	$sql = "SELECT COUNT(VID) AS ct FROM video WHERE ".$static." AND ".$where;
	$res = $conn->execute($sql);
	$count = $res->fields['ct'];

	// Total Pages
	$pages = ceil($count/$max);

	// Get Videos Data
	$sql        = "SELECT * FROM video WHERE ".$static." AND ".$where. " " .$limit;

	$rs         = $conn->execute($sql);
	$videos     = $rs->getrows();
	
	$search_query = $search;
	$smarty->assign('query', $search_query);

	$tpager='';
	if($pages>1) {
		include('pagination.php');
		$url = 'mobile/search/?search='.$search;
		$tpager = get_pagination($pg, $pages, $url);
	}
} else {
	$seo['mobile_title'] = $mconfig['mobile_sitename'].' - No search results';
}



// ------------------------------------------------------------------------------



// Assign Page Content Data
$smarty->assign('videos', $videos);
$smarty->assign('tpager', $tpager);
$smarty->assign('current_page', $pg);
$smarty->assign('total_pages', $pages);

// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);

// Assign Nav Tab
$smarty->assign('mobile_menu','videos');
$smarty->assign('mconfig',$mconfig);

// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
