<?php

declare(strict_types=1);

class Api implements I_Api {
    // 默认初始化模型
    public static $Model = null;

    // 构造函数
    public function __construct($model) {
        if (self::$Model === null) {
            self::$Model = 'M_' . $model;
        }
    }

    // 通用添加接口
    public static function Ins() {
        $res = self::$Model::Ins();

        return $res;
    }

    // 通用删除接口
    public static function Del() {
        $res = self::$Model::Del();

        return 'Api.Del';
    }

    // 通用更新接口
    public static function Upd() {
        return 'Api.Upd';
    }

    // 通用查询接口
    public static function Sel() {
        $res = self::$Model::Sel();

        return $res;
    }

    // 通用详情接口
    public static function Detail() {
        return 'Api.Detail';
    }
}
