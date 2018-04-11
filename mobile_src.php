<?php
define('_VALID', 1);
/**/
require 'include/config.php';
require 'include/config.paths.php';
require 'include/config.db.php';
require 'include/config.local.php';
require 'include/function_global.php';
require 'include/adodb/adodb.inc.php';
require 'include/dbconn.php';

$sql    = "SELECT * FROM player WHERE status = '1' LIMIT 1";
$rs     = $conn->execute($sql);
if ( $conn->Affected_Rows() == 1 ) {
    $player = $rs->getrows();
    $player = $player['0'];
} else {
    die('Failed to load player profile!');
}
$f = explode('-',$_GET['vkey']);
$_GET['vkey'] = $f[0];
$_GET['a'] = $f[1];
$_GET['b'] = $f[2];
$video_id   = NULL;
if (isset($_GET['vkey']) && is_numeric($_GET['vkey'])) {
    $sql    = "SELECT VID, title, channel, server, flvdoname, ipod_filename, hd ,type FROM video WHERE VID = '" .mysql_real_escape_string($_GET['vkey']). "' AND active = '1' LIMIT 1";
    $rs     = $conn->execute($sql);
    if ( $conn->Affected_Rows() == 1 ) {
        $video_id   = $rs->fields['VID'];
	$video_type   = $rs->fields['type'];
        $channel    = $rs->fields['channel'];
        $title      = prepare_string($rs->fields['title']);
		$server		= $rs->fields['server'];
		$sd_filename    = $rs->fields['ipod_filename'];
		$hd_filename    = $rs->fields['hd_filename'];
		$hd    			= $rs->fields['hd'];
		$SD_URL			= $config['FLVDO_URL'].'/'.$sd_filename;
		$HD_URL			= $config['HD_URL'].'/'.$hd_filename;
		$lighttpd_port  = ':81';
		if($server != ''){
			$sql = "SELECT url FROM servers WHERE video_url = '".$server."' LIMIT 1";
			$rsx = $conn->execute($sql);
			$server_urls = $rsx->fields['url'];
			$server_urls = explode(':',$server_urls);
			if(is_array($server_urls))
				$server_url = $server_urls[0].':'.$server_urls[1];
			else
				$server_url = $server_urls;
		}		
    }
}

if ( !$video_id ) {
    die('Invalid video key!');
}

if ($config['lighttpd'] == '1') {
  	$file_sd        = '/iphone/' .$video_id. '.mp4';
  	$file_hd        = '/hd/' .$video_id. '.mp4';
  	$timestamp      = time();
  	$timestamp_hex  = sprintf("%08x", $timestamp);
	$md5sum_sd      = md5($config['lighttpd_key'] . $file_sd . $timestamp_hex);
	$md5sum_hd      = md5($config['lighttpd_key'] . $file_hd . $timestamp_hex);
}

if ($config['multi_server'] == '1' && $server != '') {
	if ($config['lighttpd'] == '1') {
		$SD_URL    = $server_url.$lighttpd_port.$config['lighttpd_prefix'].$md5sum_sd.'/'.$timestamp_hex.$file_sd;
		$HD_URL    = $server_url.$lighttpd_port.$config['lighttpd_prefix'].$md5sum_hd.'/'.$timestamp_hex.$file_hd;
	} else {
		$SD_URL = $server.'/iphone/'.$sd_filename;
		$HD_URL = $server.'/hd/'.$hd_filename;
	}
} else {
	if ($config['lighttpd'] == '1') {
		$SD_URL = $config['BASE_URL'].$lighttpd_port.$config['lighttpd_prefix'].$md5sum_sd.'/'.$timestamp_hex.$file_sd;
  		$HD_URL = $config['BASE_URL'].$lighttpd_port.$config['lighttpd_prefix'].$md5sum_hd.'/'.$timestamp_hex.$file_hd;
	} 
}

$madv   = array('src' => '', 'mode' => 'none', 'duration' => '', 'link' => '');
$sql    = "SELECT adv_id, adv_url, media, duration FROM adv_media WHERE status = '1' ORDER BY rand() LIMIT 1";
$rs     = $conn->execute($sql);

if ( $conn->Affected_Rows() === 1 ) {
    $mid                = intval($rs->fields['adv_id']);
    $madv['src']        = $config['BASE_URL']. '/media/player/adv/' .$mid. '.' .$rs->fields['media'];
    $madv['mode']       = $player['video_adv_position'];
    $madv['duration']   = $rs->fields['duration'];
    $madv['link']       = $config['BASE_URL']. '/media/player/click.php?MID=' .$mid;
    $sql                = "UPDATE adv_media SET views = views+1 WHERE adv_id = " .$mid. " LIMIT 1";
    $conn->execute($sql);
}
// Is HD or Not
$HD_URL = ($hd == '1' && $_GET['a'] == '1') ? $HD_URL : '';


VRedirect::go($SD_URL);
?>
