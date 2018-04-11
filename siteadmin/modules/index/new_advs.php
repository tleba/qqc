<?php
defined('_VALID') or die('Restricted Access!');

Auth::checkAdmin();


if ( isset($_GET['a']) ) {
	//图片放置路径
    $advImgPath = '/ps';
    $advAllImgPath 	= $config['BASE_DIR'].$advImgPath;
	
    $action     = trim($_GET['a']);
    $AID        = ( isset($_GET['AID']) && is_numeric($_GET['AID']) ) ? intval(trim($_GET['AID'])) : NULL;
	
	if ( isset($_GET['a']) && ( $_GET['a'] == 'clearcache') ) {
		write_ads_cache($advAllImgPath);
		$messages[] = 'Advertise cache were deleted successfuly';
	}elseif ( $action == 'activate' or $action == 'suspend' ) {
        $status = ( $_GET['a'] == 'activate' ) ? '1' : '0';
        $sql    = "UPDATE adv SET adv_status = '" .$status. "' WHERE adv_id = " .$AID. " LIMIT 1";
        $conn->execute($sql);
        if ( $conn->Affected_Rows() ) {
            $messages[] = 'Advertise successfuly ' .$_GET['a']. 'ed!';
        } else {
            $errors[] = 'Failed to ' .$_GET['a']. ' advertise! Invalid advertise id!?';
        }
    } elseif ( $action == 'delete' ) {
        $sql    = "DELETE FROM adv_ads WHERE id = " .$AID. " LIMIT 1";
        $conn->execute($sql);
		
		write_ads_cache($advAllImgPath);
        $messages[]    = 'Advertise deleted successfully!';
    } else {
        $errors[] = 'Invalid action specified! Allowed actions: activate, suspend and delete!';
    }
}

$query      = constructQuery();
$sql        = $query['select'];


$rs         = $conn->execute($sql);
$advs       = $rs->getrows();

function constructQuery()
{
    global $smarty;

    $query              = array();
    //排序  第一优先zone_id 排序 第二优序列号排序 第二优先时间倒序
    $where ="  ORDER BY `zone_id` ASC ,`orderby` ASC , `addtime` DESC";
    $query_select       = "SELECT a.*, g.name as zone_name FROM adv_ads a LEFT JOIN adv_zone g ON (a.zone_id=g.id)".$where;
    $query_count        = "SELECT COUNT(id) AS total_advs FROM adv_ads";
    $query_add          = NULL;
    $option_orig        = array('sort' => 'a.id', 'order' => 'DESC');

    $query['select']    = $query_select . $query_add;
    $query['count']     = $query_count . $query_add;

    return $query;
}

$smarty->assign('advs', $advs);
?>
