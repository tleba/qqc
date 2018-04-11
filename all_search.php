<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
require 'include/function_user.php';
$_POST['stype'] = 'videos';
if($_POST['stype']==='videos'){
if($_POST['title'] AND $_POST['submit']){
header("location: /search?search_query=".addslashes($_POST['title'])."&search_type=videos");
}else{
exit('搜索内容为空!');
}
}elseif($_POST['stype']==='bbs'){
if($_POST['title'] AND $_POST['submit']){
header("location: ".bbsDomain()."/search.php?mod=forum&srchtxt=".addslashes($_POST['title'])."&ajax=1");
}else{
exit('搜索内容为空!');
}
}
?>
