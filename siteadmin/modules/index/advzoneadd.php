<?php
defined('_VALID') or die('Restricted Access!');

Auth::checkAdmin();

if ( isset($_POST['add_adv_group']) && !$errors ) {
	$name = mysql_real_escape_string(trim($_POST['name']));
	$width      = mysql_real_escape_string(trim($_POST['width']));
	$height     = mysql_real_escape_string(trim($_POST['height']));


	$sql  = "INSERT INTO adv_zone(name,width,height) VALUES('{$name}','{$width}','{$height}');";
	$rs = $conn->execute($sql);
	if ($rs) {
		write_ads_cache();
		$msg = '广告位置添加成功!';
		VRedirect::go('index.php?msg=' . $msg . '&m=advzone');
	}else{
		$msg = '广告位置添加失败!';
		VRedirect::go('index.php?msg=' . $msg . '&m=advzone');
	}
}
