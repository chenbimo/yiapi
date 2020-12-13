<?php

namespace YiApi;

define('DS', DIRECTORY_SEPARATOR);
define('YI_ROOT', dirname(__FILE__) . DS . '..');
define('YI_VERSION', '1.0.0');

// 错误报告等级
error_reporting(E_ALL);
// 时区设置
date_default_timezone_set('Asia/Shanghai');

// 预加载 ----------------------------------

// 配置模块
require YI_ROOT . '/config/app.php';
require YI_ROOT . '/config/db.php';

// 接口模块
require YI_ROOT . '/kernel/Interface/I_Api.php';
require YI_ROOT . '/kernel/Interface/I_Model.php';
require YI_ROOT . '/kernel/Interface/I_Rule.php';

// 核心模块
require YI_ROOT . '/kernel/Tool.php';
require YI_ROOT . '/kernel/Db.php';
require YI_ROOT . '/kernel/Model.php';
require YI_ROOT . '/kernel/Api.php';
// require YI_ROOT . '/kernel/Rule.php';
require YI_ROOT . '/kernel/App.php';

spl_autoload_register(function ($class) {
    $apiPath = YI_ROOT . "/api/{$class}.php";
    $modelPath = YI_ROOT . "/model/{$class}.php";
    $rulePath = YI_ROOT . "/rule/{$class}.php";
    if (file_exists($apiPath)) {
        require $apiPath;
    }
    if (file_exists($modelPath)) {
        require $modelPath;
    }
    if (file_exists($rulePath)) {
        require $rulePath;
    }
});
