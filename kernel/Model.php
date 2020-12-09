<?php

declare(strict_types=1);

class Model implements I_Model {
    // 表名
    public static $tableName = '';

    // 设置表名方法
    public static function SetTableName() {
        self::$tableName = '';
    }

    // 初始化
    public static function Init(): object {
        self::$tableName = static::SetTableName();
        if (DB::$pdo === null) {
            DB::Init();
        }

        return new static();
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
        $stmt = self::$db->prepare('SELECT * FROM ' . self::$tableName);
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
