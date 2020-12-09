<?php

declare(strict_types=1);

class Model implements I_Model {
    // 数据库实例
    public static $db = null;
    // 表名
    public static $tableName = '';

    // 设置表名方法
    public static function tableName() {
        self::$tableName = '';
    }

    // 初始化
    public static function init(): object {
        self::$tableName = static::tableName();
        if (self::$db === null) {
            self::$db = DB::init();
        }

        return new static();
    }

    /**
     * 准备语句
     *
     * @return void
     */
    public function Prepare(string $sql, array $params): ?PDOStatement {
        $stmt = self::$db->prepare($sql);
        if ($stmt === false) {
            return null;
        } else {
            return $stmt;
        }
    }

    /**
     * 通用添加模型
     *
     * @return void
     */
    public function Ins() {
        return 'Api.Ins';
    }

    /**
     * 通用删除模型
     *
     * @return void
     */
    public function Del() {
        return 'Api.Del';
    }

    /**
     * 通用更新模型
     *
     * @return void
     */
    public function Upd() {
        return 'Api.Upd';
    }

    /**
     * 通用查询模型
     *
     * @return void
     */
    public function Sel(): array {
        $stmt = self::$db->prepare('SELECT * FROM ' . self::$tableName . 'd');
        if ($stmt === false) {
        }
        $res = $stmt->fetchAll();

        return $res;
    }

    /**
     * 通用详情模型
     *
     * @return void
     */
    public function Detail() {
        return 'Api.Detail';
    }
}
