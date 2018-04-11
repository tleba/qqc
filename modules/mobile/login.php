<?php
/*|******************************************************
|*|	iPhone / iPod - Mobile Webapp Module Version 2.0
|*| -----------------------------
|*| AVS Version 2.0+
|*| 12-03-2009
|*|******************************************************
|*/


$errors = '';
$messages = '';
$mobile_menu				= '';
$seo['mobile_title'] 		= $lang['global.login'].' '.$mconfig['mobile_sitename'];
$module						= 'login';
// ------------------------------------------------------------------------------

if ( isset($_POST['submit_login']) ) {
    require $config['BASE_DIR'].'/classes/filter.class.php';
    $filter     = new VFilter();
    $username   = $filter->get('username');
    $password   = $filter->get('password');
    
    if ( $username == '' || $password == '' ) {
        $errors[] = $lang['login.empty'];
    }
    
    if ( !$errors ) {
        $sql    = "SELECT UID, email, pwd, emailverified, photo, fname, logintime, gender
                   FROM signup WHERE username = '" .mysql_real_escape_string($username). "' LIMIT 1";
        $rs     = $conn->execute($sql);
        if ( $conn->Affected_Rows() == 1 ) {
            $user   = $rs->getrows();
			$password = md5($password);
			if ( $password == $user['0']['pwd'] ) {
                $yesterday  = time() - 86400;
                $sql_add    = NULL;
                if ( intval($user['0']['logintime']) < $yesterday ) {
                    $sql_add = ", points = points+5";
                }
            
                $sql    = "UPDATE signup SET logintime = '" .time(). "'" .$sql_add. " WHERE username = '" .mysql_real_escape_string($username). "' LIMIT 1";
                $conn->execute($sql);
                $_SESSION['uid']            = $user['0']['UID'];
                $_SESSION['username']       = $username;
                $_SESSION['email']          = $user['0']['email'];
                $_SESSION['emailverified']  = $user['0']['emailverified'];
                $_SESSION['photo']          = $user['0']['photo'];
                $_SESSION['fname']          = $user['0']['fname'];
                $_SESSION['gender']         = $user['0']['gender'];
                $_SESSION['message']        = 'Welcome ' .$username. '!';
                
                if (isset($_POST['login_remember']) && $config['user_remember'] == '1') {
                    Remember::set($username, $user['0']['pwd']);
                }

                VRedirect::go($config['BASE_URL'].'/mobile/');
				die();
            } else {
                $errors[] = $lang['login.invalid'];
            }
        } else {
            $errors[] = $lang['login.invalid'];
        }
    }
}


$smarty->assign('errors', $errors);
$smarty->assign('messages', $messages);

// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);

// Assign Nav Tab
$smarty->assign('mobile_menu','');
$smarty->assign('mconfig',$mconfig);

// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
