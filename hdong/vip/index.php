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
$type = isset($_GET['type']) ? $_GET['type'] :'r';

$qq1 = $config[$type.'qq1'];
$qq2 = $config[$type.'qq2'];
$domain = $config[$type.'domain'];

$smarty->assign('qq1', $qq1);
$smarty->assign('qq2', $qq2);
$smarty->assign('domain', $domain);
$smarty->assign('module', 'index');
$smarty->assign('bbs_host', $bbs_host);
$key = "set_{$type}_vip";
$i = intval($config[$key]) == 0 ? 1 : intval($config[$key]);
$smarty->assign('index', $i);

$templateFile = dirname(__FILE__) . '/templates/index'.$i.'.tpl';
//echo $templateFile;
if(is_mobile())
    $templateFile = dirname(__FILE__) . '/templates/m/index'.$i.'.tpl';
if ($isMakeHtml == 1) {
    $filename = $config['BASE_DIR'].'/hdong/vip/index.html';
    $content = $smarty->fetch('header.tpl', null, null, false);
    $content .= $smarty->fetch($templateFile, null, null, false);
    $content .= $smarty->fetch('footer.tpl', null, null, false);
    
    file_put_contents($filename, $content);
    exit;
    
}else{
    $smarty->display('header.tpl');
    $smarty->display($templateFile);
    $smarty->display('footer.tpl');
    //$smarty->gzip_encode();
}