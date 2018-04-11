<?php
defined('_VALID') or die('Restricted Access!');

Auth::checkAdmin();

$allowed_acts  = array('frontend', 'backend', 'index');
$act           = ( isset($_GET['act']) ) ? $_GET['act'] : '';
if ($act!='' && !in_array($act, $allowed_acts) ) {
    $act   = NULL;
    $err    = 'Invalid page name!';
}
$num = 0;
$msg ='';
if ( $act!='' ) {
    if( $act == 'index' ) {
        $file_path  = $config['BASE_DIR'] . '/cache' ;
    } else {        //前后台缓存
        $file_path  = $config['BASE_DIR'] . '/cache/' . $act;
    }

    if ( file_exists($file_path) ) {
        $filesnames = scandir($file_path);
        if( count($filesnames) > 0) {
            foreach ($filesnames as $name) {
               if( !in_array($name, array('index.html', 'index.php', 'category.php')) && is_file($file_path . '/' . $name) ) {
                    @unlink( $file_path . '/' . $name);
                    $num++;
               }
            }
        } else {
            $msg = '缓存已经清空!';
        }
    } else {
        $msg = '文件夹不存在(' .$file_path. ')!';
    }
}

if($num == 0) {
    $msg = '文件已经清空';
}

$smarty->assign('num', $num);
$smarty->assign('msg', $msg);

?>
