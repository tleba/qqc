<?php

$mobile_menu				= 'videos';
$module						= 'album';

$aid = get_request_arg('album');
$aid        = intval($aid);
$sql        = "SELECT AID, UID, category, type, name, tags, total_photos FROM albums WHERE AID = " .$aid. " LIMIT 1";


$rs         = $conn->execute($sql);
if ( $conn->Affected_Rows() != 1 ) {
    VRedirect::go($config['BASE_URL'].'/mobile/errors/album_missing');
}
$album      = $rs->getrows();
$album      = $album['0'];

$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - '.$album['name'].' '.$lang['global.category'];

$sql            = "SELECT COUNT(PID) AS total_photos FROM photos WHERE AID = " .$aid. " AND status = '1'";
$rsc            = $conn->execute($sql);
$total          = $rsc->fields['total_photos'];



$sql            = "SELECT PID, caption FROM photos WHERE AID = " .$aid. " AND status = '1'";
$rs             = $conn->execute($sql);
$photos         = $rs->getrows();

$smarty->assign('album',$album);
$smarty->assign('photos',$photos);
$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);
$smarty->assign('mobile_menu', 'photos');

$smarty->assign('albums_total', $total);


// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);

// Assign Nav Tab
$smarty->assign('mobile_menu','photos');
$smarty->assign('mconfig',$mconfig);
// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();
?>
