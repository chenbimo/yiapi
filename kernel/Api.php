<?php

declare(strict_types=1);

class Api implements I_Api {
    // 默认初始化模型
    public static $model = null;

    // 构造函数
    public function __construct($model) {
        self::$model = 'M_' . $model;
    }

    // 通用添加接口
    public static function Ins() {
        $res = self::$model::init()->Ins();

        return $res;
    }

    // 通用删除接口
    public static function Del() {
        return 'Api.Del';
    }

    // 通用更新接口
    public static function Upd() {
        return 'Api.Upd';
    }

    // 通用查询接口
    public static function Sel() {
        $res = self::$model::init()->Sel();

        return $res;
    }

    // 通用详情接口
    public static function Detail() {
        return 'Api.Detail';
    }
}
