<?php
defined('_VALID') or die('Restricted Access!');

Auth::checkAdmin();
//include($config['BASE_DIR'].'/include/function_conversions.php');
if ( isset($_POST['submit_media_mp4']) ) {
    $filter                     = new VFilter();
    
    //config settings
    $hd_convert			    	= $filter->get('hd_convert', 'INTEGER');
    
    //db settings
    $condition_value			= $filter->get('condition_value', 'INTEGER');
    $hd_ovc_profile				= $filter->get('hd_ovc_profile');
	$hd_resize_base			    = $filter->get('hd_resize_base');
	$hd_resize_width			= $filter->get('hd_resize_width', 'INTEGER');
	$hd_resize_height		    = $filter->get('hd_resize_height', 'INTEGER');
	$hd_ref_bitrate				= $filter->get('hd_ref_bitrate', 'INTEGER');	
	$hd_ref_type				= $filter->get('hd_ref_type');
	$hd_blackbars				= $filter->get('hd_blackbars', 'INTEGER');
	$hd_encodepass				= $filter->get('hd_encodepass', 'INTEGER');
	$hd_audio_sampling			= $filter->get('hd_audio_sampling', 'INTEGER');
	$hd_audio_bitrate			= $filter->get('hd_audio_bitrate', 'INTEGER');
	
	//prep
	$hd_ovc_profile = ($hd_ovc_profile == '') ? 'standard' : $hd_ovc_profile;
	$hd_resize_base = ($hd_resize_base == '') ? 'both' : $hd_resize_base;
	$hd_resize_width = ($hd_resize_width == '') ? '640' : $hd_resize_width;
	$hd_resize_height = ($hd_resize_height == '') ? '480' : $hd_resize_height;
	$hd_ref_bitrate = ($hd_ref_bitrate == '') ? '1500' : $hd_ref_bitrate;	
	$hd_ref_type = ($hd_ref_type == '') ? 'standard' : $hd_ref_type;
	$hd_encodepass = ($hd_encodepass == '1') ? '1' : '2';
	$hd_blackbars = ($hd_blackbars == '0') ? '0' : '1';
	$hd_audio_sampling = ($hd_audio_sampling == '') ? '48000' : $hd_audio_sampling;
	$hd_audio_bitrate = ($hd_audio_bitrate == '') ? '192' : $hd_audio_bitrate;
	
	
	if ( $hd_ref_bitrate == '' )
		$errors[] = 'Video Bit-rate for converted videos cannot be left blank!';
	elseif( !is_numeric($hd_ref_bitrate) )
		$errors[] = 'Video Bit-rate for converted videos must have a numeric value!';

	if ( $hd_audio_bitrate == '' )
		$errors[] = 'Audio Bit-rate for converted videos cannot be left blank!';
	elseif( !is_numeric($hd_audio_bitrate) )
		$errors[] = 'Audio Bit-rate for converted videos must have a numeric value!';
		
	if ( $hd_audio_sampling == '' )
		$errors[] = 'Sound sampling rate for converted videos cannot be left blank!';
	elseif( !is_numeric($hd_audio_sampling) )
		$errors[] = 'Sound sampling rate for converted videos must have a numeric value!';
		
    	
	if ( !$errors ) {
		// Update encoding profile
		$sql = "UPDATE encoding_avs SET"
			."  ovc_profile = '".$hd_ovc_profile."'"
			.", resize_base = '".$hd_resize_base."'"
			.", resize_width = '".$hd_resize_width."'"
			.", resize_height = '".$hd_resize_height."'"
			.", ref_bitrate = '".$hd_ref_bitrate."'"
			.", ref_type = '".$hd_ref_type."'"
			.", encodepass = '".$hd_encodepass."'"
			.", blackbars = '".$hd_blackbars."'"	
			.", audio_sampling = '".$hd_audio_sampling."'"
			.", audio_bitrate = '".$hd_audio_bitrate."'"
			." WHERE action = 'encode_x264'"
		."";
		$conn->execute($sql);
		
		$sql = "UPDATE encoding_condition SET"
			." condition_value = '".$condition_value."'"
			." WHERE video_type = 'normal'"
			." AND condition_seq = '1'"	
		."";
		$conn->execute($sql);
		
		$config['hd_convert']                 = $hd_convert;
		update_config($config);
        update_smarty();
		$messages[] = 'Conversion settings updated successfully!';
	}
}

// Get field Values
$sql = "SELECT ovc_profile, resize_base, resize_width, resize_height, ref_bitrate,"
	." ref_type, encodepass, blackbars, audio_sampling, audio_bitrate"
	." FROM encoding_avs"
	." WHERE video_type = 'normal'"
	." AND action = 'encode_x264'"	
."";
$rs = $conn->execute($sql);


// Get field Values
$sql = "SELECT condition_value"
	." FROM encoding_condition"
	." WHERE video_type = 'normal'"
	." AND condition_seq = '1'"	
."";
$rx = $conn->execute($sql);
$condition_value = $rx->fields['condition_value'];
$smarty->assign('condition_value', $condition_value);

$ovc_profile = $rs->fields['ovc_profile'];
$resize_base = $rs->fields['resize_base'];
$resize_width = $rs->fields['resize_width'];
$resize_height = $rs->fields['resize_height'];
$ref_bitrate = $rs->fields['ref_bitrate'];
$ref_type = $rs->fields['ref_type'];
$encodepass = $rs->fields['encodepass'];
$blackbars = $rs->fields['blackbars'];
$audio_sampling = $rs->fields['audio_sampling'];
$audio_bitrate = $rs->fields['audio_bitrate'];
$smarty->assign('sm_ovc_profile', $ovc_profile);
$smarty->assign('sm_resize_base', $resize_base);
$smarty->assign('sm_resize_width', $resize_width);
$smarty->assign('sm_resize_height', $resize_height);
$smarty->assign('sm_ref_bitrate', $ref_bitrate);
$smarty->assign('sm_ref_type', $ref_type);
$smarty->assign('sm_encodepass', $encodepass);
$smarty->assign('sm_blackbars', $blackbars);
$smarty->assign('sm_audio_sampling', $audio_sampling);
$smarty->assign('sm_audio_bitrate', $audio_bitrate);
?>
