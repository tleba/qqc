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
$module						= 'watch';
// ------------------------------------------------------------------------------

if ( $config['video_view'] == 'registered' ) {
    require 'classes/auth.class.php';
    Auth::check();
}

$vid = get_request_arg('watch');
if ( !$vid ) {
    VRedirect::go($config['BASE_URL'].'/mobile/errors/video_missing');
}

$active     = ( $config['approve'] == '1' ) ? " AND v.active = '1'" : NULL;
$sql        = "SELECT v.VID, v.UID, v.description, v.title, v.duration, v.channel, v.keyword, v.viewnumber, v.type,
                      v.addtime, v.rate, v.ratedby, v.flvdoname, v.space, v.embed_code, v.width_sd, v.height_sd,v.hd,
					  u.username, u.fname
               FROM video AS v, signup AS u WHERE v.VID = " .$vid. " AND v.UID = u.UID" .$active. " LIMIT 1";


$rs         = $conn->execute($sql);
if ( $conn->Affected_Rows() != 1 ) {
    VRedirect::go($config['BASE_URL'].'/mobile/errors/video_missing');
}

if(!$errors) {

	$video              = $rs->getrows();
	$video              = $video['0'];



	if($video['embed_code']!='') {
		//$video['embed_code'] = SetEmbedSize(100,100,$video['embed_code']);
	}



	$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - '.$video['title'];
	if(strlen($video['description'])>5) {
		$desc = nl2br($video['description']);
		$desc = strip_tags($desc);
		$desc= str_replace('"','',$desc);
		$desc= str_replace("'",'',$desc);
		$seo['mobile_desc']			= $desc;;
	} else {
		$seo['mobile_desc'] 		= $mconfig['mobile_seo_description'].'. '.$video['title'];
	}

if(isset($_SESSION['uid']))
{
		$sql        = "SELECT allowvideo from signup WHERE UID='".intval($_SESSION['uid'])."' LIMIT 1";
		$rs         = $conn->execute($sql);
		if ( $conn->Affected_Rows() != 1 ) Auth::check();else	$gcallowvide = $rs->fields['allowvideo'];
}
$guest_limit	    = false;
if ((!isset($_SESSION['uid']) && $config['guest_limit'] == '1')||(isset($_SESSION['uid'])&& $gcallowvide <1)) {
    $remote_ip = ip2long($remote_ip);
    require $config['BASE_DIR']. '/classes/bandwidth.class.php';
    $guest_limit = VBandwidth::check($remote_ip, intval($video['space']),isset($_SESSION['uid']));
		if($guest_limit!=false) $smarty->assign('guest_limit', $guest_limit);
}

	$sql        = "UPDATE video SET viewnumber = viewnumber+1, viewtime='" .date('Y-m-d H:i:s'). "' WHERE VID = " .$vid. " LIMIT 1";
	$conn->execute($sql);
	$sql        = "UPDATE signup SET video_viewed = video_viewed+1 WHERE UID = " .intval($video['UID']). " LIMIT 1";
	$conn->execute($sql);
	if ( isset($_SESSION['uid']) ) {
		$sql    = "UPDATE signup SET watched_video = watched_video+1 WHERE UID = " .$uid. " LIMIT 1";
		$conn->execute($sql);
	}

	

	$video['keyword']   = explode(' ', $video['keyword']);
	$sql_add        = NULL;
	if ( $video['keyword'] ) {
		$sql_add   .= " OR (";
		$sql_or     = NULL;    
		foreach ( $video['keyword'] as $keyword ) {
			$sql_add .= $sql_or. " keyword LIKE '%" .mysql_real_escape_string($keyword). "%'";
			$sql_or   = " OR ";
		}
		$sql_add   .= ")";
	}
	$sql            = "SELECT VID, title, duration, addtime, rate, viewnumber, type, thumb, thumbs FROM video
                   WHERE active = '1' AND channel = '" .$video['channel']. "' AND (iphone='1' || embed_code LIKE '%youtube%') AND VID != " .$vid. "
                   AND ( title LIKE '%" .mysql_real_escape_string($video['title']). "%' " .$sql_add. ")
                   ORDER BY addtime DESC LIMIT 5";



	$rs             = $conn->execute($sql);
	$related        = $rs->getrows();
}

//Assign canonical
$smarty->assign('canonical',$config['BASE_URL'].'/video/'.$video['VID'].'/'.title_clean($video['title']));


if(strpos($_SERVER['HTTP_USER_AGENT'],"iPhone")) {
	$smarty->assign('iphone','1');
}

// Assign Page Content Data
$smarty->assign('related', $related);
$smarty->assign('video', $video);

// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);
if(isset($seo['mobile_desc'])) $smarty->assign('self_description', $seo['mobile_desc']);

// Assign Nav Tab
$smarty->assign('mobile_menu',$mobile_menu);
$smarty->assign('mconfig',$mconfig);

// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();
function title_clean($string)
{
    if (preg_match('/^.$/u', 'n')) {
        $string = preg_replace('/[^\pL\pN\pZ]/u', ' ', $string);
        $string = preg_replace('/\s\s+/', ' ', $string);
    } else {
        $string = ereg_replace('[^ 0-9a-zA-Z]', ' ', $string);
        $string = preg_replace('/\s\s+/', ' ', $string);
    }
    $string = trim($string);
    $string = str_replace(' ', '-', $string);
    
    return mb_strtolower($string);
}
if ($config['multi_server'] == '1' && $server != '') {
				if ($config['lighttpd'] == '1') {
					$SD_URL    = $server_url.$lighttpd_port.$config['lighttpd_prefix'].$md5sum_sd.'/'.$timestamp_hex.$file_sd;
					$HD_URL    = $server_url.$lighttpd_port.$config['lighttpd_prefix'].$md5sum_hd.'/'.$timestamp_hex.$file_hd;
				} else {
					$SD_URL = $server.'/flv/'.$sd_filename;
					$HD_URL = $server.'/hd/'.$hd_filename;
				}
			} else {
				if ($config['lighttpd'] == '1') {
					$SD_URL = $config['BASE_URL'].$lighttpd_port.$config['lighttpd_prefix'].$md5sum_sd.'/'.$timestamp_hex.$file_sd;
			  		$HD_URL = $config['BASE_URL'].$lighttpd_port.$config['lighttpd_prefix'].$md5sum_hd.'/'.$timestamp_hex.$file_hd;
				} 
			}
?>
