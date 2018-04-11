<?php
defined('_VALID') or die('Restricted Access!');
date_default_timezone_set('PRC');
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

//session_unset();
//session_destroy();
$config['db_type'] = 'mysql';
$config['db_host'] = '127.0.0.1';
$config['db_user'] = 'root';
$config['db_pass'] = 'root';
$config['db_name'] = 'qqc';

$config['mem_host'] = '127.0.0.1';
$config['mem_port'] = '11211';

$config['authDB_type'] = 'mysql';
$config['authDB_host'] = 'bbsdb.xxx.xxx';
$config['authDB_user'] = 'Auth';
$config['authDB_pass'] = 'SM9qbTSCKNWZ3fWH';
$config['authDB_name'] = 'Auth';

$config['BBS_type'] = 'mysql';
$config['BBS_host'] = 'bbsdb.xxx.xxx';
$config['BBS_user'] = 'bbsDatabase';
$config['BBS_pass'] = 'hUcXSTVpP9NFz2eV';
$config['BBS_name'] = 'bbsDatabase';

?>
