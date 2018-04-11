<?php
defined('_VALID') or die('Restricted Access!');
set_time_limit(0);
Auth::checkAdmin();

$AID    = ( isset($_GET['AID']) && advExists($_GET['AID']) ) ? intval($_GET['AID']) : NULL;
if ( !$AID ) {
    $errors[]    = 'Invalid advertise id!';
}

if ( isset($_POST['adv_edit']) && !$errors ) {
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
    $_REQUEST['orderby']==='0'|| intval($_REQUEST['orderby']) ? $orderby = intval($_REQUEST['orderby']) : $orderby = '1'; //排序

	
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
    //短连接键
    $hash = khash($media.$_SERVER['REQUEST_TIME']);
    //下载图片
    $advPath = downloadImg($media, $advAllImgPath, $AID);
    if($advPath)
        $advPath = $advImgPath.'/'.$advPath;
    else
        $advPath = '';
    
    $jpgpath = '';
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
        //更新修改时间
        $addtime = time();
    	$sql            = "UPDATE adv_ads SET ".
						"name = '" .mysql_real_escape_string($name). "',".
						"url = '" .mysql_real_escape_string($url). "',".
						"media = '" .mysql_real_escape_string($media). "',".
						"title = '" .mysql_real_escape_string($title). "',".
						"relname = '".mysql_real_escape_string($rename)."',".
                        "addtime = '".mysql_real_escape_string($addtime)."',".
						"ismobile = '{$ismobile}',".
						"margin = '".mysql_real_escape_string($margin)."',hash='{$hash}',localpic='{$advPath}',".
    	                "isbtn = '{$isbtn}',orderby='{$orderby}',";
						
    	if ($jpgpath) {
    		$sql .= "relogopic = '".$jpgpath."',";
    	}
    	$sql .= "zone_id = " .intval($zone_id). " WHERE id = " .intval($AID). " LIMIT 1;";
        $result = $conn->execute($sql);
        if($result && $conn->Affected_Rows()>0){
            write_ads_cache($advAllImgPath);
            $messages[]     = 'Advertising banner successfully updated!';
        }else 
            $errors[] = 'Advertising banner failed updated!';
    }
}

$adv    = array('adv_id' => 0, 'adv_name' => '', 'adv_group' => 0, 'adv_text' => '', 'adv_status' => '0');

    $sql    = "SELECT * FROM adv_ads WHERE id = " .intval($AID). " LIMIT 1";
    $rs     = $conn->execute($sql);
if($rs && $conn->Affected_Rows()>0){
    $adv    = $rs->getrows();
    $adv    = $adv['0'];
}
$advzones = array();
$sql        = "SELECT * FROM adv_zone ORDER BY name ASC";
$rs         = $conn->execute($sql);
if($rs && $conn->Affected_Rows()>0){
    $advzones  = $rs->getrows();
}
function advExists( $adv_id ) {
    global $conn;
    
    $sql    = "SELECT id FROM adv_ads WHERE id = " .intval($adv_id). " LIMIT 1";
    $conn->execute($sql);
    
    return $conn->Affected_Rows();
}

$smarty->assign('adv', $adv);
$smarty->assign('advzones', $advzones);