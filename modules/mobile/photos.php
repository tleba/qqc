<?php

$mobile_menu				= 'videos';
$seo['mobile_title'] 		= $config['mobile_sitename']. ' - '.$lang['menu.photos'];
$seo['mobile_desc'] 		= $lang['menu.photos'].'. '.$config['mobile_seo_description'];
$module						= 'photos';

if ( $config['photo_module'] == '0' ) {
       VRedirect::go($config['BASE_URL']. '/mobile/videos/');
}

$pg = ((isset($_GET['page'])) && $_GET['page'] >= 1) ? $_GET['page'] : '1';
$type			= 'public';

if($pg>1) {
	$seo['mobile_title'].' - '.$lang['menu.photos'].'. Page '.$pg;
    $seo['mobile_desc'] = $lang['menu.photos'].' - Page '.$pg.'. '.$config['mobile_seo_description'];
}

$max = $config['mobile_view_limit'];
if($max<1) $max=5;
if($pg == '1'){
$start = "0"; $pg = '1';}
else{$start = (($pg-1) * $max);}
if($start < 1){$start = 0;}
$limit = " ORDER BY a.addtime DESC LIMIT ".$start.", ".$max;



$sql            = "SELECT COUNT(AID) AS total_albums FROM albums WHERE type='public' AND status = '1'";


$rsc            = $conn->execute($sql);
$total          = $rsc->fields['total_albums'];
// Total Pages
$pages = ceil($total/$max);



$sql            = "SELECT a.*, s.username FROM albums AS a, signup AS s WHERE a.type='public' AND a.status = '1' AND a.UID = s.UID ".$limit;

$rs             = $conn->execute($sql);
$albums         = $rs->getrows();




$albs=array();
$i=0;

foreach($albums as $alb) {
	if($alb['total_photos']>1) {
		$pid=$alb['AID']; $photos='';
		$sql="SELECT * FROM photos WHERE AID = ".$alb['AID'];
		$rs=$conn->execute($sql);
		$rows=$rs->getrows();
		foreach($rows as $row) {
			$photos.=$row['PID']."|";
		}
		$photos =trim($photos,"|");
		$albums[$i]['photos'] = $photos;
		$photo[$i]=$photos;
		
	}
	$i++;
}

$tpager='';
if($pages>1) {
	include('pagination.php');
	$url = 'mobile/photos/';
	if(isset($request['1'])) $url.=$request['1'].'/';
	$tpager = get_pagination($pg, $pages, $url);
}

$smarty->assign('tpager', $tpager);
$smarty->assign('current_page', $pg);
$smarty->assign('total_pages', $pages);
$smarty->assign('photos',$photo);
$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);
$smarty->assign('mobile_menu', 'photos');

$smarty->assign('type', $type);
$smarty->assign('albums_total', $total);
$smarty->assign('albums', $albums);

// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);
$smarty->assign('self_description', $seo['mobile_desc']);

// Assign Nav Tab
$smarty->assign('mobile_menu','photos');
$smarty->assign('mconfig',$mconfig);

// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
