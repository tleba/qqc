<?php

$errors = '';
$messages = '';
$mobile_menu				= '';
$module						= 'dashboard';
// ------------------------------------------------------------------------------

require $config['BASE_DIR'].'/include/function_user.php';
$options    = getUserQuery();
$username   = $options['username'];
if ( !$username ) {
    require 'classes/auth.class.php';
    $auth   = new Auth();
    $auth->check();
}
$sql    = "SELECT * FROM signup WHERE username = '" .mysql_real_escape_string($username). "' LIMIT 1";
$rs     = $conn->execute($sql);
if ( $conn->Affected_Rows() != 1 ) {
    VRedirect::go($config['BASE_URL']);
}
$user   = $rs->getrows();
$user   = $user['0'];

$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - '.$user['username'].' dashboard';

if(isset($_POST['profile_submit'])) {
	require $config['BASE_DIR']. '/classes/filter.class.php';
    $filter             = new VFilter();
    $password           = $filter->get('password');
    $password_confirm   = $filter->get('password_confirm');
    if ( $password != '' ) {
        if ( $password != $password_confirm ) {
            $errors[]   = $lang['signup.password_mismatch'];
        }
    } else {
		$errors[]  = $lang['signup.password_empty'];
	}

	if(! $errors) {
		$password	= md5($password);
		$sql = "UPDATE signup set pwd = '" .mysql_real_escape_string($password). "' WHERE UID = '".mysql_real_escape_string($user['UID'])."'" ;
		$conn->execute($sql);
		$messages[]     = 'Password was successfully updated!';
	}

}
if(isset($_POST['personal_submit'])) {
	require $config['BASE_DIR']. '/classes/filter.class.php';
    $filter             = new VFilter();
    $fname              = $filter->get('fname'); $user['fname'] = $fname;
    $lname              = $filter->get('lname'); $user['lname'] = $lname;
    $gender             = $filter->get('gender'); $user['gender'] = $gender;
	$relation           = $filter->get('relation'); $user['relation'] = $relation;
    $interested         = $filter->get('interested'); $user['interested'] = $interested;
    $website            = $filter->get('website'); $user['website'] = $website;
    $town               = $filter->get('town'); $user['town'] = $town;
    $city               = $filter->get('city'); $user['city'] = $city;
    $country            = $filter->get('country'); $user['country'] = $country;
    $occupation         = $filter->get('occupation'); $user['occupation'] = $occupation;
    $company            = $filter->get('company'); $user['company'] = $company;
    $school             = $filter->get('school'); $user['school'] = $school;
    $aboutme            = $filter->get('aboutme'); $user['aboutme'] = $aboutme;
    $interest_hobby     = $filter->get('interest_hobby'); $user['interest_hobby'] = $interest_hobby;

	$sql = "UPDATE signup SET fname = '" .mysql_real_escape_string($fname). "', lname = '" .mysql_real_escape_string($lname). "', gender = '" .mysql_real_escape_string($gender). "', relation = '" .mysql_real_escape_string($relation). "', interested = '" .mysql_real_escape_string($interested). "', website = '" .mysql_real_escape_string($website). "', town = '" .mysql_real_escape_string($town). "', city = '" .mysql_real_escape_string($city). "', country = '" .mysql_real_escape_string($country). "', aboutme = '" .mysql_real_escape_string($aboutme). "', occupation = '" .mysql_real_escape_string($occupation). "', company = '" .mysql_real_escape_string($company). "', school = '" .mysql_real_escape_string($school). "', interest_hobby = '" .mysql_real_escape_string($interest_hobby). "' WHERE UID = '" .mysql_real_escape_string($user['UID']). "' LIMIT 1";
     $conn->execute($sql);
     $messages[]     = 'Profile was successfully updated!';
}



$sql = "SELECT count(*) as vcount from video WHERE UID = '".$user['UID']."'";
$rs=$conn->execute($sql);
$uploads = $rs->fields['vcount'];
$smarty->assign('uploads', $uploads);

$smarty->assign('user', $user);
$smarty->assign('errors', $errors);
$smarty->assign('messages', $messages);

// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);
$smarty->assign('self_description', $seo['mobile_desc']);
$smarty->assign('self_keywords', $seo['mobile_keywords']);

// Assign Nav Tab
$smarty->assign('mobile_menu','');
$smarty->assign('mconfig',$mconfig);
// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
