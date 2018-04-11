<?php
require $config['BASE_DIR'].'/classes/BaseModel.class.php';
class Signup extends BaseModel
{
    static $errMsgs = array(
      '传入的数据为空',
      '包含(%s)项项数少于5',
      '用户名(%s)包含重复项',
      '邮箱地址(%s)包含重复项',
      '邮箱地址(%s)格式不正确',
      '用户名(%s)已被注册',
      '邮箱地址(%s)已被使用',
      '批量插入数据失败',
    );
    /**
     * 批量注册逻辑
     * @param array $mix
     * @$mix = array(array('value'...)...)格式
     */
    public static function register($mix = array()){
        $totalCount = count($mix);
        if (!is_array($mix) || $totalCount <= 0) {
            return self::$errMsgs[0];
        }
        //每次最多50条件操作
        $maxCount = 50;
        //需要多少次，次数少于1，重新设置最低1次
        $counts = ceil($totalCount / $maxCount);
        if ($counts < 1) {
            $counts = 1;
        }
        //存储已经存在的用户名
        $usernames = array();
        //存储批量插入的数组
        $batchArr = array();
        $batchOne = array('username'=>'','pwd'=>'','email'=>'','gender'=>'','addtime'=>'');
        
        //所有的用户名或邮箱
        $allNames = array();
        $allEmails = array();
        //分批次进行处理
        for($i = 1;$i <= $counts;$i++){
           //从数据中取出一段数据 
           $offest =  ( $i - 1 ) * $maxCount;
           $carr =  array_slice($mix, $offest,$maxCount);
           //存储用户名
           $names = array();
           //存储多个邮箱地址
           $emails = array();
           //取出用用户名
           foreach ($carr as $v) {
               //检查每项用户项不能少于5项
               if(count($v) < 5){
                    return sprintf(self::$errMsgs[1],implode(',', $v));
               }
               list($username,$pwd,$email,$gender,$addtime) = $v;
               //查找是否有相同的用户名，整批次验证或单批次验证
               if (in_array($username, $names) || in_array($username, $allNames)) {
                   return sprintf(self::$errMsgs[2],$username);
               }
               //查找是否有相同的eamil，整批次验证或单批次验证
               if (in_array($email, $emails) || in_array($email, $allEmails)) {
                   return sprintf(self::$errMsgs[3],$email);
               }
               if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                   return sprintf(self::$errMsgs[4],$email);
               }
               $names[] = $username;
               $emails[] = $email;

               $batchOne['username'] = $username;
               $batchOne['pwd'] = md5($pwd);
               $batchOne['email'] = $email;
               $batchOne['gender'] = ($gender == 'Female') ? 'Female':'Male';
               $batchOne['addtime'] = time();
               $batchArr[] = $batchOne;
           }
           //将取出的用户名进行检查
           $result = self::checkExist($names,'username');
           //检查到已经注册的用户就直接返回
           if ($result) {
               return sprintf(self::$errMsgs[5],implode(',', $result));
           }
           //取出的邮箱地址检查
           $result = self::checkExist($emails,'email');
           //检查到已经注册的邮箱就直接返回
           if ($result) {
               return sprintf(self::$errMsgs[6],implode(',', $result));
           }
           $allNames = array_merge($allNames,$names);
           $allEmails = array_merge($allEmails,$emails);
        }
        //批量插入数据
        if(!self::batchInsert($batchArr))
            return self::$errMsgs[7];
        return true;
    }

    /**
     * 检查是否已经存在
     * @param array $mix = array('a','b')
     * @param string $fields 字符串
     */
    public static function checkExist($mix=array(),$fields=''){
        if (!is_array($mix) || count($mix) <= 0) {
            return false;
        }
        if (empty($fields))
            return false;
        global $conn;
        $vals = array();
        foreach ($mix as $v) {
            $v = mysql_real_escape_string($v);
            $vals[] = sprintf("unhex('%s')",bin2hex($v));
        }
        $sql = 'SELECT '.$fields.' FROM signup WHERE '.$fields.' IN ('.implode(',',$vals).') ORDER BY UID ASC';
        $rs = $conn->execute($sql);
        unset($mix);
        unset($vals);
        if($rs && $conn->Affected_Rows()>0){
            $rows = $rs->getrows();
            $result = array();
            foreach ($rows as $k => $v) {
                if (!in_array($v, $result)) {
                    $result[] = $v[$fields];
                }
            }
            unset($rows);
            return $result;
        }
        return false;
    }
    /**
     * 批量插入数据
     * @param array $mix
     * @$mix = array(array('key'=>'value'...)...)格式
     */
    public static function batchInsert($mix = array()){
        if (!is_array($mix) || count($mix) <= 0) {
            return false;
        }
        global $conn;
        $keys = array();
        $valsArr = array();
        foreach ($mix as $sm) {
            if (!is_array($sm)) {
                continue;
            }
            $vals = array();
            foreach ($sm as $k => $v) {
                if (!in_array($k, $keys)) {
                    $keys[] = $k;
                }
                $v = mysql_real_escape_string($v);
                $vals[] = sprintf("unhex('%s')",bin2hex($v));
            }
            $valsArr[] = '('.implode(',', $vals).')';
        }
       $sql = 'INSERT INTO signup ('.implode(',', $keys).') VALUES '.implode(',', $valsArr);
       $rs = $conn->execute($sql);
       unset($mix);
       unset($keys);
       unset($valsArr);
       if($rs && $conn->Affected_Rows()>0){
           return true;
       }
       return false;
    }
    public static function get($uid) {
        global $conn;
        $uid = round($uid);
        $sql = 'SELECT years,otime FROM signup WHERE UID = '.$uid.' LIMIT 1;';
        $rs = $conn->execute($sql);
        if($rs && $conn->Affected_Rows()>0){
            return array(
                'years'=>$rs->fields['years'],
                'otime'=>$rs->fields['otime']
            );
        }
        return false;
    }
    public static function update($mix=array(),$where=array()){
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
        $sql = 'UPDATE signup SET '.implode(',', $kvs).$jwhere;
        unset($where);
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return true;
        }
        return false;
    }
}
?>