<?php
class FileCache extends Cache implements ICache
{
    function __construct($options = array()){
        if (!empty($options)) {
            $this->options = $options;
        }
        $this->options['temp'] = $options['temp'];
        $this->options['prefix'] = $options['prefix'];
        $this->options['expire'] = $options['expire'];
        $this->options['length'] = $options['length'];
        if(substr($this->options['temp'], -1) != '/')
            $this->options['temp'] .='/';
        $this->init();
    }
    
    private function init(){
        if (!is_dir($this->options['temp'])) {
            mkdir($this->options['temp']);
        }
    }
    private function filename($name) {
        $name	=	md5($name);
        $filename	=	$this->options['prefix'].$name.'.php';
        return $this->options['temp'].$filename;
    }
    public function set($name,$value,$expire=null) {
        if(is_null($expire)) {
            $expire =  $this->options['expire'];
        }
        $filename   =   $this->filename($name);
        $data   =   serialize($value);
        if(function_exists('gzcompress')) {
            //数据压缩
            $data   =   gzcompress($data,3);
        }
        $data    = "<?php\n//".sprintf('%012d',$expire).$data."\n?>";
        $result  =   file_put_contents($filename,$data);
        if($result) {
            clearstatcache();
            return true;
        }else {
            return false;
        }
    }
    public function get($name) {
        $filename   =   $this->filename($name);
        if (!is_file($filename)) {
            return false;
        }
        
        $content    =   file_get_contents($filename);
        if( false !== $content) {
            $expire  =  (int)substr($content,8, 12);
            if($expire != 0 && time() > filemtime($filename) + $expire) {
                //缓存过期删除缓存文件
                unlink($filename);
                return false;
            }
            $content   =  substr($content,20, -3);
            
            if(function_exists('gzcompress')) {
                //启用数据压缩
                $content   =   gzuncompress($content);
            }
            $content    =   unserialize($content);
            return $content;
        }
        else {
            return false;
        }
    }
    public function rm($name) {
        return unlink($this->filename($name));
    }
    public function clear() {
        $path   =  $this->options['temp'];
        $files  =   scandir($path);
        if($files){
            foreach($files as $file){
                if ($file != '.' && $file != '..' && is_dir($path.$file) ){
                    array_map( 'unlink', glob( $path.$file.'/*.*' ) );
                }elseif(is_file($path.$file)){
                    unlink( $path . $file );
                }
            }
            return true;
        }
        return false;
    }
    public function close(){}
    public function _unset($name) {
        $this->rm($name);
    }
}