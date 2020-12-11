<?php


error_reporting(E_ALL);
define('DS', DIRECTORY_SEPARATOR);
define('YI_ROOT', dirname(__FILE__) . DS . '..');
define('YI_VERSION', '1.0.0');
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
    require YI_ROOT . "/api/{$class}.php";
    require YI_ROOT . "/model/{$class}.php";
    require YI_ROOT . "/rule/{$class}.php";
});
