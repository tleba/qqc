<?php
interface ICache
{
    public function get($name);
    
    public function set($name,$value,$expire=NULL);
    
    public function rm($name,$ttl=false);
    
    public function clear();
    
    public function close();
    
    public function _unset($name);
}
?>