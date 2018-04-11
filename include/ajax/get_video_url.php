<?php
defined('_VALID') or die('Restricted Access!');
header("Content-type: text/json; charset=utf-8");
$url = '';

$host = $_SERVER['HTTP_HOST'];

require $config['BASE_DIR']. '/classes/filter.class.php';
require $config['BASE_DIR']. '/include/adodb/adodb.inc.php';
require $config['BASE_DIR']. '/include/dbconn.php';
$filter     = new VFilter();
$vid = $filter->get('vid');
$token = $filter->get('token');
$expire = 3600;
$options = array(
    'host'=>$config['mem_host'],
    'port'=>$config['mem_port'],
    'prefix'=>'video',
    'expire'=>$expire,
    'length'=>99999999
);
$cache = Cache::getInstance('MemcacheAction',$options);
$referer = md5(urldecode($_SERVER['HTTP_REFERER']));
$sid = session_id(); 

$ip = GetRealIP();
$randkey = $cache->get('randkey'.$host.$sid);
$redirect_url = $cache->get('redirect_url'.$host.$sid);
$AVS = $_COOKIE['AVS'];
$http_referer = md5($referer.$randkey.$ip.$AVS.$vid.'盗链可耻!=!???');
if($redirect_url !== $http_referer){
  echo json_encode(array('url'=>$url,'code'=>4,'_furl'=>$url));
  exit;
}
$vid = intval($vid);
if ($vid == 0) {
    echo json_encode(array('url'=>$url,'code'=>2,'_furl'=>$url));
    exit;
}

// 线路
$video = $cache->get($vid);

$options['prefix'] = 'ser';
$scache = Cache::getInstance('MemcacheAction',$options);

$key_url = $type_of_user.'svers';
$servers = array();
$servers = $scache->get($key_url);
if (!$servers) {
    $sql = 'SELECT url FROM servers WHERE status = \'1\' ORDER BY server_id ASC';
    $r = $conn->execute($sql);
    $i = 0;
    if($r){
        $rows = $r->getrows();
        foreach ($rows as $k=>$row){
            $servers[$i]['url'] = $row['url'];
            $servers[$i]['gname'] ='默认线路'.($k > 0 ? $k+1 : '');
            $servers[$i]['httpkey'] = $config['lighttpd_key'];
            $servers[$i]['distributeds_id'] = 0;
            $i++;
        }
    }
    $sql = 'SELECT ds.gname,d.url,d.httpkey,d.distributeds_id FROM distributeds ds,distributed d WHERE ds.status = 0 AND ds.distributeds_id = d.distributeds_id AND ds.permisions LIKE \'%'.$type_of_user.'%\'';
    $r = $conn->execute($sql);
    $rows = $r->getrows();
    foreach ($rows as $key => $row) {
        $servers[$key + $i]['url'] = $row['url'];
        $servers[$key + $i]['gname'] = $row['gname'];
        $servers[$key + $i]['httpkey'] = $row['httpkey'];
        $servers[$key + $i]['distributeds_id'] = $row['distributeds_id'];
    }
    $scache->set($key_url,$servers);
}
$index = intval($filter->get('index'));
$server = $servers[$index];
if(!is_array($server)){
    echo json_encode(array('url'=>$url,'code'=>3,'_fuurl'=>$url));
    exit;
}
if(stripos($server['url'],'/',strlen($server['url']) -1) === false){
    $server['url'] = $server['url'] .'/';
}
$file_hd  = '/iphone/' .$vid. '.mp4';
$timestamp      = time();
$timestamp_hex  = sprintf("%08x", $timestamp);
$md5sum_hd      = md5($server['httpkey'] . $file_hd . $timestamp_hex);

$url = in_array($server['distributeds_id'],array(3,4,9,11)) ? $server['url'].'video'.$file_hd.'?k='.$md5sum_hd.'&t='.$timestamp_hex: $server['url'].'video/'.$md5sum_hd.'/'.$timestamp_hex.$file_hd;
foreach ($servers as $k=>$server){
    unset($servers[$k]['url']);
    unset($servers[$k]['httpkey']);
    unset($servers[$k]['distributeds_id']);
}
echo json_encode(array('_furl'=>$url,'servers'=>$servers));
exit;