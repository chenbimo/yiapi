<?php

namespace App\Model;

use PhalApi\Model\DataModel;

class BaseModel extends DataModel {
    /**
     * 创建并获取当前Model实例
     *
     * @return \PhalApi\Model\DataModel 当前Model子类，继承于DataModel
     */
    public static function model() {
        return new static();
    }

    /**
     * 创建并获取当前Model对应的NotORM实例
     *
     * @return NotORM_Result NotORM实例
     */
    public static function notorm() {
        $model = self::model();

        return $model->getORM();
    }

    public function ins(array $params) {
        $orm = $this->getORM();
        $res = $orm->insert($params);

        return $res;
    }

    public function del(array $params) {
        $orm = $this->getORM();
        $res = $orm->where($params)->delete();

        return $res;
    }

    public function upd(array $idArray, array $params) {
        $orm = $this->getORM();
        $res = $orm->where($idArray)->update($params);

        return $res;
    }

    /**
     * 通用查询接口
     */
    public function sel(array $params, array $select): array {
        $orm = $this->getORM();
        $orm->select(\App\getFields($select));
        $orm->page($params['page'], $params['limit']);
        $res = $orm->fetchAll();
        $count = $orm->count();

        return [
            'lists' => $res,
            'total' => $count,
            'page' => $params['page'],
            'limit' => $params['limit'],
        ];
    }

    public function detail(array $idArray, array $select) {
        $orm = $this->getORM();
        $res = $orm->select(\App\getFields($select))->where($idArray)->fetchOne();

        return $res;
    }
}
