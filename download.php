<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';

if ($new_permisions['sd_downloads'] == 1) {
    $vid = intval($_GET['id']);
    $sql = "SELECT VID, flvdoname, server FROM video WHERE VID = ".$vid." LIMIT 1";
    $rs  = $conn->execute($sql);
    $server = $rs->fields['server'];
    //update3.1
    $flv    = $rs->fields['flvdoname'];
	
    if ($conn->Affected_Rows()) {
	
		if($server != ''){
			$sql = "SELECT * FROM video v, servers s WHERE v.VID = ".$vid." AND v.server = s.video_url LIMIT 1";
			$rs  = $conn->execute($sql); 
			$vroot = $rs->fields['video_url']; 
			//$file = $vroot.'/flv/'.$vid.'.flv';
			//update3.1
			if ($flv == '') {
							$file = $vroot.'/iphone/'.$vid.'.mp4';
						} else {
							$file = $vroot.'/flv/'.$vid.'.flv';
				}
						
						
	  		$conn->execute("UPDATE video SET download_num = download_num+1 WHERE VID = ".$vid." LIMIT 1");
	  		@ob_end_clean();
	  		if(ini_get('zlib.output_compression')) {
				ini_set('zlib.output_compression', 'Off');
	  		}
			
	  		header('Content-Type: application/force-download');
	  		header('Content-Disposition: attachment; filename="'.basename($file).'"');
	  		header('Content-Transfer-Encoding: binary');
	  		header('Accept-Ranges: bytes');
	  		header('Cache-control: private');
	  		header('Pragma: private');
	  		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	  		header('Content-Length: ' .filesize($file));             
	  		readfile($file);
	  		exit();				
		}
		else {
			//$file = $config['BASE_DIR']. '/media/videos/flv/'.$vid.'.flv';

				//update3.1
				if ($flv == '') {
								$file = $config['BASE_DIR']. '/media/videos/iphone/'.$vid.'.mp4';
							} else {
								$file = $config['BASE_DIR']. '/media/videos/flv/'.$vid.'.flv';
							}
				
			if (file_exists($file) && is_file($file) && is_readable($file)) {
				$conn->execute("UPDATE video SET download_num = download_num+1 WHERE VID = ".$vid." LIMIT 1");
				@ob_end_clean();
				if(ini_get('zlib.output_compression')) {
					ini_set('zlib.output_compression', 'Off');
				}
			
				header('Content-Type: application/force-download');
				header('Content-Disposition: attachment; filename="'.basename($file).'"');
				header('Content-Transfer-Encoding: binary');
				header('Accept-Ranges: bytes');
				header('Cache-control: private');
				header('Pragma: private');
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Content-Length: ' .filesize($file));             
				readfile($file);
				exit();
			} else {
				VRedirect::go($config['BASE_URL']. '/error');
			}
		}
    } else {
		VRedirect::go($config['BASE_URL']. '/error');
    }
}
if ($new_permisions['sd_downloads'] == 0 && !$_SESSION['uid']) {
    $_SESSION['error'] = $lang['download.error'];
    VRedirect::go($config['BASE_URL']. '/signup');
}
if ($new_permisions['sd_downloads'] == 0 && $_SESSION['uid'] && $_SESSION['uid_premium'] == 0) {
	VRedirect::go($config['BASE_URL']. '/error/download_free');
}
if ($new_permisions['sd_downloads'] == 0 && $_SESSION['uid_premium']) {
	VRedirect::go($config['BASE_URL']. '/error/download_premium');
}

die();
?>
