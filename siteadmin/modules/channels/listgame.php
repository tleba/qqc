<?php
defined('_VALID') or die('Restricted Access!');

Auth::checkAdmin();

if ( isset($_GET['a']) && $_GET['a'] == 'delete' ) {
    $CID = ( isset($_GET['CID']) && is_numeric($_GET['CID']) ) ? trim($_GET['CID']) : NULL;
    if ( $CID ) {
        $sql = "DELETE FROM game_categories WHERE category_id = '" .mysql_real_escape_string($CID). "' LIMIT 1";
        $conn->execute($sql);
        if ( $conn->Affected_Rows() )
            $messages[] = 'Channel deleted successfuly!';
        else
            $errors[] = 'Failed to delete channel. Invalid channel id!?';
    } else
        $errors[] = 'Channel id not set or not numeric!';
}

$query      = constructQuery();
$sql        = $query['select'];
$rs         = $conn->execute($sql);
$channels   = $rs->getrows();

function constructQuery()
{
    global $smarty;

    $query              = array();
    $query_select       = "SELECT * FROM game_categories";
    $query_count        = "SELECT count(category_id) AS total_categories FROM game_categories";
    $query_add          = NULL;
    $option_orig        = array('sort' => 'CHID', 'order' => 'DESC');
    $option             = ( isset($_SESSION['search_channels_option']) ) ? $_SESSION['search_channels_option'] : $option_orig;
    
    if ( isset($_POST['search_packages']) ) {
        $option['sort']     = trim($_POST['sort']);
        $option['order']    = trim($_POST['order']);
        
        $query_add = " ORDER BY " .$option['sort']. " " .$option['order'];
        
        $_SESSION['search_channels_option'] = $option;
    }
    
    $query['select']    = $query_select . $query_add;
    $query['count']     = $query_count . $query_add;
    
    $smarty->assign('option', $option);
    
    return $query;
}

$smarty->assign('channels', $channels);
?>
