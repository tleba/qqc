<?php
if($_SERVER['HTTP_REFERER'] === ""){
exit();
}
define('_VALID', 1);
require '../../include/config.paths.php';
require '../../include/config.db.php';
require '../../include/config.php';
require '../../include/config.local.php';
require '../../include/function_global.php';
//require '../../include/function_language.php';
require '../../include/adodb/adodb.inc.php';
require '../../include/dbconn.php';
//update3.1
require_once ('../../include/function_thumbs.php');

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
$_GET['c'] = $f[3];
//print_r($_GET);
$video_id   = NULL;
$videos = distributed_videoinfo($_GET['vkey']);
if(!$videos) exit('视频不存在');

$video_id = $_GET['vkey'];

$default_url = default_server_array($_GET['vkey']); // 默认线路
$num = 0;
if($videos['added']==='yes'){

		$get_distributed = get_distributed($videos['VID']);
		if($get_distributed){
		$default_url = array_merge($default_url,$get_distributed); // 分布式线路+默认线路	
		}

}

	$distributeds = $_GET['c'];
	$array_count = count($default_url)-1;
	if($distributeds==='' OR !isset($distributeds)){
	 // 随机	
	 $num = array_rand($default_url,1); 
	
	}else{
		if($distributeds<=$array_count){$num = intval($distributeds);}else{$num = '0';}
	} // 获取参数

$default_url = $default_url["$num"]; // 最终线路

$SD_URL = $default_url['flv'];
$HD_URL = $default_url['mp4'];



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
header('Content-Type: text/xml; charset=utf-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
?>
<xml>
  <logo>
    <image><?php echo $config['BASE_URL']. '/media/player/logo/' .$player['logo_url']; ?></image>
    <position><?php echo $player['logo_position']; ?></position>
    <link><?php echo $player['logo_link']; ?></link>
    <alpha><?php echo $player['logo_alpha']; ?></alpha>
  </logo>
  <video>
    <autorun><?php echo $player['autorun']; ?></autorun>
    <image><?php echo get_thumb_url($video_id). '/default.jpg'; ?></image>
    <bufferTime><?php echo $player['buffertime']; ?></bufferTime>
    <src><?php echo $SD_URL; ?></src>
    <hd><?php echo $HD_URL; ?></hd>
	<ratio>fit</ratio>       
    <?php if ($config['lighttpd'] == '1'): ;?> 
    <server>lighttpd</server> 
    <?php endif; ?> 
    <related><?php echo $config['BASE_URL']. '/media/player/related.php?mode=' .$player['related_content']. '&amp;video_id=' .$video_id; ?></related>
  </video>
  <?php if ($_GET['b'] == 1) : ?>
  <mediaAdv>
    <src><?php echo $madv['src']; ?></src>
    <mode><?php echo $madv['mode']; ?></mode>
    <duration><?php echo $madv['duration']; ?></duration>
    <link><?php echo $madv['link']; ?></link>
  </mediaAdv>
  <?php endif; ?>
  <?php if ($_GET['b'] == 0) : ?>
  <mediaAdv>
  <src/>
  <mode>none</mode>
  <duration/>
  <link/>
  </mediaAdv>
  <?php endif;?>
  <textAdv<?php if ( $player['text_adv'] == '1' && $_GET['b'] == 1) {; ?> enable="true"<?php } ?>>
    <src><?php echo $config['BASE_URL']. '/media/player/ads.php'; ?></src>
    <delay><?php echo $player['text_adv_delay']; ?></delay>
  </textAdv>
  <share><?php echo $config['BASE_URL']. '/video/' .$video_id. '/' .$title; ?></share>
  <embed><?php echo '<![CDATA[<embed width="452" height="361" quality="high" wmode="transparent" name="main" id="main" allowfullscreen="true" allowscriptaccess="always" src="' .$config['BASE_URL']. '/media/player/player.swf?f=' .$config['BASE_URL']. '/media/player/config_embed.php?vkey=' .$video_id. '" type="application/x-shockwave-flash" />]]>'; ?></embed>
  <skin><?php echo $config['BASE_URL']. '/media/player/skin.php?t=' .$player['skin']. '&amp;b=' .$player['buttons']. '&amp;r=' .$player['replay']. '&amp;e=' .$player['embed']. '&amp;s=' .$player['share']. '&amp;m=' .$player['mail']. '&amp;p=' .$player['related']. '&amp;mc=' .$player['mail_color']. '&amp;rc=' .$player['related_color']. '&amp;ec=' .$player['embed_color']. '&amp;rec=' .$player['replay_color']. '&amp;cc=' .$player['copy_color']. '&amp;tc=' .$player['time_color']. '&amp;sc=' .$player['share_color']. '&amp;anc=' .$player['adv_nav_color']. '&amp;atc=' .$player['adv_title_color']. '&amp;abc=' .$player['adv_body_color']. '&amp;alc=' .$player['adv_link_color']. '&amp;video=' .$video_id; ?></skin>
</xml>
