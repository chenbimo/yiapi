<?php

namespace App;

/**
 * 获取请求参数
 */
function getParams(array $methodRules): array {
    $rules = \PhalApi\DI()->config->get('rules', []);
    foreach ($methodRules as $methodKey => &$methodValue) {
        $rule = $rules[$methodKey] ?? [];
        $methodValue = array_merge($rule, $methodValue);
    }

    return $methodRules;
}

/**
 * 获取生成令牌
 */
function getToken(): string {
    return  strtoupper(substr(sha1(uniqid(null, true)) . sha1(uniqid(null, true)), 0, 64));
}

// 参数过滤，只更新局部字段
function filterParams(array $params): array {
    $newParams = [];
    foreach ($params as $key => $value) {
        if (null !== $value) {
            $newParams[$key] = $value;
        }
    }

    return $newParams;
}
/**
 * 获取sql字段
 */
function getFields(array $params, string $aliasA = null, string $aliasB = null, array $paramsB = null): string {
    if (null === $aliasA) {
        foreach ($params as &$v) {
            $v = "`{$v}`";
        }
        // return implode(',', $params);
    } else {
        foreach ($params as &$v) {
            $v = "{$aliasA}.`{$v}`";
        }
    }
    if (null === $aliasB) {
        return implode(',', $params);
    }
    foreach ($paramsB as &$v) {
        $v = "{$aliasB}.`{$v}`";
    }

    return implode(',', $params) . ',' . implode(',', $paramsB);
}

/**
 * 密码加密
 */
function encryptPassword(string $password, string $salt): string {
    return md5(md5(\PhalApi\DI()->config->get('app.password.salt')) . md5($password) . sha1($salt));
}

function encodeString(string $strs): string {
    // return addslashes(htmlspecialchars($strs, ENT_NOQUOTES));
    return htmlspecialchars($strs, ENT_QUOTES);
}

// function decodeString(string $strs){
//     return
// }
