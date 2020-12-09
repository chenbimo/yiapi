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

    public static function GetParams(): array {
        $params = empty($_POST) ? $_GET : $_POST;

        return $params;
    }

    /**
     * 排除数组中的某些参数
     *
     * @return array
     */
    public static function Exclude(array $params, array $exclude): array {
        $newParams = [];
        foreach ($params as $key => $value) {
            if (!in_array($key, $exclude, true)) {
                $newParams[$key] = $value;
            }
        }

        return $newParams;
    }

    /**
     * 获取类型值
     *
     * @param mixin $var
     *
     * @return void
     */
    public static function GetSqlValue($var) {
        if (preg_match('/^[0-9]+$/', $var) > 0) {
            return intval($var);
        } else {
            return "'" . $var . "'";
        }
    }
}
