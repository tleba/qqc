<?php
class TuiGuang{

    function write_tuiguang_cache($dir,$baseName='/tuiguang.txt',$data) {
        if(!$dir||!$baseName) return false;
        $fileName = $dir.$baseName;
        if(!$data['min_sebi']) $data['min_sebi'] = 1;
        $cont = json_encode($data);
        if (!file_exists($dir)) {
            mkdir($dir,755,true);
        }
        file_put_contents($fileName,$cont);
    }

    public static function selectUserRanksTotal($where=array()){
        global $conn;
        $jwhere = self::joinWhere($where);
        if ($jwhere) $jwhere = ' WHERE '.$jwhere;
        else $jwhere = ' ';
        $sql =  "SELECT count(DISTINCT `day`) total FROM user_award WHERE type=1  LIMIT 1";
        $rs = $conn->execute($sql);
        if ($rs && $conn->Affected_Rows() > 0) {
            return (int)$rs->fields['total'];
        }
        return 0;
    }

    public static function selectUserRanks($where=array(),$pageindex=0,$pagesize=20){
        global $conn;
        $jwhere = self::joinWhere($where);
        if ($jwhere) $jwhere = ' WHERE '.$jwhere;
        else $jwhere = ' ';
        $sql = "SELECT
                sum(award) totSeb,
                `day`,
                (
                    SELECT
                        count(DISTINCT uid) totUid
                    FROM
                        `user_award` t2
                    WHERE
                        t2.type = 1
                    AND t2.`day` = t1.`day`
                ) totUid,
                (
                    SELECT
                        count(*) AS totIp
                    FROM
                        `user_tuiguang` t3
                    WHERE
                        t3.`condition` = 2
                    AND t3.`day` = t1.`day`
                ) AS totIp
            FROM
                user_award t1
            WHERE
                type = 1
            GROUP BY
                DAY LIMIT $pageindex,$pagesize
            ";
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