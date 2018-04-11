<?php
defined('_VALID') or die('Restricted Access!');
$key = 'u_blo_'.$uid;
$blocks = $public_cache->get($key);
if(!$blocks){
    $sql    = "SELECT u.username, u.UID
               FROM signup AS u, users_blocks AS b
               WHERE b.UID = " .$uid. " AND b.BID = u.UID";
    $rs     = $conn->execute($sql);
    $blocks = $rs->getrows();
    $public_cache->set($key,$blocks);
}
$smarty->assign('blocks', $blocks);
?>
