<?php

declare(strict_types=1);

class App {
    /**
     * 应用初始化
     *
     * @return void
     */
    public static function Init() {
        if (!isset($_SERVER['PATH_INFO'])) {
            $pathinfo = ['Site', 'Index'];
        } else {
            $pathinfo = explode('/', substr($_SERVER['PATH_INFO'], 1));
        }
        if (is_array($pathinfo) && sizeof($pathinfo, 1) === 2) {
            $Class = ucfirst($pathinfo[0]);
            $Method = ucfirst($pathinfo[1]);
            if (class_exists($Class, true)) {
                $Api = new $Class();
                if (method_exists($Api, $Method)) {
                    $Result = $Api->{$Method}();
                    Tool::Response($Result);
                } else {
                    Tool::SetCode(1);
                    Tool::SetMsg($Method . '方法不存在');
                    Tool::Response();
                }
            } else {
                Tool::SetCode(1);
                Tool::SetMsg($Class . '类不存在');
                Tool::Response();
            }
        } else {
            Tool::SetCode(1);
            Tool::SetMsg('参数错误');
            Tool::Response();
        }
    }
}
