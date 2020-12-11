<?php

define('APP_CONFIG', [
    // 是否开启 debug 模式
    'debug' => true,
    /*
     * pdo 错误模式设置
     * -------------------
     * silent 无警告，无异常
     * warning 显示警告
     * exception 抛出异常
     */
    'pdo_error_mode' => 'exception',
]);

// APP 返回码代号
define('APP_CODE', [
    // 成功
    'success' => 0,
    // 未登录
    'no_login' => 1,
    // 无字段规则
    'no_field_rule' => 2,
    // 规则类型错误
    'rule_type_error' => 3,
    // 方法不存在
    'method_is_not_exists' => 4,
    // 类不存在
    'class_is_not_exists' => 5,
    // 命令不存在
    'command_is_not_exists' => 6,
]);
