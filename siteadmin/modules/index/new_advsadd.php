<?php
defined('_VALID') or die('Restricted Access!');
set_time_limit(0);
Auth::checkAdmin();
$adv    = array('name' => '', 'group' => 0, 'text' => '', 'status' => '1');

if ( isset($_POST['adv_add']) ) {
    //图片放置路径
    $advImgPath = '/ps';
    $advAllImgPath 	= $config['BASE_DIR'].$advImgPath;
	
    $name   = trim($_POST['name']);
    $zone_id  = trim($_POST['zone_id']);
    $url   = trim($_POST['url']);
	$media = trim($_POST['media']);
	$title = trim($_POST['title']);
	$rename = trim($_POST['rename']);
    $ismobile = intval($_POST['ismobile']);
    $margin = $_POST['margin'];
    $isbtn  = intval($_POST['isbtn']);
    
    if ( $name == '' ) {
        $errors[]       = 'Advertise name field cannot be left blank!';
    } else {
        $adv['name']    = $name;
    }
    
    if ( $zone_id == '0' ) {
        $errors[]       = 'Please select a advertise group!';
    } else {
        $adv['zone_id']   = intval($zone_id);
    }
	
	if ( $url == '' ) {
        $errors[]       = 'Advertise url cannot be blank!';
    } else {
        $adv['url']    = $url;
    }
    $adv['media'] = $media;
    //短连接键
    $hash = khash($media.$_SERVER['REQUEST_TIME']);

    if ( $_FILES['relogopic']['tmp_name'] != '' ) {
	    if ( !is_uploaded_file($_FILES['relogopic']['tmp_name']) ) {
	    	$errors[]           = $lang['upload.album_invalid'];
	    } else {
	    	$filename           = substr($_FILES['relogopic']['name'], strrpos($_FILES['relogopic']['name'], DIRECTORY_SEPARATOR)+1);
	    	$extension          = strtolower(substr($_FILES['relogopic']['name'], strrpos($_FILES['relogopic']['name'], '.')+1));
	    	$extensions_allowed = explode(',', trim($config['image_allowed_extensions']));
	    	if ( !in_array($extension, $extensions_allowed) ) {
	    		$errors[] 		= translate('upload.album_ext_invalid', $config['image_allowed_extensions']);
	    	}
	    }
	    $name_q   = time() . rand(1, 999999999);
	    $jpgname    = $name_q. '.' .$extension;
	    
	    $logo_path   = $advAllImgPath. '/' .$jpgname;
	    $jpgpath = $advImgPath.'/'.$jpgname;
	    
	    if ( !move_uploaded_file($_FILES['relogopic']['tmp_name'], $logo_path) ) {
	    	$errors[]   = 'Failed to move uploaded file!';
	    }
	}
    if ( !$errors ) {
       	$zone_id = intval($zone_id);
    	$url = mysql_real_escape_string($url);
    	$media =mysql_real_escape_string($media);
    	$name = mysql_real_escape_string($name);
    	$title = mysql_real_escape_string($title);
    	$rename = mysql_real_escape_string($rename);
    	$margin = mysql_real_escape_string($margin);
    	$time = time();
    	$sql = "INSERT INTO adv_ads (zone_id, url, media, name, title, relname, relogopic, addtime,ismobile,margin,isbtn,hash)
                           VALUES ({$zone_id},'{$url}','{$media}','{$name}','{$title}','{$rename}','{$jpgpath}',{$time},{$ismobile},'{$margin}',{$isbtn},'{$hash}')";
        $result = $conn->execute($sql);
        if($result && $conn->Affected_Rows()>0){
            $id = $conn->Insert_ID();
            $advPath = downloadImg($media, $advAllImgPath, $id);
            if($advPath){
                $advPath = $advImgPath.'/'.$advPath;
                $sql = 'UPDATE adv_ads SET localpic = \''.$advPath.'\'  WHERE id='.$id;
                $conn->execute($sql);
            }
    		write_ads_cache($advAllImgPath);
            $messages[]     = 'Advertising banner successfully added!';
        }else 
            $errors[] = 'Advertising banner failed added!';
    }
}
$advzones = array();
$sql        = "SELECT * FROM adv_zone ORDER BY name ASC";
$rs         = $conn->execute($sql);
if($rs && $conn->Affected_Rows() > 0)
    $advzones  = $rs->getrows();

$smarty->assign('adv', $adv);
$smarty->assign('advzones', $advzones);