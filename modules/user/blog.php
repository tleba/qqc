<?php
defined('_VALID') or die('Restricted Access!');
require $config['BASE_DIR']. '/classes/pagination.class.php';

if ( $config['blog_module'] == '0' ) {
    VRedirect::go($config['BASE_URL']. '/error/page_invalid');
}
$key = 'u_blog_'.$uid;
$blogs_arr = array();
$blogs_arr = $public_cache->get($key);
if (empty($blogs_arr)) {
    $sql            = "SELECT COUNT(BID) AS total_blogs FROM blog WHERE status = '1' AND UID = " .$uid;
    $rs             = $conn->execute($sql);
    $total          = $rs->fields['total_blogs'];
    $blogs_arr['total'] = $total;
    $pagination     = new Pagination(5);
    $limit          = $pagination->getLimit($total);
    $sql            = "SELECT BID, title, content, total_views, total_comments, addtime FROM blog
                       WHERE status = '1' AND UID = " .$uid. " ORDER BY addtime DESC LIMIT " .$limit;
    $rs             = $conn->execute($sql);
    $blogs          = $rs->getrows();
    $blogs_arr['blogs'] = $blogs;
    $page_link      = $pagination->getPagination('user/' .$username. '/blog');
    $blogs_arr['page_link'] = $page_link;
    $start_num      = $pagination->getStartItem();
    $blogs_arr['start_num'] = $start_num;
    $end_num        = $pagination->getEndItem();
    $blogs_arr['end_num'] = $end_num;
    $public_cache->set($key,$blogs_arr);
}
if (!empty($blogs_arr)) {
    $blogs = $blogs_arr['blogs'];
    $total = $blogs_arr['total'];
    $page_link = $blogs_arr['page_link'];
    $start_num = $blogs_arr['start_num'];
    $end_num = $blogs_arr['end_num'];
}
foreach($blogs as $key => $content) {
	$blogs[$key]['content'] = blog_output($blogs[$key]['content']);
}

$self_title     = $username. '\'s Blog';

$smarty->assign('blogs', $blogs);
$smarty->assign('blogs_total', $total);
$smarty->assign('page_link', $page_link);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
?>
