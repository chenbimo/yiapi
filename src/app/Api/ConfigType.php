<?php

namespace App\Api;

use App\Model\ConfigType as ConfigTypeModel;
use PhalApi\Api;
use PhalApi\Exception\BadRequestException;

/**
 * 用户插件
 *
 * @author dogstar 20200331
 */
class ConfigType extends Api {
    public function getRules(): array {
        return [
            'sel' => \App\getParams([
                'page' => ['require' => true],
                'limit' => ['require' => true],
            ]),
        ];
    }

    public function sel() {
        $params = \App\filterParams([
            'page' => $this->page,
            'limit' => $this->limit,
        ]);

        $select = ['id', 'code', 'name', 'state', 'create_at', 'update_at'];

        $res = ConfigTypeModel::model()->sel($params, $select);

        return $res;
    }
}
