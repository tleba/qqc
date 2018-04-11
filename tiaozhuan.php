<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';

$id = intval($_GET['id']);
if (!$id) {
	VRedirect::go($config['BASE_URL']. '/error/video_missing');
}
$sql = "SELECT * FROM adv_ads where id = {$id}";
$rs         = $conn->execute($sql);
if ( $conn->Affected_Rows() != 1 ) {
	VRedirect::go($config['BASE_URL']. '/error/video_missing');
}
$url = $rs->fields['url'];
$rename = $rs->fields['relname'];
$relogopic = $rs->fields['relogopic'];

$smarty->assign('rename',$rename);
$smarty->assign('relogopic',$relogopic);
$smarty->assign('url',$url);

$smarty->display('tzhuan.tpl');
$smarty->gzip_encode();
?>
