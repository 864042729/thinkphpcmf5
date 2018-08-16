<?php

$DB_HOST = 'localhost';
$DB_NAME = 'demo';
$DB_USER = 'sucaishui';
$DB_PWD = '123456';

$arr = array(
    'DB_TYPE' => 'mysql',
    'DB_HOST' => $DB_HOST,
    'DB_NAME' => $DB_NAME,
    'DB_USER' => $DB_USER,
    'DB_PWD' => $DB_PWD,
    'DB_PORT' => 3306,
    'DB_PREFIX' => '',
    'DB_CHARSET' => 'utf8',
    'MODULE_ALLOW_LIST' => array(
        'Home',
    ),
    'LOG_RECORD' => false, //日志开启
//    'TMPL_EXCEPTION_FILE' => './Application/Home/View/Public/404.html', //./Application/Home/View/Public/404.html
    'URL_MODEL' => 2,
    'SHOW_ERROR_MSG' => true, // 显示错误信息
    'LOAD_EXT_FILE' => 'common',
    'SHOW_PAGE_TRACE' => false,
    'SESSION_PREFIX' => 'sucaihuo.com',
    'privateKey' => '*&09aa%$_s@??kaola',
    'SESSION_AUTO_START' => true,
    'COOKIE_EXPIRE' => 3600 * 24 * 7, //cookie的生存时间
    'DEFAULT_FILTER' => 'htmlspecialchars,addslashes,trim',
);
if ($host == 'localhost') {
    unset($arr['TMPL_EXCEPTION_FILE']);
}
return $arr;
