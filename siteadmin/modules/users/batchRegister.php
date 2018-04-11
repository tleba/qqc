<?php
defined('_VALID') or die('Restricted Access!');
set_time_limit(0);
Auth::checkAdmin();
$errors = array();
$successFile = '';
if ( isset($_POST['batch_insert']) ) {
    $path = $config['BASE_DIR'].'/tmp';
    
    if (!isset($_FILES['csv'])) {
        $errors[] = '请上传文件';
    }
    $file = $_FILES['csv'];
    if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
        if (!is_uploaded_file($file['tmp_name'])) {
            $errors[] = '文件上传方式异常';
        }else{
            $filename = substr($file['name'], strrpos($file['name'], DIRECTORY_SEPARATOR)+1);
            $extension = strtolower(substr($filename, strrpos($filename, '.')+1));
            if ($extension !== 'csv') {
                $errors[] = '上传文件名不对';
            }
            if (!$errors) {
                $csvFullPath = $path.'/'.$filename;
                
                if ( move_uploaded_file($file['tmp_name'], $csvFullPath) ) 
                    $successFile = $csvFullPath;
                else 
                    $errors[] = 'Failed to move uploaded file!';
            }
        }
    }
    if (!$errors && !empty($successFile)) {
        $arr = array();
        $fp = fopen($successFile, 'r');
        if ( $fp ) {
            @flock($fp, LOCK_SH);
            $i = 0;
            while (($data = fgetcsv($fp,3096,",")) !== false) {
                foreach ($data as $key => $value) {
                    $arr[$i][] = iconv("GBK", "UTF-8", $value);
                }
                $arr[$i][] = $_SERVER['REQUEST_TIME'];
                $i++;
            }
            fclose($fp);
        }
        unlink($successFile);
        if (count($arr) > 0) {
            unset($arr[0]);
            require $config['BASE_DIR'].'/classes/Signup.classes.php';
            $result = Signup::register($arr);
            if ($result === true) {
                $messages[] = '批量注册成功';
            }else{
                $errors[] = $result;
            }
        }
    }
    sort($arr);
    $smarty->assign('arr', $arr);
}
$smarty->assign('errors', $errors);
$smarty->assign('messages', $messages);