<?php


class Api implements I_Api {
    // 默认初始化模型
    public static object $Model;
    public static object $Rule;

    // 构造函数
    public function __construct($Class) {
        $M = $Class . 'Model';
        $R = $Class . 'Rule';
        self::$Model = new $M();
        self::$Rule = new $R();
    }

    // 通用添加接口
    public function Ins() {
        $rules = self::$Rule->Ins();
        $params = Tool::GetParams();
        // 检查规则
        Tool::CheckRule($rules, $params);
        $res = self::$Model->Ins($params);

        return $res;
    }

    // 通用删除接口
    public function Del() {
        $res = self::$Model->Del(Tool::GetParams());

        return $res;
    }

    // 通用更新接口
    public function Upd() {
        $res = self::$Model->Upd(Tool::GetParams());

        return  $res;
    }

    // 通用查询接口
    public function Sel() {
        $res = self::$Model->Sel(Tool::GetParams());

        return $res;
    }

    // 通用详情接口
    public function Detail() {
        return 'Api.Detail';
    }
}
