<?php

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
                $Api = new $Class($Class);
                if (method_exists($Api, $Method)) {
                    $Result = $Api->{$Method}();
                    Tool::Response($Result);
                } else {
                    Tool::SetExceptionData($Method . '方法不存在', APP_CODE['method_is_not_exists']);
                }
            } else {
                Tool::SetExceptionData($Method . '类不存在', APP_CODE['class_is_not_exists']);
            }
        } else {
            Tool::SetExceptionData(implode('/', $pathinfo) . '命令不存在', APP_CODE['command_is_not_exists']);
        }
    }
}
