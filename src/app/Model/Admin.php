<?php

namespace App\Model;

use App\Model\BaseModel;

class Admin extends BaseModel {
    protected function getTableName($id) {
        return '`admin`';
    }

    public function initAdmin(array $params) {
        $res = \App\Model\Admin::notorm()->insert($params);

        return $res;
    }

    /**
     * 获取用户简介
     */
    public function getProfileByUsername(string $username, array $select) {
        $res = \App\Model\Admin::notorm()->select(\App\getFields($select))->where('`username`', $username)->fetchOne();

        return $res;
    }

    public function updateAdminLogin(int $user_id) {
        $update = [
            'update_at' => $_SERVER['REQUEST_TIME'],
            'login_time' => $_SERVER['REQUEST_TIME'],
        ];
        $res = \App\Model\Admin::notorm()->where('`id`', $user_id)->update($update);

        return $res;
    }
}
