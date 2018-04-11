<?php
defined('_VALID') or die('Restricted Access!');
$page = intval($_GET['page']);
$mkey = 'mi_p_'.$uid.$page;
require $config['BASE_DIR']. '/classes/pagination.class.php';

if ( isset($_GET['delete']) ) {
    require $config['BASE_DIR']. '/classes/filter.class.php';
    $filter     = new VFilter();
    $mail_id    = $filter->get('delete', 'INTEGER', 'GET');
    if ( $mail_id !== 0 ) {
        $sql    = "SELECT mail_id FROM mail
                   WHERE mail_id = " .$mail_id. " AND receiver = '" .mysql_real_escape_string($username). "'
                   LIMIT 1";
        $conn->execute($sql);
        if ( $conn->Affected_Rows() === 1 ) {
            $sql    = "DELETE FROM mail WHERE mail_id = " .$mail_id. " LIMIT 1";
            $conn->execute($sql);
            $messages[] = $lang['mail.delete_msg'];
            $cache->_unset($mkey);
            $key = 'total_mails_'.$username;
            $options = array(
                'host'=>$config['mem_host'],
                'port'=>$config['mem_port'],
                'prefix'=>'puc_count',
                'expire'=>0,
                'length'=>0
            );
            $scache = Cache::getInstance('MemcacheAction',$options);
            $scache->_unset($key);
        } else {
            VRedirect::go($config['BASE_URL']. '/error/mail_missing');
        }
    }
}

$mail_arr = array();
$mail_arr = $cache->get($mkey);
if( !$mail_arr ){
    $sql_count      = "SELECT COUNT(mail_id) AS total_messages FROM mail WHERE receiver = '" .mysql_real_escape_string($username). "'
                      AND inbox = '1' AND status = '1'";
    $rsc            = $conn->execute($sql_count);
    $total          = $rsc->fields['total_messages'];
    $mail_arr['total'] = $total;

    $pagination     = new Pagination(50);
    $limit          = $pagination->getLimit($total);
    $sql            = "SELECT * FROM mail WHERE receiver = '" .mysql_real_escape_string($username). "' AND inbox = '1' AND status = '1' ORDER BY mail_id DESC LIMIT " .$limit;
    $rs             = $conn->execute($sql);
    $mails          = $rs->getrows();
    
    $usernames = array();
    foreach ($mails as $key => &$value) {
        if ($value['sender'] != SITE_ADMIN) {
            if (!in_array($value['sender'], $usernames)) {
                $usernames[] = $value['sender'];
            }
        }else{
            $value['photo'] = '';
            $value['gender'] = 'Male';
        }
    }
    if (!empty($usernames)) {
        $sql_str = '';
        foreach ($usernames as $u){
            $sql_str .= "'{$u}',";
        }
        $sql_str = rtrim($sql_str,',');
        $sql = "SELECT username, photo,gender FROM signup WHERE username in({$sql_str})";
        $rs             = $conn->execute($sql);
        $users          = $rs->getrows();
        foreach ($mails as &$vs) {
            foreach ($users as $v) {
                if ($v['username'] == $vs['sender']) {
                    $vs['photo'] = $v['photo'];
                    $vs['gender'] = $v['gender'];
                    break;
                }
            
            }  
        }
    }
    $mail_arr['mails'] = $mails;
    $page_link      = $pagination->getPagination('mail');
    $mail_arr['page_link'] = $page_link;
    $start_num      = $pagination->getStartItem();
    $mail_arr['start_num'] = $start_num;
    $end_num        = $pagination->getEndItem();
    $mail_arr['end_num'] = $end_num;
    $cache->set($mkey,$mail_arr);
}
if( $mail_arr ){
    $mails = $mail_arr['mails'];
    $total = $mail_arr['total'];
    $page_link = $mail_arr['page_link'];
    $start_num = $mail_arr['start_num'];
    $end_num = $mail_arr['end_num'];
    unset($mail_arr);
}
$smarty->assign('mails', $mails);
$smarty->assign('total_mails', $total);
$smarty->assign('page_link', $page_link);
$smarty->assign('start_num', $start_num);
$smarty->assign('end_num', $end_num);
$smarty->assign('folder', 'inbox');
?>
