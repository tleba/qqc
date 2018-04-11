<?php
defined('_VALID') or die('Restricted Access!');

require $config['BASE_DIR']. '/classes/filter.class.php';

$filter     = new VFilter();
$mail_id    = $filter->get('id', 'INTEGER', 'GET');
$folder    = $filter->get('f', 'STRING', 'GET');
if ( !$mail_id ) {
    VRedirect::go($config['BASE_URL']. '/error/mail_missing');
}

$sql        = "SELECT m.mail_id, m.sender, m.receiver, m.subject, m.body FROM mail AS m
               WHERE ( m.sender = '" .mysql_real_escape_string($username). "' OR m.receiver = '" .mysql_real_escape_string($username). "' )
               AND m.mail_id = " .$mail_id. " AND m.status = '1'
               LIMIT 1";
$rs         = $conn->execute($sql);
if ( !$conn->Affected_Rows() ) {
    VRedirect::go($config['BASE_URL']. '/error/mail_missing');
}

$mail       = $rs->getrows();
$mail       = $mail['0'];
$mail['body'] = urldecode($mail['body']);
if ($mail['sender'] == SITE_ADMIN) {
    $mail['photo'] = '';
    $mail['gender'] = 'Male';
}else{
    $sql = "SELECT photo,gender FROM signup WHERE username ='{$mail['sender']}'";
    $rs         = $conn->execute($sql);
    $user = $rs->getrows();
    $user = $user['0'];
    if (!empty($user)) {
        $mail['photo'] = $user['photo'];
        $mail['gender'] = $user['gender'];
    }
}
$sql        = "UPDATE mail SET readed = '1' WHERE mail_id = " .$mail_id. " LIMIT 1";
$conn->execute($sql);

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

$smarty->assign('mail', $mail);
$smarty->assign('folder', $folder);
?>
