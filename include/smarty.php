<?php
defined('_VALID') or die('Restricted Access!');

$tpl        = $config['template'];
$tpl_dir    = 'frontend';
if ( defined('_ADMIN') ) {
    $tpl        = $config['template_admin'];
    $tpl_dir    = 'backend';
}

$PremiumRemaining = isset($_SESSION['uid']) ? NewPremiumRemainingSEBI($_SESSION['uid'],$premium) : "";
$PremiumRemainingView = NewPremiumRemainingView($PremiumRemaining);
//$PremiumNikename = NewPremiumNikename($PremiumRemaining['rank']);
$smarty  = new Smarty();
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->cache = 0;
$smarty->template_dir = $config['BASE_DIR']. '/templates/' .$tpl_dir. '/' .$tpl;
$smarty->compile_dir = $config['BASE_DIR']. '/cache/' .$tpl_dir;
foreach ( $config as $key => $value ) {
    $smarty->assign($key, $value);
}
$smarty->assign('languages', $languages);
$smarty->assign('bgcolor',      '#E8E8E8');
$smarty->assign('baseurl',    $config['BASE_URL']);
$smarty->assign('basedir',    $config['BASE_DIR']);
$smarty->assign('type_of_user',$type_of_user);
$smarty->assign('relative',   $config['RELATIVE']);
$smarty->assign('relative_tpl', $config['RELATIVE']. '/templates/' .$tpl_dir. '/' .$tpl);
$smarty->assign('imgurl',     $config['IMG_URL']);
$smarty->assign('vdourl',     $config['VDO_URL']);
$smarty->assign('flvdourl',   $config['FLVDO_URL']);
$smarty->assign('picurl',     $config['PHO_URL']);
$smarty->assign('tmburl',     $config['TMB_URL']);
$smarty->assign('photourl',   $config['PHO_URL']);
$PremiumRemaining['rank'] = isset($PremiumRemaining['rank']) ? $PremiumRemaining['rank'] : 0;
$smarty->assign('rank',$PremiumRemaining['rank']);
$PremiumRemaining['user_range'] = isset($PremiumRemaining['user_range']) ? $PremiumRemaining['user_range'] : 0;
$smarty->assign('user_range',$PremiumRemaining['user_range']);
$smarty->assign('PremiumRemainingView',$PremiumRemainingView);
//$smarty->assign('PremiumNikename',$PremiumNikename);
//update3.1
$smarty->assign('max_thumb_folders',   $config['max_thumb_folders']);
$smarty->assign('bbsdomain', bbsDomain());
//sso
if(@$_GET['sso']==='bbs_login'){	
	$sso_bbs = "<iframe src=\"/auth/bbs_ajax\" style=\"display:none\"></iframe>";
}else{
	$sso_bbs = '';
}
$smarty->assign('sso_bbs',   $sso_bbs);
?>
