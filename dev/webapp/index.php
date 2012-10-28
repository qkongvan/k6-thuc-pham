<?php
$login = 'rauvinh';
$pass = 'cowfcasnguwaj2610';

if((!isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_PW']!= $pass || !isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != $login)|| !$_SERVER['PHP_AUTH_USER'])
{
    header('WWW-Authenticate: Basic realm="Rau Sach Thanh Pho Vinh"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8" /></head><body>Tên hoặc mật khẩu sai!</body></html>';
    exit;
}

// change the following paths if necessary
$yii=dirname(__FILE__).'/../frameworks/yii/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
