<?php
/*|******************************************************
|*|	iPhone / iPod - Mobile Webapp Module Version
|*| -----------------------------
|*| AVS Version 2.0+
|*| by Nuevolab.com
|*| 12-03-2009
|*|******************************************************
|*/

$errors = '';
$messages = '';
$mobile_menu				= 'videos';
$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' Error: Page missing';
$module						= '404';
// ------------------------------------------------------------------------------


$error_type = get_request_arg('error');

switch ( $error_type ) {
    case 'video_private':
        $message = 'This video is private. You must be friends with the owner to view this video!';
        break;
    case 'album_private':
        $message = 'This album is private. You must be friends with the owner to view this album!';
        break;
    case 'photo_private':
        $message = 'This photo is private. You must be friends with the owner to view this photo!';
        break;
    case 'video_missing':
        $message = 'This video cannot be found. Are you sure you typed in the correct url?';
        break;
    case 'album_missing':
        $message = 'This album cannot be found. Are you sure you typed in the correct url?';
        break;
    case 'photo_missing':
        $message = 'This photo cannot be found. Are you sure you typed in the correct url?';
        break;
    case 'registration_disabled':
        $message = 'User registration is currently disabled. Please try again later!';
        break;
    default:
        $message = 'Unexpected error! Please contact us and tell us more how you got to this page!';
        break;
}

$module ='error';

$smarty->assign('error', $error);

// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);
$smarty->assign('self_description', $seo['mobile_desc']);
$smarty->assign('self_keywords', $seo['mobile_keywords']);

// Assign Nav Tab
$smarty->assign('mobile_menu','');
$smarty->assign('mconfig',$mconfig);
// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
