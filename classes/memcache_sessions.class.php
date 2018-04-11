<?php
defined('_VALID') or die('Restricted Access!');
require_once 'Cache.class.php';
class memcache_sessions{
    private static $_cache;
    public static function open(){
        global $config;
        $options = array(
            'host'=>$config['mem_host'],
            'port'=>$config['mem_port'],
            'prefix'=>'ses',
            'expire'=>0,
            'length'=>0
        );
        self::$_cache = Cache::getInstance('MemcacheAction',$options);
        return self::$_cache;
    }
    public static function close() {
        self::$_cache->close();
    }
    public static function read($session_id) {
        return self::$_cache->get($session_id);
    }
    public static function write($session_id, $session_data) {
        return self::$_cache->set($session_id,$session_data);
    }
    public static function destroy($session_id){
        return self::$_cache->rm($session_id);
    }
    public static function gc($max){
        
    }
}

?>