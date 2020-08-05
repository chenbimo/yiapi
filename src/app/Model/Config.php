<?php

namespace App\Model;

use App\Model\BaseModel;

class Config extends BaseModel {
    protected function getTableName($id) {
        return '`config`';
    }
}
