<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';

if ( $config['video_view'] == 'registered' ) {
    require 'classes/auth.class.php';
    Auth::check();
}

$vid = get_request_arg('video');
if ( !$vid ) {
    VRedirect::go($config['BASE_URL']. '/error/video_missing');
}
$isMakeHtml = 1;
$expire = 7200;
$options = array(
    'host'=>$config['mem_host'],
    'port'=>$config['mem_port'],
    'prefix'=>'vdo',
    'expire'=>$expire,
    'length'=>99999999
);
$cache = Cache::getInstance('MemcacheAction',$options);
$video = $cache->get($vid);

if (!$video || !is_array($video)){
    $active     = ( $config['approve'] == '1' ) ? " AND v.active = 1" : NULL;
    $sql        = "SELECT v.VID, v.UID, v.title, v.channel, v.keyword, v.viewnumber, v.type,
                          v.addtime, v.rate, v.likes, v.dislikes, v.ratedby, v.flvdoname, v.space, v.embed_code, v.width_sd, v.height_sd, v.hd, v.iphone,
    		v.sebi,v.tuijian,u.username, u.photo, u.gender, u.fname
                   FROM video AS v, signup AS u WHERE v.VID = " .$vid. " AND v.UID = u.UID" .$active. " LIMIT 1";
    $rs         = $conn->execute($sql);
    if($rs && $conn->Affected_Rows() > 0){
        $video              = $rs->getrows();
        $video              = $video['0'];
        $cache->set($vid,$video);
    }else{
        $video = null;
        $cache->_unset($vid);
    }
}
if ( !$video ) {
    VRedirect::go($config['BASE_URL']. '/error/video_missing');
}
$uid                = ( isset($_SESSION['uid']) ) ? intval($_SESSION['uid']) : NULL;
$hide_categories = array(61,63,65,67);
if ( in_array($video['channel'], $hide_categories) && $video['tuijian'] != 4 ) {
    if ($premium == 0 ) {
        VRedirect::go($config['BASE_URL']. '/error/video_preminum');
    }else{
         if ($premium > 0) {
            $sql = "SELECT money FROM user_deposit WHERE uid = {$uid} ORDER BY dtime ASC";
            $rs         = $conn->execute($sql);
            $count = 0;
            $rows = null;
            if($rs && $conn->Affected_Rows() > 0){
                $rows = $rs->getrows();
            }
            $isFirstView = true;
            if ($rows && isset($rows[0]) && $rows[0]['money'] <= 200) {
                $isFirstView = false;
            }
            $isSumView = true;
            $sql = "SELECT SUM(money) AS total FROM user_deposit WHERE uid = {$uid} LIMIT 1";
            $rs         = $conn->execute($sql);
            $total = 0;
            if($rs && $conn->Affected_Rows() > 0){
                $total = $rs->fields['total'];
            }
            if($total <= 200){
                $isSumView = false;
            }
            if(!$isFirstView && !$isSumView){
                VRedirect::go($config['BASE_URL']. '/error/video_deposit');
            }
        }
    }
}

$hd = $video['hd'];
$video_width		= $video['width_sd'];
$video_height		= $video['height_sd'];

$player_width = 640;
$embed_width = 530;
$embed_auto_height = round(530 * ($video_height/$video_width));

if ($hd==0) 
{
	$autoheight	= round(640 * ($video_height/$video_width));
	$player_width = 640;
}
if ($hd==1) 
{
	$autoheight	= round(800 * ($video_height/$video_width));
	$player_width = 800;
}
$guest_limit	    = false;

$video['keyword']   = explode(' ', $video['keyword']);
$is_friend          = true;
//转移到视频有正常播放的时候记录
//update_cache_mysql($cache, 'up_info',$vid, 'video', 'viewnumber', 'VID',200);
//update_cache_mysql($cache, 'up_sv', intval($video['UID']), 'signup', 'video_viewed', 'UID',100);

if ( isset($_SESSION['uid']) ) {
   // update_cache_mysql($cache, 'up_sv1', $uid, 'signup', 'watched_video', 'UID',200);
    
    $sql    = "SELECT UID FROM playlist WHERE UID = " .$uid. " AND VID = " .$vid. " LIMIT 1";
    $conn->CacheExecute(3000,$sql);
    if ( $conn->Affected_Rows() == 0 ) {
        $sql    = "INSERT INTO playlist SET UID = '" .$uid. "' , VID = '" .$vid. "'";
        $conn->execute($sql);
    }
}


$sql_add        = NULL;
if ( $video['keyword'] ) {
    $sql_add   .= " OR (";
    $sql_or     = NULL;
    if (is_array($video['keyword'])) {
        foreach ( $video['keyword'] as $keyword ) {
            $sql_add .= $sql_or. " keyword LIKE '%" .mysql_real_escape_string($keyword). "%'";
            $sql_or   = " OR ";
        }
    }
    $sql_add   .= ")";
}


$sql_at		= NULL;
$sql_delim	= ' WHERE';
if ( $config['show_private_videos'] == '0' ) {
    $sql_at    .= $sql_delim. " type = 'public'";
    $sql_delim	= ' AND';
}

if ( $config['approve'] == '1' ) {
    $sql_at    .= $sql_delim. " active = '1'";
	$sql_delim  = ' AND';
}
$sql_at	       .= $sql_delim;

$title = mysql_real_escape_string($video['title']);
$key1 = $vid.'1';
$key2 = $vid.'2';
$key3 = $vid.'3';
$total_related = $cache->get($key1);
$videos = $cache->get($key2);
$page_link = $cache->get($key3);

if (!$videos){
    $sql            = "SELECT COUNT(VID) AS total_videos FROM video" .$sql_at. " channel = '" .$video['channel']. "' AND VID != " .$vid. "
                       AND ( title LIKE '%" .$title. "%' " .$sql_add. ")";
    $rsc            = $conn->CacheExecute(3000,$sql);
    $total_related = 0 ;
    if($rsc && $conn->Affected_Rows() > 0){
        $total_related  = $rsc->fields['total_videos'];
    }
    if ( $total_related > 32 ) {
        $total_related = 32;
    }
    if ($total_related > 0) {
        $cache->set($key1,$total_related);
    }else{
        $cache->_unset($key1);
    }
    
    $pagination     = new Pagination(8, 'p_related_videos_' .$video['VID']. '_');
    $limit          = $pagination->getLimit($total_related);
    $sql            = "SELECT VID, title, duration, addtime, rate, likes, dislikes, viewnumber, type, thumb, thumbs, hd FROM video
                       WHERE active = 1 AND channel = {$video['channel']} AND VID != " .$vid. "
                       AND ( title LIKE '%" .$title. "%' " .$sql_add. ")
                       ORDER BY addtime DESC LIMIT " .$limit;
    $rs             = $conn->CacheExecute(3000,$sql);
    if($rs && $conn->Affected_Rows() > 0){
        $videos         = $rs->getrows();
        $page_link      = $pagination->getPagination('video');
        $cache->set($key2,$videos);
        $cache->set($key3,$page_link);
    }else{
        $cache->_unset($key2);
        $cache->_unset($key3);
    }
}

$self_title         = $video['title'] . $seo['video_title'];
$self_description   = $video['title'] . $seo['video_desc'];
$self_keywords = '';
if (strpos($video['keyword'], ',') !== false) {
    $self_keywords      = implode(', ', $video['keyword']) . $seo['video_keywords'];
}else{
    $self_keywords      = $video['keyword'] . $seo['video_keywords'];
}
if ($new_permisions['watch_normal_videos'] == 0) {
	VRedirect::go($config['BASE_URL']. '/vip.php?ms=watch_permission');
}
$remote_ip = GetRealIP();
require $config['BASE_DIR']. '/classes/sebi.class.php';
$guest_limit = VSebi::check($remote_ip, intval($video['sebi']),$video['VID'],intval($_SESSION['uid'])); 
if (is_array($guest_limit)) {
	if (isset($guest_limit['is_premium']) && $guest_limit['is_premium'] == 0) {
		$tpl_msg = '亲爱的<font style="color:red;">%s</font>，您目前VIP身份已到期，如需续费，请与客服联系！';
		$type_of_user_str = $guest_limit['name'];
		$msg = sprintf($tpl_msg , $type_of_user_str );
	}else{
		$tpl_msg = '亲爱的<font style="color:red;">%s</font>，您目前还有剩余体验币个数：<font style="color:red;">%s</font>个，不够体验币播放该视频！';
		$type_of_user_str = $guest_limit['name'];
		$msg = sprintf($tpl_msg , $type_of_user_str , intval($guest_limit['sebi_surplus']));
	}
	$smarty->assign('vmsg', $msg);
	$smarty->assign('type_of_user_str', $type_of_user_str);
	$smarty->assign('vid', $video['VID']);
}
$type_new_player = 1;
if (is_mobile()) {
    $type_new_player = 2;
}
$key = 'new_player_'.$type_new_player;
$player_ads = $cache->get($key);
if(!$player_ads){
    $sql = "SELECT * FROM new_player WHERE type = {$type_new_player} LIMIT 0,1;";
    $rs    = $conn->CacheExecute(300,$sql);
    if($rs && $conn->Affected_Rows() > 0){
        $player_ads = $rs->fields;
        $cache->set($key,$player_ads);
    }else {
        $cache->_unset($key);
    }
}
$ads_view = in_array($type_of_user,explode('|',$player_ads['front_ads_view']));
$front_ads['src'] = $player_ads["front_ads_$type_of_user"];
$front_ads['href'] = $player_ads["front_ads_uri_$type_of_user"];
$front_ads['time'] = $player_ads["front_ads_time_$type_of_user"];

//保证获取URL的AJAX安全
$ip = GetRealIP();
if(!$guest_limit){
    $sid = session_id();
    $host = $_SERVER['HTTP_HOST'];
    $random = rand(100, 999999999999);
    $cache->_unset('randkey'.$host.$sid);
    $cache->set('randkey'.$host.$sid,$random);
    $referer = md5($_SERVER['REDIRECT_SCRIPT_URI']);
    $AVS = $_COOKIE['AVS'];
    $cache->set('redirect_url'.$host.$sid,md5($referer.$random.$ip.$AVS.$vid .'盗链可耻!=!???'));
}else 
    $cache->_unset('redirect_url');

$conn->Close();
$cache->close();
$smarty->assign('remotehost','http://'.$host);
$smarty->assign('vid',$vid);
$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);
$smarty->assign('menu', 'home');
$smarty->assign('ads_view',$ads_view);
$smarty->assign('submenu', '');
$smarty->assign('player_ads',$player_ads);
$smarty->assign('front_ads',$front_ads);
$smarty->assign('view', true);
//$smarty->assign('distributeds_token', $distributeds_token);
$smarty->assign('autoheight',$autoheight);
$smarty->assign('player_width',$player_width);
$smarty->assign('video_width',$video_width);
$smarty->assign('video_height',$video_height);
$smarty->assign('embed_width',$embed_width);
$smarty->assign('embed_auto_height',$embed_auto_height);
$smarty->assign('hd',$hd);
//$smarty->assign('distributeds_array',$distributeds_array);
$smarty->assign('c',intval(@$_GET['c']));
$smarty->assign('video', $video);
$smarty->assign('self_title', $self_title);
$smarty->assign('self_description', $self_description);
$smarty->assign('self_keywords', $self_keywords);
$smarty->assign('videos_total', $total_related);
$smarty->assign('videos', $videos);
$smarty->assign('page_link', $page_link);
$smarty->assign('type_of_user', $type_of_user);
$smarty->assign('is_friend', $is_friend);
$smarty->assign('guest_limit', $guest_limit);
$smarty->assign('new_permisions', $new_permisions);
$smarty->display('video.tpl');
$smarty->gzip_encode();
?>
