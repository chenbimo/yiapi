<?php

class UserRule implements I_Rule {
    public function Ins(): array {
        return [
            'username' => [
                'require' => true,
                'name' => 'username',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => 'username',
            ],
            'password' => [
                'require' => true,
                'name' => 'password',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => 'password',
            ],
        ];
    }

    public function Del(): array {
        return [
            'username' => [
                'require' => true,
                'name' => '用户名',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => '用户名',
            ],
            'username' => [
                'require' => true,
                'name' => '用户名',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => '用户名',
            ],
        ];
    }

    public function Upd(): array {
        return [
            'username' => [
                'require' => true,
                'name' => '用户名',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => '用户名',
            ],
            'username' => [
                'require' => true,
                'name' => '用户名',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => '用户名',
            ],
        ];
    }

    public function Sel(): array {
        return [
            'username' => [
                'require' => true,
                'name' => '用户名',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => '用户名',
            ],
            'username' => [
                'require' => true,
                'name' => '用户名',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => '用户名',
            ],
        ];
    }

    public function Detail(): array {
        return [
            'username' => [
                'require' => true,
                'name' => '用户名',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => '用户名',
            ],
            'username' => [
                'require' => true,
                'name' => '用户名',
                'type' => 'string',
                'min' => 2,
                'max' => 16,
                'default' => 'chensuiyi',
                'desc' => '用户名',
            ],
        ];
    }
}
