<?php
if($_SERVER['HTTP_REFERER'] == ""){
//exit();
}
header("Content-type: application/x-javascript; charset=utf-8"); 
define('_VALID', 1);
require 'include/config.paths.php';
require 'include/config.db.php';
require 'include/config.php';
require 'include/config.local.php';
require 'include/function_global.php';
require 'include/adodb/adodb.inc.php';
require 'include/dbconn.php';
require_once ('include/function_thumbs.php');

$sql    = "SELECT * FROM player WHERE status = '1' LIMIT 1";
$rs     = $conn->execute($sql);
if ( $conn->Affected_Rows() == 1 ) {
    $player = $rs->getrows();
    $player = $player['0'];
} else {
    die('Failed to load player profile!');
}
$_GET['vkey'] = get_request_arg('video');
$token = get_request_arg('token','varchar');
$videos = distributed_videoinfo($_GET['vkey']);
if($token != distributeds_token()){
    exit('TOKEN错误');
}
$default_url = default_server_array($videos['VID']); // 默认线路
if($videos['added']==='yes'){
$get_distributed = get_distributed($videos['VID']);
if($get_distributed){
$default_url = array_merge($default_url,$get_distributed); // 分布式线路+默认线路	
}
}
$default_url = $default_url; // 最终线路
$tmp = get_thumb_url($videos['VID']). '/default.jpg';

$sql = "SELECT * FROM new_player WHERE 1=1 LIMIT 0,1;";
$rs    = $conn->CacheExecute(300,$sql);
$player_ads = $rs->fields;

$ads_view = in_array("$type_of_user",explode('|',$player_ads['front_ads_view']));
$front_ads['src'] = $player_ads["front_ads_$type_of_user"];
$front_ads['href'] = $player_ads["front_ads_uri_$type_of_user"];
$front_ads['time'] = $player_ads["front_ads_time_$type_of_user"];

//print_r($videos);
echo '/*******多线路加速播放，此链接不定时失效******/'."\r\n";
foreach ($default_url as $age=>$key) {
    //echo $age;
//    echo 'var'." flash_player_$age = '".'<embed type=\"application/x-shockwave-flash\" src=\"/media/player/player.swf?f=/media/player/config.php?vkey='.$_GET['vkey'].'-0-1-'.$age.'\" width=\"100%\" height=\"100%\" style=\"undefined\" id=\"main\" name=\"main\" bgcolor=\"#000000\" quality=\"high\" allowfullscreen=\"true\" allowscriptaccess=\"always\" wmode=\"opaque\">\';'."\r\n";

//$vars = "f=".$key['mp4']."&amp;a=&amp;s=0&amp;c=0&amp;x=&amp;i=".$tmp."&amp;d=/ads/player/load.png&amp;u=http://www.zhiboav.me/?ads1&amp;y=&amp;e=3&amp;v=80&amp;p=0&amp;h=0&amp;q=&amp;m=&amp;o=&amp;w=&amp;g=&amp;j=&amp;k=30|60&amp;wh=&amp;lv=0&amp;loaded=loadedHandler";
echo "var url_{$age} = '{$key['mp4']}';";
if($ads_view){
$ads = "&amp;l=".$front_ads['src']."&amp;r=".$front_ads['href']."&amp;t=".$front_ads['time'];
}else{
$ads = '';
}

$vars = "f=".$key['mp4']."&amp;a=&amp;s=0&amp;c=0&amp;x=&amp;i=".$tmp."&amp;d=".$player_ads['stop_ads']."".$ads."&amp;u=".$player_ads['stop_ads']."&amp;y=&amp;e=3&amp;v=80&amp;p=0&amp;h=0&amp;q=&amp;m=&amp;o=&amp;w=&amp;g=&amp;j=&amp;k=30|60&amp;wh=&amp;lv=0&amp;loaded=loadedHandler";

echo 'var'." flash_player_$age = '".'<embed src=\"/media/new_player/player.swf\" flashvars=\"'.$vars.'\" quality=\"high\" width=\"100%\" height=\"100%\" align=\"middle\" allowScriptAccess=\"always\" allowFullscreen=\"true\" type=\"application/x-shockwave-flash\"></embed>\';'."\r\n";
//echo 'var'." flash_player_$age = '".'<object pluginspage=\"http://www.macromedia.com/go/getflashplayer\" classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=11,3,0,0\" width=\"100%\" height=\"100%\" id=\"flash_player_id\" name=\"flash_player_id\" align=\"middle\"><param name=\"allowScriptAccess\" value=\"always\"><param name=\"allowFullScreen\" value=\"true\"><param name=\"quality\" value=\"high\"><param name=\"bgcolor\" value=\"#FFF\"><param name=\"wmode\" value=\"transparent\"><param name=\"movie\" value=\"/media/new_player/player.swf\"><param name=\"flashvars\" value=\"'.$vars.'\"><embed allowscriptaccess=\"always\" allowfullscreen=\"true\" quality=\"high\" bgcolor=\"#FFF\" wmode=\"transparent\" src=\"/media/new_player/player.swf\" flashvars=\"'.$vars.'\" width=\"100%\" height=\"100%\" name=\"flash_player_id\" id=\"flash_player_id\" align=\"middle\" type=\"application/x-shockwave-flash\" pluginspage=\"\"></object>\';'."\r\n";

    echo 'var'." mobile_video_$age = '<video controls poster=\"".$tmp."\" width=\"100%\" height=\"100%\"> <source src=\"".$key['mp4']."\" type=\"video/mp4\"></video>';\r\n";
}

foreach ($default_url as $age=>$key) {
$arr['id'] = $age;
$arr['gname'] = $key['gname'];
$distributeds_array[]= $arr;
}

?>
// Email:office.frontend@gmail.com

// 线路切换 START

 $(document).ready(function(){
 <?php 
 foreach ($distributeds_array as $age=>$key) {
 ?>
 // 电脑开始
$("#line_<?php echo $age;?>").click(function(){
$("#flash").html('<div style="width: 100%; height: 100%; background: url(<?php echo $tmp; ?>) no-repeat; color: red; font-size: 3em; text-align: center; background-size: 100%;">加载中。。。。。</div>');
setTimeout(function () { 
        loadVideo(url_<?php echo $age;?>);
       //$("#flash").html(flash_player_<?php echo $age;?>);
    }, 1000);
});
//手机开始
$("#mobile_line_<?php echo $age;?>").click(function(){
$("#mobile_player").html('<div style="width: 100%; height: 100%; background: url(<?php echo $tmp; ?>) no-repeat; color: red; font-size: 3em; text-align: center; background-size: 100%;">加载中。。。。。</div>');
setTimeout(function () { 
        loadVideo(url_<?php echo $age;?>);
       //$("#mobile_player").html(mobile_video_<?php echo $age;?>);
    }, 1000);
});


	<?php }?>

 });

// 线路切换 END

function detectFlash() {
        //navigator.mimeTypes是MIME类型，包含插件信息
    if(navigator.mimeTypes.length>0){
    //application/x-shockwave-flash是flash插件的名字
        var flashAct = navigator.mimeTypes["application/x-shockwave-flash"];
        return flashAct != null ? flashAct.enabledPlugin!=null : false;
    } else if(self.ActiveXObject) {
        try {
            new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
            return true;
        } catch (oError) {
            return false;
        }
    }
}

if(detectFlash()){
document.writeln("<style>#mobile_player_line{display:none;}</style>");
}else{
document.writeln("<style>#pc_player_line{display:none;}</style>");
}
