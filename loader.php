<?php
header("Content-type: text/html; charset=utf-8");
//die('Only enable this script if you dont have support for MultiViews');
$relative = '';
$loaders  = array(
    'ajax' => 1,
    'album' => 1,
    'albums' => 1,
    'blog' => 1,
    'blogs' => 1,
    'captcha' => 1,
    'categories' => 1,
    'community' => 1,
    'confirm' => 1,
    'error' => 1,
    'feedback' => 1,
    'feeds' => 1,
    'game' => 1,
    'games' => 1,
    'index' => 1,
    'invite' => 1,
    'loader' => 1,
    'login' => 1,
    'logout' => 1,
    'lost' => 1,
    'mail' => 1,
    'notice' => 1,
    'notices' => 1,
    'photo' => 1,
    'hd' => 1,
	'yinshi' => 1,
    'requests' => 1,
    'search' => 1,
    'signup' => 1,
    'index_ajax' => 1,
    'static' => 1,
    'stream' => 1,
    'upload' => 1,
    'vip' => 1,	
    'limited' => 1,
    'user' => 1,
    'users' => 1,
    'video' => 1,
    'videos' => 1,
    'picture' => 1,
    'pictures' => 1,
    'novel' => 1,
    'novels' => 1,
    'distributeds' => 1,
    'login_ajax' => 1,
    'all_search' => 1,
    'v' => 1,
    'auth' => 1,
    'edit' => 1,
    'applogin' => 1,
    'return'=>1,
    'tuiguang'=>1,
    'link'=>1
);

$query      = ( isset($_SERVER['QUERY_STRING']) ) ? $_SERVER['QUERY_STRING'] : NULL;
$request    = str_replace($relative, '', $_SERVER['REQUEST_URI']);
$request    = str_replace('?' .$query, '', $request);
$request    = explode('/', trim($request, '/'));
if (isset($request['0'])) {
    //file_put_contents('a.log', var_export($request, true));
    $page   = $request['0'];
    if (isset($loaders[$page])) {
		check_static($page, $request);
        require $page. '.php';
    } else {
		header('HTTP/1.0 404 Not Found');
  		die('404');
	}
} else {
	header('HTTP/1.0 404 Not Found');
    	die('404');
}

function check_static($page, $route) {
	$static_file = dirname(__FILE__) . '/static/' . md5($_SERVER['REQUEST_URI']);
/*    file_put_contents('p.log', $static_file);
	file_put_contents('p1.log', $page . '|'.$_SERVER['REQUEST_URI']);*/
	file_put_contents('./1.test', file_get_contents('./1.test') . "\r\n" . $page . '|'.$_SERVER['REQUEST_URI']);
	if(file_exists($static_file)) {
		echo file_get_contents($static_file);
		exit;
	}
}

