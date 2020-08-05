<?php

namespace App\Api;

use App\Model\Partner as PartnerModel;
use PhalApi\Api;
use PhalApi\Exception\BadRequestException;

/**
 * 用户插件
 *
 * @author dogstar 20200331
 */
class Partner extends Api {
    public function getRules(): array {
        return [
            'ins' => \App\getParams([
                'first_name' => [
                    'name' => 'first_name',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 32,
                    'desc' => 'first name',
                    'require' => true,
                ],
                'last_name' => [
                    'name' => 'last_name',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 32,
                    'desc' => 'last name',
                    'require' => true,
                ],
                'email' => ['require' => true],
                'code' => [
                    'name' => 'code',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 32,
                    'desc' => 'code',
                    'require' => true,
                ],
                'company' => [
                    'name' => 'company',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 128,
                    'desc' => 'company',
                    'require' => true,
                ],
                'story' => [
                    'name' => 'story',
                    'type' => 'string',
                    'min' => 0,
                    'max' => 512,
                    'desc' => 'story',
                    'require' => true,
                ],
            ]),
            'del' => \App\getParams([
                'id' => ['require' => true],
            ]),
            'upd' => \App\getParams([
                'id' => ['require' => true],
                'title' => [],
                'desc' => [],
                'thumbnail' => [],
                'content' => [],
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
            'first_name' => \App\encodeString($this->first_name),
            'last_name' => \App\encodeString($this->last_name),
            'email' => \App\encodeString($this->email),
            'code' => \App\encodeString($this->code),
            'company' => \App\encodeString($this->company),
            'story' => \App\encodeString($this->story),
            'create_at' => $_SERVER['REQUEST_TIME'],
        ]);
        $res = PartnerModel::model()->ins($params);
        \PhalApi\DI()->response->setMsg('添加伙伴申请成功');

        return $res;
    }

    public function del() {
        $params = \App\filterParams([
            'id' => $this->id,
        ]);
        $res = PartnerModel::model()->del($params);
        if ($res > 0) {
            \PhalApi\DI()->response->setMsg('删除合作申请成功');
        } else {
            \PhalApi\DI()->response->setMsg('删除合作申请失败');
        }

        return $res;
    }

    public function upd() {
        $idArray = ['id' => $this->id];
        $params = \App\filterParams([
            'title' => \App\encodeString($this->title),
            'thumbnail' => \App\encodeString($this->thumbnail),
            'content' => \App\encodeString($this->content),
            'update_at' => $_SERVER['REQUEST_TIME'],
        ]);

        $res = PartnerModel::model()->upd($idArray, $params);
        \PhalApi\DI()->response->setMsg('更新合作申请成功');

        return $res;
    }

    public function sel() {
        $params = \App\filterParams([
            'page' => $this->page,
            'limit' => $this->limit,
        ]);

        $select = ['id', 'first_name', 'last_name', 'code', 'email', 'company', 'story', 'state', 'create_at', 'update_at'];

        $res = PartnerModel::model()->sel($params, $select);
        \PhalApi\DI()->response->setMsg('查询合作申请成功');

        return $res;
    }

    public function detail() {
        $idArray = ['id' => $this->id];
        $select = ['id', 'user_id', 'thumbnail', 'title', 'content', 'desc', 'state', 'create_at', 'update_at'];
        $res = PartnerModel::model()->detail($idArray, $select);

        return $res;
    }
}
