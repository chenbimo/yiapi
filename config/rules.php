<?php

return [
    // id
    'id' => [
        'name' => 'id',
        'type' => 'int',
        'min' => 1,
        'max' => MAX_ID,
        'desc' => 'id',
    ],
    // 用户id
    'user_id' => [
        'name' => 'user_id',
        'type' => 'int',
        'min' => 0,
        'max' => MAX_ID,
        'desc' => '用户id',
    ],
    // 用户名
    'username' => [
        'name' => 'username',
        'type' => 'string',
        'min' => 1,
        'max' => 32,
        'desc' => '用户名',
        'regex' => '/^[0-9a-zA-Z]{1,32}$/i',
    ],
    // 昵称
    'nickname' => [
        'name' => 'nickname',
        'type' => 'string',
        'min' => 1,
        'max' => 32,
        'desc' => '昵称',
    ],
    // 密码
    'password' => [
        'name' => 'password',
        'type' => 'string',
        'min' => 2,
        'max' => 32,
        'desc' => '密码',
    ],
    // 第几页
    'page' => [
        'name' => 'page',
        'type' => 'int',
        'min' => 1,
        'max' => MAX_ID,
        'default' => 1,
        'desc' => '第几页',
    ],
    // 每页查询数
    'limit' => [
        'name' => 'limit',
        'type' => 'int',
        'min' => 1,
        'max' => 100,
        'default' => 20,
        'desc' => '每页查询数',
    ],
    // 缩略图
    'thumbnail' => [
        'name' => 'thumbnail',
        'type' => 'string',
        'min' => 0,
        'max' => 128,
        'desc' => '缩略图',
    ],
    // 头像
    'avatar' => [
        'name' => 'avatar',
        'type' => 'string',
        'min' => 0,
        'max' => 128,
        'desc' => '缩略图',
    ],
    // 描述
    'desc' => [
        'name' => 'desc',
        'type' => 'string',
        'min' => 0,
        'max' => 256,
        'desc' => '描述',
    ],
    // 内容
    'content' => [
        'name' => 'content',
        'type' => 'string',
        'min' => 0,
        'max' => 65535,
        'desc' => '内容',
    ],
    // 标题
    'title' => [
        'name' => 'title',
        'type' => 'string',
        'min' => 0,
        'max' => 128,
        'desc' => '内容',
    ],
    // 上传图片
    'file' => [
        'name' => 'file',
        'type' => 'file',
        'min' => 0,
        'max' => 1024 * 1024 * 10,
        'range' => ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'],
        'ext' => ['jpeg', 'png', 'jpg', 'gif'],
    ],
    // 邮箱
    'email' => [
        'name' => 'email',
        'type' => 'string',
        'min' => 3,
        'max' => 128,
        'desc' => '内容',
        'regex' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',
    ],
];
