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
$mobile_menu				= 'categories';
$module						= 'categories';
// ------------------------------------------------------------------------------

$cat = get_request_arg('categories');

$type='recent';

if($cat!='') {

	$max = $config['mobile_view_limit'];
	if($max<1) $max=5;
	$pg = ((isset($_GET['page'])) && $_GET['page'] >= 1) ? $_GET['page'] : '1';
	$type = $config['mobile_default_type'];

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
	// Hard Coded Where Results
	$where = '';
	$static = "(iphone = '1' OR embed_code LIKE '%youtube%') AND type = 'public' AND active = '1'";

	$sql = "SELECT * FROM channel WHERE CHID = '".intval($cat)."' LIMIT 1";

	

	$rs=$conn->execute($sql);
	if ( $conn->Affected_Rows() != 1 ) {
		VRedirect::go($config['BASE_URL'].'/mobile/errors/category_missing');
	}

	$chid = $rs->fields['CHID'];
	$where .= "channel = '".$chid."'";
	$smarty->assign('channel_name', $rs->fields['name']);

	$seo['mobile_title'] = $mconfig['mobile_sitename'].' - '.$rs->fields['name'].' - '.$lang['index.most_recent_videos'];


	// Count All Videos
	$sql = "SELECT COUNT(*) AS ct FROM video WHERE ".$static." AND ".$where;
	
	

	$res = $conn->execute($sql);
	$count = $res->fields['ct'];



	// Total Pages
	if($count>0) { $pages = ceil($count/$max); } else $pages=0;

	

	// Get Videos Data
	$videos=array();

	if($count>0) {

		$sql        = "SELECT * FROM video WHERE ".$static." AND ".$where. " " .$limit;
		

		$rs         = $conn->execute($sql);
		$videos     = $rs->getrows();

		$tpager='';
		if($pages>1) {
			include('pagination.php');
			$url = 'mobile/categories/';
			if(isset($request['1'])) $url.=$cat.'/';
		
			$tpager = get_pagination($pg, $pages, $url);
		}
	}
		$smarty->assign('videos', $videos);
		$smarty->assign('tpager', $tpager);
		$smarty->assign('current_page', $pg);
		$smarty->assign('total_pages', $pages);
		$module ='videos';

} else {

	$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - '.$lang['menu.categories'];

	$sql            = "SELECT * FROM channel ORDER BY name ASC";
	$rs             = $conn->execute($sql);
	$cats     = $rs->getrows();

	$categories=array();
	foreach($cats as $cat) {

		$static = "(iphone = '1' OR embed_code LIKE '%youtube%') AND type = 'public' AND active = '1'";

		$sql = "SELECT COUNT(VID) AS ct FROM video WHERE ".$static." AND channel = '".$cat['CHID']."'";
	
		$res = $conn->execute($sql);
		$cnt = $res->fields['ct'];
		
		$slug=str_replace(' ','-',$cat['name']);
		$slug=strtolower($slug);
		$categories[] = array('CHID'=>$cat['CHID'], 'name'=>$cat['name'],'total_videos'=>$cnt,'slug'=>$slug);
	}

	// Assign Page Content Data
	$smarty->assign('categories', $categories);

}

// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);

// Assign Nav Tab
$smarty->assign('mobile_menu',$mobile_menu);
$smarty->assign('mconfig',$mconfig);
// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
