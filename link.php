<?php
define('_VALID', true);
require 'include/config.php';

$hash = get_request_arg('link','STRING');
$hash = strip_tags($hash);
$hash = htmlentities($hash);

$hash = mysql_real_escape_string($hash);

$sql = "SELECT url FROM adv_ads WHERE hash = '$hash' LIMIT 1;";
$rs         = $conn->execute($sql);

if($rs && $conn->Affected_Rows() > 0 &&$hash){
    $url = $rs->fields['url'];
    header('HTTP/1.1 302 Moved Permanently');
    header('Location:'.$url);
}else{
    header('Location:/');
}
exit;