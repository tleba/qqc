<?php
set_time_limit(0);
ini_set('memory_limit','2048M');
ini_set('error_reporting', E_ALL);
header("Content-type: text/html; charset=utf-8");
define('_VALID', true);
require 'include/config.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';
require 'include/function_html.php';
//开始时间
$starttime  = get_microtime_array();
$href       = 'http://'.$_SERVER['HTTP_HOST'];

$array = array(
	'index.php',
    //'/hdong/vip/index.php?type=r',
    //'/qhd/index.php',
);
$url_param = 'isMakeHtml=1';
if (!isset($_GET['t'])) {
	foreach ($array as $v) {
		$url = (strpos($v, '?') === false) ? $href.'/'.$v.'?'.$url_param : $href.'/'.$v.'&'.$url_param;
		curlGetData($url);
	}
	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("各列表首页生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}

if(isset($_GET['t']) && trim($_GET['t'])=='m')
{	
	$arrlist_html = array(
			'最新更新' => array(
					'sql' => "SELECT count(VID) AS total FROM video WHERE channel NOT IN(61,63,65) AND active = '1'",
					'purl'=>  $href . '/videos.php?'.$url_param,
			),
			'高清视频' => array(
					'sql' => "SELECT count(VID) AS total FROM video WHERE channel NOT IN(61,63,65) AND active = '1' AND hd='1'",
					'purl'=>  $href . '/hd.php?'.$url_param,
			),
    	    '青草影视' => array(
    	        'sql' => "SELECT count(VID) AS total FROM video WHERE channel IN(61,63,65) AND active = '1' AND hd='1'",
    	        'purl'=>  $href . '/yinshi.php?'.$url_param,
    	    ),
			'小说列表'=>array(
				'sql'=>'SELECT count(VID) AS total FROM novel',
				'purl' =>$href . '/novels.php?'.$url_param,
			),
			'图片列表'=>array(
				'sql'=>'SELECT count(VID) AS total FROM picture',
				'purl'=>$href . '/pictures.php?'.$url_param,
			),
	);
	
	$urls = array();
	foreach ($arrlist_html as $keyname => $val) {
		$rsc            = $conn->CacheExecute(3000, $val['sql'] );
		$total          = $rsc->fields['total'];
		$pagination     = new Pagination($config['videos_per_page']);
		$limit          = $pagination->getLimit($total);
		$totalpages     = $pagination->total_pages;
		
		for ($i =1;$i <= $totalpages;$i++){
			$urls[] = $val['purl'].'&page='.$i;
		}
	}
	$urls_chunk = array_chunk($urls, 60);
	foreach ($urls_chunk as $val) {
		curlMultiGet($val);
	}
	unset($urls);
	unset($urls_chunk);
	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("最新更新、高清视频、小说、图片列表生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}
//生成分类子列表的页面 生成必需先生成缓存
if(isset($_GET['t']) && trim($_GET['t'])=='m2')
{
	$arrs = include('cache/category.php');
	//开始循环生成
	$urls = array();
	foreach ($arrs as $keys => $vals) {
		$pagecount = ceil($vals['total']/$config['videos_per_page']);
		for ($i = 1; $i <= $pagecount; $i++) {
			$urls[] = $vals['purl'].'&page='.$i;
		}
	}
	$urls_chunk = array_chunk($urls, 60);
	foreach ($urls_chunk as $val) {
		curlMultiGet($val);
	}
	unset($arrs);
	unset($urls);
	unset($urls_chunk);
	$arrs = include 'cache/hdcategory.php';
	//开始循环生成
	$urls = array();
	foreach ($arrs as $keys => $vals) {
	    $pagecount = ceil($vals['total']/$config['videos_per_page']);
	    for ($i = 1; $i <= $pagecount; $i++) {
	        $urls[] = $vals['purl'].'&page='.$i;
	    }
	}
	$urls_chunk = array_chunk($urls, 60);
	foreach ($urls_chunk as $val) {
	    curlMultiGet($val);
	}
	unset($arrs);
	unset($urls);
	unset($urls_chunk);
	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("所有视频分类子列表生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}
//生成小说和图片分类子列表的页面 生成必需先生成缓存
if(isset($_GET['t']) && trim($_GET['t'])=='m3')
{
	$arrs = include('cache/npcategory.php');
	$urls = array();
	//开始循环生成
	foreach ($arrs as $keys => $vals) {
		$pagecount = ceil($vals['total']/$config['videos_per_page']);
		for ($i = 1; $i <= $pagecount; $i++) {
			$urls[] = $vals['purl'].'&page='.$i;
		}
	}
	$urls_chunk = array_chunk($urls, 60);
	foreach ($urls_chunk as $val) {
		curlMultiGet($val);
	}
	unset($arrs);
	unset($urls);
	unset($urls_chunk);
	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("小说和图片分类子列表生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}
if (isset($_GET['t']) && trim($_GET['t'])=='mn') {
	$sql = 'SELECT VID FROM novel ORDER BY VID ASC;';
	$rs         = $conn->CacheExecute(3000,$sql);
	$list = $rs->getrows();
	
	$urls = array();
	foreach ($list as $value) {
		$urls[] = $href.'/novel/'.$value['VID'].'/isMakeHtml/1';
	}
	$urls_chunk = array_chunk($urls, 60);
	foreach ($urls_chunk as $val) {
		curlMultiGet($val);
	}
	unset($list);
	unset($urls);
	unset($urls_chunk);
	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("小说详细页生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}
if (isset($_GET['t']) && trim($_GET['t'])=='mp') {
	$sql = 'SELECT VID,total_imgs FROM picture ORDER BY VID ASC;';
	$rs         = $conn->CacheExecute(3000,$sql);
	$list = $rs->getrows();
	$nlist = array();
	foreach ($list as $value) {
		$nlist[$value['VID']] = ceil(($value['total_imgs']-1) / $config['videos_per_page']);
	}
	unset($list);
	$urls = array();
	foreach ($nlist as $key => $pages) {
		for ($i = 1; $i <= $pages; $i++) {
			$urls[] = $href.'/picture/'.$key.'/isMakeHtml/1/page/'.$i;
		}
	}
	$urls_chunk = array_chunk($urls, 60);
	foreach ($urls_chunk as $val) {
		curlMultiGet($val);
	}
	unset($urls);
	unset($urls_chunk);
	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("图片详细页生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}
//生成分类缓存，子列表的页面生成必需先生成缓存
if(isset($_GET['t']) && trim($_GET['t'])=='c')
{
	$categories     = get_categories();     //所有的子栏目页面和参数
	$npcategories = get_npcategories();

	$arr_cate = array();
	foreach ($categories as $key => $value) {
	    if (in_array($value[0], array(61,63,65))) {
	        if(isset($value[0], $value[1], $value[2]))
	        {
	            $arr_cate[$value[1]] = array(
	                'total' => $value['num'],
	                'purl'  =>  $href . '/yinshi.php?c=' . $value[0].'&'.$url_param,
	            );
	        }
	    }else{
    		if(isset($value[0], $value[1], $value[2]))
    		{
    			$arr_cate[$value[1]] = array(
    					'total' => $value['num'],
    					'purl'  =>  $href . '/videos.php?c=' . $value[0].'&'.$url_param,
    			);
    		}
	    }
	}
	$nparr_cate =  array();
	foreach ($npcategories as $key => $value) {
		if(isset($value[0], $value[1], $value[2], $value[3]))
		{
			$nparr_cate[$value[1]] = array(
					'total' => $value[2],
					'purl'  =>  $href . '/'.$value[3].'.php?c=' . $value[0].'&'.$url_param,
			);
		}
	}
	$hdcategory = array();
	$sql = 'SELECT * FROM hd_cat';
	$rs         = $conn->CacheExecute(3000,$sql);
	if($rs){
	   $list = $rs->getrows();
	   foreach ($list as $k => $v) {
	       $hdcategory[$v['name']] = array(
	         'total' => get_hd_cat_total($v['id']),
	         'purl' => $href . '/qhd/index.php?cid='.$v['id'].'&'.$url_param,
	       );
	   }
	}
	if (count($hdcategory) > 0) {
	    $endtime = get_microtime_array();
	    $totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	    $timecost   = sprintf("生成文件，用时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	    file_put_contents('cache/hdcategory.php', '<?php return ' . var_export($hdcategory, true) . ';' );
	    echo $timecost;
	}
	if( count($arr_cate) > 0 ) {
		$endtime = get_microtime_array();
		$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
		$timecost   = sprintf("生成文件，用时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
		file_put_contents('cache/category.php', '<?php return ' . var_export($arr_cate, true) . ';' );
		echo $timecost;
	}
	if( count($nparr_cate) > 0 ) {
		$endtime = get_microtime_array();
		$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
		$timecost   = sprintf("生成文件，用时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
		file_put_contents('cache/npcategory.php', '<?php return ' . var_export($nparr_cate, true) . ';' );
		echo $timecost;
	}
}
function get_hd_cat_total($cid){
    global $conn;
    $cid = round($cid);
    $sql = 'SELECT COUNT(id) total FROM hd WHERE cid ='.$cid.' LIMIT 1';
    $rs = $conn->CacheExecute(3000,$sql);
    if($rs)
        return $rs->NumRows();
    return 0;
}