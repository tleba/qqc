<?php

$mobile_menu				= 'photo';
$module						= 'photo';

$pid = get_request_arg('photo');
if ( !$pid ) {
    VRedirect::go($config['BASE_URL'].'/mobile/errors/photo_missing');
}

$sql        = "SELECT PID, AID, caption, rate, ratedby FROM photos WHERE PID = " .$pid. " AND status = '1' LIMIT 1";
$rs         = $conn->execute($sql);
if ( $conn->Affected_Rows() != 1 ) {
    VRedirect::go($config['BASE_URL'].'/mobile/errors/photo_missing');
}

if(!$errors) {

	$photo      = $rs->getrows();
	$photo      = $photo['0'];

	if(strlen($photo['caption'])>0) {
		$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - '.$photo['caption']. ' '.$lang['album.photo'];
	}else {
		$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - '.$lang['album.photo'].' #'.$pid;
	}

	$aid        = intval($photo['AID']); 

	$sql        = "SELECT UID, name, type, tags FROM albums WHERE AID = " .$aid. " AND status = '1' LIMIT 1";
	$rs         = $conn->execute($sql);
	if ( $conn->Affected_Rows() != 1 ) {
		$errors[] = 'Invalid photo album!';
	}
	
	if(!$errors) {

		$album      = $rs->getrows();
		$album      = $album['0'];

		$sql    = "SELECT PID FROM photos WHERE AID = " .$aid. " AND PID < " .$pid. " AND status = '1' ORDER BY PID DESC LIMIT 1";
		$rs     = $conn->execute($sql);
		if ( $conn->Affected_Rows() == 1 ) {
			$prev   = $rs->fields['PID'];
			$prev = '<a href="'.$config['BASE_URL'].'/mobile/photo/'.$prev.'" data-role="button" data-theme="b" data-inline="true" rel="external">&lt;</a>';	
			$smarty->assign('prev', $prev);
		}

		$sql    = "SELECT PID FROM photos WHERE AID = " .$aid. " AND PID > " .$pid. " AND status = '1'  ORDER BY PID ASC LIMIT 1";
		$rs     = $conn->execute($sql);
		if ( $conn->Affected_Rows() == 1 ) {
			$next   = $rs->fields['PID'];
			$next = '<a href="'.$config['BASE_URL'].'/mobile/photo/'.$next.'" data-role="button" data-theme="b" data-inline="true" rel="external">&gt;</a>';	
			$smarty->assign('next', $next);
		}

		$sql            = "UPDATE photos SET total_views = total_views+1 WHERE PID = " .$pid. " LIMIT 1";
		$conn->execute($sql);

	}
}

$smarty->assign('album', $album);
$smarty->assign('photo',$photo);
$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);
$smarty->assign('mobile_menu', 'photos');
$smarty->assign('mconfig',$mconfig);

// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);

// Assign Nav Tab
$smarty->assign('mobile_menu','photos');

// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();
?>
