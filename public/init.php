<?php

declare(strict_types=1);
error_reporting(E_ALL);
define('DS', DIRECTORY_SEPARATOR);
define('YI_ROOT', dirname(__FILE__) . DS . '..');
// 时区设置
date_default_timezone_set('Asia/Shanghai');

// 预加载 ----------------------------------
require YI_ROOT . '/config/db.php';

// 核心模块
require YI_ROOT . '/kernel/Db.php';
require YI_ROOT . '/kernel/Api.php';

// 自动加载类
spl_autoload_register(function ($class) {
    require YI_ROOT . "/api/{$class}.php";
    require YI_ROOT . "/model/{$class}.php";
});
