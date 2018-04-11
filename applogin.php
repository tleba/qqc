<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_smarty.php';
require 'classes/filter.class.php';
$filter     = new VFilter();
$username   = $filter->get('username');
$password   = $filter->get('password');
$stime       = $filter->get('time');
$m          = $filter->get('m');
$key = 'zhiboav';
$rand = $key . $username . $password .$stime;
$md5        = md5($rand);
//file_put_contents('login.log', "username:{$username};password:{$password};time:{$stime};m:{$m}<==>{$md5},str:{$rand}");

$result = array('code'=>0,'id'=>0,'username'=>'','error'=>'');
if ( $md5 == $m ) { 
    if ( empty($username) || empty($password) ) {
        $error = $lang['login.empty'];
    }
    if ( !$error ) {
        $username = mysql_real_escape_string($username);
        $sql    = "SELECT UID, email, pwd, emailverified, photo, fname, logintime, gender,premium,years,otime
                   FROM signup WHERE username = '{$username}' LIMIT 1;";
        $rs     = $conn->Execute($sql);
        if ( $conn->Affected_Rows() == 1 ) {
            $user   = $rs->getrows();
            $pwd = $user['0']['pwd'];
            $uid = intval($user['0']['UID']);
            $result['id'] = $uid;
            $result['username'] = $username;
			$password = md5($password);
			if ( $password == $pwd) {
                $yesterday  = time() - 86400;
                $sql_add    = '';
                if ( intval($user['0']['logintime']) < $yesterday ) {
                    $sql_add = ", points = points+5";
                }
                $time = time();
                $sql    = "UPDATE signup SET session_id = {$time}, logintime = '" .$time. "'" .$sql_add. " WHERE UID = {$uid} LIMIT 1";
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
				    'session_id'=> $time,
				    'uid' => $uid,
				    'username' => $username,
				    'uid_premium' => $premium,
				    'email' => $user['0']['email'],
				    'emailverified' => $user['0']['emailverified'],
				    'photo' => $user['0']['photo'],
				    'fname' => $user['0']['fname'],
				    'gender' => $user['0']['gender'],
				    'message' => 'Welcome ' .$username. '!'
				));
                
                $sql = "DELETE FROM `users_online` WHERE UID = {$uid} AND online < {$time}";
                $conn->execute($sql);
                $result['code'] = 1;
                echo json_encode($result);
                exit;
            } else {
                $error = $lang['login.is_rightpwd'];
            }
        } else {
            $error = $lang['login.is_username'];
        }
    }
}else{
    $error = '验证key不正确';
}
$result['error'] = $error;
echo json_encode($result);
exit;