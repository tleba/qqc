<?php
defined('_VALID') or die('Restricted Access!');
require $config['BASE_DIR']. '/classes/pagination.class.php';

Auth::checkAdmin();

if (isset($_POST['unflag_selected_games'])) {
    $index = 0;
    foreach ( $_POST as $key => $value ) {
        if ( $key != 'check_all_games' && substr($key, 0, 17) == 'game_id_checkbox_') {
            if ( $value == 'on' ) {
                $sql = "DELETE FROM game_flags WHERE GID = " .intval(str_replace('game_id_checkbox_', '', $key)). " LIMIT 1";
                $conn->execute($sql);
                ++$index;
            }
        }
    }

    if ( $index === 0 ) {
        $errors[]   = 'Please select games to be unflaged!';
    } else {
        $messages[] = 'Successfully unflaged ' .$index. ' (selected) games!';
    }
}

if (isset($_POST['suspend_selected_games']) || isset($_POST['approve_selected_games']) ) {
    $act        = 1;
    $act_name   = 'activated';
    $index      = 0;
    if ( isset($_POST['suspend_selected_games']) ) {
        $act        = 0;
        $act_name   = 'suspended';
    }

    foreach ( $_POST as $key => $value ) {
        if ( $key != 'check_all_games' && substr($key, 0, 17) == 'game_id_checkbox_') {
            if ( $value == 'on' ) {
                $gid = intval(str_replace('game_id_checkbox_', '', $key));
                $sql = "UPDATE game SET status = '" .$act. "' WHERE GID = " .$gid. " LIMIT 1";
                $conn->execute($sql);
                ++$index;
            }
        }
    }
    
    if ( $index === 0 ) {
        $errors[]   = 'Please select games to be ' .$act_name. '!';
    } else {
        $messages[] = 'Successfully ' .$act_name. ' ' .$index. ' (selected) games!';
    }
}


$remove         = NULL;
$page   = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

if ( isset($_GET['a']) && $_GET['a'] != '' ) {
    $action = trim($_GET['a']);
    $GID    = ( isset($_GET['GID']) && is_numeric($_GET['GID']) ) ? intval(trim($_GET['GID'])) : NULL;
    $FID    = ( isset($_GET['FID']) && is_numeric($_GET['FID']) ) ? intval(trim($_GET['FID'])) : NULL;
    switch ( $action ) {
        case 'unflag':
            $sql    = "DELETE FROM game_flags WHERE FID = " .$FID. " LIMIT 1";
            $conn->execute($sql);
            if ( $conn->Affected_Rows() == 1 ) {
                $messages[] = 'Successfully unflaged game!';
            } else {
                $errors[]   = 'Failed to unflag game! Are you sure this game is flagged?!';
            }
            $remove = '&a=unflag&FID=' .$FID;
            break;
        case 'activate':
        case 'suspend':
            if ( $action == 'activate' ) {
                $status     = 1;
                $perform    = 'activated';
            } else {
                $status     = 0;
                $perform    = 'suspended';
            }
            $sql        = "UPDATE game SET status = '" .$status. "' WHERE GID = " .$GID. " LIMIT 1";
            $conn->execute($sql);
            if ( $conn->Affected_Rows() == 1 ) {
                $messages[] = 'Successfully ' .$perform. ' game!';
            } else {
                $errors[]   = 'Failed to ' .$action. ' game! Are you sure this game exists?!';
            }
            $remove     = '&a=' .$action. '&GID=' .$GID;
            break;
        default:
            $errors[]   = 'Invalid action. Allowed actions: delete, activate, suspend and unflag!';
    }
}

$query          = constructQuery();
$sql            = $query['count'];
$rs             = $conn->execute($sql);
$total_games    = $rs->fields['total_games'];
$pagination     = new Pagination($query['page_items']);
$limit          = $pagination->getLimit($total_games);
$paging         = $pagination->getAdminPagination($remove);
$sql            = $query['select']. " LIMIT " .$limit;
$rs             = $conn->execute($sql);
$games          = $rs->getrows();

function constructQuery()
{
    global $smarty;

    $query              = array();
    $query_select       = "SELECT g.*, s.username, f.UID AS SUID, f.FID, f.add_date, f.reason, f.message
                           FROM game AS g, signup AS s, game_flags AS f
                           WHERE g.GID = f.GID AND g.UID = s.UID";
    $query_count        = "SELECT COUNT(g.GID) AS total_games FROM game AS g, signup AS s, game_flags AS f
                           WHERE g.GID = f.GID AND g.UID = s.UID";
    $query_option       = array();
    $option_orig             = array('username' => '', 'title' => '', 'flagger' => '', 'sort' => 'g.GID', 'order' => 'DESC', 'display' => 10);

	$all   = (isset($_GET['all'])) ? intval($_GET['all']) : 0;
	if ($all == 1) {
		unset ($_SESSION['search_games_flagged_option']);
	}
	
	$option             = ( isset($_SESSION['search_games_flagged_option']) ) ? $_SESSION['search_games_flagged_option'] : $option_orig;	
		
    if ( isset($_POST['search_games']) ) {
		$option['username']     = trim($_POST['username']);
        $option['title']        = trim($_POST['title']);
        $option['flagger']      = trim($_POST['flagger']);
        $option['sort']         = trim($_POST['sort']);
        $option['order']        = trim($_POST['order']);
        $option['display']      = trim($_POST['display']);

		if ( $option['username'] != '' || isset($_GET['UID']) ) {
			if ( $option['username'] != '' ) {
				$UID            = getUserID($option['username']);
			} else {
				$UID            = ( isset($_GET['UID']) && is_numeric($_GET['UID']) ) ? $_GET['UID'] : 0;
			}
			$UID            = ( $UID ) ? intval($UID) : 0;
			$query_option[] = " AND g.UID = " .$UID;
		}
		
		if ( $option['flagger'] != '' ) {
			$UID                = getUserID($option['flagger']);
			$UID                = ( $UID ) ? intval($UID) : 0;
			$query_option[]     = " AND f.UID = " .$UID;
		}
									
		if ( $option['title'] != '' ) {
			$query_option[] = " AND g.title LIKE '%" .mysql_real_escape_string($option['title']). "%'";
		}

		$_SESSION['search_games_flagged_option'] = $option;

	}
	
    $query_option[]         = " ORDER BY " .$option['sort']. " " .$option['order'];
    $query['select']        = $query_select .implode(' ', $query_option);
    $query['count']         = $query_count .implode(' ', $query_option);
    $query['page_items']    = $option['display'];
    
    $smarty->assign('option', $option);

    return $query;
}
 
function getUserID( $username )
{
    global $conn;
        
    $sql = "SELECT UID FROM signup WHERE username = '" .mysql_real_escape_string($username). "' LIMIT 1";
    $rs  = $conn->execute($sql);
    if ( $conn->Affected_Rows() == 1 ) {
        return $rs->fields['UID'];
    }

    return false;
}

$smarty->assign('games', $games);
$smarty->assign('games_total', $total_games);
$smarty->assign('paging', $paging);
$smarty->assign('page', $page);
?>
