<?php

declare(strict_types=1);

class Api implements IApi {
    public static function Ins() {
        return 'Api.Ins';
    }

    public static function Del() {
        return 'Api.Del';
    }

    public static function Upd() {
        return 'Api.Upd';
    }

    public static function Sel() {
        return 'Api.Sel';
    }
}
