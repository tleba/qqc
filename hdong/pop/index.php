<?php
define('_VALID', true);
require '../../include/config.php';
require '../../include/function_smarty.php';

$i = 0;
$templateFile = dirname(__FILE__) . '/pc/index'.$i.'.tpl';
if(is_mobile())
    $templateFile = dirname(__FILE__) . '/mo/index'.$i.'.tpl';
$smarty->display($templateFile);
$smarty->gzip_encode();