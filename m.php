<?php
set_time_limit(0);
ini_set('memory_limit','2048M');
ini_set('error_reporting', E_ALL);
header("Content-type: text/html; charset=utf-8");
define('_VALID', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
require 'classes/pagination.class.php';
require 'include/function_html.php';
//开始时间
$starttime  = get_microtime_array();
$href       = 'http://'.$_SERVER['HTTP_HOST'];
//注册页面生成
$arrindex1 = array(
    'index.html'           => $href . '/index.php',                //首页
    'videos/index.html'    =>  $href . '/videos.php',              //最新更新
    'hd/index.html'        =>  $href . '/hd.php',                  //高清视频
    'signup.html'          =>  $href . '/signup.php',              //注册页
    'lost.html'            =>  $href . '/lost.php',                //找回密码
    //'yamei/vip/index.html' =>  $href . '/yamei/vip/index.php',     //加入vip
);
//内容替换
$a_header   = array('"/"', '"/videos"', '"/hd"','"/novels.php"','"/pictures.php"', '?c=', '?page=', '&page=', $href . '/', '"' . $href . '"', 'style="display:none;visibility:hidden;"', 'data-cfsrc');
$a_replace  = array('"/index.html"', '"/videos/index.html"', '"/hd/index.html"','"/novels/"','"/pictures/"', '/', '/index_page_', '/index_page_', '/', 'window.location.host', '', 'src');

$arrs = include('cache/category.php');          //分类

//开始生成页面
if(!isset($_GET['t']))
{
    $arrindex2 = array();
     foreach ($arrs as $keys => $valcates) {
        if( isset($valcates['dir']) ) {
            $arr_c = explode('/', $valcates['dir']);
            if( isset($arr_c[1]) && !in_array($valcates['dir'] . '.html', $arrindex2) ) {
                $arrindex2[ $valcates['dir'] . '.html'] = $href . '/videos.php?c=' . intval($arr_c[1]);
            }
            unset($arr_c);
        }
    }

    $arrindex = array_merge( $arrindex1, $arrindex2 );

    foreach ($arrindex as $filename => $url) {
    	$arr_f = explode('.', $filename);
        $dir    = dirname($filename);       //目录
        if( strlen($dir) > 1 && !file_exists( $dir ) ) {
            mkdirs($dir);
        }
        //获取内容
        $html       = curlGetData( $url );

        //头部替换
        $html = str_replace($a_header, $a_replace, $html);
        
        $htmlstr = preg_replace('/(page_\d+)/', '$1.html', $html);      //加后缀
        GenerateHtml($filename,  $htmlstr);      //文件
        unset($dir, $html, $a_header, $a_replace);
    }
    $endtime = get_microtime_array();

    $totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
    $timecost   = sprintf("各列表首页生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
    echo $timecost . '<br/><br/>';
}
//生成图片列表静态页
if(isset($_GET['t']) && trim($_GET['t'])=='p')
{
	$arrindex1 = array(
			'pictures/index.html'  => $href . '/pictures.php',
	);
	$nparrs = include('cache/npcategory.php');
	$arrindex = array();
	$cat_arr = array();
	$cat_replace = array();
	foreach ($nparrs as $keys => $valcates) {
		if( isset($valcates['dir']) ) {
			$arr_c = explode('/', $valcates['dir']);
			if( isset($arr_c[1]) && !in_array($arr_c[0], $arrindex) ) {
				$cat_str = '/'.$arr_c[0].'?c=' . intval($arr_c[1]);
				$cat_arr[] = $cat_str;
				$cat_replace_str = '/'.$arr_c[0].'/'.$arr_c[1].'/index.html';
				$cat_replace[] = $cat_replace_str;
				$arrindex[$arr_c[0]]['total'] += $valcates['total']; 
			}
			unset($arr_c);
		}
	}
	//生成数据缓存数据
	$pic_arr =  array();
	$sql = 'SELECT VID,title FROM picture ORDER BY VID ASC;';
	$rs         = $conn->CacheExecute(3000,$sql);
	$list = $rs->getrows();
	foreach ($list as $value) {
		$pic_arr[$value['VID']] = $value['title'];
	}
	file_put_contents('cache/pictures.php', '<?php return ' . var_export($pic_arr, true) . ';' );
	unset($list,$pic_arr);
	
	foreach ($arrindex1 as $filename => $url) {
		$arr_f = explode('.', $filename);
		$dir    = dirname($filename);       //目录
		if ($dir == 'pictures') {
			$keys = '图片列表生成';
		}
		$pagecount = ceil($arrindex[$dir]['total']/$config['videos_per_page']);
		echo $keys . ' 费时 ';
		echo makeHtml($pagecount, $url, $dir, $starttime);
		echo '<br/><br/>';
	}
	//开始循环生成类型列表
	foreach ($nparrs as $keys => $vals) {
		$arr_c = explode('/', $vals['dir']);
		if ($arr_c[0] != 'pictures') {
			continue;
		}
		$pagecount = ceil($vals['total']/$config['videos_per_page']);
		echo $keys . ' 费时 ';
		echo makeHtml($pagecount, $vals['purl'], $vals['dir'], $starttime);
		echo '<br/><br/>';
	}
	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}
if(isset($_GET['t']) && trim($_GET['t'])=='xp')
{
	//生成图片详细静态页
	$pic_list = include('cache/pictures.php');
	foreach ($pic_list as $vid => $title) {
		$dir = 'picture/'.$vid;//目录
		$filename = $dir.'/index.html';
		$url = $href.'/'.$dir.'/'.$title;
		if( strlen($dir) > 1 && !file_exists( $dir ) ) {
			mkdirs($dir);
		}
		//获取内容
		$html       = curlGetData( $url );
		//头部替换
		$html = str_replace($a_header, $a_replace, $html);
		GenerateHtml($filename,  $html);      //文件
	}
	unset($pic_list);
	
	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}
//生成小说
if(isset($_GET['t']) && trim($_GET['t'])=='n')
{
	$arrindex1 = array(
			'novels/index.html'    => $href . '/novels.php',
	);
	$nparrs = include('cache/npcategory.php');
	$arrindex = array();
	$cat_arr = array();
	$cat_replace = array();
	foreach ($nparrs as $keys => $valcates) {
		if( isset($valcates['dir']) ) {
			$arr_c = explode('/', $valcates['dir']);
			if( isset($arr_c[1]) && !in_array($arr_c[0], $arrindex) ) {
				$cat_str = '/'.$arr_c[0].'?c=' . intval($arr_c[1]);
				$cat_arr[] = $cat_str;
				$cat_replace_str = '/'.$arr_c[0].'/'.$arr_c[1].'/index.html';
				$cat_replace[] = $cat_replace_str;
				$arrindex[$arr_c[0]]['total'] += $valcates['total'];
			}
			unset($arr_c);
		}
	}
	//生成数据缓存数据
	$novels_arr = array();
	$sql = 'SELECT VID,title FROM novel ORDER BY VID ASC;';
	$rs         = $conn->CacheExecute(3000,$sql);
	$list = $rs->getrows();
	foreach ($list as $value) {
		$novels_arr[$value['VID']] = $value['title'];
	}
	file_put_contents('cache/novels.php', '<?php return ' . var_export($novels_arr, true) . ';' );
	unset($list,$novels_arr);
	//无类型的列表页
	foreach ($arrindex1 as $filename => $url) {
		$arr_f = explode('.', $filename);
		$dir    = dirname($filename);       //目录
		if ($dir == 'novels') {
			$keys = '小说列表生成';
		}
		$pagecount = ceil($arrindex[$dir]['total']/$config['videos_per_page']);
		echo $keys . ' 费时 ';
		echo makeHtml($pagecount, $url, $dir, $starttime);
		echo '<br/><br/>';
	}
	//开始循环生成类型列表
	foreach ($nparrs as $keys => $vals) {
		$arr_c = explode('/', $vals['dir']);
		if ($arr_c[0] != 'novels') {
			continue;
		}
		$pagecount = ceil($vals['total']/$config['videos_per_page']);
		echo $keys . ' 费时 ';
		echo makeHtml($pagecount, $vals['purl'], $vals['dir'], $starttime);
		echo '<br/><br/>';
	}

	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}
if(isset($_GET['t']) && trim($_GET['t'])=='xn')
{
	//生成小说详细静态页
	$novels_list = include('cache/novels.php');
	foreach ($novels_list as $vid => $title) {
		$dir = 'novel/'.$vid;//目录
		$filename = $dir.'/index.html';
	
		$url = $href.'/'.$dir.'/'.$title;
		if( strlen($dir) > 1 && !file_exists( $dir ) ) {
			mkdirs($dir);
		}
		//获取内容
		$html       = curlGetData( $url );
		//头部替换
		$html = str_replace($a_header, $a_replace, $html);
		GenerateHtml($filename,  $html);      //文件
	}
	unset($novels_list);
	
	$endtime = get_microtime_array();
	$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost   = sprintf("生成费时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
	echo $timecost . '<br/><br/>';
}
//生成高清和所有视频
if(isset($_GET['t']) && trim($_GET['t'])=='m')
{
    $arrlist_html = array(
        '最新更新' => array(
            'sql' => "SELECT count(VID) AS total_videos FROM video WHERE active = '1'",
            'purl'=>  $href . '/videos.php',
            'dir' => 'videos'
        ),
        '高清视频' => array(
            'sql' => "SELECT count(VID) AS total_videos FROM video WHERE active = '1' AND hd='1'",
            'purl'=>  $href . '/hd.php',
            'dir' => 'hd'
        ),
    );
    //所有的列表页面
    foreach ($arrlist_html as $keyname => $val) {
        $rsc            = $conn->CacheExecute(3000, $val['sql'] );
        $total          = $rsc->fields['total_videos'];
        $pagination     = new Pagination($config['videos_per_page']);
        $limit          = $pagination->getLimit($total);
        $totalpages     = $pagination->total_pages;

        echo $keyname . ' 费时 ';
        echo makeHtml($totalpages, $val['purl'], $val['dir'], $starttime);
        echo '<br/><br/>';
    }
}
//生成分类子列表的页面 生成必需先生成缓存
if(isset($_GET['t']) && trim($_GET['t'])=='m2')
{
    //开始循环生成
    foreach ($arrs as $keys => $vals) {
        $pagecount = ceil($vals['total']/$config['videos_per_page']);
        echo $keys . ' 费时 ';
        echo makeHtml($pagecount, $vals['purl'], $vals['dir'], $starttime);
        echo '<br/><br/>';
    }
}
//生成分类缓存，子列表的页面生成必需先生成缓存
if(isset($_GET['t']) && trim($_GET['t'])=='c')
{
    $categories     = get_categories();     //所有的子栏目页面和参数
    $npcategories = get_npcategories();
    //"SELECT count(VID) AS total_videos FROM video WHERE channel = 10 AND active = '1'";
    $arr_cate = array();
    foreach ($categories as $key => $value) {
        if(isset($value[0], $value[1], $value[2]))
        {
            $arr_cate[$value[1]] = array(
                'total' => $value['num'],
                'purl'  =>  $href . '/videos.php?c=' . $value[0],
                'dir'   => 'videos/' . $value[0]
            );
        }
    }
    $nparr_cate =  array();
    foreach ($npcategories as $key => $value) {
    	if(isset($value[0], $value[1], $value[2], $value[3]))
    	{
    		$nparr_cate[$value[1]] = array(
    				'total' => $value[2],
    				'purl'  =>  $href . '/'.$value[3].'.php?c=' . $value[0],
    				'dir'   => $value[3] . '/' . $value[0]
    		);
    	}
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

//删除两个目录
if(isset($_GET['t']) && trim($_GET['t'])=='d')
{
    deldir('videos');
    $endtime = get_microtime_array();
    $totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
    $timecost   = sprintf("删除videos用时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
    echo $timecost . '<br/><br/>';
    //删除HD
    deldir('hd');
    $endtime = get_microtime_array();
    $totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
    $timecost   = sprintf("删除hd用时 %s Hour %s Minutes %s Second", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));
    echo $timecost . '<br/><br/>';
}
//所有的子页面
/*$sqlcount = "SELECT count(VID) AS total_videos FROM video WHERE active = '1'"; //总数
$rsc            = $conn->CacheExecute(3000, $sqlcount );
$total          = $rsc->fields['total_videos'];
$pagination     = new Pagination($config['videos_per_page']);
$limit          = $pagination->getLimit($total);
$totalpages     = $pagination->total_pages;
//一页一页的生成
//for ($i=1; $i <= $totalpages; $i++) {
    $sql    = "SELECT VID FROM video ORDER BY addtime DESC LIMIT " . $limit;
    $rs             = $conn->CacheExecute(3000, $sql);
    $videos         = $rs->getrows();
    //新建目录
    $dir = 'video';
    if(!file_exists( $dir ) ) {
        mkdirs($dir);
    }
    unset($dir);
    foreach ($videos as $key => $video) {
        $url =  $href . '/video/' . $video['VID'];
        $html = curlGetData( $url );
        file_put_contents('video/' . $video['VID'] . '.html', $html);
        unset($url, $html);
    }
//}

$conn->Close();

$endtime = get_microtime_array();
$totaltime  = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
echo '用时:';
echo sprintf(" %s 小时 %s 分钟 %s 秒", floor($totaltime/3600), floor($totaltime/60), ceil($totaltime%60));*/