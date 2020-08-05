<?php

namespace App\Api;

use App\Model\News as NewsModel;
use PhalApi\Api;
use PhalApi\Exception\BadRequestException;

/**
 * 用户插件
 *
 * @author dogstar 20200331
 */
class News extends Api {
    public function getRules(): array {
        return [
            'ins' => \App\getParams([
                'title' => ['require' => true],
                'thumbnail' => ['require' => true],
                'desc' => ['require' => true],
                'content' => ['require' => true],
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
            'title' => \App\encodeString($this->title),
            'thumbnail' => \App\encodeString($this->thumbnail),
            'desc' => \App\encodeString($this->desc),
            'content' => \App\encodeString($this->content),
            'create_at' => $_SERVER['REQUEST_TIME'],
            'user_id' => $_SESSION['user_id'],
        ]);
        $res = NewsModel::model()->ins($params);
        \PhalApi\DI()->response->setMsg('添加资讯成功');

        return $res;
    }

    public function del() {
        $params = \App\filterParams([
            'id' => $this->id,
        ]);
        $res = NewsModel::model()->del($params);
        if ($res > 0) {
            \PhalApi\DI()->response->setMsg('删除资讯成功');
        } else {
            \PhalApi\DI()->response->setMsg('删除资讯失败');
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

        $res = NewsModel::model()->upd($idArray, $params);
        \PhalApi\DI()->response->setMsg('更新资讯成功');

        return $res;
    }

    public function sel() {
        $params = \App\filterParams([
            'page' => $this->page,
            'limit' => $this->limit,
        ]);

        $select = ['id', 'thumbnail', 'desc', 'content', 'title', 'state', 'create_at', 'update_at'];

        $res = NewsModel::model()->sel($params, $select);
        \PhalApi\DI()->response->setMsg('查询资讯成功');

        return $res;
    }

    public function detail() {
        $idArray = ['id' => $this->id];
        $select = ['id', 'user_id', 'thumbnail', 'title', 'content', 'desc', 'state', 'create_at', 'update_at'];
        $res = NewsModel::model()->detail($idArray, $select);

        return $res;
    }
}
