<?php
exit('请去上传中心上传！');
defined('_VALID') or die('Restricted Access!');
require $config['BASE_DIR']. '/include/function_video.php';
require $config['BASE_DIR']. '/classes/filter.class.php';

if ( $config['video_module'] == '0' ) {
    VRedirect::go($config['BASE_URL']. '/error/page_invalid');
}

// Added to enforce these paths
$basedir = dirname(dirname(dirname(__FILE__)));
$config['BASE_DIR'] 	= $basedir;
$config['LOG_DIR'] 		= $basedir.'/tmp/logs';
$config['VDO_DIR'] 		= $basedir.'/media/videos/vid';

$upload_id          = mt_rand(). '_' .time();
$upload_max_size    = $config['video_max_size']*1024*1024;
$video_extensions  = '(' .str_replace(',', ' | ', $config['video_allowed_extensions']). ')';
$video_allowed_ext  = '(' .str_replace(',', '|', $config['video_allowed_extensions']). ')';
$video              = array('title' => '', 'keywords' => '', 'category' => 0, 'paysite' => '',
                            'privacy' => 'public', 'anonymous' => 'no');
                            

if ( isset($_POST['video_upload_started']) ) {
    $filter     = new VFilter();
    $title      = $filter->get('video_title');
    $category   = $filter->get('video_category', 'INTEGER');
    $keywords   = $filter->get('video_keywords');
    $paysite    = $filter->get('video_paysite');
    $privacy    = $filter->get('video_privacy');
    $anonymous  = $filter->get('video_anonymous');

    if ( $title == '' ) {
        $errors[]           = $lang['upload.video_title_empty'];
    } else {
        $video['title'] = $title;
    }

    if ( $keywords == '' ) {
        $errors[]           = $lang['upload.video_tags_empty'];
    } else {
        $keywords           = prepare_string($keywords, false);
        $video['keywords']  = $keywords;
    }

    if ( $category == '0' ) {
        $errors[]           = $lang['global.category_empty'];
    } else {
        $video['category']  = $category;
    }

    if ( $_FILES['video_file']['tmp_name'] == '' ) {
        $errors[]           = $lang['upload.video_file_empty'];
    } elseif ( !is_uploaded_file($_FILES['video_file']['tmp_name']) ) {
        $errors[]           = $lang['upload.video_file_invalid'];
    } else {
        $filename           = substr($_FILES['video_file']['name'], strrpos($_FILES['video_file']['name'], DIRECTORY_SEPARATOR)+1);
        $extension          = strtolower(substr($filename, strrpos($filename, '.')+1));
        $extensions_allowed = explode(',', $config['video_allowed_extensions']);
        if ( !in_array($extension, $extensions_allowed) ) {
            $errors[]       = translate('upload.video_ext_invalid', $config['video_allowed_extensions']);
        } else {
            $space = filesize($_FILES['video_file']['tmp_name']);
            if ( $space > $upload_max_size ) {
                $errors[]   = translate('upload.video_size_invalid', $config['video_max_size']);
            }
        }
    }

    $video['paysite']       = $paysite;
    $video['privacy']       = ( $privacy == 'private' ) ? 'private' : 'public';
    $video['anonymous']     = ( $anonymous == 'yes' ) ? 'yes' : 'no';
    $uid                    = ( $anonymous == 'yes' ) ? getAnonymousUID() : intval($_SESSION['uid']);

    if ( !$errors ) {
        $sql        = "INSERT INTO video 
                       SET UID = " .$uid. ", title = '" .mysql_real_escape_string($title). "',
                           channel = " .$category. ", keyword = '" .mysql_real_escape_string($keywords). "',
                           space = '" .$space. "', addtime = '" .time(). "', adddate = '" .date('Y-m-d'). "', vkey = '" .mt_rand(). "',
                           type = '" .$video['privacy']. "', active = '2'";
        $conn->execute($sql);
        $video_id   = mysql_insert_id();
        $vdoname    = $video_id. '.' .$extension;
        $flvdoname  = $video_id. '.flv';
        
        $vdo_path   = $config['VDO_DIR']. '/' .$vdoname;
        if ( !move_uploaded_file($_FILES['video_file']['tmp_name'], $vdo_path) ) {
            $errors[]   = 'Failed to move uploaded file!';
        }

        if ( !$errors ) {
        
        
			// ---------------------------------------------------------------------------
			// ---------------------------------------------------------------------------
			function run_in_background($Command, $Priority = 0){
				if($Priority) $PID = shell_exec("nohup nice -n $Priority $Command 2> /dev/null & echo $!");
			    else $PID = shell_exec("nohup $Command 2> /dev/null & echo $!");
			    return($PID);
			}
				
			exec($config['mplayer']. ' -vo null -ao null -frames 0 -identify "' .$config['VDO_DIR']. '/' .$vdoname. '"', $p);
			while(list($k,$v)=each($p)){
				if (preg_match("/^ID_.+\=.+/", $v)){
					$lx = explode("=", $v);
					$vidinfo[$lx[0]] = $lx[1];
				}
			}
			$duration = $vidinfo['ID_LENGTH'];
			$height = $vidinfo['ID_VIDEO_HEIGHT'];
			$width = $vidinfo['ID_VIDEO_WIDTH'];
			$fps = $vidinfo['ID_VIDEO_FPS'];
			$id_video_format = $vidinfo['ID_VIDEO_FORMAT'];
			$cgi = ( strpos(php_sapi_name(), 'cgi') ) ? 'env -i ' : NULL;
			
			// Proc
            $cmd = $cgi.$config['phppath']
		    	." ".$config['BASE_DIR']."/scripts/convert_videos.php"
		    	." ".$vdoname
		    	." ".$video_id
		    	." ".$vdo_path
		    ."";
            log_conversion($config['LOG_DIR']. '/' .$video_id. '.log', $cmd);
            $lg = $config['LOG_DIR']. '/' .$video_id. '.log2';
            run_in_background($cmd.' > '.$lg);


            $duration   = get_video_duration($vdo_path, $video_id);
            $vkey       = substr(md5($video_id),11,20);
            $sql        = "UPDATE video SET duration = '" .mysql_real_escape_string($duration). "', vkey = '" .$vkey. "',
                                            vdoname = '" .mysql_real_escape_string($vdoname). "', flvdoname = '" .mysql_real_escape_string($flvdoname). "'
                           WHERE VID = " .intval($video_id). " LIMIT 1";
            $conn->execute($sql);
            
			
            $video_url  = $config['BASE_URL']. '/video/' .$video_id. '/' .prepare_string($title);
			$video_link = '<a href="'.$video_url.'">'.$video_url.'</a>';
            
            $sql        = "SELECT sv.SUID, s.username, s.email FROM video_subscribe AS sv, signup AS s
                           WHERE sv.UID = " .$uid. " AND sv.UID = s.UID";
            $rs         = $conn->execute($sql);
            if ( $conn->Affected_Rows() > 0 ) {
                $subscribers    = $rs->getrows();
                $mail           = new VMail();
                $mail->setNoReply();
                $sql            = "SELECT * FROM emailinfo WHERE email_id = 'subscribe_email' LIMIT 1";
                $rs             = $conn->execute($sql);
                $email_path     = $config['BASE_DIR']. '/templates/' .$rs->fields['email_path'];
                $sender         = ( $anonymous == 'yes' ) ? 'anonymous' : $_SESSION['username'];
                $mail->Subject  = str_replace('$sender_name', $sender, $rs->fields['email_subject']);
                foreach ( $subscribers as $subscriber ) {
                    $smarty->assign('video_link', $video_link);
                    $smarty->assign('username', $subscriber['username']);
                    $smarty->assign('sender_name', $_SESSION['username']);
                    $body               = $smarty->fetch($email_path);
                    $mail->AltBody      = $body;
                    $mail->Body         = nl2br($body);
                    $mail->AddAddress($subscriber['email']);
                    $mail->Send();
                    $mail->ClearAddresses();
                }
            }
          
            $search     = array('{$site_title}', '{$site_name}', '{$username}', '{$video_link}', '{$baseurl}');
            $replace    = array($config['site_title'], $config['site_name'], $_SESSION['username'], $video_link, $config['BASE_URL']);
            $mail       = new VMail();
            if ( $config['approve'] == '0' ) {
                $mail->sendPredefined($_SESSION['email'], 'video_approve', $search, $replace);
            } else {
                $mail->sendPredefined($_SESSION['email'], 'video_upload', $search, $replace);    
            }
          
            $sql        = "UPDATE channel SET total_videos = total_videos+1 WHERE CHID = " .$category. " LIMIT 1";
            $conn->execute($sql);
            $sql        = "UPDATE signup SET total_videos = total_videos+1, points = points+10 WHERE UID = " .$uid. " LIMIT 1";
            $conn->execute($sql);

            $video['title']     = '';
            $video['keywords']  = '';
            $video['category']  = 0;
            $video['paysite']   = '';
            $video['privacy']   = 'public';
            $video['anonymous'] = 'no';
            
            if ( $config['approve'] == '1' ) {
				$messages[] = translate('upload.video_approve', $config['site_name']);
            } else {
				$messages[] = translate('upload.video_success', $config['site_name'], $video_url, htmlspecialchars($title, ENT_QUOTES, 'UTF-8'));
            }
        }
    }
}

$smarty->assign('video', $video);
$smarty->assign('upload_id', $upload_id);
$smarty->assign('upload_max_size', $upload_max_size);
$smarty->assign('allowed_video_extensions', $video_allowed_ext);
$smarty->assign('video_extensions', $video_extensions);
$smarty->assign('upload_video', true);
$smarty->assign('categories', get_categories());
?>
