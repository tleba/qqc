<?php
$dir = dirname(dirname(__FILE__));
$filepath = $dir.'/index.html';
$isStaticPage = false;

function curlGetData($uri='')
{
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $uri );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 0 );
    $return = curl_exec ( $ch );
    curl_close ( $ch );
    return $return;
}

echo "检测开始。。。\n";
while (true) {
    if (!file_exists($filepath)) {
        $isStaticPage = true;
    }
    $filesize = filesize($filepath);
    if ($filesize < 1000) {
        $isStaticPage = true;
    }
    if ($isStaticPage) {
        echo "检查到首页为空...\n";
        if(curlGetData('http://www.qqclogo.com/nm.php')){
            $isStaticPage = false;
        }
        echo "生成完成\n";
    }
    sleep(10);
}
echo "检测结束。。。";