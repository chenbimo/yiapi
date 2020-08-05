<?php

namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception\BadRequestException;

class Tool extends Api {
    public function getRules() {
        return [
            'uploadImage' => \App\getParams([
                'file' => [
                    'require' => true,
                ],
            ]),
        ];
    }

    /**
     * 上传图片
     *
     * @return void
     */
    public function uploadImage() {
        $tmpName = $this->file['tmp_name'];

        $name = md5($this->file['name'] . $_SERVER['REQUEST_TIME'] . mt_rand());
        $ext = strrchr($this->file['name'], '.');
        $relativePath = '/uploads/' . date('Ymd');
        $uploadFolder = API_ROOT . '/public' . $relativePath;
        if (!is_dir($uploadFolder)) {
            if (!mkdir($uploadFolder)) {
                throw new BadRequestException('创建上传目录失败');
            }
        }

        $imgPath = $uploadFolder . '/' . $name . $ext;
        if (!move_uploaded_file($tmpName, $imgPath)) {
            throw new BadRequestException('上传图片失败');
        }

        return [
            'url' => $relativePath . '/' . $name . $ext,
        ];
    }
}
