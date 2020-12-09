<?php

declare(strict_types=1);

class Tool {
    public static int $code = 0;
    public static string $msg = '操作成功';

    /**
     * 返回操作值
     *
     * @param string $data
     * @param string $defaultValue
     *
     * @return void
     */
    public static function Response($data = '', $defaultValue = ''): void {
        echo json_encode([
            'code' => self::$code,
            'msg' => self::$msg,
            'data' => $data ?? $defaultValue,
        ]);
    }

    /**
     * 设置状态码
     */
    public static function SetCode(int $code): void {
        self::$code = $code;
    }

    /**
     * 设置消息码
     *
     * @return void
     */
    public static function SetMsg(string $msg): void {
        self::$msg = $msg;
    }
}
