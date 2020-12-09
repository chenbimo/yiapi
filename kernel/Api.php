<?php

declare(strict_types=1);

class Api implements I_Api {
    // 默认初始化模型
    public static string $tableName = '';

    // 构造函数
    public function __construct() {
        self::$tableName = static::$tableName ?? '';
    }

    // 通用添加接口
    public static function Ins() {
        $res = UserModel::Ins(self::$tableName, Tool::GetParams());

        return $res;
    }

    // 通用删除接口
    public static function Del() {
        $res = UserModel::Del(self::$tableName, Tool::GetParams());

        return $res;
    }

    // 通用更新接口
    public static function Upd() {
        $res = UserModel::Upd(self::$tableName, Tool::GetParams());

        return  $res;
    }

    // 通用查询接口
    public static function Sel() {
        $res = UserModel::Sel(self::$tableName, Tool::GetParams());

        return $res;
    }

    // 通用详情接口
    public static function Detail() {
        return 'Api.Detail';
    }
}
