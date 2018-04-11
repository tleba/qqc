<?php
define('_VALID', true);
define('_MOBILE', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';	



$mobile_loaders = array(
	'videos', 'categories', 'photos', 'login', 'signup', 'album', 'faq', 'privacy', 'terms', 'dmca', 'watch', 'photo', '404' 
);

$config['mobile_default']='videos';
$load = get_request_arg('mobile','STRING');
if($load=='') {
  $load = $config['mobile_default'];
}

$required = $config['BASE_DIR'].'/modules/mobile/'.$load.'.php';



if (!isset($mobile_loaders[$load]) || !file_exists($required) ) {
	$load='404';
}


if(!isset($config['mobile_sitename']))
	$config['mobile_sitename'] = $config['site_name'];
if(!isset($config['mobile_seo_title']))
	$config['mobile_seo_title'] = 'Free video share service for mobile devices';
if(!isset($config['mobile_seo_description']))
	$config['mobile_seo_description'] = $config['site_name'].' - for mobile. Watch, share, comment.';
if(!isset($config['mobile_tint']))
	$config['mobile_tint'] = 'blue';
if(!isset($config['mobile_thumbs']))
	$config['mobile_thumbs'] = '1';
if(!isset($config['mobile_watch_type']))
	$config['mobile_watch_type'] = 'page';
if(!isset($config['mobile_watch_player']))
	$config['mobile_watch_player'] = 'poster';

if(!isset($config['mobile_view_limit']))
	$config['mobile_view_limit'] = '5';
if(!isset($config['mobile_faq']))
	$config['mobile_faq'] = '1';
if(!isset($config['mobile_terms']))
	$config['mobile_terms'] = '1';
if(!isset($config['mobile_privacy']))
	$config['mobile_privacy'] = '1';
if(!isset($config['mobile_dmca']))
	$config['mobile_dmca'] = '1';


$mconfig=array();
$mconfig['mobile_sitename'] = $config['mobile_sitename'];
$mconfig['mobile_seo_title'] = $config['mobile_seo_title'];
$mconfig['mobile_seo_description'] = $config['mobile_seo_description'];
$mconfig['mobile_view_limit'] = $config['mobile_view_limit'];
$mconfig['mobile_tint'] = $config['mobile_tint'];
$mconfig['mobile_watch_type'] = $config['mobile_watch_type'];
$mconfig['mobile_thumbs'] =  $config['mobile_thumbs'];
$mconfig['mobile_faq'] = $config['mobile_faq'];
$mconfig['mobile_terms'] = $config['mobile_terms'];
$mconfig['mobile_privacy'] = $config['mobile_privacy'];
$mconfig['mobile_dmca'] = $config['mobile_dmca'];
$mconfig['mobile_watch_player'] =  $config['mobile_watch_player'];


$sql="select * from mobile_static";
$rs = $conn->execute($sql);
if($rs==false) {
$sql = "CREATE TABLE IF NOT EXISTS `mobile_static` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `content` text character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;";
$conn->execute($sql);
$sql = "INSERT INTO `mobile_static` (`ID`, `name`, `content`) VALUES
(1, 'faq', 'Your content goes here'),
(2, 'terms', 'Your content goes here'),
(3, 'privacy', 'Your content goes here'),
(4, 'dmca', 'Your content goes here');";
$conn->execute($sql);
}


if(!isset($lang['mobile.length']))  $lang['mobile.length'] = 'Length';
if(!isset($lang['mobile.rating'])) $lang['mobile.rating'] = 'Rating';
if(!isset($lang['mobile.views'])) $lang['mobile.views'] = 'Views';
if(!isset($lang['mobile.related'])) $lang['mobile.related'] = 'Related videos';
if(!isset($lang['mobile.video'])) $lang['mobile.video'] = 'video';
if(!isset($lang['mobile.videos'])) $lang['mobile.videos'] = 'videos';


$sql="select * from mobile_static";
$rs=$conn->execute($sql);
$rows = $rs->getrows();
$static=array();
foreach ($rows as $row) {
	$static[$row['name']]=$row['content'];
}

require $required;
?>