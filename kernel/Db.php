<?php

declare(strict_types=1);

class Db {
    public static function init() {
        // 数据库连接器拼接 [准备只支持 mysql 和 sqlite]
        $dsn = DB_CONFIG['type'] . ':host=' . DB_CONFIG['host'] . ';dbname=' . DB_CONFIG['dbname'];
        $pdo = new PDO($dsn, DB_CONFIG['username'], DB_CONFIG['password']);

        // 取消数字强制转换为字符串
        $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // 将null转换为空字符串
        $pdo->setAttribute(PDO::NULL_TO_STRING, true);
        // 默认提取模式
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // 设置字符集
        $pdo->exec('SET NAMES ' . DB_CONFIG['charset']);

        return $pdo;
    }
}
