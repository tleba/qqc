<?php
function smarty_function_surl($params, &$smarty){
    if (is_array($params)) {
        return '/' . $params['dir'] . '/' . $params['val'] .'/' . $params['file'];
    }
    return '';
}