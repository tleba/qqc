<?php
header('Access-Control-Allow-Origin: *');
header ("Cache-Control: no-cache, must-revalidate");  
header ("Pragma: no-cache");  
define('_VALID', true);
require 'include/config.php';
require 'include/function_smarty.php';
require 'include/function_user.php';

if ( $_GET['action']==='login' ) {
    require 'classes/filter.class.php';
    $filter     = new VFilter();
    $username   = $filter->get('user','STRING','GET');
    $password   = $filter->get('pass','STRING','GET');
    
    if (empty($username)||empty($password)) {
        $arr['success'] = 0; 
        $arr['msg'] = $lang['login.empty'];
    }

    if ( !$arr ) {
        $username = mysql_real_escape_string($username);
        $sql    = "SELECT UID, email, pwd, emailverified, photo, fname, logintime, gender,premium,years,otime
                   FROM signup WHERE username = '{$username}' LIMIT 1";
        $rs     = $conn->Execute($sql);
        if ( $conn->Affected_Rows() == 1 ) {
            $user   = $rs->getrows();
            $pwd = $user['0']['pwd'];
            $uid = $user['0']['UID'];
			$password = md5($password);
			if ( $password == $pwd ) {
                $yesterday  = time() - 86400;
                $sql_add    = NULL;
                if ( intval($user['0']['logintime']) < $yesterday ) {
                    $sql_add = ", points = points+5";
                }
                $time = time();
                $sql    = "UPDATE signup SET session_id = '{$time}',logintime = '" .$time. "'" .$sql_add. " WHERE UID = {$uid} LIMIT 1";
                $conn->execute($sql);
                $premium = 0;
				//如果积分VIP用户
				if ($user['0']['premium'] == '1') {
				    $sql = "SELECT sebi_surplus FROM user_sebi WHERE uid={$uid} LIMIT 1;";
				    $rs = $conn->execute($sql);
				    $sebi_surplus = $rs->fields['sebi_surplus'];
					if ($sebi_surplus == 0){
						$sql    = "UPDATE signup SET premium = 0 WHERE UID = {$uid} LIMIT 1";
						$conn->execute($sql);
						$sql = "UPDATE user_sebi SET sebi = 0, sebi_total = 0,sebi_consume = 0,sebi_surplus=0,isfree =1 WHERE UID= {$uid} LIMIT 1;";
						$conn->execute($sql);
						$sql = "UPDATE user_deposit SET sebi=0,isget_sebi=0,get_sebi=0 WHERE UID={$uid} LIMIT 1;";
						$conn->execute($sql);
					}else{
					    $premium = $user['0']['premium'];
					}
				}elseif ($user['0']['premium'] == '2'){//年VIP用户
				    $Today = date("y-m-d");
				    $Today = strtotime($Today);
				    $years = $user['0']['years'];
				    $endTime = strtotime("+{$years} year",$user['0']['otime']);
				    if ($Today > $endTime) {
				        $sql    = "UPDATE signup SET premium = 0 WHERE UID = {$uid} LIMIT 1";
				        $conn->execute($sql);
				        $sql = "UPDATE user_sebi SET sebi = 0, sebi_total = 0,sebi_consume = 0,sebi_surplus=0,isfree =1 WHERE UID= {$uid} LIMIT 1;";
				        $conn->execute($sql);
				        $sql = "UPDATE user_deposit SET sebi=0,isget_sebi=0,get_sebi=0 WHERE UID={$uid} LIMIT 1;";
				        $conn->execute($sql);
				    }else{
				        $premium = $user['0']['premium'];
				    }
				}elseif ($user['0']['premium'] == '3'){
				    $premium = $user['0']['premium'];
				}
				set_session_vals(array(
				    'session_id' => $time,
				    'uid' => $uid,
				    'username' => $username,
				    'uid_premium' => $premium,
				    'email' => $user['0']['email'],
				    'emailverified'  => $user['0']['emailverified'],
				    'photo'          => $user['0']['photo'],
				    'fname'          => $user['0']['fname'],
				    'gender'         => $user['0']['gender'],
				    'message'        => 'Welcome ' .$username. '!',
				));
				
                $cache->set($uid,$time);
                
                require 'classes/QQCToGame.class.php';
                $gameUser = QQCToGame::findObj($uid);
                $isgameUserNull = 1;
                if ($gameUser) {
                    $isgameUserNull = 0;
                    $smarty->assign('gusername',$gameUser['gusername']);
                }
                if (isset($_POST['login_remember']) && $config['user_remember'] == '1') {
                    Remember::set($username, $pwd);
                }
                if (isset($_SESSION['redirect'])) {
                    unset($_SESSION['redirect']);
                }  
                $sql = "DELETE FROM `users_online` WHERE UID = {$uid} AND online < {$time}";
                $conn->execute($sql);
                $smarty->assign('isgameUserNull', $isgameUserNull);
                $PremiumRemaining = NewPremiumRemainingSEBI($uid,$premium);
                $PremiumRemainingView = NewPremiumRemainingView($PremiumRemaining);
                //$PremiumNikename = NewPremiumNikename($PremiumRemaining['rank']);
                
                $smarty->assign('rank',$PremiumRemaining['rank']);
                $smarty->assign('user_range',$PremiumRemaining['user_range']);
                $smarty->assign('PremiumRemainingView',$PremiumRemainingView);
               // $smarty->assign('PremiumNikename',$PremiumNikename);
                $smarty->assign('premium', $premium);
                $smarty->assign('remotehost','http://'.$_SERVER['HTTP_HOST']);
                $content = $smarty->fetch('site_login.tpl', null, null, false);
                
        		$arr['success'] = 1;
        		$arr['msg'] = '登录成功！';
        		$arr['html'] = $content;
	          } else {
				$arr['success'] = 0; 
				$arr['msg'] = $lang['login.is_rightpwd'];
				$arr['html'] = '';
             }
        } else {
            $arr['success'] = 0; 
            $arr['msg'] = $lang['login.is_username'];
            $arr['html'] = '';
        }
    }
    $callback = htmlspecialchars($_GET['callback']);
    echo $callback.'('.json_encode($arr).')';
}
?>