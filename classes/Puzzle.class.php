<?php
class Puzzle{
    private static function getPics($cache,$basedir){
        $picKey = 'pics';
        $pics = $cache->get($picKey);
        //通过memcached加锁，防止多线程同时进入读取
        $pickeylock = 'imageslock';
        $result = array('pic'=>'','picname'=>'');
        //如果缓存不存在或失效，去相关的目录下获取图片文件
        if (!$pics) {
            //检查是否有锁
            $lock = $cache->get($pickeylock);
            if($lock)
                return $result;
            //没有锁就添加锁
            $cache->set($pickeylock,1,0);
            //获取图片数组
            $picPath = $basedir.'/images/picture/';
            $pics = glob($picPath.'*.jpg',GLOB_NOSORT);
            //如果成功获取
            if (is_array($pics)) {
                foreach ($pics as &$v) {
                    $v = str_replace($picPath, '', $v);
                    //$v = iconv('gbk', 'utf-8', $v);
                }
                $cache->set($picKey,$pics,3600);
                //顺利查询移除锁
                $cache->rm($pickeylock);
            }
        }
        return $pics;
    }
    public static function getPic($cache,$usedPic=array(),$basedir=''){
        $pics = self::getPics($cache, $basedir);
        //随机获取图片
        $pic = '';
        $picname = '';
        if (is_array($pics)) {
            foreach ($pics as $k => $v) {
                if (in_array($v, $usedPic)) {
                    unset($pics[$k]);
                }
            }
            sort($pics);
            $picIndex = array_rand($pics,1);
            $pic = $pics[$picIndex];
            $picname = preg_replace('/\d+/i', '',str_replace('.jpg', '', $pic));
            $result['picindex'] = $picIndex;
            $result['pic'] = $pic;
            $result['picname'] = $picname;
        }
        return $result;
    }
    public static function getPuzzleTotal($where=array()){
        global $conn;
        $jwhere = self::joinWhere($where);
        if ($jwhere)
            $jwhere = ' WHERE '.$jwhere;
        else
            $jwhere = ' ';
        $sql = 'SELECT COUNT(id) AS total FROM puzzle'.$jwhere.' LIMIT 1';
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return (int)$rs->fields['total'];
        }
        return 0;
    }
    public static function getAll($where = array(),$pageindex=0,$pagesize=20,$order=''){
        global $conn;
        $jwhere = self::joinWhere($where);
        if ($jwhere)
            $jwhere = ' WHERE '.$jwhere;
        else 
            $jwhere = ' ';
        if (!empty($order)) {
            $order = ' ORDER BY '.$order;
        }
        $sql = 'SELECT id,uid,gid,title,moves,seconds,status,playtime,stime,etime,pindex,diff FROM puzzle'.$jwhere.$order.' LIMIT '.$pageindex.','.$pagesize;
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
              return $rs->getrows();
        }
        return false;
    }
    public static function getCount($uid){
        global $conn;
        $uid = round($uid);
        $sql = 'SELECT SUM(moves) AS movesTotal,SUM(seconds) AS secondsTotal,COUNT(uid) as nums FROM puzzle WHERE status = 1 AND uid = '.$uid.' LIMIT 1;';
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return array(
              'movesTotal'=>$rs->fields['movesTotal'],
              'secondsTotal'=>$rs->fields['secondsTotal'],
              'nums'=>$rs->fields['nums']
            );
        }
        return false;
    }
    public static function get($uid,$gid,$pindex,$playtime=0){
        global $conn;
        $uid = mysql_real_escape_string($uid);
        $gid = mysql_real_escape_string($gid);
        $pindex = mysql_real_escape_string($pindex);
        $sql = "SELECT id,uid,gid,title,moves,seconds,status,playtime,stime,etime,pindex,diff FROM puzzle WHERE uid = '{$uid}' AND gid = '{$gid}' AND pindex = '{$pindex}' AND playtime = '$playtime' LIMIT 1;";
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return array(
              'id'=>$rs->fields['id'],
              'uid'=>$rs->fields['uid'],
              'gid'=>$rs->fields['gid'],
              'title'=>$rs->fields['title'],
              'moves'=>$rs->fields['moves'],
              'seconds'=>$rs->fields['seconds'],
              'status'=>$rs->fields['status'],
              'playtime'=>$rs->fields['playtime'],
              'stime'=>$rs->fields['stime'],
              'etime'=>$rs->fields['etime'],
              'pindex'=>$rs->fields['pindex'],
              'diff'=>$rs->fields['diff'],
            );
        }
        return false;
    }
    public static function getLevel($playtime,$uid){
        global $conn;
        $playtime = mysql_real_escape_string($playtime);
        $uid = mysql_real_escape_string($uid);
        $sql = "SELECT playtime,uid,completes,level FROM puzzle_level WHERE playtime = '{$playtime}' AND uid = '{$uid}' LIMIT 1;";
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return array(
              'playtime'=>$rs->fields['playtime'],
              'uid'=>$rs->fields['uid'],
              'completes'=>$rs->fields['completes'],
              'level'=>$rs->fields['level']
            );
        }
        return false;
    }
    public static function getLevels($where=array()){
        global $conn;
        $jwhere = self::joinWhere($where);
        if ($jwhere)
            $jwhere = ' WHERE '.$jwhere;
        else
            $jwhere = ' ';
        $sql = 'SELECT playtime,completes,level,username FROM puzzle_level '.$jwhere.' ORDER BY playtime ASC';
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            $rows = $rs->getrows();
            $arr = array();
            foreach ($rows as $key => $value) {
                $arr[$key]['playtime'] = date('Y-m-d',$value['playtime']);
                $arr[$key]['completes'] = $value['completes'];
                $arr[$key]['level'] = $value['level'];
                $arr[$key]['username'] =$value['username'];
            }
            unset($rows);
            return $arr;
        }
        return false;
    }
    public static function getChuangGuanCount(){
        global $conn;
        $sql = 'select playtime,uid,completes,level,username from puzzle_level where level > 0 group by uid;';
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return $conn->Affected_Rows();
        }
        return 0;
    }
    public static function getRank($uid){
        global $conn;
        $uid = mysql_real_escape_string($uid);
        $sql = "SELECT uid,moves,seconds,finishpics,utime FROM puzzle_rank WHERE uid = '{$uid}' LIMIT 1;";
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return array(
                'uid'=>$rs->fields['uid'],
                'moves'=>$rs->fields['moves'],
                'seconds'=>$rs->fields['seconds'],
                'finishpics'=>$rs->fields['finishpics'],
                'utime'=>$rs->fields['utime'],
            );
        }
        return false;
    }
    public static function getIpRank($ip){
        global $conn;
        $uid = mysql_real_escape_string($uid);
        $sql = "SELECT uid,moves,seconds,finishpics,utime FROM puzzle_rank WHERE ip = '{$ip}' LIMIT 1;";
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return array(
                'uid'=>$rs->fields['uid'],
                'moves'=>$rs->fields['moves'],
                'seconds'=>$rs->fields['seconds'],
                'finishpics'=>$rs->fields['finishpics'],
                'utime'=>$rs->fields['utime'],
            );
        }
        return false;
    }
    public static function add($tablename, $mix = array()) {
        if (!is_array($mix)) {
            return false;
        }
        global $conn;
        $fields = array();
        $values = array();
        foreach ($mix as $k => $v) {
            $fields[] = $k;
            if (is_numeric($v)) {
                $v = intval($v);
                $values[] = $v;
            }else{
                $v = mysql_real_escape_string($v);
                $values[] = sprintf("unhex('%s')",bin2hex($v));
            }
        }
        unset($mix);
        $fcount = count($fields);
        $vcount = count($values);
        if ($fcount > 0 && $vcount > 0 && $fcount === $vcount) {
            $sql = 'INSERT INTO '.$tablename.' ('.implode(',', $fields).') VALUES ('.implode(',', $values).')';
            unset($fields);
            unset($values);
            $rs = $conn->execute($sql);
            if ($rs && $conn->Affected_Rows() > 0) {
                return true;
            }
        }
        return false;
    }
    
    public static function update($tablename,$mix = array(),$where=array()) {
        if (!is_array($mix)) {
            return false;
        }
        if (!is_array($where)) {
            return false;
        }
        global $conn;
        $kvs = array();
        foreach ($mix as $k => $v) {
            if (is_numeric($v)) {
                $v = intval($v);
                $kvs[] = "{$k}={$v}";
            }else{
                $v = mysql_real_escape_string($v);
                $v = bin2hex($v);
                $kvs[] = "{$k} = unhex('{$v}')";
            }
        }
        unset($mix);
        $jwhere = self::joinWhere($where);
        if ($jwhere)
            $jwhere = ' WHERE '.$jwhere;
        else 
            $jwhere = '';
        $sql = 'UPDATE '.$tablename.' SET '.implode(',', $kvs).$jwhere;
        unset($where);
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return true;
        }
        return false;
    }

    public static function getUserRank($uid){
        global $conn;
        $uid = round($uid);
        $sql = 'SET @urank=0;';
        $rs = $conn->execute($sql);
        $sql = 'SELECT p.* FROM(SELECT uid,(@urank:=@urank+1) AS urank FROM puzzle_rank ORDER BY finishpics DESC,moves,seconds asc) as p WHERE uid ='.$uid.' LIMIT 1;';
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return array(
                'uid'=>$rs->fields['uid'],
                'rank'=>$rs->fields['urank']
            );
        }
        return false;
    } 
    
    public static function getUserRanks($cache){
        $key = 'urank';
        $userRanks = $cache->get($key);
        if ($userRanks) {
            return $userRanks;
        }
        $lockkey = 'lock';
        $lockCache = $cache->get($lockkey);
        if (!$lockCache) {
            $rows = self::selectUserRanks(array(),0,10);
            $cache->rm($lockkey);
            if ($rows) {
                $cache->set($key,$rows,300);
                return $rows;
            }
        }
        return false;
    }
    public static function selectUserRanksTotal($where=array()){
        global $conn;
        $jwhere = self::joinWhere($where);
        if ($jwhere)
            $jwhere = ' WHERE '.$jwhere;
        else
            $jwhere = ' ';
        $sql = 'SELECT COUNT(uid) AS total FROM puzzle_rank'.$jwhere.' LIMIT 1';
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return (int)$rs->fields['total'];
        }
        return 0;
    }
    public static function selectUserRanks($where=array(),$pageindex=0,$pagesize=20){
        global $conn;
        $jwhere = self::joinWhere($where);
        if ($jwhere)
            $jwhere = ' WHERE '.$jwhere;
        else
            $jwhere = ' ';
        $sql = 'SET @urank=0;';
        $rs = $conn->execute($sql);
        $sql = 'SELECT p.* FROM(SELECT uid,moves,seconds,finishpics,username,utime,(@urank:=@urank+1) AS urank FROM puzzle_rank ORDER BY finishpics DESC,moves,seconds asc) as p '.$jwhere.' ORDER BY P.urank ASC LIMIT '.$pageindex.','.$pagesize;
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return $rs->getrows();
        }
        return false;
    } 
    public static function joinWhere($mix=array()){
        if (!is_array($mix) || count($mix) <= 0) {
            return false;
        }
        $count = count($mix);
        $joins = array();
        $i = 1;
        $l = ' AND ';
        foreach ($mix as $key => $value) {
            if (is_array($key)) {
                return false;
            }
            if (is_array($value)) {
                list($o,$v,$l) = $value;
                $l = strtolower($l);
                $l = ($l ==='or') ? ' OR ':' AND ';
                if (is_array($v)) {
                    foreach ($v as &$sval) {
                        if (is_numeric($sval)) {
                            $sval = intval($sval);
                        }else{
                            $sval = mysql_real_escape_string($sval);
                            $sval = sprintf("unhex('%s')",bin2hex($sval));
                        }
                    }
                    $v = implode(',', $v);
                }else{
                    $v = mysql_real_escape_string($v);
                }
                switch ($o){
                    case 'like':
                        $joins[] = "{$key} like '%{$v}%'";
                        break;
                    case 'in':
                        $joins[] = "{$key} in ({$v})";
                        break;
                    default:
                        $joins[] = "{$key} = '{$v}'";
                        break;
                }
            }else{
                if (is_numeric($value)) {
                    $value = intval($value);
                    $joins[] = "{$key} = {$value}";
                }else{
                    $value = mysql_real_escape_string($value);
                    $formatValue = "{$key} = unhex('%s')";
                    $joins[] = sprintf($formatValue,bin2hex($value));
                }
            }
            if ($count > $i) {
                $joins[] = $l;
            }
            $i++;
        }
        return implode(' ', $joins);
    } 
}
?>