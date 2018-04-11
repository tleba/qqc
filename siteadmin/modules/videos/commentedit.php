<?php
defined('_VALID') or die('Restricted Access!');

Auth::checkAdmin();

$comment    = NULL;
$COMID      = ( isset($_GET['COMID']) && is_numeric($_GET['COMID']) ) ? intval(trim($_GET['COMID'])) : NULL;
if ( isset($_POST['edit_comment']) ) {
    $comment = trim($_POST['comment']);
    
    if ( $comment == '' ) {
        $errors[] = 'Please enter your comment!';
    }
    
    if ( !$errors ) {
        $sql    = "UPDATE video_comments SET commen = '" .mysql_real_escape_string($comment). "'
                   WHERE CID = " .$COMID. " LIMIT 1";
        $conn->execute($sql);
        $messages[]    = 'Comment successfully updated!';
    }
}

if ( $COMID ) {
    $sql    = "SELECT commen FROM video_comments WHERE CID = " .$COMID. " LIMIT 1";
    $rs     = $conn->execute($sql);
    if ( $conn->Affected_Rows() == 1 ) {
        $comment = $rs->fields['comment'];
    } else {
        $errors[] = 'Invalid comment id or not set!?';
    }
}

$smarty->assign('COMID', $COMID);
$smarty->assign('comment', $comment);
?>
