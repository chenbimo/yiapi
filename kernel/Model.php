<?php

declare(strict_types=1);

class Model implements I_Model {
    /**
     * 通用添加模型
     */
    public static function Ins(string $tableName, array $params) {
        $res = Db::Ins($tableName, $params);

        return $res;
    }

    /**
     * 通用删除模型
     */
    public static function Del(string $tableName, array $params) {
        $res = Db::Del($tableName, $params);

        return $res;
    }

    /**
     * 通用更新模型
     */
    public static function Upd(string $tableName, array $params) {
        $res = Db::Upd($tableName, $params);

        return $res;
    }

    /**
     * 通用查询模型
     */
    public static function Sel(string $tableName, array $params) {
        $res = Db::Sel($tableName, $params);

        return $res;
    }

    /**
     * 通用详情模型
     */
    public static function Detail() {
        return 'Api.Detail';
    }
}
