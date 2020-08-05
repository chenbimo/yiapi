<?php

namespace App\Model;

use App\Model\BaseModel;

class Event extends BaseModel {
    protected function getTableName($id) {
        return '`event`';
    }

    // 查询资讯接口
    // public function sel(array $params, array $select): array {
    //     $orm = \App\Model\Event::notorm();
    //     $orm->select(\App\getFields($select, 'A', 'B', ['avatar', 'username', 'nickname']))->alias('A')->leftJoin('admin', 'B', 'A.`user_id` = B.`id`')->order('A.`id` ASC');
    //     $orm->page($params['page'], $params['limit']);
    //     $res = $orm->fetchAll();
    //     $count = $orm->count();

    //     return [
    //         'lists' => $res,
    //         'total' => $count,
    //         'page' => $params['page'],
    //         'limit' => $params['limit'],
    //     ];
    // }
}
