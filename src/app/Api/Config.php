<?php

namespace App\Api;

use App\Model\Config as ConfigModel;
use PhalApi\Api;
use PhalApi\Exception\BadRequestException;

class Config extends Api {
    public function getRules(): array {
        return [
            'ins' => \App\getParams([
                'code' => [
                    'name' => 'code',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 32,
                    'desc' => '代号',
                    'require' => true,
                ],
                'name' => [
                    'name' => 'name',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 32,
                    'desc' => '配置名称',
                ],
                'value' => [
                    'name' => 'value',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 256,
                    'desc' => '配置值',
                ],
                'desc' => [
                    'name' => 'desc',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 256,
                    'desc' => '配置描述',
                ],
            ]),
            'sel' => \App\getParams([
                'page' => ['require' => true],
                'limit' => ['require' => true],
            ]),
        ];
    }

    public function ins() {
        $params = \App\filterParams([
            'code' => \App\encodeString($this->code),
            'name' => \App\encodeString($this->name),
            'value' => \App\encodeString($this->value),
            'desc' => \App\encodeString($this->desc),
            'create_at' => $_SERVER['REQUEST_TIME'],
        ]);
        $res = ConfigModel::model()->ins($params);
        \PhalApi\DI()->response->setMsg('添加配置成功');

        return $res;
    }

    public function sel() {
        $params = \App\filterParams([
            'page' => $this->page,
            'limit' => $this->limit,
        ]);

        $select = ['id', 'code', 'name', 'value', 'desc', 'state', 'create_at', 'update_at'];

        $res = ConfigModel::model()->sel($params, $select);
        \PhalApi\DI()->response->setMsg('查询配置成功');

        return $res;
    }
}
