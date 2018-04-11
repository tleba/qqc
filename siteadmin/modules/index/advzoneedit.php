<?php
defined('_VALID') or die('Restricted Access!');

Auth::checkAdmin();

$adv_group  = array('id' => '', 'name' => '', 'width' => 0, 'height' => 0);
$AGID       = ( isset($_GET['AGID']) && is_numeric($_GET['AGID']) && advGroupExists($_GET['AGID']) ) ? intval(trim($_GET['AGID'])) : NULL;
if ( !$AGID ) {
    $errors[] = 'Invalid advertise group ID! Are you sure this advertise exists!?';
}

if ( isset($_POST['edit_adv_group']) && !$errors ) {
	$name = mysql_real_escape_string(trim($_POST['name']));
    $width      = mysql_real_escape_string(trim($_POST['width']));
    $height     = mysql_real_escape_string(trim($_POST['height']));
    $sql  = "UPDATE adv_zone SET name='{$name}', width = '{$width}', height =  '{$height}'  WHERE id = " .$AGID. " LIMIT 1";
    $conn->execute($sql);
	
	write_ads_cache();
	
    $messages[]     = 'Advertising group successfully updated!';
}

if ( !$errors ) {
    $sql        = "SELECT * FROM adv_zone WHERE id = " .$AGID. " LIMIT 1";
    $rs         = $conn->execute($sql);
    $zone  = $rs->getrows();
}

function advGroupExists( $id )
{
    global $conn;
    
    $sql = "SELECT id FROM adv_zone WHERE id = " .intval($id). " LIMIT 1";
    $conn->execute($sql);
    
    return $conn->Affected_Rows();
}

$smarty->assign('zone', $zone);
?>