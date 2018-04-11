<?php
if (isset($_SESSION['uid'])&&$_SESSION['uid']>0&&$_SESSION['uid_premium']>1) {
    $msg = $_SESSION['uid_premium'];
    exit(json_encode(array('code'=>1,'msg'=>$msg) ) );
}else{
	exit(json_encode(array('code'=>0,'msg'=>0)));
}
?>