<?php
define('_VALID', true);
require 'include/config.php';
require 'classes/filter.class.php';
require 'classes/validation.class.php';
require 'include/function_smarty.php';
require 'classes/email.class.php';
require 'include/function_user.php';

if ( $config['user_registration'] == '0' ) {
    VRedirect::go($config['BASE_URL']. '/error/registration_disabled');
}
$isMakeHtml = 1;
if ( $config['captcha'] == '1' ) {

		require_once("modules/ayah/ayah.php");
		$ayah = new AYAH();

		if (array_key_exists('submit_signup', $_POST))
		{
				// Use the AYAH object to see if the user passed or failed the game.
				$score = $ayah->scoreResult();

				if ($score)
				{
						// This happens if the user passes the game. In this case,
						// we're just displaying a congratulatory message.
						// echo "Congratulations: you are a human!";
				}
				else
				{
						// This happens if the user does not pass the game.
						// echo "Sorry, but we were not able to verify you as human. Please try again.";
						$errors[]               = $lang['signup.captcha'];
						$err['captcha']			= 1;
				}
		}

		$areyh = $ayah->getPublisherHTML();
		$smarty->assign('areyh',$areyh);
}

$signup     = array('username' => '', 'email' => '', 'age' => '', 'terms' => '', 'gender' => '');
if ( isset($_POST['submit_signup']) ) {
    $filter             = new VFilter();
    $valid              = new VValidation();
    $username           = $filter->get('username');
    $password           = $filter->get('password');
    $password_confirm   = $filter->get('password_confirm');
    $email              = $filter->get('email');
    $vcode              = $filter->get('verification');
    $age                = $filter->get('age');
    $terms              = $filter->get('terms');
    $gender             = $filter->get('gender');
    $guname             = $filter->get('guname');

    if ( $username == '' ) {
        $errors[]               = $lang['signup.username_empty'];
		$err['username']		=  1;
    } elseif ( strlen($username) > 15 ) {
        $errors[]               = $lang['signup.username_length'];
		$err['username']		= 1;
    } elseif ( !$valid->username($username) ) {
        $errors[]               = $lang['signup.username_invalid'];
		$err['username']		= 1;
    } elseif ( $valid->usernameExists($username) ) {
        $errors[]               = $lang['signup.username_exists'];
		$err['username']		= 1;
    } else {
        $signup['username']     = $username;
    }

    if ( $email == '' ) {
        $errors[]               = $lang['signup.email_empty'];
		$err['email']			= 1;
    } elseif ( !$valid->email($email) ) {
        $errors[]               = $lang['signup.email_invalid'];
		$err['email']			= 1;
    } elseif ( $valid->emailExists($email) ) {
        $errors[]               = $lang['signup.email_exists'];
		$err['email']			= 1;
    } else {
        $signup['email']        = $email;
    }

    if ( $password == '' ) {
        $errors[]               = $lang['signup.password_empty'];
		$err['password']		= 1;
		$err['password_confirm']= 1;
    } elseif ( $password_confirm == '' ) {
        $errors[]               = $lang['signup.passwordc_empty'];
		$err['password']		= 1;
		$err['password_confirm']= 1;
    } elseif ( $password != $password_confirm ) {
        $errors[]               = $lang['signup.password_mismatch'];
		$err['password']		= 1;
		$err['password_confirm']= 1;
    }

    if ( !empty($guname) ) {
        require 'classes/QQCToGame.class.php';
        if (QQCToGame::find($guname)) {
            $errors[]           = $lang['signup.guname'];
        }
        $result = getRemoteData($guname);
        if (!$result) {
            $errors[]          = $lang['signup.remote_guname'];
        }else{
            $nr = json_decode($result,true);
            if ($nr['status'] == 0) {
                $errors[]      = $lang['signup.remote_guname'];
            }
        }
    }
    if ( $age == '' ) {
        $errors[]               = $lang['signup.age_err'];
		$err['age']				= 1;
    } else {
        $signup['age']          = 'on';
    }

    if ( $terms == '' ) {
        $errors[]               = $lang['signup.terms_err'];
		$err['terms']			= 1;
    } else {
        $signup['terms']        = 'on';
    }

    if ( $gender == '' ) {
        $errors[]               = $lang['signup.gender_err'];
		$err['gender']			= 1;
    } else {
        $gender                 = ( $gender == 'Male' ) ? 'Male' : 'Female';
        $signup['gender']       = $gender;
    }
    $reg_ip = GetRealIP();
    if ( !$errors ) {
        require 'classes/random.class.php';
		$password_clear = $password;
        $password       = md5($password);
        $time = time();
        $sql            = "INSERT INTO signup SET email = '" .mysql_real_escape_string($email). "', username = '" .mysql_real_escape_string($username). "',
                                              pwd = '" .mysql_real_escape_string($password). "', gender = '" .$gender. "',
                                             addtime = '" .$time. "', logintime = '" .$time. "', reg_ip='{$reg_ip}'";
        $result = $conn->execute($sql);
        $uid            = mysql_insert_id();
        if (intval($uid) == 0) {
            $sql = 'SELECT last_insert_id();';
            $res = $conn->execute($sql);
            $uid = $res->fields[0];
            unset($res);
        }
        $uid_premium = 0;
        if ($result && !empty($guname)) {
            require 'include/config.products.php';
            require 'include/config.rank.php';
            $r = QQCToGame::add($uid, $guname);
            //获取用户存款信息,如果有就得将用户存款信息添加，并且添加相关数据的色币及升级
            if($r){
                $re = getRemoteData($guname);
                $re = json_decode($re,true);
                if ($re['status'] == 1) {
                    require 'classes/Deposit.class.php';
                    require 'classes/NSebi.class.php';
                    require 'classes/Member.class.php';
                    foreach ($re['msg'] as $sk => $sval){
                        if ($sk === 'balance_record') {
                            continue;
                        }
                        if (strpos($sk, 'deposit') === false) {
                            continue;
                        }
                        list($key,$time) = explode('_', $sk);
                        $re = Deposit::isRepeatRecord($uid, $time);
                        if (!$re) {
                            $r = Member::deposit($uid, $sval, $time);
                           if( $r !== false ){
                               Member::updateUserProducts($uid, $guname);
                               $uid_premium = $r;
                           }
                           unset($re['msg'][$sk]);
                        }
                    }
                }
            }
        }
        $sql            = "INSERT INTO users_prefs (UID) VALUES (" .$uid. ")";
        $conn->execute($sql);
        $sql            = "INSERT INTO users_online (UID, online) VALUES (" .$uid. ", " .$time. ")";
        $conn->execute($sql);
        $code           = VRandom::generate(10, 'confirmation');
        $sql            = "INSERT INTO confirm (UID, code) VALUES (" .$uid. ",'" .mysql_real_escape_string($code). "')";
        $conn->execute($sql);
        set_session_vals(
            array(
                'session_id'=>$time,
                'uid' =>$uid,
                'username'=>$username,
                'uid_premium'=>$uid_premium,
                'email'=>$email,
                'emailverified'=>'',
                'photo'=>'',
                'fname'=>'',
                'gender'=>$gender,
                'message'=>'Welcome ' .$username. '!',
            )
        );
        $cache->set($uid,$time);
        VRedirect::go('/');
    }
}
$smarty->assign('errors',$errors);
if ( isset($arr) ) {
    $smarty->assign('err',$err);
}
$smarty->assign('messages',$messages);
$smarty->assign('menu', 'home');
$smarty->assign('signup', $signup);
$smarty->assign('self_title', $seo['signup_title']);
$smarty->assign('self_description', $seo['signup_desc']);
$smarty->assign('self_keywords', $seo['signup_keywords']);
$smarty->display('header.tpl');
$smarty->display('errors.tpl');
$smarty->display('messages.tpl');
$smarty->display('signup.tpl');
$smarty->display('footer.tpl');
$smarty->gzip_encode();