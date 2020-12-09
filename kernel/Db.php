<?php

declare(strict_types=1);

class Db {
    // 错误模式
    public static array $errmode = [
        'silent' => PDO::ERRMODE_SILENT,
        'warning' => PDO::ERRMODE_WARNING,
        'exception' => PDO::ERRMODE_EXCEPTION,
    ];

    /**
     * pdo 实例
     *
     * @var [type]
     */
    public static $pdo = null;

    /**
     * 预处理语句
     *
     * @var [type]
     */
    public static $sql = null;
    public static $stmt = null;

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
     * 查询函数，查询数据
     *
     * @return void
     */
    public static function Query(string $sql = '', array $params = []) {
        self::Init();
        self::$stmt = self::$pdo->prepare($sql);
        if (self::$stmt !== false) {
            self::$stmt->execute(array_values($params));
            $result = self::$stmt->fetchAll();

            return $result;
        }
    }

    /**
     * 执行函数，返回执行是否成功
     *
     * @return void
     */
    public static function Execute(string $sql, array $params) {
        self::Init();
        self::$stmt = self::$pdo->prepare($sql);
        if (self::$stmt !== false) {
            $result = self::$stmt->execute(array_values($params));
            $t0 = self::$stmt->errorCode();
            $t1 = self::$stmt->errorInfo();

            return $result;
        }
    }

    /**
     * 添加语句
     *
     * @return void
     */
    public static function Ins(string $tableName, array $params) {
        $sqlArray = [
            'INSERT INTO',
            $tableName,
            '(',
            implode(',', array_keys($params)),
            ')',
            'VALUES',
            '(',
            implode(',', array_fill(0, count($params, 1), '?')),
            ')',
        ];
        $sql = implode(' ', $sqlArray);
        $result = self::Execute($sql, $params);

        return $result;
    }

    /**
     * 删除语句
     *
     * @return void
     */
    public static function Del(string $tableName, array $params) {
        $where = [];
        foreach ($params as $key => $value) {
            array_push(
                $where,
                implode(
                    ' ',
                    [
                        $key,
                        ' = ',
                        Tool::GetSqlValue($value),
                    ]
                )
            );
        }
        $sqlArray = [
            'DELETE FROM',
            $tableName,
            'WHERE',
            implode(' && ', $where),
        ];
        $sql = implode(' ', $sqlArray);
        $result = self::Execute($sql, []);

        return $result;
    }

    /**
     * 更新语句
     *
     * @return void
     */
    public static function Upd(string $tableName, array $params) {
        $fields = [];
        $newParams = Tool::Exclude($params, ['whereKey', 'whereValue']);
        foreach ($newParams as $key => $value) {
            array_push(
                $fields,
                implode(
                    '',
                    [
                        $key,
                        ' = ',
                        Tool::GetSqlValue($value),
                    ]
                )
            );
        }
        $sqlArray = [
            'UPDATE',
            $tableName,
            'SET',
            implode(',', $fields),
            'WHERE',
            implode(' = ', [
                $params['whereKey'],
                Tool::GetSqlValue($params['whereValue']),
            ]),
        ];
        $sql = implode(' ', $sqlArray);
        $result = self::Execute($sql, []);

        return $result;
    }

    /**
     * 查询语句
     *
     * @return void
     */
    public static function Sel(string $tableName, array $params) {
        $sqlArray = [
            'SELECT',
            implode('') explode(',',$params['fields']) ,
            'FROM',
            $tableName,
            'WHERE',
            implode(' = ', [
                $params['whereKey'],
                Tool::GetSqlValue($params['whereValue']),
            ]),
            'LIMIT',
            implode(',', [
                Tool::GetSqlValue($params['page']),
                Tool::GetSqlValue($params['limit']),
            ]),
        ];
        $sql = implode(' ', $sqlArray);
        $result = self::Query($sql, []);

        return $result;
    }

    public static function Format(array $params) {
        foreach ($params as $key => $value) {
        }
    }
}
