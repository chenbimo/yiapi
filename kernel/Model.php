<?php

declare(strict_types=1);

class Model implements I_Model {
    public static string $tableName = '';

    public function __construct() {
        self::$tableName = static::$tableName;
    }

    /**
     * 通用添加模型
     */
    public function Ins(array $params) {
        $res = Db::Ins(self::$tableName, $params);

        return $res;
    }

    /**
     * 通用删除模型
     */
    public function Del(array $params) {
        $res = Db::Del(self::$tableName, $params);

        return $res;
    }

    /**
     * 通用更新模型
     */
    public function Upd(array $params) {
        $res = Db::Upd(self::$tableName, $params);

        return $res;
    }

    /**
     * 通用查询模型
     */
    public function Sel(array $params) {
        $res = Db::Sel(self::$tableName, $params);

        return $res;
    }

    /**
     * 通用详情模型
     */
    public function Detail() {
        return 'Api.Detail';
    }
}
