<?php
define('_VALID', true);
require '../include/config.php';
require '../include/function_smarty.php';

$cid = intval($_GET['cid']);
$where = $cid > 0 ? ' WHERE cid = '.$cid : ' ';

if (isset($_GET['search_btn'])) {
    $keyword = mysql_real_escape_string(trim($_GET['keyword']));
    $kstr = 'title like \'%'.$keyword.'%\'';//sprintf("title like unhex('%%s%')",bin2hex($keyword));
    $where .=  $cid > 0 ? ' AND '.$kstr : ' WHERE '.$kstr;
}
require $config['BASE_DIR']. '/classes/pagination.class.php';
$page = isset($_GET['page']) && (intval($_GET['page']) > 0) ? intval($_GET['page']) : 1;

$hdkey = 'hd_'.md5($where).'_'.$page;
$hdlock = 'qhd_lock';
$rows = $cache->get($hdkey);
if (!$rows || !is_array($rows) || isset($rows['hds'])) {
    $lock = $cache->get($hdlock);
    if(!$lock){
        $cache->set($hdlock,1,0);
        
        $sql = 'SELECT id,name FROM hd_cat ORDER BY id asc;';
        $rs = $conn->execute($sql);
        if($rs && $conn->Affected_Rows() > 0){
            $hd_cats = $rs ? $rs->getrows() : NULL;
            $rows['hd_cats'] = $hd_cats;
        }
        $sql = 'SELECT COUNT(id) total FROM hd '.$where;
        $crs = $conn->execute($sql);
        $total = 0;
        if($crs && $conn->Affected_Rows() > 0){
            $total  = (int)$crs->fields['total'];
        }
        $rows['total'] = $total;
        $pagination     = new Pagination(8);
        $limit          = $pagination->getLimit($total);
        $paging         = $pagination->getPagination('qhd/index.php');
        $rows['paging'] = $paging;
        $sql = 'SELECT id,cid,title,img,context,url,ispopular,stime,etime,keyword,atime,utime,CASE WHEN (etime > unix_timestamp() AND ispopular = 1) THEN 1 WHEN stime > unix_timestamp() THEN 2 WHEN stime < unix_timestamp() AND etime > unix_timestamp() THEN 3 when etime < unix_timestamp() THEN 4 else 5 END AS od  FROM hd  '.$where.' ORDER BY od ASC LIMIT '.$limit;
        $crs = $conn->execute($sql);
        if($crs && $conn->Affected_Rows() > 0){
            $hds = $crs->getrows();
            $rows['hds'] = $hds;
            $cache->set($hdkey,$rows,3600);
        }
        $cache->rm($hdlock);
    }
}

$conn->Close();
$cache->close();

$basedir = dirname(__FILE__);
$tpl = $basedir.'/templates/index.tpl';
$smarty->assign('cid', $cid);
$smarty->assign('page', $page);
$smarty->assign('categories', $rows['hd_cats']);
$smarty->assign('hds', $rows['hds']);
$smarty->assign('total', $rows['total']);
$smarty->assign('paging', $rows['paging']);
$smarty->assign('keyword', $keyword);
$smarty->assign('curtime', time());
if ($isMakeHtml == 1) {
    $fileName = $cid > 0 ? $cid.'.html' : 'index.html';
    $content = $smarty->fetch($tpl, null, null, false);
    $static_file = $config['BASE_DIR'] . '/qhd/' . $fileName;
    $makeTime = date('Y-m-d H:i:s',time());
    file_put_contents($static_file, $content . "\r\n<!-- static file: index.html make time:{$makeTime}-->");
}else{
    $smarty->display($tpl);
    $smarty->gzip_encode();
}