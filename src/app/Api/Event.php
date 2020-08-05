<?php

namespace App\Api;

use App\Model\Event as EventModel;
use PhalApi\Api;
use PhalApi\Exception\BadRequestException;

/**
 * 用户插件
 *
 * @author dogstar 20200331
 */
class Event extends Api {
    public function getRules(): array {
        $rules = [
            'address' => [
                'name' => 'address',
                'type' => 'string',
                'min' => 0,
                'max' => 32,
                'desc' => '地址',
            ],
            'year' => [
                'name' => 'year',
                'type' => 'string',
                'min' => 0,
                'max' => 32,
                'desc' => '年份',
            ],
        ];

        return [
            'ins' => \App\getParams([
                'title' => ['require' => true],
                'address' => [
                    'name' => 'address',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 32,
                    'desc' => '地址',
                    'require' => true,
                ],
                'year' => [
                    'name' => 'year',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 32,
                    'desc' => '年份',
                    'require' => true,
                ],
                'thumbnail' => ['require' => true],
            ]),
            'del' => \App\getParams([
                'id' => ['require' => true],
            ]),
            'upd' => \App\getParams([
                'id' => ['require' => true],
                'title' => [],
                'address' => [
                    'name' => 'address',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 32,
                    'desc' => '地址',
                ],
                'year' => [
                    'name' => 'year',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 32,
                    'desc' => '年份',
                ],
                'thumbnail' => [],
            ]),
            'sel' => \App\getParams([
                'page' => ['require' => true],
                'limit' => ['require' => true],
            ]),
            'detail' => \App\getParams([
                'id' => ['require' => true],
            ]),
        ];
    }

    public function ins() {
        $params = \App\filterParams([
            'title' => \App\encodeString($this->title),
            'thumbnail' => \App\encodeString($this->thumbnail),
            'address' => \App\encodeString($this->address),
            'year' => \App\encodeString($this->year),
            'create_at' => $_SERVER['REQUEST_TIME'],
            'user_id' => $_SESSION['user_id'],
        ]);
        $res = EventModel::model()->ins($params);
        \PhalApi\DI()->response->setMsg('添加事件成功');

        return $res;
    }

    public function del() {
        $params = \App\filterParams([
            'id' => $this->id,
        ]);
        $res = EventModel::model()->del($params);
        if ($res > 0) {
            \PhalApi\DI()->response->setMsg('删除事件成功');
        } else {
            \PhalApi\DI()->response->setMsg('删除事件失败');
        }

        return $res;
    }

    public function upd() {
        $idArray = ['id' => $this->id];
        $params = \App\filterParams([
            'title' => \App\encodeString($this->title),
            'address' => \App\encodeString($this->address),
            'year' => \App\encodeString($this->year),
            'thumbnail' => \App\encodeString($this->thumbnail),
            'update_at' => $_SERVER['REQUEST_TIME'],
        ]);

        $res = EventModel::model()->upd($idArray, $params);
        \PhalApi\DI()->response->setMsg('更新事件成功');

        return $res;
    }

    public function sel() {
        $params = \App\filterParams([
            'page' => $this->page,
            'limit' => $this->limit,
        ]);

        $select = ['id', 'user_id', 'title', 'thumbnail', 'address', 'year', 'state', 'create_at', 'update_at'];

        $res = EventModel::model()->sel($params, $select);
        \PhalApi\DI()->response->setMsg('查询事件成功');

        return $res;
    }

    public function detail() {
        $idArray = ['id' => $this->id];
        $select = ['id', 'user_id', 'thumbnail', 'title', 'state', 'create_at', 'update_at'];
        $res = EventModel::model()->detail($idArray, $select);

        return $res;
    }
}
