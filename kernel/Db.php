<?php

declare(strict_types=1);

class Db {
    // 错误模式
    public static array $errmode = [
        'silent' => PDO::ERRMODE_SILENT,
        'warning' => PDO::ERRMODE_WARNING,
        'exception' => PDO::ERRMODE_EXCEPTION,
    ];

    public static $pdo = null;

    // 初始化连接
    public static function Init() {
        try {
            if (self::$pdo === null) {
                // 数据库连接器拼接 [准备只支持 mysql 和 sqlite]
                $dsn = DB_CONFIG['type'] . ':host=' . DB_CONFIG['host'] . ';dbname=' . DB_CONFIG['dbname'];
                self::$pdo = new PDO($dsn, DB_CONFIG['username'], DB_CONFIG['password']);

                // 取消数字强制转换为字符串
                self::$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
                self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                // 将null转换为空字符串
                self::$pdo->setAttribute(PDO::NULL_TO_STRING, true);
                // 默认提取模式
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                // 设置错误模式
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, self::$errmode[APP_CONFIG['pdo_error_mode']]);
                // 设置字符集
                self::$pdo->exec('SET NAMES ' . DB_CONFIG['charset']);
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }

    /**
     * 准备语句
     *
     * @return void
     */
    public function Prepare(string $sql, array $params): ?PDOStatement {
        $stmt = self::$pdo->prepare($sql);
        foreach ($params as $key => $value) {
            if (gettype($value) === 'integer') {
                $stmt->bindParams(":{$key}", $value, PDO::PARAM_INT);
            }
            if (gettype($value) === 'string') {
                $stmt->bindParams(":{$key}", $value, PDO::PARAM_STR);
            }
            if (gettype($value) === 'boolean') {
                $stmt->bindParams(":{$key}", $value, PDO::PARAM_BOOL);
            }
        }
        if ($stmt === false) {
            return null;
        } else {
            return $stmt;
        }
    }
}
