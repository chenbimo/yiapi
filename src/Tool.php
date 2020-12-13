<?php

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
        exit(0);
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

        foreach ($params as $key => $value) {
        }

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

    /**
     * 获取类型值
     *
     * @param [type] $var
     *
     * @return void
     */
    public static function GetTypeValue($var) {
    }

    /**
     * 规则检测函数
     *
     * @return void
     */
    public static function CheckRule(array $rules, array $params) {
        $newParams = [];
        $paramsKeys = array_keys($params);
        foreach ($rules as $ruleKey => $ruleValue) {
            // 判断参数完整性
            if (in_array($ruleKey, $paramsKeys, true) === false) {
                self::SetExceptionData('缺少' . $ruleKey, APP_CODE['rule_type_error']);
            }

            // 当前参数值
            $paramsValue = $params[$ruleKey];
            // 字符串
            if ($ruleValue['type'] === 'string') {
                // 如果为空且有默认值
                if (empty($paramsValue) && isset($ruleValue['default'])) {
                    $paramsValue = $ruleValue['default'];
                }
                if (gettype($paramsValue) !== 'string') {
                    self::SetExceptionData($ruleKey . ' 字段类型错误', APP_CODE['rule_type_error']);
                }
                if (mb_strlen($paramsValue, APP_CONFIG['encoding']) < $ruleValue['min']) {
                    self::SetExceptionData($ruleKey . ' 长度不能小于' . $ruleValue['min'], APP_CODE['rule_type_error']);
                }
                if (mb_strlen($paramsValue, APP_CONFIG['encoding']) > $ruleValue['max']) {
                    self::SetExceptionData($ruleKey . ' 长度不能大于' . $ruleValue['max'], APP_CODE['rule_type_error']);
                }
                if (isset($ruleValue['regexp']) && preg_match($ruleValue['regexp'], $paramsValue) !== 1) {
                    self::SetExceptionData($ruleKey . ' 正则匹配错误', APP_CODE['rule_type_error']);
                }
                $newParams[$ruleKey] = $paramsValue;

                continue;
            }
            // 整数判断
            if ($ruleValue['type'] === 'integer') {
                if (is_numeric($paramsValue) === false || ((string) (int) $paramsValue) !== $paramsValue) {
                    self::SetExceptionData($ruleKey . ' 字段类型错误', APP_CODE['rule_type_error']);
                }
                $paramsValue = (int) $paramsValue;

                if ($paramsValue < $ruleValue['min']) {
                    self::SetExceptionData($ruleKey . ' 不能小于' . $ruleValue['min'], APP_CODE['rule_type_error']);
                }
                if ($paramsValue < $ruleValue['max']) {
                    self::SetExceptionData($ruleKey . ' 不能大于' . $ruleValue['max'], APP_CODE['rule_type_error']);
                }
                $newParams[$ruleKey] = $paramsValue;

                continue;
            }
            // 布尔值
            if ($ruleValue['type'] === 'bool') {
                if (in_array($paramsValue, ['true', 'false'], true) === false) {
                    self::SetExceptionData($ruleKey . ' 字段类型错误', APP_CODE['rule_type_error']);
                }
                if ($paramsValue === 'true') {
                    $value = true;
                }
                if ($value === 'false') {
                    $value = false;
                }
                $newParams[$ruleKey] = $paramsValue;

                continue;
            }
            // 数组
            if ($ruleValue['type'] === 'array') {
                $newValue = implode(',', $value);
            }
            $newParams[$ruleKey] = $value;
        }

        return $newParams;
    }

    /**
     * 设置异常数据
     *
     * @return void
     */
    public static function SetExceptionData(string $msg, int $code): void {
        try {
            throw new Exception(
                $msg,
                $code,
            );
        } catch (Exception $e) {
            Tool::SetCode($e->getCode());
            Tool::SetMsg($e->getMessage());
            $data = [];
            if (APP_CONFIG['debug'] === true) {
                $data['file'] = $e->getFile();
                $data['line'] = $e->getLine();
                $data['trace'] = $e->getTrace();
            }

            self::Response($data);
        }
    }
}
