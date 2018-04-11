<?php
set_time_limit(0);
ini_set('memory_limit','1024M');
ini_set('error_reporting', E_ALL);
function curlGetData($uri='', $data='')
{
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $uri );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$return = curl_exec ( $ch );
	curl_close ( $ch );
	return $return;
}
$str = curlGetData('http://www.zhibose.com/index.php');
file_put_contents('index.html', $str);