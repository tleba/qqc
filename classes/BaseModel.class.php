<?php
class BaseModel
{
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