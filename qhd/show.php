<?php
define('_VALID', true);
require '../include/config.php';
require '../include/function_global.php';
require '../include/function_smarty.php';

$id = intval($_GET['id']);
$sql = 'SELECT title,context FROM hd WHERE id='.$id.' LIMIT 1;';
$crs = $conn->execute($sql);
$hds = $crs->getrows();
$hd = count($hds) > 0 ? $hds[0] :NULL;
$basedir = dirname(__FILE__);
$tpl = $basedir.'/templates/show.tpl';
$smarty->assign('hd', $hd);
$smarty->display($tpl);