<?php

namespace App\Api;

use App\Model\Admin as AdminModel;
use PhalApi\Api;
use PhalApi\Exception\BadRequestException;

/**
 * 用户插件
 *
 * @author dogstar 20200331
 */
class Admin extends Api {
    public function getRules(): array {
        return [
            'detail' => \App\getParams([
                'id' => ['require' => true],
            ]),
            'initAdmin' => \App\getParams([]),
            'login' => \App\getParams([
                'username' => [
                    'require' => true,
                ],
                'password' => [
                    'require' => true,
                ],
            ]),
            'ins' => \App\getParams([
                'username' => ['require' => true],
                'nickname' => ['require' => true],
                'password' => ['require' => true],
                'avatar' => ['require' => true],
            ]),
            'del' => \App\getParams([
                'id' => ['require' => true],
            ]),
            'upd' => \App\getParams([
                'id' => ['require' => true],
                'nickname' => [],
                'avatar' => [],
                'password' => [],
            ]),
            'sel' => \App\getParams([
                'page' => ['require' => true],
                'limit' => ['require' => true],
            ]),
        ];
    }

    public function initAdmin() {
        $salt = \PhalApi\Tool::createRandStr(32);
        $params = \App\filterParams([
            'username' => 'admin',
            'nickname' => '超级管理员',
            'role_code' => 0,
            'role_name' => 'super',
            'password' => \App\encryptPassword('admin', $salt),
            'avatar' => \App\encodeString($this->avatar),
            'salt' => $salt,
            'create_at' => $_SERVER['REQUEST_TIME'],
        ]);
        $res = AdminModel::model()->initAdmin($params);

        return $res;
    }

    public function detail() {
        $idArray = ['id' => $this->id];
        $select = ['id', 'avatar', 'username', 'nickname', 'role_code', 'login_time', 'state', 'create_at', 'update_at'];
        $res = AdminModel::model()->detail($idArray, $select);

        return $res;
    }

    public function sessionDetail() {
        $idArray = ['id' => $_SESSION['user_id']];
        $select = ['id', 'avatar', 'username', 'nickname', 'role_code', 'role_name', 'login_time', 'state', 'create_at', 'update_at'];
        $res = AdminModel::model()->detail($idArray, $select);

        return $res;
    }

    public function ins() {
        if ('super' !== $_SESSION['role_name']) {
            throw new BadRequestException('权限不足');
        }
        $salt = \PhalApi\Tool::createRandStr(32);
        $params = \App\filterParams([
            'username' => \App\encodeString($this->username),
            'nickname' => \App\encodeString($this->nickname),
            'password' => \App\encryptPassword($this->password, $salt),
            'role_code' => 1,
            'role_name' => 'admin',
            'avatar' => \App\encodeString($this->avatar),
            'create_at' => $_SERVER['REQUEST_TIME'],
        ]);
        $res = AdminModel::model()->ins($params);
        \PhalApi\DI()->response->setMsg('添加管理员成功');

        return $res;
    }

    public function del() {
        if ('super' !== $_SESSION['role_name']) {
            throw new BadRequestException('权限不足');
        }
        $params = \App\filterParams([
            'id' => $this->id,
        ]);
        $res = AdminModel::model()->del($params);
        if ($res > 0) {
            \PhalApi\DI()->response->setMsg('删除管理员成功');
        } else {
            \PhalApi\DI()->response->setMsg('删除管理员失败');
        }

        return $res;
    }

    public function upd() {
        $salt = \PhalApi\Tool::createRandStr(32);
        $idArray = ['id' => $this->id];
        $params = \App\filterParams([
            'nickname' => \App\encodeString($this->nickname),
            'avatar' => \App\encodeString($this->avatar),
            'update_at' => $_SERVER['REQUEST_TIME'],
        ]);
        if ($this->password) {
            $params['salt'] = $salt;
            $params['password'] = \App\encryptPassword($this->password, $salt);
        }
        $res = AdminModel::model()->upd($idArray, $params);
        \PhalApi\DI()->response->setMsg('更新管理员资料成功');

        return $res;
    }

    public function sel() {
        $params = \App\filterParams([
            'page' => $this->page,
            'limit' => $this->limit,
        ]);

        $select = ['id', 'avatar', 'username', 'username', 'nickname',  'state', 'create_at', 'update_at'];

        $res = AdminModel::model()->sel($params, $select);
        \PhalApi\DI()->response->setMsg('查询管理员列表成功');

        return $res;
    }

    public function login() {
        // 存在性判断
        $profile = AdminModel::model()->getProfileByUsername($this->username, ['id', 'username', 'password', 'role_code', 'role_name', 'state', 'salt']);
        if (false === $profile) {
            throw new BadRequestException('用户不存在');
        }

        // 密码判断
        $password = \App\encryptPassword($this->password, $profile['salt']);
        if ($profile['password'] !== $password) {
            throw new BadRequestException('密码错误');
        }

        // 更新登录
        $res = AdminModel::model()->updateAdminLogin($profile['id']);
        if (false === $res) {
            return false;
        }
        $_SESSION['user_id'] = $profile['id'];
        $_SESSION['username'] = $profile['username'];
        $_SESSION['role_code'] = $profile['role_code'];
        $_SESSION['role_name'] = $profile['role_name'];
        $_SESSION['state'] = $profile['state'];
        $res = [
            'id' => $profile['id'],
            'username' => $profile['username'],
            'role_code' => $profile['role_code'],
            'role_name' => $profile['role_name'],
            'state' => $profile['state'],
        ];
        \PhalApi\DI()->response->setMsg('登录成功');

        return $res;
    }
}
