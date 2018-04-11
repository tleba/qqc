<?php
require 'common.php';
$errors             = ( isset($_GET['err']) ) ? array($_GET['err']) : $errors;
$messages           = ( isset($_GET['msg']) ) ? array($_GET['msg']) : $messages;
$module             = ( isset($_GET['m']) && $_GET['m'] != '' ) ? trim($_GET['m']) : 'list';
$modules_allowed    = array('list', 'view', 'add', 'edit', 'videos', 'groups', 'addgame', 'listgame', 'editgame');
if ( !in_array($module, $modules_allowed) ) {
    $module = 'list';
    $err    = 'Invalid Channels Module!';
}

switch ( $module ) {
    case 'view':
    case 'add':
    case 'edit':
    case 'game':
    case 'addgame':
    case 'listgame':
    case 'editgame':
        $module_template = 'channels_' .$module. '.tpl';
        break;
    case 'list':
    default:
        $module_template = 'channels.tpl';
}

require 'modules/channels/' .$module. '.php';

$smarty->assign('errors', $errors);
$smarty->assign('messages', $messages);
$smarty->assign('active_menu', 'channels');
$smarty->display('header.tpl');
$smarty->display('leftmenu/channels.tpl');
$smarty->display($module_template);
$smarty->display('footer.tpl');
?>
