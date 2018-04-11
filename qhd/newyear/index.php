<?php
define('_VALID', true);
require '../../include/config.php';
require '../../include/function_smarty.php';
require $config['BASE_DIR'].'/include/config.rank.php';

shuffle($yuanxiao_jp_index);
$_SESSION['yuanxiao_jp_index'] = $yuanxiao_jp_index;

$smarty->assign('beast_zhuangbei',$beast_zhuangbei);
$basedir = dirname(__FILE__);
$tpl = $basedir.'/tpl/index.tpl';
$smarty->display($tpl);
$smarty->gzip_encode();