<?php

define('_VALID', true);
require '../../include/config.php';

require '../../include/function_smarty.php';


$resource_url = 'http://www.5188yy.com/yamei/vip';
$smarty->assign('resource_url', $resource_url);

if(substr($_SERVER["HTTP_HOST"],0, 4) == 'www.') {
	$bbs_host  = 'bbs.'.substr($_SERVER["HTTP_HOST"],4);
} else {
	$bbs_host  = 'bbs.'.$_SERVER["HTTP_HOST"];
}
$qq1 = $config['qq1'];
$qq2 = $config['qq2'];
$domain = $config['domain'];

$smarty->assign('qq1', $qq1);
$smarty->assign('qq2', $qq2);
$smarty->assign('domain', $domain);
$smarty->assign('module', 'index');
$smarty->assign('bbs_host', $bbs_host);

$i = intval($config['set_vip']) == 0 ? 1 : intval($config['set_vip']);
$smarty->assign('index', $i);
$templateFile = dirname(__FILE__) . '/templates/index'.$i.'.tpl';

$smarty->display('header.tpl');
$smarty->display($templateFile);
$smarty->display('footer.tpl');
$smarty->gzip_encode();
?>



